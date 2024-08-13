@extends('layouts.app')

@section('title', 'Quiz')

@section('content')

<div class="container">
    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">{{ $num+1 }}/{{ count(session('quizzes')) }}</p>
        </div>
        <form action="{{ route('quiz.quiz.run', $num) }}" method="post">
            @csrf
            @method('GET')
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <p class="text-second p-2 my-2 text-center w-50 m-auto fs-3 bg-yellow">{{ $quiz['question'] }}</p>
                </div>
                <div class="col-6">
                    <div class="form-check ps-0">
                        <div class="">
                            <input type="radio" name="choice" value="{{ $quiz['choices'][0] }}" class="btn-check form-check-input" id="choice1" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="choice1">{{ $quiz['choices'][0] }}</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="choice" value="{{ $quiz['choices'][1] }}" class="btn-check form-check-input" id="choice2" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="choice2">{{ $quiz['choices'][1] }}</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="choice" value="{{ $quiz['choices'][2] }}" class="btn-check form-check-input" id="choice3" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="choice3">{{ $quiz['choices'][2] }}</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="choice" value="{{ $quiz['choices'][3] }}" class="btn-check form-check-input" id="choice4" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="choice4">{{ $quiz['choices'][3] }}</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                @if(isset($error))
                    <p class="text-danger p-2 w-75 m-auto">{{ $error }}</p>
                @endif
                <button type="submit" class="btn btn-second w-25 m-auto p-3 fs-5 my-5 fw-semibold">Next</button>
            </div>
        </form>
    </div>
</div>

@endsection
