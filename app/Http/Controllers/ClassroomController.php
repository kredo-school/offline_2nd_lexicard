<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Classroom;
use App\Models\Like;
use App\Models\Quiz;
use App\Models\QuizTitle;
use App\Models\User;
use App\Models\Word;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;



class ClassroomController extends Controller
{
    private $classroom, $category, $quiz, $quizTitle, $word, $like;
    public function __construct(Classroom $classroom, Category $category, Word $word ,Quiz $quiz, QuizTitle $quizTitle, Like $like)
    {
        $this->classroom = $classroom;
        $this->category = $category;
        $this->word = $word;
        $this->quiz = $quiz;
        $this->quizTitle = $quizTitle;
        $this->like = $like;
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
            'name' => ['required','max:255'],
            'description' => ['max:255'],
            'status' => ['required'],
            'password' =>['required','confirmed']
        ]);

        $this->classroom->name = $request->name;
        if($request->image){
            $this->classroom->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        }
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

    public function liked($id)
    {
        $classroom = $this->classroom->findOrFail($id);

        $liked_ids = $this->like->where('user_id', Auth::id())->pluck('category_id');
        $categories = $classroom->categories()
                                ->whereHas('like', function($query) use ($liked_ids){
                                    $query->whereIn('category_id', $liked_ids);
                                })
                                ->get();


        return view('users.classroom.users.show')
                ->with('classroom', $classroom)
                ->with('categories', $categories);
    }

    public function popular($id)
    {
        $classroom = $this->classroom->findOrFail($id);
        $categories = $classroom->categories()->withCount('like')->orderBy('like_count', 'desc')->get();

        return view('users.classroom.users.show')
                ->with('classroom', $classroom)
                ->with('categories', $categories);
    }

    //Category
    public function category($id) {
        $category = $this->category->findOrFail($id);

        return view('users.category.index')
                ->with('category', $category);
    }

    //Word
    public function word_show($id) {
        $word = $this->word->where('id', $id)->first();

        $example = $word->example;

        $example = str_replace('{it}', '', $example);
        $example = str_replace('{/it}', '', $example);

        return view('users.category.show')
                ->with('word', $word)
                ->with('example', $example);
    }

    //Search
    public function search(Request $request) {
        $search = $request->classroom;
        $classrooms = $this->classroom->where('name', 'like', '%'.$search.'%')->get();

        return view('users.classroom.users.search')
                ->with('classrooms', $classrooms)
                ->with('search', $search);
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

    //Apply
    public function apply($id){
        $classroom = $this->classroom->findOrFail($id);

        $wait_list[] = ["user_id" => Auth::id()];

        $classroom->waitList()->createMany($wait_list);

        return redirect()->route('classroom.classroom.show', $classroom);
    }

    public function apply_cancel($id) {
        $classroom = $this->classroom->findOrFail($id);

        $classroom->waitList()->where('user_id', Auth::id())->delete();

        return redirect()->route('classroom.classroom.show', $classroom);
    }


    //Quiz
    public function quiz($id){
        $classroom = $this->classroom->findOrFail($id);

        return view('users.classroom.quiz.index')
                ->with('classroom', $classroom);
    }

    public function quiz_show($id) {
        $quizTitle = $this->quizTitle->findOrFail($id);

        $quizzes = $quizTitle->quizzes()->get();
        $quiz = [];

        $choices = [];
        $choices[] = $quizzes[0]->answer;
        $choices[] = $quizzes[0]->choice1;
        $choices[] = $quizzes[0]->choice2;
        $choices[] = $quizzes[0]->choice3;
        shuffle($choices);

        $quiz = [
            'question' => $quizzes[0]->question,
            'answer' => $quizzes[0]->answer,
            'choices' => [
                $choices[0],
                $choices[1],
                $choices[2],
                $choices[3]
            ]
        ];

        $selected = [];
        session(['quizzes' => $quizzes, 'selected' => $selected, 'quizTitle' => $quizTitle]);
        $num = 0;

        return view('users.classroom.quiz.run')
                ->with('num', $num)
                ->with('quiz', $quiz);

    }

    public function quiz_run($num, Request $request) {
        $quizzes = session('quizzes');
        $selected = session('selected');

        $selected[] = $request->choice;
        session(['selected' => $selected]);

        $num++;
        if($num < count($quizzes)){
            $choices = [];
            $choices[] = $quizzes[$num]->answer;
            $choices[] = $quizzes[$num]->choice1;
            $choices[] = $quizzes[$num]->choice2;
            $choices[] = $quizzes[$num]->choice3;
            shuffle($choices);

            $quiz = [];
            $quiz = [
                'question' => $quizzes[$num]->question,
                'answer' => $quizzes[$num]->answer,
                'choices' => [
                    $choices[0],
                    $choices[1],
                    $choices[2],
                    $choices[3]
                ]
            ];



            return view('users.classroom.quiz.run')
                    ->with('num', $num)
                    ->with('quiz', $quiz);
        }else{
            // result page
            $selected = session('selected');

            $correct_answers = 0;
            foreach($quizzes as $key => $quiz) {
                if($quiz['answer'] == $selected[$key]) {
                    $correct_answers++;
                }
            }

            return view('users.classroom.quiz.result')
                    ->with('quizzes', $quizzes)
                    ->with('selected', $selected)
                    ->with('correct_answers', $correct_answers);
        }



    }

    //Admin
    public function admin_index($id, Request $request) {
        $classroom = $this->classroom->findOrFail($id);

        if(isset($request->password)){
            if(password_verify($request->password, $classroom->password)){
                return view('users.classroom.admin.index')
                        ->with('classroom', $classroom);
            }else{
                return redirect()->route('classroom.classroom.show', $classroom)->with('error', 'Password is incorrect');
            }
        }

        return view('users.classroom.admin.index')
                ->with('classroom', $classroom);
    }

    public function admin_edit($id) {
        $classroom = $this->classroom->findOrFail($id);

        return view('users.classroom.admin.edit')
                ->with('classroom', $classroom);
    }



    public function admin_update(Request $request, $id) {
        $classroom = $this->classroom->findOrFail($id);

        $classroom->name = $request->name;
        $classroom->description = $request->description;
        if($request->image) {
            $classroom->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        }
        $classroom->status_id = $request->status;
        $classroom->save();

        return redirect()->route('classroom.admin.index', $classroom);
    }

    public function admin_delete($id) {
        $classroom = $this->classroom->findOrFail($id);
        $classroom->delete();

        return redirect()->route('classroom.classroom.index');
    }


    public function admin_user_delete($id, Request $request) {
        $classroom = $this->classroom->findOrFail($id);
        $classroom->userClassroom()->where('user_id', $request->user_id)->delete();

        return redirect()->back();
    }

    //Admin Category
    public function admin_category($id) {
        $classroom = $this->classroom->findOrFail($id);

        return view('users.classroom.admin.category.index')
                ->with('classroom', $classroom);
    }

    public function admin_category_store($id, Request $request) {
        $classroom = $this->classroom->findOrFail($id);

        $this->category->name = $request->category;
        $this->category->admin_id = 2;
        $this->category->classroom_id = $id;
        $this->category->save();

        return redirect()->route('classroom.admin.category', $classroom);
    }

    public function admin_category_show($id) {
        $category = $this->category->findOrFail($id);
        $classroom = $this->classroom->findOrFail($category->classroom_id);

        return view('users.category.index')
                ->with('category', $category)
                ->with('classroom', $classroom);
    }

    public function admin_category_delete($id) {
        $category = $this->category->findOrFail($id);
        $category->delete();

        return redirect()->route('classroom.admin.category', $category->classroom_id);
    }

    //Admin Word
    public function admin_word_show($id) {
        $word = $this->word->findOrFail($id);

        $example = $word->where('id', $word->id)->first()->example;

        $example = str_replace('{it}', '', $example);
        $example = str_replace('{/it}', '', $example);

        $category_id = $word->categoryWord()->first()->category_id;
        $category = $this->category->findOrFail($category_id);
        $classroom = $this->classroom->findOrFail($category->classroom_id);

        return view('users.category.show')
                ->with('word', $word)
                ->with('example', $example)
                ->with('classroom', $classroom);
    }

    //Admin Accept
    public function accept($id){
        $classroom = $this->classroom->findOrFail($id);

        $classroom->waitList()->where('user_id', Auth::id())->delete();

        $category_post[] = ["user_id" => Auth::id()];
        $classroom->userClassroom()->createMany($category_post);

        return redirect()->route('classroom.admin.index', $classroom);
    }

    public function reject($id){
        $classroom = $this->classroom->findOrFail($id);

        $classroom->waitList()->where('user_id', Auth::id())->delete();

        return redirect()->route('classroom.admin.index', $classroom);
    }

    //Admin Quiz
    public function admin_quiz($id) {
        $classroom = $this->classroom->findOrFail($id);

        return view('users.classroom.admin.quiz.index')
                ->with('classroom', $classroom);
    }

    public function admin_quiz_create($id, Request $request) {
        $classroom = $this->classroom->findOrFail($id);
        $title = $request->title;
        $number = $request->number;

        return view('users.classroom.admin.quiz.create')
                ->with('classroom', $classroom)
                ->with('title', $title)
                ->with('number', $number);
    }

    public function admin_quiz_store($id, Request $request) {
        $classroom = $this->classroom->findOrFail($id);

        $this->quizTitle->title = $request->title;
        if($request->image){
            $this->quizTitle->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        }
        $this->quizTitle->class_id = $id;
        $this->quizTitle->save();

        foreach($request->question as $key => $question) {

            $this->quiz->create([
                "question" => $question,
                "answer" => $request->answer[$key],
                "choice1" => $request->choice1[$key],
                "choice2" => $request->choice2[$key],
                "choice3" => $request->choice3[$key],
                "title_id" => $this->quizTitle->id,
            ]);
        }

        return redirect()->route('classroom.admin.quiz', $classroom->id);
    }

    public function admin_quiz_show($id) {
        $quiz_title = $this->quizTitle->findOrFail($id);
        $classroom = $quiz_title->classroom()->first();


        return view('users.classroom.admin.quiz.show')
                ->with('classroom', $classroom)
                ->with('quiz_title', $quiz_title);
    }

    public function admin_quiz_add($id, Request $request) {
        $quiz = $this->quiz;
        $quiz->title_id = $id;
        $quiz->question = $request->question;
        $quiz->answer = $request->answer;
        $quiz->choice1 = $request->choice1;
        $quiz->choice2 = $request->choice2;
        $quiz->choice3 = $request->choice3;
        $quiz->save();

        return redirect()->back();
    }

    public function admin_quiz_update($id, Request $request) {
        $quiz_title = $this->quizTitle->findOrFail($id);

        $quiz_title->title = $request->title;
        if($request->image){
            $quiz_title->image = 'data:image/'.$request->image->extension().';base64,'.base64_encode(file_get_contents($request->image));
        }
        $quiz_title->save();

        return redirect()->route('classroom.admin.quiz.show', $quiz_title->id);
    }

    public function admin_quiz_delete($id, Request $request) {
        $classroom = $this->classroom->findOrFail($id);
        $quiz_title = $this->quizTitle->findOrFail($request->title);

        $quiz_title->delete();

        return redirect()->route('classroom.admin.quiz', $classroom->id);
    }

    public function admin_quiz_question_update($id, Request $request) {
        $quiz = $this->quiz->findOrFail($id);

        $quiz->question = $request->question;
        $quiz->answer = $request->answer;
        $quiz->choice1 = $request->choice1;
        $quiz->choice2 = $request->choice2;
        $quiz->choice3 = $request->choice3;
        $quiz->save();

        return redirect()->back();
    }

    public function admin_quiz_question_delete($id) {
        $quiz = $this->quiz->findOrFail($id);

        $quiz->delete();

        return redirect()->back();
    }


}
