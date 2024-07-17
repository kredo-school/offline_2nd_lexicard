<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;





class ClassroomController extends Controller
{
    private $classroom;
    public function __construct(Classroom $classroom)
    {
        $this->classroom = $classroom;
    }

    public function index(Request $request)
    {
        // dd($this->classroom->userClassroom());

        if(isset($request->my_class)){
            $classrooms = $this->classroom->whereHas('userClassroom', function($query){
                $query->where('user_id', Auth::user()->id);
            })->get();
            $display = 'my_class';
        }else{
            $classrooms = $this->classroom->all();
            $display = 'all_class';
        }




        return view('users.classroom.users.index')
                ->with('classrooms', $classrooms)
                ->with('display', $display);
    }

    public function create()
    {
        return view('users.classroom.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'password' =>['required','confirmed']
        ]);

        $this->classroom->name = $request->name;
        $this->classroom->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        $this->classroom->description = $request->description;
        $this->classroom->status_id = $request->status;
        $this->classroom->password = Hash::make($request->password);
        $this->classroom->save();

        $classroom = $this->classroom->fresh();

        return redirect()->route('classroom.classroom.show', $classroom);
    }

    public function show(Classroom $classroom)
    {
        $classroom = $this->classroom->findOrFail($classroom->id);

        return view('users.classroom.users.show')
                ->with('classroom', $classroom);
    }

    //Join & Leave
    public function join($id) {
        $classroom = $this->classroom->findOrFail($id);

        $category_post[] = ["user_id" => Auth::id()];

        $classroom->userClassroom()->createMany($category_post);

        return redirect()->route('classroom.classroom.show', $classroom);
    }

    public function leave($id) {
        $classroom = $this->classroom->findOrFail($id);

        $classroom->userClassroom()->where('user_id', Auth::id())->delete();

        return redirect()->route('classroom.classroom.show', $classroom);
    }

    //Search
    public function search(Request $request) {
        $search = $request->classroom;
        $classrooms = $this->classroom->where('name', 'like', '%'.$search.'%')->get();

        return view('users.classroom.users.search')
                ->with('classrooms', $classrooms)
                ->with('search', $search);
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
