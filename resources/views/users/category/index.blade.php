@extends('layouts.app')

@section('title', 'Category List')

@section('content')

<div class="container">
    <div class="row w-100 m-auto align-items-center">
        {{-- back --}}
        <div class="col-2 text-center">
            <a href="{{ route('home') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
        </div>
        {{-- like --}}
        <div class="col-2 text-start">
            <i class="fa-regular fa-heart fs-1"></i>
        </div>
        <div class="col-4">
            <p class="text-yellow bg-second p-2 my-5 text-center w-100 m-auto fs-3">{{ $category->name }}</p>
        </div>
        {{-- edit --}}
        <div class="col-2 text-end">
            <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editCategory-{{$category->id}}">
                <i class="fa-solid fa-pen-to-square fs-2 text-second"></i>
                <p class="fs-small text-second">EDIT</p>
            </button>
        </div>
        {{-- delete --}}
        <div class="col-2 text-center">
            <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteCategory-{{$category->id}}">
                <i class="fa-solid fa-trash fs-2 text-danger"></i>
                <p class="fs-small text-second">DELETE</p>
            </button>
        </div>
    </div>

    {{-- Add --}}
    <div class="w-75 m-auto">
        <p class="ps-2">ADD NEW WORD</p>
        <div class="row">
            <div class="col-7">
                <form action="{{ route('word.word.create') }}" method="post" class="my-3">
                    @csrf
                    @method('GET')
                    <div class="input-group my-2">
                        <input type="text" name="word" class="form-control rounded-start-4">
                        <input type="hidden" name="category" value="{{ $category->id }}">
                        <button class="btn btn-search rounded-end-4 px-4 py-2" type="submit">ADD</button>
                      </div>
                </form>
            </div>
            <div class="col-5">
                <button type="button" class="btn btn-yellow w-100 p-2 border border-second rounded-4 my-3" data-bs-toggle="modal" data-bs-target="#addMore">
                    Add More
                </button>
            </div>
        </div>
    </div>

    {{-- Word List --}}
    <div class="my-5">
        @forelse($category->categoryWord as $word)
            <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                <div class="col-4">
                    <a href="{{ route('word.word.show', $word->word, $category) }}" class="text-second text-decoration-none fs-3">{{ $word->word->word }}</a>
                </div>
                <div class="col-6">
                    <a href="{{ route('word.word.show', $word->word, $category) }}" class="text-second text-decoration-none fw-semibold fs-3">{{ $word->word->meaning }}</a>
                </div>
                <div class="col-2 justify-content-evenly d-flex">
                    {{-- word edit --}}
                    <button type="button" class="btn" data-bs-toggle="modal" data-bs-target="#editWord-{{ $word->word->id }}">
                        <i class="fa-solid fa-pen-to-square fs-2 text-second"></i>
                    </button>
                    {{-- word delete --}}
                    <button type="button" class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteWord-{{ $word->word->id }}">
                        <i class="fa-solid fa-trash fs-2 text-danger"></i>
                    </button>
                </div>
            </div>
        @empty
            <p class="text-center text-second my-5">No Word</p>
        @endforelse
    </div>
</div>



<!-- Edit Category Modal -->
<div class="modal fade" id="editCategory-{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Category Name</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.category.update', $category) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('PATCH')
            <input type="text" name="category" value="{{$category->name}}" class="form-control my-4 text-second">
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

<!-- Delete Category Modal -->
<div class="modal fade" id="deleteCategory-{{$category->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Category</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.category.destroy', $category) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('DELETE')
            <p class="mb-5">Are you sure you want to delete <span class="fw-bold">{{ $category->name }}</span> category?</p>
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

<!-- Edit Word Modal -->
@forelse($category->categoryWord as $word)
<div class="modal fade" id="editWord-{{ $word->word->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Word</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('word.word.update', $word->word) }}" method="post" class="m-auto">
            @csrf
            @method(('PATCH'))
            <table class="table table-borderless my-4">
                <tr>
                    <td class="text-end text-second pb-4 w-25">Word:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="word" value="{{ $word->word->word }}" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-4 w-25">meaning:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="meaning" value="{{ $word->word->meaning }}" class="form-control">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-5 w-25">definition:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="definition" value="{{ $word->word->definition }}" class="form-control pb-5">
                    </td>
                </tr>
                <tr>
                    <td class="text-end text-second pb-5 w-25">example sectence:</td>
                    <td class="text-second w-75 pt-0">
                        <input type="text" name="example" value="{{ $word->word->example }}" class="form-control pb-5">
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
<div class="modal fade" id="deleteWord-{{ $word->word->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Delete Word</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('word.word.destroy', $word->word) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('DELETE')
            <p class="mb-5">Are you sure you want to delete word <span class="fw-bold">{{ $word->word->word }}</span>?</p>
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

<!-- add More Modal -->
<div class="modal fade" id="addMore" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add More</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('word.word.store_more') }}" method="post" class="w-75 m-auto">
            @csrf
            @method('GET')
                @for($i = 0; $i < 5; $i++)
                    <input type="text" name="word[]" class="form-control my-4">
                @endfor
                <input type="hidden" name="category" value="{{ $category->id }}">
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
