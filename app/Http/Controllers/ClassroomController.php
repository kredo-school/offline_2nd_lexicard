<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;

class ClassroomController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('users.classroom.users.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('users.classroom.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Classroom $classroom)
    {
        return view('users.classroom.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classroom $classroom)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Classroom $classroom)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Classroom $classroom)
    {
        //
    }

    //Quiz
    public function quiz(){
        return view('users.classroom.quiz.index');
    }

    //Admin
    public function admin_index() {
        return view('users.classroom.admin.index');
    }

    public function admin_edit() {
        return view('users.classroom.admin.edit');
    }

    public function admin_category() {
        return view('users.classroom.admin.category');
    }

    public function admin_quiz() {
        return view('users.classroom.admin.quiz.index');
    }

    public function admin_quiz_create(Request $request) {
        $title = $request->title;
        $number = $request->number;

        return view('users.classroom.admin.quiz.create')
                ->with('title', $title)
                ->with('number', $number);
    }

    public function admin_quiz_show() {
        return view('users.classroom.admin.quiz.show');
    }
}
