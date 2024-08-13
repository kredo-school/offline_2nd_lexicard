@extends('layouts.app')

@section('title', 'JtoE Quiz')

@section('content')

<div class="container">
    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">{{ $num+1 }}/{{ count(session('quizzes')) }}</p>
        </div>
    </div>
    <form action="{{ route('quiz.quiz.run', $num) }}" method="post">
        @csrf
        @method('GET')
        <div class="">
            <p class="text-second p-2 my-2 w-75 m-auto fs-3">{{ $quiz['question'] }}</p>
            <p class="text-second p-2 mt-5 w-75 m-auto fs-3">{{ $quiz['example']['before'] }} <input type="text" name="input" class="form-control w-25 m-auto d-inline"> {{ $quiz['example']['after'] }}</p>
            @if(isset($error))
                <p class="text-danger p-2 w-75 m-auto">{{ $error }}</p>
            @endif
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-second w-25 m-auto p-3 fs-5 my-5 fw-semibold">Next</button>
        </div>
    </form>
</div>

@endsection
