<?php

use App\Http\Controllers\PollController;
use App\Http\Controllers\ProfileController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::get('/handbuch', function () {
    return view('handbuch');
})->name('handbuch');

Route::get('/about-me', function () {
    return view('about_me');
})->name('about_me');

Route::post('/about-me/avatar', function (Request $request) {
    $request->validate([
        'avatar' => 'required|image|max:10240',
    ]);
    $file = $request->file('avatar');
    $file->move(public_path('images'), 'robert_hofer.jpg');

    return back()->with('success', 'Profilbild erfolgreich gespeichert!');
})->name('about_me.avatar');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [PollController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Polls (Auth required for creation & deletion)
    Route::get('/polls', [PollController::class, 'index'])->name('polls.index');
    Route::get('/polls/create', [PollController::class, 'create'])->name('polls.create');
    Route::post('/polls', [PollController::class, 'store'])->name('polls.store');
    Route::delete('/polls/{uuid}', [PollController::class, 'destroy'])->name('polls.destroy');
});

// Public poll routes (No auth required to vote)
Route::get('/p/{uuid}', [PollController::class, 'show'])->name('polls.show');
Route::post('/p/{uuid}/vote', [PollController::class, 'storeVote'])->name('polls.vote');
Route::post('/p/{uuid}/vote/{edit_token}', [PollController::class, 'updateVote'])->name('polls.vote.update');

require __DIR__.'/auth.php';
