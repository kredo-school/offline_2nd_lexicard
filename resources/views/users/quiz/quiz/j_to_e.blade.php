@extends('layouts.app')

@section('title', 'JtoE Quiz')

@section('content')

<div class="container">
    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">1/10</p>
        </div>
        <form action="{{ route('quiz.quiz.result') }}" method="post">
            @csrf
            @method('GET')
            <div class="row">
                <div class="col-6 d-flex align-items-center">
                    <p class="text-second p-2 my-2 text-center w-50 m-auto fs-3 bg-yellow">りんご</p>
                </div>
                <div class="col-6">
                    <div class="form-check ps-0">
                        <div class="">
                            <input type="radio" name="category" class="btn-check form-check-input" id="choice1" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="choice1">apple</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="category" class="btn-check form-check-input" id="choice2" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="choice2">grape</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="category" class="btn-check form-check-input" id="choice3" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="choice3">orange</label>
                        </div>
                        <div class="div">
                            <input type="radio" name="category" class="btn-check form-check-input" id="choice4" autocomplete="off">
                            <label class="btn btn-outline-yellow w-100 p-3 fs-5 border border-second rounded-4 my-2 fw-semibold" for="choice4">banana</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-second w-25 m-auto p-3 fs-5 my-5 fw-semibold">Next</button>
            </div>
        </form>
    </div>
</div>

@endsection
