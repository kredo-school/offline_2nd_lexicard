<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\CategoryController;


Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware" => "auth"], function() {
    Route::get('/category/show', [CategoryController::class, 'show'])->name('category.show');

//otherusers wordlist
    Route::get('/otheruser/category', [CategoryController::class, 'otheruser_index'])->name('otheruser.index');

    Route::resource('/word', WordController::class);
    Route::resource('/category', CategoryController::class)->except('show');

});
