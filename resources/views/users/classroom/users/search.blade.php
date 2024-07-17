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
                <form action="{{ route('classroom.search') }}" method="post" class="my-3">
                    @csrf
                    @method('GET')
                    <div class="input-group my-2">
                        <input type="text" name="classroom" value="{{ $search }}" class="form-control rounded-start-4">
                        <button class="btn btn-search rounded-end-4 px-4 py-2" type="submit">Search</button>
                      </div>
                </form>
            </div>
        </div>
    </div>

    <div class="">
        <button class="btn bg-yellow px-4 border border-yellow rounded-bottom-0 rounded-top-4 text-second">My class</button>
        <button class="btn bg-light px-4 border  rounded-bottom-0 rounded-top-4 text-second">Find Class</button>
        <div class="row bg-yellow mb-5">
            @forelse($classrooms as $classroom)
                <div class="col-4">
                    <a href="{{ route('classroom.classroom.show', $classroom) }}" class="card m-2 shadow-sm p-3 rounded text-start text-decoration-none" style="height: 24rem;">
                        <img src="{{ $classroom->image }}" alt="" class="logo-lg my-2">
                        <p class="text-second fs-5 my-2">{{ $classroom->name }}</p>
                        <p class="mb-2">{{ $classroom->description }}</p>
                    </a>
                </div>
            @empty
                <div class="col-4 m-auto text-center fs-1 py-5">
                    No class founded
                </div>
            @endforelse
        </div>
    </div>


</div>

@endsection
