@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container">
    <div class="row justify-content-between w-75 m-auto align-items-center">
        <div class="col-1 text-center">
            <a href="{{ route('classroom.admin.quiz', $classroom->id) }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
        </div>
        <div class="col-8">
            <p class="text-second bg-yellow p-3 my-5 text-center w-50 m-auto fs-4">{{ $title }}</p>
        </div>
        <div class="col-1">

        </div>
    </div>

    <form action="{{ route('classroom.admin.quiz.store', $classroom->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="title" value="{{ $title }}">
        <div class="row my-5">
            <div class="col-6 d-flex m-auto">
                <p class="text-second fs-4 me-3">Image: </p>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <table class="table">
            <thead>
                <tr class="text-center table-second">
                    <th>#</th>
                    <th class="table-item4">Question</th>
                    <th>Answer</th>
                    <th>Choice1</th>
                    <th>Choice2</th>
                    <th>Choice3</th>
                </tr>
            </thead>
            <tbody>
                @for($i=0; $i<$number; $i++)
                <tr class="table-white">
                    <td class="text-center">{{ $i+1 }}</td>
                    <td><input type="text" name="question[]" class="form-control bg-yellow border border-second text-second" required></td>
                    <td><input type="text" name="answer[]" class="form-control bg-yellow border border-second text-second" required></td>
                    <td><input type="text" name="choice1[]" class="form-control bg-yellow border border-second text-second" required></td>
                    <td><input type="text" name="choice2[]" class="form-control bg-yellow border border-second text-second" required></td>
                    <td><input type="text" name="choice3[]" class="form-control bg-yellow border border-second text-second" required></td>
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
