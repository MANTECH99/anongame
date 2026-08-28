<?php

use App\Http\Controllers\AnonymousController;
use App\Http\Controllers\DevinetteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ShareController;
use Illuminate\Support\Facades\Route;

Route::get('/manifest.webmanifest', function () {
    return response(file_get_contents(public_path('manifest.json')), 200, [
        'Content-Type' => 'application/manifest+json; charset=utf-8',
        'Cache-Control' => 'public, max-age=86400',
    ]);
})->name('manifest');

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/* ---------------- Quiz ---------------- */
Route::get('/quiz', [QuizController::class, 'index'])->name('quiz.index');
Route::get('/quiz/create', [QuizController::class, 'create'])->middleware('auth')->name('quiz.create');
Route::post('/quiz', [QuizController::class, 'store'])->middleware('auth')->name('quiz.store');
Route::get('/quiz/{quiz:slug}', [QuizController::class, 'show'])->name('quiz.show');
Route::get('/quiz/{quiz:slug}/play', [QuizController::class, 'play'])->name('quiz.play');
Route::post('/quiz/{quiz:slug}/submit', [QuizController::class, 'submit'])->name('quiz.submit');
Route::get('/quiz/{quiz:slug}/rankings', [QuizController::class, 'rankings'])->name('quiz.rankings');
Route::get('/mon-quiz', [QuizController::class, 'my'])->middleware('auth')->name('quiz.my');
Route::get('/result/{attempt}', [QuizController::class, 'result'])->name('quiz.result');

/* ---------------- Devinettes ---------------- */
Route::get('/devinette', [DevinetteController::class, 'index'])->name('devinette.index');
Route::get('/devinette/create', [DevinetteController::class, 'create'])->middleware('auth')->name('devinette.create');
Route::post('/devinette', [DevinetteController::class, 'store'])->middleware('auth')->name('devinette.store');
Route::get('/devinette/{devinette:slug}', [DevinetteController::class, 'show'])->name('devinette.show');
Route::post('/devinette/{devinette:slug}/solve', [DevinetteController::class, 'solve'])->name('devinette.solve');
Route::get('/mes-devinettes', [DevinetteController::class, 'my'])->middleware('auth')->name('devinette.my');

/* ---------------- Anonymous ---------------- */
Route::middleware('auth')->group(function () {
    Route::get('/anon', [AnonymousController::class, 'dashboard'])->name('anonymous.dashboard');
    Route::post('/anon', [AnonymousController::class, 'store'])->name('anonymous.store');
    Route::get('/anon/link/{link}', [AnonymousController::class, 'messages'])->name('anonymous.messages');
    Route::patch('/anon/link/{link}/toggle', [AnonymousController::class, 'toggle'])->name('anonymous.toggle');
});

/* Public anonymous page */
Route::get('/anon/{link:slug}/send', [AnonymousController::class, 'send'])->name('anonymous.send');
Route::post('/anon/{link:slug}/send', [AnonymousController::class, 'submit'])->name('anonymous.submit');
Route::get('/anon/thanks/{slug}', [AnonymousController::class, 'thanks'])->name('anonymous.thanks');

/* ---------------- Partage WhatsApp ---------------- */
Route::match(['get', 'post'], '/share/quiz/{quiz:slug}', [ShareController::class, 'quiz'])->name('share.quiz');
Route::match(['get', 'post'], '/share/devinette/{devinette:slug}', [ShareController::class, 'devinette'])->name('share.devinette');
Route::match(['get', 'post'], '/share/anon/{slug}', [ShareController::class, 'anonymousLink'])->name('share.anonymous');

/* ---------------- Profile ---------------- */
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
