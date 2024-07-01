@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container">
    <div class="row w-75 m-auto align-items-center">
        <div class="col-1 text-center">
            <a href="{{ route('classroom.admin.quiz') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
        </div>
        {{--  --}}
        <div class="col-3 text-center">
        </div>
        {{-- title --}}
        <div class="col-4">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">Title</p>
        </div>
        {{--  --}}
        <div class="col-3 text-center">
            <button type="button" class="btn btn-yellow px-4" data-bs-toggle="modal" data-bs-target="#addQuizModal">Add Quiz</button>
        </div>
        {{-- create new class --}}
        <div class="col-1 text-center">
            <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteQuizModal">
                <i class="fa-solid fa-trash fs-2 text-danger"></i>
                <p class="fs-small text-second">DELETE</p>
            </button>
        </div>
    </div>

    <form action="{{ route('classroom.admin.quiz') }}" method="post">
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
                @for($i=0; $i<10; $i++)
                <tr class="table-yellow">
                    <td class="text-center p-3">{{ $i+1 }}</td>
                    <td class="p-3">Question</td>
                    <td class="p-3">Answer</td>
                    <td class="p-3">
                        {{-- word edit --}}
                        <button type="button" class="btn py-0" data-bs-toggle="modal" data-bs-target="#editQuestionModal">
                            <i class="fa-solid fa-pen-to-square text-second fs-4"></i>
                        </button>
                        {{-- word delete --}}
                        <button type="button" class="btn py-0" data-bs-toggle="modal" data-bs-target="#deleteQuestionModal">
                            <i class="fa-solid fa-trash text-danger fs-4"></i>
                        </button>
                    </td>
                </tr>
                @endfor
            </tbody>
        </table>
    </form>



</div>


{{-- Add Quiz Modal --}}
<div class="modal fade" id="addQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Quiz</h1>
        </div>
        <div class="modal-body">
          <form action="#" method="post" class="w-75 m-auto">
            @csrf
            @method('GET')
            <div class="row align-items-center">
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Question: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Answer: </p>
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

<!-- Delete Quiz Modal -->
<div class="modal fade" id="deleteQuizModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Quiz</h1>
        </div>
        <div class="modal-body">
          <form action="#" method="post" class="w-75 m-auto">
            @csrf
            <p class="mb-5">Are you sure you want to delete quiz <span class="fw-bold">title</span>?</p>
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

{{-- Edit Quiz Modal --}}
<div class="modal fade" id="editQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Quiz</h1>
        </div>
        <div class="modal-body">
          <form action="#" method="post" class="w-75 m-auto">
            @csrf
            @method('GET')
            <div class="row align-items-center">
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Question: </p>
                </div>
                <div class="col-7">
                    <input type="text" name="title" class="form-control">
                </div>
                <div class="col-5 my-3 fw-semibold">
                    <p class="text-second">Answer: </p>
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
                    <button type="submit" class="btn btn-yellow w-100">Edit</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>

<!-- Delete Question Modal -->
<div class="modal fade" id="deleteQuestionModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Question</h1>
        </div>
        <div class="modal-body">
          <form action="#" method="post" class="w-75 m-auto">
            @csrf
            <p class="mb-3">Are you sure you want to delete this Question?</p>
            <div class="row align-items-center mb-5">
                <div class="col-3 my-3 fw-semibold">
                    <p class="text-second">Question: </p>
                </div>
                <div class="col-9">
                    <p class="text-second">Question</p>
                </div>
                <div class="col-3 my-3 fw-semibold">
                    <p class="text-second">Answer: </p>
                </div>
                <div class="col-9">
                    <p class="text-second">Answer</p>
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

@endsection
