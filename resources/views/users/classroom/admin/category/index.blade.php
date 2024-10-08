@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    {{-- category list --}}
        <div class="col-8">
            @forelse($classroom->categories as $category)
            <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                <div class="col-4">
                </div>
                <div class="col-4 text-center">
                    <a href="{{ route('classroom.admin.category.show', $category->id) }}" class="text-second text-decoration-none fw-bold fs-3">{{ $category->name }}</a>
                </div>
                <div class="col-2 justify-content-end d-flex align-items-center">
                    @if($category->isliked())
                        <form action="{{ route('like.destroy', $category->id) }}" method="post" class="mb-0 me-2">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn p-0 text-danger"><i class="fa-solid fa-heart"></i></button>
                        </form>
                    @else
                        <form action="{{ route('like.store') }}" method="post" class="mb-0 me-2">
                            @csrf
                            <input type="hidden" value="{{ $category->id }}" name="category_id">
                            <button type="submit" class="btn p-0 text-second"><i class="fa-regular fa-heart"></i></button>
                        </form>
                    @endif
                    <p class="text-second">{{ $category->like->count() }}</p>
                </div>
                <div class="col-2 justify-content-end d-flex align-items-center">
                    <p class="text-second text-end ms-3">{{ $category->categoryWord->count() }}  Words</p>
                </div>
            </div>
            @empty
                <p class="text-second text-center p-5">No categories yet.</p>
            @endforelse
        </div>
    {{-- side bar --}}
        <div class="col-4">
            {{-- Create New Category --}}
            <button type="button" class="btn btn-yellow w-100 p-3 fs-5 border border-second rounded-4 my-3" data-bs-toggle="modal" data-bs-target="#createNewCategoryModal-{{ $classroom->id }}">
                Create New Category
            </button>
            @error('category')
                <p class="text-danger text-center">{{ $errors->first('category') }}</p>
            @enderror
        </div>
    </div>


</div>

{{-- Create New Category Modal --}}
<div class="modal fade" id="createNewCategoryModal-{{ $classroom->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Category</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('classroom.admin.category.store', $classroom->id) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('GET')
            <input type="text" name="category" class="form-control my-4">
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
