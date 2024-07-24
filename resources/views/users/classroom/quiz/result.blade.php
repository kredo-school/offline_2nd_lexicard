@extends('layouts.app')

@section('title', 'Quiz Results')

<?php $classroom_id  = session('quizTitle')->classroom->id ?>
@section('content')

<div class="container">

    @if(session('quizTitle')->image)
        <div class="w-50 m-auto mb-5">
            <img src="{{ session('quizTitle')->image }}" class="img-fluid w-100">
        </div>
    @endif

    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second p-2 my-5 text-center w-100 m-auto fs-1">{{ $correct_answers }}/{{ count($quizzes) }}</p>
        </div>



        <table class="table w-75 m-auto">
            <thead class="table-second">
                <tr>
                    <th class="table-item1">#</th>
                    <th class="table-item1"></th>
                    <th class="table-item2">Question</th>
                    <th class="table-item3">Your Answer</th>
                    <th class="table-item3">Answer</th>
                </tr>
            </thead>
            <tbody class="table-yellow">
                @for($i = 0; $i < count($quizzes); $i++)
                    <tr>
                        <th scope="row">{{ $i+1 }}</th>
                        <th>
                            @if($selected[$i] == $quizzes[$i]['answer'])
                                <i class="fa-solid fa-check text-success"></i></th>
                            @else
                                <i class="fa-solid fa-xmark text-danger"></i>
                            @endif
                        <td>{{ $quizzes[$i]['question'] }}</td>
                        <td>{{ $selected[$i] }}</td>
                        <td>{{ $quizzes[$i]['answer'] }}</td>
                    </tr>
                @endfor
        </table>

        <div class="text-center">
            <a href="{{  route('classroom.quiz.index', $classroom_id) }}" type="submit" class="btn btn-second w-25 m-auto p-3 fs-5 my-5 fw-semibold">Back to Menu</a>
        </div>
    </div>
</div>

@endsection

