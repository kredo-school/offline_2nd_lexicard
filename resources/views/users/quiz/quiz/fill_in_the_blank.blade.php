@extends('layouts.app')

@section('title', 'JtoE Quiz')

@section('content')

<div class="container">
    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">1/10</p>
        </div>
    </div>
    <form action="{{ route('quiz.quiz.result') }}" method="post">
        @csrf
        @method('GET')
        <div class="">
            <p class="text-second p-2 my-2 w-75 m-auto fs-3">私の名前はTomです。</p>
            <p class="text-second p-2 my-5 w-75 m-auto fs-3">My <input type="text" class="form-control w-25 m-auto d-inline"> is Tom.</p>
        </div>
        <div class="text-center">
            <button type="submit" class="btn btn-second w-25 m-auto p-3 fs-5 my-5 fw-semibold">Next</button>
        </div>
    </form>
</div>

@endsection
