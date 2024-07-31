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
Route::get('/my_category', [App\Http\Controllers\HomeController::class, 'my_category'])->name('home.my_category');
Route::get('/liked', [App\Http\Controllers\HomeController::class, 'liked'])->name('home.liked');
Route::get('/popular', [App\Http\Controllers\HomeController::class, 'popular'])->name('home.popular');
Route::get('/otheruser', [App\Http\Controllers\HomeController::class, 'otheruser'])->name('home.other.user');

Route::group(["middleware" => "auth"], function() {

    Route::group(['prefix' => 'category', 'as' => 'category.'], function(){
        Route::resource('/category', CategoryController::class);

        #Other User
        Route::get('/otheruser/category', [CategoryController::class, 'otheruser_index'])->name('otheruser.index');
        Route::get('/otheruser/category/popular', [CategoryController::class, 'popular'])->name('otheruser.popular');
        Route::get('/otheruser/category/recent', [CategoryController::class,'recent'])->name('otheruser.recent');
        Route::get('/otheruser/category/search/user', [CategoryController::class,'search_user'])->name('otheruser.search_user');
        Route::get('/otheruser/category/search/category', [CategoryController::class,'search_category'])->name('otheruser.search_category');

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
        Route::get('/liked/{id}', [ClassroomController::class, 'liked'])->name('liked');
        Route::get('/popular/{id}', [ClassroomController::class, 'popular'])->name('popular');

        #Search
        Route::get('/search', [ClassroomController::class,'search'])->name('search');

        #Category
        Route::get('/category/{id}', [ClassroomController::class, 'category'])->name('category');

        #Word
        Route::get('/word/show/{id}', [ClassroomController::class, 'word_show'])->name('word.show');

        #Join
        Route::get('/join/{id}', [ClassroomController::class, 'join'])->name('join');
        Route::get('/leave/{id}', [ClassroomController::class, 'leave'])->name('leave');

        #Apply
        Route::get('/apply/{id}', [ClassroomController::class, 'apply'])->name('apply');
        Route::get('/apply/cancel/{id}', [ClassroomController::class, 'apply_cancel'])->name('apply.cancel');
        Route::get('/accept/{id}', [ClassroomController::class, 'accept'])->name('accept');
        Route::get('/reject/{id}', [ClassroomController::class,'reject'])->name('reject');

        #Quiz
        Route::get('/quiz/{id}', [ClassroomController::class, 'quiz'])->name('quiz.index');
        Route::get('/quiz/{quiz_title_id}/show', [ClassroomController::class, 'quiz_show'])->name('quiz.show');
        Route::get('/quiz/run/{num}', [ClassroomController::class, 'quiz_run'])->name('quiz.run');

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
            Route::get('/category/show/{id}', [ClassroomController::class, 'admin_category_show'])->name('category.show');
            Route::delete('/category/{id}/delete', [ClassroomController::class, 'admin_category_delete'])->name('category.delete');

            #Word
            Route::get('/word/show/{id}', [ClassroomController::class, 'admin_word_show'])->name('word.show');


            #Quiz
            Route::get('/quiz/{id}', [ClassroomController::class, 'admin_quiz'])->name('quiz');
            Route::get('/quiz/{id}/create', [ClassroomController::class, 'admin_quiz_create'])->name('quiz.create');
            Route::post('/quiz/{id}/store', [ClassroomController::class, 'admin_quiz_store'])->name('quiz.store');
            Route::get('/quiz/{id}/show', [ClassroomController::class, 'admin_quiz_show'])->name('quiz.show');
            Route::get('/quiz/{id}/add', [ClassroomController::class, 'admin_quiz_add'])->name('quiz.add');
            Route::patch('/quiz/{id}/update', [ClassroomController::class, 'admin_quiz_update'])->name('quiz.update');
            Route::delete('/quiz/{id}/delete', [ClassroomController::class, 'admin_quiz_delete'])->name('quiz.delete');
            Route::patch('/quiz/update/{question_id}', [ClassroomController::class, 'admin_quiz_question_update'])->name('quiz.question.update');
            Route::delete('/quiz/question/{question_id}/delete', [ClassroomController::class, 'admin_quiz_question_delete'])->name('quiz.question.delete');
        });
    });

    Route::group(['prefix' => 'profile', 'as' => 'profile.'], function(){
        Route::get('/{id}', [ProfileController::class, 'index'])->name('index');
        Route::get('/follow/{id}', [ProfileController::class, 'follow'])->name('follow');
        Route::get('/edit/{id}', [ProfileController::class, 'edit'])->name('edit');

        Route::get('/category/{category_id}', [ProfileController::class, 'category'])->name('category');
        Route::get('/word/{word_id}', [ProfileController::class, 'word'])->name('word');

        Route::resource('/profile', ProfileController::class)->except('index', 'edit');
    });

    Route::resource('/follow', FollowController::class);
    Route::resource('/like', LikeController::class);

});
