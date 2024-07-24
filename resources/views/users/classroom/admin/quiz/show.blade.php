@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container">
    <div class="row w-75 m-auto align-items-center">
        <div class="col-1 text-center">
            <a href="{{ route('classroom.admin.quiz', $classroom->id) }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
        </div>
        {{-- add quiz --}}
        <div class="col-3 text-center">
            <button type="button" class="btn btn-yellow px-4" data-bs-toggle="modal" data-bs-target="#addQuizModal-{{ $quiz_title->id }}">Add Quiz</button>
        </div>
        {{-- title --}}
        <div class="col-4">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">{{ $quiz_title->title }}</p>
        </div>
        {{-- edit quiz --}}
        <div class="col-3 text-center">
            <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#editQuizModal-{{ $quiz_title->id }}">
                <i class="fa-solid fa-pen-to-square fs-2 text-second"></i>
                <p class="fs-small text-second">Edit</p>
            </button>
        </div>
        {{-- delete quiz --}}
        <div class="col-1 text-center">
            <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteQuizModal-{{ $quiz_title->id }}">
                <i class="fa-solid fa-trash fs-2 text-danger"></i>
                <p class="fs-small text-second">DELETE</p>
            </button>
        </div>
    </div>

    @if($quiz_title->image)
        <div class="w-50 m-auto mb-5">
            <img src="{{ $quiz_title->image }}" class="img-fluid w-100">
        </div>
    @endif

    <form action="{{ route('classroom.admin.quiz', $classroom->id) }}" method="post">
        @csrf
        @method('GET')
        <table class="table w-75 m-auto">
            <thead>
                <tr class="table-second">
                    <th class="table-item1 text-center p-3">#</th>
                    <th class="table-item4 p-3">Question</th>
                    <th class="table-item4 p-3">Answer</th>
                    <th class="table-item5"></th>
                </tr>
            </thead>
            <tbody>
                @foreach($quiz_title->quizzes as $i => $quiz)
                <tr class="table-yellow">
                    <td class="text-center p-3">{{ $i+1 }}</td>
                    <td class="p-3">{{ $quiz->question }}</td>
                    <td class="p-3">{{ $quiz->answer }}</td>
                    <td class="p-3">
                        {{-- word edit --}}
                        <button type="button" class="btn py-0" data-bs-toggle="modal" data-bs-target="#editQuestionModal-{{ $quiz->id }}">
                            <i class="fa-solid fa-pen-to-square text-second fs-4"></i>
                        </button>
                        {{-- word delete --}}
                        <button type="button" class="btn py-0" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal-{{ $quiz->id }}">
                            <i class="fa-solid fa-trash text-danger fs-4"></i>
                        </button>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </form>



</div>


{{-- Add Quiz Modal --}}
<div class="modal fade" id="addQuizModal-{{ $quiz_title->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Quiz</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('classroom.admin.quiz.add', $quiz_title->id) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('GET')
            <div class="row align-items-center">
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Question: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="question" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Answer: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="answer" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Choice1: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="choice1" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Choice2: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="choice2" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Choice3: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="choice3" class="form-control">
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

<!-- Edit Category Modal -->
<div class="modal fade" id="editQuizModal-{{ $quiz_title->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category Name</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('classroom.admin.quiz.update', $quiz_title->id) }}" method="post" class="w-75 m-auto" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
            <input type="text" name="title" value="{{ $quiz_title->title }}" class="form-control my-4 text-second">
            <input type="file" name="image" class="form-control">
            <div class="row justify-content-between my-4">
                <div class="col-5">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-yellow w-100">Update</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>

<!-- Delete Quiz Modal -->
<div class="modal fade" id="deleteQuizModal-{{ $quiz_title->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Quiz</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('classroom.admin.quiz.delete', $quiz_title->classroom->id) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('DELETE')
            <p class="mb-5">Are you sure you want to delete quiz <span class="fw-bold">{{ $quiz_title->title }}</span>?</p>
            <input type="hidden" name="title" value="{{ $quiz_title->id }}">
            <div class="row justify-content-between my-4">
                <div class="col-5">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-delete w-100">Delete</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>

@foreach ($quiz_title->quizzes as $quiz)
{{-- Edit Question Modal --}}
<div class="modal fade" id="editQuestionModal-{{ $quiz->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Quiz</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('classroom.admin.quiz.question.update', $quiz->id) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('PATCH')
            <div class="row align-items-center">
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Question: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="question" value="{{ $quiz->question }}" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Answer: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="answer" value="{{ $quiz->answer }}" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Choice1: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="choice1" value="{{ $quiz->choice1 }}" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Choice2: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="choice2" value="{{ $quiz->choice2 }}" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Choice3: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="choice3" value="{{ $quiz->choice3 }}" class="form-control">
                </div>
            </div>
            <div class="row justify-content-between my-4">
                <div class="col-5">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-yellow w-100">Edit</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>

<!-- Delete Question Modal -->
<div class="modal fade" id="deleteQuestionModal-{{ $quiz->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Question</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('classroom.admin.quiz.question.delete', $quiz->id) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('DELETE')
            <p class="mb-3">Are you sure you want to delete this Question?</p>
            <div class="row align-items-center mb-5">
                <div class="col-3 my-3 fw-semibold">
                    <p class="text-second">Question: </p>
                </div>
                <div class="col-9">
                    <p class="text-second">{{ $quiz->question }}</p>
                </div>
                <div class="col-3 my-3 fw-semibold">
                    <p class="text-second">Answer: </p>
                </div>
                <div class="col-9">
                    <p class="text-second">{{ $quiz->answer }}</p>
                </div>
            </div>
            <div class="row justify-content-between my-4">
                <div class="col-5">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-delete w-100">Delete</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>
@endforeach

@endsection
