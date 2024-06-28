@extends('layouts.app')

@section('title', 'Classroom index')

@section('content')

<div class="container">
    <div class="row w-100 m-auto align-items-center">
        {{--  --}}
        <div class="col-2 text-center">
        </div>
        {{--  --}}
        <div class="col-2 text-start">
        </div>
        {{-- title --}}
        <div class="col-4">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">Classroom</p>
        </div>
        {{--  --}}
        <div class="col-1">
        </div>
        {{-- create new class --}}
        <div class="col-3 text-center">
            <form action="{{ route('classroom.classroom.create') }}" method="post">
                @csrf
                @method('GET')
                <button type="submit" class="btn btn-yellow">Create New Classroom</button>
            </form>
        </div>
    </div>

    <div class="w-75 m-auto">
        <div class="row">
            <div class="col-7 m-auto">
                <p class="ps-2">Search Classroom</p>
                <form action="{{ route('word.word.create') }}" method="post" class="my-3">
                    @csrf
                    @method('GET')
                    <div class="input-group my-2">
                        <input type="text" name="word" class="form-control rounded-start-4">
                        <button class="btn btn-search rounded-end-4 px-4 py-2" type="submit">Search</button>
                      </div>
                </form>
            </div>
        </div>
    </div>

    <div class="">
        <button class="btn bg-yellow px-4 border border-yellow rounded-bottom-0 rounded-top-4 text-second">My class</button>
        <button class="btn bg-light px-4 border  rounded-bottom-0 rounded-top-4 text-second">Find Class</button>
        <div class="row bg-yellow">
            @for($i=0; $i<9; $i++)
                <div class="col-4">
                    <a href="{{ route('classroom.classroom.show') }}" class="card m-2 shadow-sm p-3 rounded text-start text-decoration-none">
                        <img src="{{ asset('storage/images/classroom.png') }}" alt="" class="logo-lg">
                        <p class="text-second fs-5 my-2">TOEIC class</p>
                        <p class="mb-2">Let's get high score on the TOEIC</p>
                    </a>
                </div>
            @endfor
        </div>
    </div>


</div>

@endsection
