@extends('layouts.app')

@section('title', 'Word Detail')

@section('content')

<div class="container">
    <div class="row w-100 m-auto align-items-center">
        {{-- back --}}
        <div class="col-2 text-center">
            <a href="{{ route('category.category.index') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
        </div>
        {{-- like --}}
        <div class="col-2 text-start">

        </div>
        <div class="col-4">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">Apple</p>
        </div>
        {{-- edit --}}
        <div class="col-2 text-end">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editWord">
                <i class="fa-solid fa-pen-to-square fs-2 text-second"></i>
                <p class="fs-small text-second">EDIT</p>
            </button>
        </div>
        {{-- delete --}}
        <div class="col-2 text-center">
            <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteWord">
                <i class="fa-solid fa-trash fs-2 text-danger"></i>
                <p class="fs-small text-second">DELETE</p>
            </button>
        </div>
    </div>

    <table class="table w-75 m-auto my-5 table-borderless">
        <tr>
            <td class="text-end text-second pb-4 w-25 fs-5 fw-semibold">意味:</td>
            <td class="text-second w-75 fs-5">意味、語</td>
        </tr>
        <tr>
            <td class="text-end text-second pb-5 w-25 fs-5 fw-semibold">definition:</td>
            <td class="text-second w-75 fs-5">a single unit of language that has meaning and can be spoken or written </td>
        </tr>
        <tr>
            <td class="text-end text-second pb-5 w-25 fs-5 fw-semibold">example sectence:</td>
            <td class="text-second w-75 fs-5">Your paper should be no more than two thousand words long.</td>
        </tr>
    </table>


</div>


<!-- Edit Word Modal -->
<div class="modal fade" id="editWord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Word</h1>
        </div>
        <div class="modal-body">
          <form action="#" method="post" class="m-auto">
            @csrf
            <table class="table table-borderless my-4">
                <tr>
                    <td class="text-end text-second pb-4 w-25">Word:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="category" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-4 w-25">意味:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="category" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-5 w-25">definition:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="category" class="form-control pb-5">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-5 w-25">example sectence:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="category" class="form-control pb-5">
                    </td>
                </tr>
            </table>
            <div class="row my-4">
                <div class="col-3">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-9">
                    <button type="submit" class="btn btn-yellow w-100">Add</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>

<!-- Delete Word Modal -->
<div class="modal fade" id="deleteWord" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Word</h1>
        </div>
        <div class="modal-body">
          <form action="#" method="post" class="w-75 m-auto">
            @csrf
            @method('DELETE')
            <p class="mb-5">Are you sure you want to delete word <span class="fw-bold">apple</span>?</p>
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

