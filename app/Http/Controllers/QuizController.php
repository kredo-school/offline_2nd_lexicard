<?php

namespace App\Http\Controllers;

use App\Http\Requests\QuizRequest;
use App\Http\Requests\QuizRunRequest;
use App\Models\Category;
use App\Models\QuizResult;
use App\Models\Word;
use ChrisKonnertz\DeepLy\DeepLy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;



class QuizController extends Controller
{
    private $category, $word, $quizResult;
    public function __construct(Category $category, Word $word, QuizResult $quizResult)
    {
        $this->category = $category;
        $this->word = $word;
        $this->quizResult = $quizResult;
    }

    public function index() {
        $categories = $this->all_categories();

        return view('users.quiz.index')
                ->with('categories', $categories);
    }

    public function all_categories() {
        $categories = $this->category->get();

        $all_categories = [];

        foreach ($categories as $category) {

            if($category->user_id){
                if($category->user_id == Auth::id() || $category->user->isFollowed() || $category->isLiked()) {
                    if($category->categoryWord->count() > 0){
                        $all_categories[] = $category;
                    }
                }
            }
        }

        return $all_categories;
    }

    public function show(QuizRequest $request) {
        session(['category_id' => $request->category, 'format' => $request->format]);

        $category = $this->category->where('id', $request->category)->get();
        $words_id = $category[0]->categoryWord()->pluck('word_id');
        foreach($words_id as $word_id) {
            $words[] = $this->word->where('id', $word_id)->get();
        }

        shuffle($words);

        if($request->format == "JtoEQ") {

        // Japanese to English quiz
            $quizzes = $this->createJtoEQuiz($words);
            $choices = [];

            session(['quizzes' => $quizzes, 'choices' => $choices]);
            $num = 0;
            $quiz = $quizzes[$num];
            return view('users.quiz.quiz')
                    ->with('num', $num)
                    ->with('quiz', $quiz);

        }else if($request->format == "EtoJQ") {

        // English to Japanese quiz
            $quizzes = $this->createEtoJQuiz($words);
            $choices = [];

            session(['quizzes' => $quizzes, 'choices' => $choices]);
            $num = 0;
            $quiz = $quizzes[$num];
            return view('users.quiz.quiz')
                    ->with('num', $num)
                    ->with('quiz', $quiz);

        }else if($request->format == "FillQ") {

        // Fill in the blank quiz
            $quizzes = $this->createFillInQuiz($words);
            $choices = [];

            session(['quizzes' => $quizzes, 'choices' => $choices]);
            $num = 0;
            $quiz = $quizzes[$num];
            return view('users.quiz.fill_in_the_blank')
                    ->with('num', $num)
                    ->with('quiz', $quiz);

        }else if($request->format == "JtoEF") {

        // Japanese to English flashcard
            $flashcards = $this->createFlashcard($words);

            session(['flashcards' => $flashcards,]);
            $num = 0;
            $flashcard = $flashcards[$num];

            return view('users.quiz.JtoEflashcard')
                    ->with('num', $num)
                    ->with('flashcard', $flashcard);

        }else{

        // English to Japanese flashcard
            $flashcards = $this->createFlashcard($words);

            session(['flashcards' => $flashcards,]);
            $num = 0;
            $flashcard = $flashcards[$num];

            return view('users.quiz.EtoJflashcard')
                    ->with('num', $num)
                    ->with('flashcard', $flashcard);

        }
    }

//Quiz Creation and Running
    public function runQuizzes($num, QuizrunRequest $request) {

        if(session('format') == "JtoEQ" || session('format') == "EtoJQ") {
            $validator = Validator::make($request->all(), [
                'choice' => ['required']
            ]);

            if ($validator->fails()) {
                $quizzes = session('quizzes');

                $quiz = $quizzes[$num];
                return view('users.quiz.quiz')
                        ->with('num', $num)
                        ->with('quiz', $quiz)
                        ->with('error', 'Please select an answer.');
            }


            $choices = session('choices');
            $choices[] = $request->choice;

            session(['choices' => $choices]);

        }else{
            $validator = Validator::make($request->all(), [
                'input' => ['required'],
            ]);

            if ($validator->fails()) {
                $quizzes = session('quizzes');

                $quiz = $quizzes[$num];
                return view('users.quiz.fill_in_the_blank')
                        ->with('num', $num)
                        ->with('quiz', $quiz)
                        ->with('error', 'Please enter an answer.');
            }


            $choices = session('choices');
            $choices[] = $request->input;

            session(['choices' => $choices]);
        }

        $num++;
        $quizzes = session('quizzes');
        if($num < count($quizzes)) {
            $quiz = $quizzes[$num];

            if($request->choice){
        // quiz
                return view('users.quiz.quiz')
                    ->with('num', $num)
                    ->with('quiz', $quiz);
            }else if($request->input){
        // fill in the blank
                return view('users.quiz.fill_in_the_blank')
                    ->with('num', $num)
                    ->with('quiz', $quiz);
            }


        }else{
    // result page
            $choices = session('choices');

            $correct_answers = 0;
            $questions = [];
            $answer = [];
            foreach($quizzes as $key => $quiz) {
                if($quiz['answer'] == $choices[$key]) {
                    $correct_answers++;
                }

                $questions[] = $quiz['question'];
                $answer[] = $quiz['answer'];
            }



            //store to quiz resutls table
            $previous_result = $this->quizResult->where('user_id', Auth::id())->where('category_id', session('category_id'))->where('format', session('format'))->latest()->first();
            if($previous_result){
                $this->quizResult->user_id = Auth::id();
                $this->quizResult->category_id = session('category_id');
                $this->quizResult->format = session('format');
                $this->quizResult->score = $correct_answers;
                $this->quizResult->questions = json_encode($questions);
                $this->quizResult->answers = json_encode($answer);
                $this->quizResult->choices = json_encode($choices);
                $this->quizResult->times_taken = $previous_result->times_taken + 1;
                $this->quizResult->save();
            }else{
                $this->quizResult->user_id = Auth::id();
                $this->quizResult->category_id = session('category_id');
                $this->quizResult->format = session('format');
                $this->quizResult->score = $correct_answers;
                $this->quizResult->questions = json_encode($questions);
                $this->quizResult->answers = json_encode($answer);
                $this->quizResult->choices = json_encode($choices);
                $this->quizResult->times_taken = 1;
                $this->quizResult->save();
            }


            return view('users.quiz.result')
                    ->with('quizzes', $quizzes)
                    ->with('choices', $choices)
                    ->with('correct_answers', $correct_answers);
        }
    }

    public function createJtoEQuiz($words) {
        $quizzes = [];
        foreach($words as $word) {
            $choices = [];
            $choices[] = $word[0]->word;
            $all_choice = $this->word->whereNotIn('id', [$word[0]->id])->inRandomOrder()->limit(3)->pluck('word')->toArray();
            foreach($all_choice as $choice) {
                $choices[] = $choice;
            }
            shuffle($choices);

            $quiz = [
                'question' => $word[0]->meaning,
                'answer' => $word[0]->word,
                'choices' => [
                    $choices[0],
                    $choices[1],
                    $choices[2],
                    $choices[3]
                ]
            ];
            $quizzes[] = $quiz;
        }

        return $quizzes;
    }

    public function createEtoJQuiz($words) {
        $quizzes = [];
        foreach($words as $word) {
            $choices = [];
            $choices[] = $word[0]->meaning;
            $all_choice = $this->word->whereNotIn('id', [$word[0]->id])->inRandomOrder()->limit(3)->pluck('meaning')->toArray();
            foreach($all_choice as $choice) {
                $choices[] = $choice;
            }
            shuffle($choices);

            $quiz = [
                'question' => $word[0]->word,
                'answer' => $word[0]->meaning,
                'choices' => [
                    $choices[0],
                    $choices[1],
                    $choices[2],
                    $choices[3]
                ]
            ];
            $quizzes[] = $quiz;
        }

        return $quizzes;
    }

// Fill in the Blank Creation and Running
    public function createFillInQuiz($words) {
        $quizzes = [];
        foreach($words as $word) {
            $example_with_it = $word[0]->example;
            $example_meaning = $this->translateExample($example_with_it);

            $example = $this->getExample($example_with_it);

            $quiz = [
                'question' => $example_meaning,
                'answer' => $example['answer'],
                'example' => [
                    'before' => $example['before'],
                    'after' => $example['after']
                ]
            ];
            $quizzes[] = $quiz;
        }

        return $quizzes;
    }

    public function translateExample($example_with_it)
    {
        $example_meaning = str_replace('{it}', '', $example_with_it);
        $example_meaning = str_replace('{/it}', '', $example_meaning);

        $apiKey = config('services.deeply.api_key');

        $deepLy = new DeepLy($apiKey);

        try {
            $translatedText = $deepLy->translate($example_meaning, DeepLy::LANG_JA, DeepLy::LANG_AUTO);

            return $translatedText;
        } catch (\Exception $exception) {
            echo $exception->getMessage();
        }
    }

    public function getExample($example_with_it)
    {
        $before_it = explode('{it}', $example_with_it);
        $answer = explode('{/it}', $before_it[1]);
        $after_it = explode('{/it}', $example_with_it);

        $example = [
            'before' => $before_it[0],
            'after' => $after_it[1],
            'answer' => $answer[0]
        ];

        return $example;
    }

// Flashcard Creation and Running
    public function runJtoEFlashcards($num) {
        $num++;
        $flashcards = session('flashcards');
        if($num < count($flashcards)) {
            $flashcard = $flashcards[$num];

            return view('users.quiz.JtoEflashcard')
                    ->with('num', $num)
                    ->with('flashcard', $flashcard);
        }else{
            // result page
            return redirect()->route('quiz.quiz.index');
        }

    }

    public function runEtoJFlashcards($num) {
        $num++;
        $flashcards = session('flashcards');
        if($num < count($flashcards)) {
            $flashcard = $flashcards[$num];

            return view('users.quiz.EtoJflashcard')
                    ->with('num', $num)
                    ->with('flashcard', $flashcard);
        }else{
            // result page
            return redirect()->route('quiz.quiz.index');
        }

    }

    public function createFlashcard($words) {
        $flashcards = [];
        foreach($words as $word) {
            $flashcard = [
                'word' => $word[0]->word,
                'meaning' => $word[0]->meaning
            ];
            $flashcards[] = $flashcard;
        }

        return $flashcards;
    }

    public function result_list() {
        $quiz_datas = $this->quizResult->where('user_id', Auth::id())->latest()->get();

        return view('users.quiz.result_list')
                ->with('quiz_datas', $quiz_datas);
    }
}
