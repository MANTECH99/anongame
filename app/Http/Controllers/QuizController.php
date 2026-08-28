<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Quiz;
use App\Models\QuizAttempt;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class QuizController extends Controller
{
    public function index(Request $request)
    {
        $query = Quiz::public()->withCount('questions');

        if ($request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }

        if ($request->search) {
            $query->where('title', 'like', '%'.$request->search.'%');
        }

        $quizzes = $query->with('user')->latest()->paginate(9);

        $categories = [
            'general' => 'Général',
            'culture' => 'Culture sénégalaise',
            'football' => 'Football',
            'geographie' => 'Géographie',
            'musique' => 'Musique',
            'histoire' => 'Histoire',
        ];

        return view('quiz.index', compact('quizzes', 'categories'));
    }

    public function show(Quiz $quiz)
    {
        $quiz->load('questions', 'user');
        $total = $quiz->questions->count();

        return view('quiz.show', compact('quiz', 'total'));
    }

    public function create()
    {
        return view('quiz.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'category' => 'required|string',
            'questions' => 'required|array|min:1',
            'questions.*.question' => 'required|string',
            'questions.*.options' => 'required|array|min:2',
            'questions.*.correct' => 'required|integer',
        ]);

        $quiz = Quiz::create([
            'user_id' => auth()->id(),
            'title' => $data['title'],
            'description' => $data['description'] ?? null,
            'category' => $data['category'],
            'slug' => Str::slug($data['title']).'-'.Str::random(6),
            'is_public' => true,
        ]);

        foreach ($data['questions'] as $q) {
            $quiz->questions()->create([
                'question' => $q['question'],
                'options' => $q['options'],
                'correct_index' => $q['correct'],
                'points' => 10,
            ]);
        }

        return redirect()->route('quiz.show', $quiz)->with('success', 'Quiz créé avec succès !');
    }

    public function play(Quiz $quiz)
    {
        $quiz->load('questions');

        return view('quiz.play', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
    {
        $quiz->load('questions');

        $answers = $request->input('answers', []);
        $playerName = $request->input('player_name', 'Anonyme');

        $score = 0;
        $total = 0;
        $details = [];

        foreach ($quiz->questions as $question) {
            $total += $question->points;
            $selected = $answers[$question->id] ?? null;
            $correct = (int) $selected === (int) $question->correct_index;

            if ($correct) {
                $score += $question->points;
            }

            $details[] = [
                'question_id' => $question->id,
                'selected' => $selected,
                'correct' => $correct,
            ];
        }

        $attempt = QuizAttempt::create([
            'quiz_id' => $quiz->id,
            'user_id' => auth()->id(),
            'player_name' => $playerName,
            'score' => $score,
            'total' => $total,
            'answers' => $details,
        ]);

        $quiz->increment('plays');

        return redirect()->route('quiz.result', $attempt->id);
    }

    public function result(QuizAttempt $attempt)
    {
        $attempt->load('quiz');

        return view('quiz.result', compact('attempt'));
    }

    public function rankings(Quiz $quiz)
    {
        $attempts = QuizAttempt::where('quiz_id', $quiz->id)
            ->orderByDesc('score')
            ->orderBy('time_taken')
            ->take(50)
            ->get();

        return view('quiz.rankings', compact('attempts', 'quiz'));
    }

    public function my()
    {
        $quizzes = auth()->user()->quizzes()->withCount('questions')->latest()->get();

        return view('quiz.my', compact('quizzes'));
    }
}
