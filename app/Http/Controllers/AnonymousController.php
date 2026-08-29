<?php

namespace App\Http\Controllers;

use App\Models\AnonymousLink;
use App\Models\AnonymousMessage;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AnonymousController extends Controller
{
    protected function requireAuth(): void
    {
        if (! auth()->check()) {
            abort(redirect()->guest(route('login')));
        }
    }

    public function dashboard()
    {
        $this->requireAuth();

        $links = auth()->user()->anonymousLinks;

        return view('anonymous.dashboard', compact('links'));
    }

    public function store(Request $request)
    {
        $this->requireAuth();

        $data = $request->validate([
            'title' => 'nullable|string|max:100',
        ]);

        $slug = Str::random(8);

        while (AnonymousLink::where('slug', $slug)->exists()) {
            $slug = Str::random(8);
        }

        $link = auth()->user()->anonymousLinks()->create([
            'slug' => $slug,
            'title' => $data['title'] ?? auth()->user()->name,
            'is_active' => true,
        ]);

        return redirect()->route('anonymous.dashboard')->with('success', 'Lien créé ! Partage-le sur WhatsApp.');
    }

    public function send(AnonymousLink $link)
    {
        return view('anonymous.send', compact('link'));
    }

    public function submit(Request $request, AnonymousLink $link)
    {
        $data = $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        AnonymousMessage::create([
            'anonymous_link_id' => $link->id,
            'content' => $data['content'],
            'sender_name' => 'Anonyme',
            'is_read' => false,
        ]);

        $link->increment('message_count');

        return redirect()->route('anonymous.thanks', $link->slug);
    }

    public function thanks($slug)
    {
        $link = AnonymousLink::where('slug', $slug)->firstOrFail();

        return view('anonymous.thanks', compact('link'));
    }

    public function messages(AnonymousLink $link)
    {
        $this->requireAuth();

        abort_unless($link->user_id === auth()->id(), 403);

        $link->load('messages');

        $link->messages()->where('is_read', false)->update(['is_read' => true]);

        return view('anonymous.messages', compact('link'));
    }

    public function toggle(AnonymousLink $link, Request $request)
    {
        $this->requireAuth();

        abort_unless($link->user_id === auth()->id(), 403);

        $link->update(['is_active' => ! $link->is_active]);

        if ($request->expectsJson()) {
            return response()->json(['active' => $link->is_active]);
        }

        return back();
    }
}
