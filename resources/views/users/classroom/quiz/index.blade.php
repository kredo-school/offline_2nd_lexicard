@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container">
    <div class="row justify-content-between w-75 m-auto align-items-center">
        <div class="col-1 text-center">
            <a href="{{ route('classroom.classroom.show') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
        </div>
        <div class="col-8">
            <p class="text-second bg-yellow p-3 my-5 text-center w-50 m-auto fs-4">Quiz</p>
        </div>
        <div class="col-1">

        </div>
    </div>

    <div class="col-8 m-auto">
        @for($i=0;$i< 10;$i++)
            <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                <div class="col-9 text-center">
                    <a href="#" class="text-second text-decoration-none fw-bold fs-3">TOEIC</a>
                </div>
                <div class="col-3 justify-content-end d-flex">
                    <p class="text-second fw-semibold me-4">30 Questions</p>
                </div>
            </div>
        @endfor
    </div>
</div>

@endsection
