<?php

use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
Route::view('dashboard', 'dashboard')->name('dashboard');
Route::livewire('/movies', 'pages::movies.index')->middleware(['auth'])->name('movies.index');
Route::livewire('/showtimes', 'pages::showtimes.index')->name('showtimes.index');
Route::livewire('/seats', 'pages::seats.index')->name('seats.index');
Route::livewire('/book-ticket', 'pages::bookings.index')->name('bookings.index');
});

require __DIR__.'/settings.php';