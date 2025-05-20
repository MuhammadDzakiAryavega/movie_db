<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;

Route::get('/', [MovieController::class, 'index']);

Route::resource('movies', MovieController::class);

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MovieController;

// Route::get('/', [MovieController::class, 'index']);

// Route::resource('movies', MovieController::class);  

// Route::get('/movies/{id}', [MovieController::class, 'show'])->name('detail_movie');

// Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

// Route::get('/movie/create', [MovieController::class, 'create']);