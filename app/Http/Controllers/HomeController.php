<?php

namespace App\Http\Controllers;

use App\Models\Devinette;
use App\Models\Quiz;

class HomeController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::public()->withCount('questions')->latest()->take(6)->get();
        $devinettes = Devinette::where('is_public', true)->latest()->take(6)->get();

        $stats = [
            'quizzes' => Quiz::public()->count(),
            'devinettes' => Devinette::where('is_public', true)->count(),
            'players' => \App\Models\QuizAttempt::count(),
        ];

        return view('home', compact('quizzes', 'devinettes', 'stats'));
    }
}
