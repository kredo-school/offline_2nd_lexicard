<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index() {
        return view('users.quiz.index');
    }

    public function show(Request $request) {
        if($request->format == "JtoEQ") {
            return view('users.quiz.quiz.j_to_e');
        }else if($request->format == "EtoJQ") {
            return view('users.quiz.quiz.e_to_j');
        }else if($request->format == "FillQ") {
            return view('users.quiz.quiz.fill_in_the_blank');
        }else if($request->format == "JtoEF") {
            return view('users.quiz.flashcard.j_to_e');
        }else{
            return view('users.quiz.flashcard.j_to_e');
        }

    }

    public function result() {
        return view('users.quiz.result');
    }
}
