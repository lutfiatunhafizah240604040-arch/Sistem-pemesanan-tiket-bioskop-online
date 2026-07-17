<?php

use App\Http\Controllers\RoleSwitchController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');
Route::middleware(['auth'])->post('/switch-role', [RoleSwitchController::class, 'switch'])->name('switch.role');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');
    Route::livewire('/book-ticket', 'pages::bookings.index')->name('bookings.index');
    Route::view('/payments', 'pages.payments.index')->name('payments.index');

    Route::livewire('/movies', 'pages::movies.index')->name('movies.index');
    Route::livewire('/showtimes', 'pages::showtimes.index')->name('showtimes.index');

    Route::middleware(['role:admin'])->group(function () {
        Route::livewire('/seats', 'pages::seats.index')->name('seats.index');
    });
});

require __DIR__.'/settings.php';