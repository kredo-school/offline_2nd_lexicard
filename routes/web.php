<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ClassroomController;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware" => "auth"], function() {

    Route::group(['prefix' => 'category', 'as' => 'category.'], function(){
        Route::get('/category/show', [CategoryController::class, 'show'])->name('category.show');
        Route::resource('/category', CategoryController::class)->except('show');

        #Other User
        Route::get('/otheruser/category', [CategoryController::class, 'otheruser_index'])->name('otheruser.index');

    });


    Route::group(['prefix' => 'word', 'as' => 'word.'], function(){
        Route::resource('/word', WordController::class);
    });

    Route::group(['prefix' => 'quiz', 'as' => 'quiz.'], function(){
        Route::get('/quiz/show', [QuizController::class, 'show'])->name('quiz.show');
        Route::get('/quiz/result', [QuizController::class, 'result'])->name('quiz.result');
        Route::resource('/quiz', QuizController::class)->except('show');
    });

    Route::group(['prefix' => 'classroom', 'as' => 'classroom.'], function(){
        Route::get('/classroom/show', [ClassroomController::class,'show'])->name('classroom.show');

        #Quiz
        Route::get('/classroom/quiz', [ClassroomController::class, 'quiz'])->name('quiz.index');


        Route::resource('/classroom', ClassroomController::class)->except('show');
    });




});
