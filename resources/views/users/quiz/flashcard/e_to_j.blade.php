@extends('layouts.app')

@section('title', 'JtoE FlashCard')

@section('content')

<div class="container">
    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">1/10</p>
        </div>
        <form action="{{ route('quiz.quiz.index') }}" method="post">
            @csrf
            @method('GET')
            <div class="bg-yellow py-5 w-50 m-auto border rounded-5">
                <p class="text-second py-5 my-5 text-center fs-1">apple</p>
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-second w-25 m-auto fs-4 my-5 fw-semibold">Next</button>
            </div>
        </form>
    </div>
</div>

@endsection

