<?php

namespace App\Http\Controllers;

use App\Models\Devinette;
use App\Models\Quiz;
use Illuminate\Http\Request;

class ShareController extends Controller
{
    protected function waUrl(string $phone, string $text): string
    {
        $phone = preg_replace('/[^0-9]/', '', $phone);
        $phone = str_starts_with($phone, '221') ? $phone : '221'.$phone;

        return 'https://wa.me/'.$phone.'?text='.urlencode($text);
    }

    public function quiz(Request $request, Quiz $quiz)
    {
        $url = route('quiz.show', $quiz->slug);
        $text = $request->input('text') ?: "🎯 Défi quiz : {$quiz->title} ! Peux-tu battre mon score ? Joue ici : {$url}";

        $phone = $request->input('phone', '');

        if ($phone) {
            return redirect()->away($this->waUrl($phone, $text));
        }

        return view('share.quiz', compact('quiz', 'url', 'text'));
    }

    public function devinette(Request $request, Devinette $devinette)
    {
        $url = route('devinette.show', $devinette->slug);
        $text = $request->input('text') ?: "🤔 Devinette anonyme : {$devinette->title} ! Trouve la réponse ici : {$url}";

        $phone = $request->input('phone', '');

        if ($phone) {
            return redirect()->away($this->waUrl($phone, $text));
        }

        return view('share.devinette', compact('devinette', 'url', 'text'));
    }

    public function anonymousLink(Request $request, string $slug)
    {
        $url = route('anonymous.send', $slug);
        $text = $request->input('text') ?: "💬 Envoie-moi un message anonyme ! (dis ce que tu penses vraiment) : {$url}";

        $phone = $request->input('phone', '');

        if ($phone) {
            return redirect()->away($this->waUrl($phone, $text));
        }

        return view('share.anonymous', compact('slug', 'url', 'text'));
    }
}
