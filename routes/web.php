<?php

use App\Http\Controllers\ProfileController;
use Core\Frontend\DTO\Navigation;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'navigation' => Navigation::loadFromFile(__DIR__ . '/../resources/data/navigations.php', 'main'),
    ]);
})->name("home");

Route::get('/about', function () {
    return "About page";
})->name("about");

Route::get('/contact', function () {
    return "Contact page";
})->name("contact");


/*
 * Authenticated routes
 */
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', fn() => view('dashboard'))->middleware(['verified'])->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
