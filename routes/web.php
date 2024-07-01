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

        #Admin
        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
            Route::get('/', [ClassroomController::class, 'admin_index'])->name('index');
            Route::get('/edit', [ClassroomController::class, 'admin_edit'])->name('edit');
            Route::get('/category', [ClassroomController::class, 'admin_category'])->name('category');
            Route::get('/quiz', [ClassroomController::class, 'admin_quiz'])->name('quiz');
            Route::get('/quiz/create', [ClassroomController::class, 'admin_quiz_create'])->name('quiz.create');
            Route::get('/quiz/show', [ClassroomController::class, 'admin_quiz_show'])->name('quiz.show');
        });


        Route::resource('/classroom', ClassroomController::class)->except('show');
    });




});
