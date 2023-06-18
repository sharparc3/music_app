<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MusicController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

Route::middleware(['auth'])->group(function () {
    // Music file routes
    Route::get('/musics/upload', [MusicController::class, 'create'])->name('musics.create');
    // Route::get('music-files/{id}/show', [MusicFileController::class, 'play'])->name('music-files.show');
    Route::get('musics/{id}', [MusicController::class, 'show'])->name('musics.show');
    Route::post('/musics', [MusicController::class, 'store'])->name('musics.store');
});
