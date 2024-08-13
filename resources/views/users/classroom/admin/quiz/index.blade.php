@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container">
    <div class="row justify-content-between w-75 m-auto align-items-center my-5">
        <div class="col-8 m-auto">
            <button type="button" class="btn btn-yellow w-100 p-3 fs-5 border border-second rounded-4 my-3" data-bs-toggle="modal" data-bs-target="#createNewQuizModal">
                Create New Quiz
            </button>

            @if ($errors->has('title'))
                <p class="text-danger text-center">{{ $errors->first('title') }}</p>
            @endif
            @error('number')
                <p class="text-danger text-center">{{ $errors->first('number') }}</p>
            @enderror
        </div>
    </div>

    <div class="col-8 m-auto">
        @forelse($classroom->quizTitles as $quizTitle)
            <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                <div class="col-9 text-center">
                    <form action="{{ route('classroom.admin.quiz.show', $quizTitle->id) }}" method="post">
                        @csrf
                        @method('GET')
                        {{-- <input type="hidden" name="title_id" value="{{ $quizTitle->id }}"> --}}
                        <button type="submit" class="btn text-second text-decoration-none fw-bold fs-3">{{ $quizTitle->title }}</button>
                    </form>
                </div>
                <div class="col-3 justify-content-end d-flex">
                    <p class="text-second fw-semibold me-4">{{ $quizTitle->quizzes->count() }} Questions</p>
                </div>
            </div>
        @empty
            <p class="text-second text-center p-5">No quiz titles yet.</p>
        @endforelse
    </div>
</div>

{{-- Create New Quiz Modal --}}
<div class="modal fade" id="createNewQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Category</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('classroom.admin.quiz.create', $classroom->id) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('GET')
            <div class="row align-items-center">
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Quiz title: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Number of Quiz: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="number" class="form-control">
                </div>
            </div>
            <div class="row justify-content-between my-4">
                <div class="col-5">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-yellow w-100">Add</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>

@endsection
