<?php

use App\Http\Controllers\AdController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('/acceuil', [AdController::class, 'index'])->name('acceuil');
Route::get('/annonce/creer',[AdController::class, 'create'])->name('ads.create');
Route::post('/annonce/enregistrer',[AdController::class, 'store'])->name('ads.store');
Route::get('/annonce/{id}/modifier',[AdController::class, 'edit'])->name('ads.edit');
Route::post('/annonce/{id}/update',[AdController::class, 'update'])->name('ads.update');
Route::post('/annonce/{id}/supprimer',[AdController::class, 'destroy'])->name('ads.destroy');