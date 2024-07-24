@extends('layouts.app')

@section('title', 'Word Detail')

@section('content')

<div class="container">
    <div class="row w-100 m-auto align-items-center">
        {{-- back --}}
        <div class="col-2 text-center">
            @foreach($word->categoryWord as $pivot)
                @if (\Route::is('classroom.admin.*'))
                    <a href="{{ route('classroom.admin.category.show', $pivot->category_id) }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
                @elseif (\Route::is('classroom.*'))
                    <a href="{{ route('classroom.category', $pivot->category_id) }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
                @else
                    <a href="{{ route('category.category.show', $pivot->category_id) }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
                @endif
            @endforeach
        </div>
        {{-- like --}}
        <div class="col-2 text-start">

        </div>
        <div class="col-4">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">{{ $word->word }}</p>
        </div>
        {{-- edit --}}
        <div class="col-2 text-end">
            @if($word->user_id == Auth::id() || \Route::is('classroom.admin.*'))
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editWord-{{ $word->id }}">
                <i class="fa-solid fa-pen-to-square fs-2 text-second"></i>
                <p class="fs-small text-second">EDIT</p>
            </button>
            @endif
        </div>
        {{-- delete --}}
        <div class="col-2 text-center">
            @if($word->user_id == Auth::id() || \Route::is('classroom.admin.*'))
            <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteWord-{{ $word->id }}">
                <i class="fa-solid fa-trash fs-2 text-danger"></i>
                <p class="fs-small text-second">DELETE</p>
            </button>
            @endif
        </div>
    </div>

    <table class="table w-75 m-auto my-5 table-borderless">
        <tr>
            <td class="text-end text-second pb-4 w-25 fs-5 fw-semibold">meaning:</td>
            <td class="text-second w-75 fs-5">{{ $word->meaning }}</td>
        </tr>
        <tr>
            <td class="text-end text-second pb-5 w-25 fs-5 fw-semibold">definition:</td>
            <td class="text-second w-75 fs-5">{{ $word->definition }}</td>
        </tr>
        <tr>
            <td class="text-end text-second pb-5 w-25 fs-5 fw-semibold">example sectence:</td>
            <td class="text-second w-75 fs-5">{{ $example }}</td>
        </tr>
    </table>




</div>


<!-- Edit Word Modal -->
<div class="modal fade" id="editWord-{{ $word->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Word</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('word.word.update', $word) }}" method="post" class="m-auto">
            @csrf
            @method(('PATCH'))
            <table class="table table-borderless my-4">
                <tr>
                    <td class="text-end text-second pb-4 w-25">Word:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="word" value="{{ $word->word }}" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-4 w-25">meaning:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="meaning" value="{{ $word->meaning }}" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-5 w-25">definition:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="definition" value="{{ $word->definition }}" class="form-control pb-5">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-5 w-25">example sectence:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="example" value="{{ $word->example }}" class="form-control pb-5">
                    </td>
                </tr>
            </table>
            <div class="row my-4">
                <div class="col-3">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-9">
                    <button type="submit" class="btn btn-yellow w-100">Update</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>


<!-- Delete Word Modal -->
<div class="modal fade" id="deleteWord-{{ $word->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Word</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('word.word.destroy', $word) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('DELETE')
            <p class="mb-5">Are you sure you want to delete word <span class="fw-bold">{{ $word->word }}</span>?</p>
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

