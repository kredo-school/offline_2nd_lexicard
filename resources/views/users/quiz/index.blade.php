@extends('layouts.app')

@section('title', 'quiz home')

@section('content')

<div class="container">
    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">Quiz</p>
        </div>
        <form action="{{ route('quiz.quiz.show') }}" method="post">
            @csrf
            @method('GET')
            <div class="row">
                <div class="col-6">
                    <p class="text-second p-2 my-2 text-center w-100 m-auto fs-3">Choose Quiz Format</p>
                    <div class="form-check ps-0">
                        <p class="text-yellow bg-second p-2 my-5 text-center w-25 fs-5">Quiz</p>
                        <div class="">
                            <input type="radio" name="format" class="btn-check form-check-input" id="JtoE-quiz-btn" value="JtoEQ" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="JtoE-quiz-btn">Japanese <i class="fa-solid fa-arrow-right"></i> English</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="format" class="btn-check form-check-input" id="EtoJ-quiz-btn" value="EtoJQ" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="EtoJ-quiz-btn">English <i class="fa-solid fa-arrow-right"></i> Japanese</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="format" class="btn-check form-check-input" id="fill-in-the-blank-btn" value="FillQ" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="fill-in-the-blank-btn">Fill In The Blank</label>
                        </div>
                        <p class="text-yellow bg-second p-2 my-5 text-center w-25 fs-5">FlashCard</p>
                        <div class="">
                            <input type="radio" name="format" class="btn-check form-check-input" id="JtoE-flashcard-btn" value="JtoEF" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="JtoE-flashcard-btn">Japanese <i class="fa-solid fa-arrow-right"></i> English</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="format" class="btn-check form-check-input" id="EtoJ-flashcard-btn" value="EtoJF" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="EtoJ-flashcard-btn">English <i class="fa-solid fa-arrow-right"></i> Japanese</label>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <p class="text-second p-2 my-2 text-center w-100 m-auto fs-3">Choose Quiz Category</p>
                    <div class="form-check ps-0">
                        @forelse($categories as $category)
                            <div class="">
                                <input type="radio" name="category" class="btn-check form-check-input" value="{{ $category->id }}" id="{{ $category->id }}" autocomplete="off">
                                <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="{{ $category->id }}">{{ $category->name }}</label>
                            </div>
                        @empty
                            <p class="text-second my-5 text-center ">No categories available.</p>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-yellow w-75 m-auto p-3 fs-5 border rounded-4 my-5 fw-semibold">Take a Quiz</button>
            </div>
        </form>
    </div>
</div>

@endsection
