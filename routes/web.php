<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TestController;
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

Route::controller(TestController::class)->middleware('auth')->group(function(){
    Route::get('listes','index')->name('listes');
    Route::get('showArticle/{id}','showArticle')->name('showArticle');
    // Route::get('showArticle/{id}','showArticle')->name('showArticle');
    Route::get('addArticle','addArticle')->name('addArticle');
    Route::post('storeArticle','storeArticle')->name('storeArticle');
    Route::post('storeCommantaire/{id}','storeCommantaire')->name('storeCommantaire');
    Route::get('editArticle/{id}','editArticle')->name('editArticle');
    Route::patch('updateArticle/{id}','updateArticle')->name('updateArticle');
    Route::delete('deleteArticle/{id}','deleteArticle')->name('deleteArticle');
});
require __DIR__.'/auth.php';
