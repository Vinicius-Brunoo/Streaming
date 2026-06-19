<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MusicaController;
use App\Http\Controllers\PlaylistController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('musicas.index');
});

Route::middleware('guest')->group(function (): void {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.store');
    Route::get('/cadastro', [AuthController::class, 'showRegister'])->name('register');
    Route::post('/cadastro', [AuthController::class, 'register'])->name('register.store');
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->middleware('auth')
    ->name('logout');

Route::resource('musicas', MusicaController::class)->only(['index']);
Route::resource('playlists', PlaylistController::class)->only(['index']);

Route::middleware('auth')->group(function (): void {
    Route::resource('musicas', MusicaController::class)->except(['index', 'show']);
    Route::resource('playlists', PlaylistController::class)->except(['index', 'show']);
});

Route::resource('musicas', MusicaController::class)->only(['show']);
Route::resource('playlists', PlaylistController::class)->only(['show']);
