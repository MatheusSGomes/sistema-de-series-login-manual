<?php

use Illuminate\Support\Facades\Route;
use App\Http\Middleware\Autenticador;
use App\Http\Controllers\{
    SeriesController,
    SeasonsController,
    EpisodesController,
    LoginController,
    UsersController
};


Route::get('/', function () {
    return redirect('/series');
})->middleware(Autenticador::class);

Route::resource('/series', SeriesController::class)
    ->except(['show']);


Route::middleware('autenticador')->group(function() {
    Route::get('/series/{serie}/seasons', [SeasonsController::class, 'index'])
        ->name('seasons.index');
    
    Route::get('seasons/{season}/episodes', [EpisodesController::class, 'index'])->name('episodes.index');
    
    Route::post('seasons/{season}/episodes', [EpisodesController::class, 'update'])
    ->name('episodes.update');
});


Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store'])->name('signin');
Route::get('/logout', [LoginController::class, 'destroy'])->name('logout');

Route::get('/register', [UsersController::class, 'create'])->name('users.create');
Route::post('/register', [UsersController::class, 'store'])->name('users.store');

// Route::delete('/series/destroy/{id}', [SeriesController::class, 'destroy'])->name('series.destroy');

// Route::controller(SeriesController::class)->group(function () {
//     Route::get('/series', 'index')->name('series.index');
//     Route::get('/series/criar', 'create')->name('series.create');
//     Route::post('/series/salvar', 'store')->name('series.store');
// });
