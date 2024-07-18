<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\WordController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\FollowController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\ProfileController;



Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(["middleware" => "auth"], function() {

    Route::group(['prefix' => 'category', 'as' => 'category.'], function(){
        Route::resource('/category', CategoryController::class);

        #Other User
        Route::get('/otheruser/category', [CategoryController::class, 'otheruser_index'])->name('otheruser.index');

    });


    Route::group(['prefix' => 'word', 'as' => 'word.'], function(){
        Route::get('/word/store_more', [WordController::class,'store_more'])->name('word.store_more');

        Route::resource('/word', WordController::class);
    });

    Route::group(['prefix' => 'quiz', 'as' => 'quiz.'], function(){
        Route::get('/show', [QuizController::class, 'show'])->name('quiz.show');
        Route::get('/run/{num}', [QuizController::class, 'runQuizzes'])->name('quiz.run');
        Route::get('/JtoEFlashcards/{num}', [QuizController::class, 'runJtoEFlashcards'])->name('quiz.jtoe');
        Route::get('/EtoJFlashcards/{num}', [QuizController::class, 'runEtoJFlashcards'])->name('quiz.etoj');

        Route::resource('/quiz', QuizController::class)->except('show');

    });

    Route::group(['prefix' => 'classroom', 'as' => 'classroom.'], function(){
        Route::resource('/classroom', ClassroomController::class);

        #Search
        Route::get('/search', [ClassroomController::class,'search'])->name('search');

        #Join
        Route::get('/join/{id}', [ClassroomController::class, 'join'])->name('join');
        Route::get('/leave/{id}', [ClassroomController::class, 'leave'])->name('leave');

        #Quiz
        Route::get('/classroom/quiz', [ClassroomController::class, 'quiz'])->name('quiz.index');

        #Admin
        Route::group(['prefix' => 'admin', 'as' => 'admin.'], function(){
            Route::get('/{id}', [ClassroomController::class, 'admin_index'])->name('index');
            Route::get('/edit/{id}', [ClassroomController::class, 'admin_edit'])->name('edit');
            Route::get('/update/{id}', [ClassroomController::class, 'admin_update'])->name('update');
            Route::get('/delete/{id}', [ClassroomController::class, 'admin_delete'])->name('delete');

            #User
            Route::get('/user/delete/{id}', [ClassroomController::class, 'admin_user_delete'])->name('user.delete');

            #Category
            Route::get('/category/{id}', [ClassroomController::class, 'admin_category'])->name('category');
            Route::get('/category/store/{id}', [ClassroomController::class, 'admin_category_store'])->name('category.store');

            #Quiz
            Route::get('/quiz/{id}', [ClassroomController::class, 'admin_quiz'])->name('quiz');
            Route::get('/quiz/create', [ClassroomController::class, 'admin_quiz_create'])->name('quiz.create');
            Route::get('/quiz/show', [ClassroomController::class, 'admin_quiz_show'])->name('quiz.show');
        });
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function(){
        Route::get('/profile/follow', [ProfileController::class, 'follow'])->name('follow');
        Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');

        Route::resource('/profile', ProfileController::class)->except('edit');
    });

    Route::resource('/follow', FollowController::class);
    Route::resource('/like', LikeController::class);

});
