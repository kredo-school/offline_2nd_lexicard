<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\QuizResult;
use App\Models\Word;
use Illuminate\Support\Facades\Auth;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    private $category, $word, $quizResult;
    public function __construct(Category $category, Word $word, QuizResult $quizResult)
    {
        $this->middleware('auth');
        $this->category = $category;
        $this->word = $word;
        $this->quizResult = $quizResult;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $all_categories = $this->category->latest()->get();

        $categories = [];

        foreach ($all_categories as $category) {

            if($category->user_id){
                if($category->user_id == Auth::id() || $category->user->isFollowed() || $category->isLiked()) {
                    $categories[] = $category;
                }
            }else{
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }
        }

        //Learning progress
        if($request->prev)
        {
            $date = date('Y-m-d', strtotime('- 7 day', strtotime($request->prev)));
        }elseif($request->next){
            $date = date('Y-m-d', strtotime('+ 7 day', strtotime($request->next)));
        }else{
            $date = date('Y-m-d');
        }

        $date = $this->getDate($date);
        $added_words = $this->getAddedWords($date);
        $quiz_score_total = $this->getQuizResults($date);
        $learning_data = $this->getLearningData("today");
        $quiz_datas = $this->getQuizData();



        return view('users.home.home')
                ->with('categories', $categories)
                ->with('date', $date)
                ->with('added_words', $added_words)
                ->with('quiz_score_total', $quiz_score_total)
                ->with('learning_data', $learning_data)
                ->with('quiz_datas', $quiz_datas);
    }

    public function index_day(Request $request, $day)
    {
        $all_categories = $this->category->latest()->get();

        $categories = [];

        foreach ($all_categories as $category) {

            if($category->user_id){
                if($category->user_id == Auth::id() || $category->user->isFollowed() || $category->isLiked()) {
                    $categories[] = $category;
                }
            }else{
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }
        }

        //Learning progress
        if($request->prev)
        {
            $date = date('Y-m-d', strtotime('- 7 day', strtotime($request->prev)));
        }elseif($request->next){
            $date = date('Y-m-d', strtotime('+ 7 day', strtotime($request->next)));
        }else{
            $date = date('Y-m-d');
        }

        $date = $this->getDate($date);
        $added_words = $this->getAddedWords($date);
        $quiz_score_total = $this->getQuizResults($date);
        $learning_data = $this->getLearningData($day);
        $quiz_datas = $this->getQuizData();



        return view('users.home.home')
                ->with('categories', $categories)
                ->with('date', $date)
                ->with('added_words', $added_words)
                ->with('quiz_score_total', $quiz_score_total)
                ->with('learning_data', $learning_data)
                ->with('quiz_datas', $quiz_datas);
    }


// Sort functions
    public function my_category(Request $request)
    {
        $categories = $this->category->where('user_id', Auth::id())->latest()->get();

        //Learning progress
        if($request->prev)
        {
            $date = date('Y-m-d', strtotime('- 7 day', strtotime($request->prev)));
        }elseif($request->next){
            $date = date('Y-m-d', strtotime('+ 7 day', strtotime($request->next)));
        }else{
            $date = date('Y-m-d');
        }

        $date = $this->getDate($date);
        $added_words = $this->getAddedWords($date);
        $quiz_score_total = $this->getQuizResults($date);
        $learning_data = $this->getLearningData("today");
        $quiz_datas = $this->getQuizData();



        return view('users.home.home')
                ->with('categories', $categories)
                ->with('date', $date)
                ->with('added_words', $added_words)
                ->with('quiz_score_total', $quiz_score_total)
                ->with('learning_data', $learning_data)
                ->with('quiz_datas', $quiz_datas);
    }

    public function liked(Request $request)
    {
        $all_categories = $this->category->latest()->get();

        $categories = [];

        foreach ($all_categories as $category) {

            if($category->user_id){
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }else{
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }

        }

        //Learning progress
        if($request->prev)
        {
            $date = date('Y-m-d', strtotime('- 7 day', strtotime($request->prev)));
        }elseif($request->next){
            $date = date('Y-m-d', strtotime('+ 7 day', strtotime($request->next)));
        }else{
            $date = date('Y-m-d');
        }

        $date = $this->getDate($date);
        $added_words = $this->getAddedWords($date);
        $quiz_score_total = $this->getQuizResults($date);
        $learning_data = $this->getLearningData("today");
        $quiz_datas = $this->getQuizData();



        return view('users.home.home')
                ->with('categories', $categories)
                ->with('date', $date)
                ->with('added_words', $added_words)
                ->with('quiz_score_total', $quiz_score_total)
                ->with('learning_data', $learning_data)
                ->with('quiz_datas', $quiz_datas);
    }

    public function popular(Request $request)
    {
        $all_categories = $this->category->withCount('like')->orderBy('like_count', 'desc')->get();

        $categories = [];

        foreach ($all_categories as $category) {

            if($category->user_id){
                if($category->user_id == Auth::id() || $category->user->isFollowed() || $category->isLiked()) {
                    $categories[] = $category;
                }
            }else{
                if($category->isLiked()) {
                    $categories[] = $category;
                }
            }
        }


        //Learning progress
        if($request->prev)
        {
            $date = date('Y-m-d', strtotime('- 7 day', strtotime($request->prev)));
        }elseif($request->next){
            $date = date('Y-m-d', strtotime('+ 7 day', strtotime($request->next)));
        }else{
            $date = date('Y-m-d');
        }

        $date = $this->getDate($date);
        $added_words = $this->getAddedWords($date);
        $quiz_score_total = $this->getQuizResults($date);
        $learning_data = $this->getLearningData("today");
        $quiz_datas = $this->getQuizData();



        return view('users.home.home')
                ->with('categories', $categories)
                ->with('date', $date)
                ->with('added_words', $added_words)
                ->with('quiz_score_total', $quiz_score_total)
                ->with('learning_data', $learning_data)
                ->with('quiz_datas', $quiz_datas);
    }

    public function otheruser(Request $request)
    {
        $categories = $this->category->where('user_id', $request->other_user)->latest()->get();

        //Learning progress
        if($request->prev)
        {
            $date = date('Y-m-d', strtotime('- 7 day', strtotime($request->prev)));
        }elseif($request->next){
            $date = date('Y-m-d', strtotime('+ 7 day', strtotime($request->next)));
        }else{
            $date = date('Y-m-d');
        }

        $date = $this->getDate($date);
        $added_words = $this->getAddedWords($date);
        $quiz_score_total = $this->getQuizResults($date);
        $learning_data = $this->getLearningData("today");
        $quiz_datas = $this->getQuizData();



        return view('users.home.home')
                ->with('categories', $categories)
                ->with('date', $date)
                ->with('added_words', $added_words)
                ->with('quiz_score_total', $quiz_score_total)
                ->with('learning_data', $learning_data)
                ->with('quiz_datas', $quiz_datas);
    }

//Learning progress helper functions
    public function getDate($date)
    {
        $one_week = [];
        for ($i = 0; $i < 7; $i++) {
            $one_week[] = date('Y-m-d', strtotime('-'. $i. ' day', strtotime($date)));
        }

        return $one_week;
    }

    public function getAddedWords($date)
    {
        $added_words = [];
        foreach ($date as $day) {
            $added_words[] = $this->word->whereDate('created_at', $day)->where('user_id', Auth::id())->count();
        }

        return $added_words;
    }

    public function getQuizResults($date)
    {
        $quiz_score_total = [];
        foreach ($date as $day) {
            $quiz_results = $this->quizResult->whereDate('created_at', $day)->where('user_id', Auth::id())->get();

            $quiz_score = 0;
            foreach ($quiz_results as $quiz_result) {
                $quiz_score += $quiz_result->score;
            }
            $quiz_score_total[] = $quiz_score;
        }

        return $quiz_score_total;

    }

    public function getLearningData($day)
    {
        $today = date('Y-m-d');

        if($day == "today"){
            $data_added_words = $this->word->whereDate('created_at', $today)->where('user_id', Auth::id())->count();
            $data_quiz_score = $this->quizResult->whereDate('created_at', $today)->where('user_id', Auth::id())->sum('score');
            $quizzes = $this->quizResult->whereDate('created_at', $today)->where('user_id', Auth::id())->get();
            $quiz_amount = 0;
            foreach($quizzes as $quiz){
                $questions = json_decode($quiz->questions);
                $quiz_amount += count($questions);
            }
            $data_quiz_answered = $quiz_amount;
        }elseif($day == "week"){
            $week_ago = date('Y-m-d', strtotime('-7 day', strtotime($today)));
            $tommorow = date('Y-m-d', strtotime('+1 day', strtotime($today)));

            $data_added_words = $this->word->whereBetween('created_at', [$week_ago, $tommorow])->where('user_id', Auth::id())->count();
            $data_quiz_score = $this->quizResult->whereBetween('created_at', [$week_ago, $tommorow])->where('user_id', Auth::id())->sum('score');
            $quizzes = $this->quizResult->whereBetween('created_at', [$week_ago, $tommorow])->where('user_id', Auth::id())->get();
            $quiz_amount = 0;
            foreach($quizzes as $quiz){
                $questions = json_decode($quiz->questions);
                $quiz_amount += count($questions);
            }
            $data_quiz_answered = $quiz_amount;
        }elseif($day == "month"){
            $month_ago = date('Y-m-d', strtotime('-1 month', strtotime($today)));
            $tommorow = date('Y-m-d', strtotime('+1 day', strtotime($today)));

            $data_added_words = $this->word->whereBetween('created_at', [$month_ago, $tommorow])->where('user_id', Auth::id())->count();
            $data_quiz_score = $this->quizResult->whereBetween('created_at', [$month_ago, $tommorow])->where('user_id', Auth::id())->sum('score');
            $quizzes = $this->quizResult->whereBetween('created_at', [$month_ago, $tommorow])->where('user_id', Auth::id())->get();
            $quiz_amount = 0;
            foreach($quizzes as $quiz){
                $questions = json_decode($quiz->questions);
                $quiz_amount += count($questions);
            }
            $data_quiz_answered = $quiz_amount;
        }elseif($day == "year"){
            $year_ago = date('Y-m-d', strtotime('-1 year', strtotime($today)));
            $tommorow = date('Y-m-d', strtotime('+1 day', strtotime($today)));

            $data_added_words = $this->word->whereBetween('created_at', [$year_ago, $tommorow])->where('user_id', Auth::id())->count();
            $data_quiz_score = $this->quizResult->whereBetween('created_at', [$year_ago, $tommorow])->where('user_id', Auth::id())->sum('score');
            $quizzes = $this->quizResult->whereBetween('created_at', [$year_ago, $tommorow])->where('user_id', Auth::id())->get();
            $quiz_amount = 0;
            foreach($quizzes as $quiz){
                $questions = json_decode($quiz->questions);
                $quiz_amount += count($questions);
            }
            $data_quiz_answered = $quiz_amount;
        }else{
            $data_added_words = $this->word->where('user_id', Auth::id())->count();
            $data_quiz_score = $this->quizResult->where('user_id', Auth::id())->sum('score');
            $quizzes = $this->quizResult->where('user_id', Auth::id())->get();
            $quiz_amount = 0;
            foreach($quizzes as $quiz){
                $questions = json_decode($quiz->questions);
                $quiz_amount += count($questions);
            }
            $data_quiz_answered = $quiz_amount;
        }

        $data_learned = [
            'added_words' => $data_added_words,
            'quiz_score' => $data_quiz_score,
            'quiz_answered' => $data_quiz_answered,
        ];

        return $data_learned;
    }

    public function getQuizData(){
        $quizzes = $this->quizResult->where('user_id', Auth::id())->orderBy('times_taken', 'asc')->orderBy('updated_at', 'desc')->get();

        $now = date('Y-m-d');

        $quiz_list = [];
        // To get only 8 data
        $num = 0;
        foreach($quizzes as $quiz){
            $quiz_taken = $quiz->updated_at->diffInDays($now);

            if($quiz->times_taken == 1){
                if($quiz_taken  >= 1){
                    $quiz_list[] = $quiz;
                    $num++;
                    if($num == 8){
                        break;
                    }
                }
            }elseif($quiz->times_taken == 2){
                if($quiz_taken  >= 7){
                    $quiz_list[] = $quiz;
                    $num++;
                    if($num == 8){
                        break;
                    }
                }
            }elseif($quiz->times_taken == 3){
                if($quiz_taken  >= 30){
                    $quiz_list[] = $quiz;
                    $num++;
                    if($num == 8){
                        break;
                    }
                }
            }
        }
        return $quiz_list;
    }

}
