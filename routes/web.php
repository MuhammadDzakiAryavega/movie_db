<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\AuthController;

Route::resource('/movies', MoviesController::class);

Route::get('/movie/{id}/{slug}', [MoviesController::class, 'detailMovie']);

Route::get('/movies/create', [MoviesController::class, 'create'])->middleware('auth');

Route::get('/movie/create', [MoviesController::class, 'store']);

Route::get('/login', [AuthController::class, 'formlogin'])->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/view', [MoviesController::class, 'listMovie']);

Route::get('/{id}/{slug}/edit', [MoviesController::class, 'edit']);

// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\MovieController;

// Route::get('/', [MovieController::class, 'index']);

// Route::resource('movies', MovieController::class);  

// Route::get('/movies/{id}', [MovieController::class, 'show'])->name('detail_movie');

// Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

// Route::get('/movie/create', [MovieController::class, 'create']);