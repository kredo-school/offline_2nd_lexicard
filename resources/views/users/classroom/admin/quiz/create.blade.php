@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container">
    <div class="row justify-content-between w-75 m-auto align-items-center">
        <div class="col-1 text-center">
            <a href="{{ route('classroom.admin.quiz') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
        </div>
        <div class="col-8">
            <p class="text-second bg-yellow p-3 my-5 text-center w-50 m-auto fs-4">{{ $title }}</p>
        </div>
        <div class="col-1">

        </div>
    </div>

    <form action="{{ route('classroom.admin.quiz') }}" method="post">
        @csrf
        @method('GET')
        <table class="table w-75 m-auto">
            <thead>
                <tr class="text-center table-second">
                    <th>#</th>
                    <th>Question</th>
                    <th>Answer</th>
                </tr>
            </thead>
            <tbody>
                @for($i=0; $i<$number; $i++)
                <tr class="table-white">
                    <td class="text-center">{{ $i+1 }}</td>
                    <td><input type="text" class="form-control bg-yellow border border-second text-second"></td>
                    <td><input type="text" class="form-control bg-yellow border border-second text-second"></td>
                </tr>
                @endfor
            </tbody>
        </table>

        <div class="text-center my-5">
            <button type="submit" class="btn btn-yellow border rounded-4 w-25 p-2 fs-4">Create</button>
        </div>
    </form>



</div>

@endsection
