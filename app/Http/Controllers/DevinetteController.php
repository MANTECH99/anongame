<?php

namespace App\Http\Controllers;

use App\Models\Devinette;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DevinetteController extends Controller
{
    public function index(Request $request)
    {
        $query = Devinette::where('is_public', true);

        if ($request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        $devinettes = $query->latest()->paginate(12);

        $categories = [
            'general' => 'Général',
            'culture' => 'Culture',
            'enigma' => 'Énigmes',
            'maths' => 'Mathématiques',
            'logique' => 'Logique',
        ];

        return view('devinette.index', compact('devinettes', 'categories'));
    }

    public function create()
    {
        return view('devinette.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'question' => 'required|string',
            'answer' => 'required|string|max:255',
            'hint' => 'nullable|string',
            'category' => 'required|string',
        ]);

        Devinette::create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'question' => $data['question'],
            'answer' => $data['answer'],
            'hint' => $data['hint'] ?? null,
            'category' => $data['category'],
            'slug' => Str::slug($data['title']).'-'.Str::random(5),
            'is_public' => true,
        ]);

        return redirect()->route('devinette.index')->with('success', 'Devinette publiée !');
    }

    public function show(Devinette $devinette)
    {
        $devinette->load('user');
        $devinette->increment('challenges');

        return view('devinette.show', compact('devinette'));
    }

    public function solve(Request $request, Devinette $devinette)
    {
        $answer = strtolower(trim($request->input('answer')));

        $correct = strtolower(trim($devinette->answer));

        $isCorrect = $answer === $correct
            || $answer === Str::ascii($correct)
            || Str::contains(Str::ascii($correct), $answer)
            || Str::contains($answer, Str::ascii($correct));

        if ($isCorrect) {
            $devinette->increment('successes');

            return back()->with('success', 'Bonne réponse ! 🎉');
        }

        return back()->with('error', 'Mauvaise réponse, essaie encore !');
    }

    public function my()
    {
        $devinettes = auth()->user()->devinettes()->latest()->get();

        return view('devinette.my', compact('devinettes'));
    }
}
