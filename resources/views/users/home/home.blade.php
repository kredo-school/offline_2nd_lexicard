@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
    {{-- category list --}}
        <div class="col-8">
            @foreach($categories as $category)
                <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                    <div class="col-4">
                        {{-- if the category is from other user, it will display avatar and username --}}
                        <p class="text-second fs-5"><i class="fa-solid fa-circle-user fs-3"></i> Username</p>
                    </div>
                    <div class="col-4 text-center">
                        <a href="{{ route('category.category.show', $category) }}" class="text-second text-decoration-none fw-bold fs-3">{{ $category->name }}</a>
                    </div>
                    <div class="col-4 justify-content-end d-flex">
                        <p class="text-second text-end"><i class="fa-regular fa-heart"></i>  0</p>
                        <p class="text-second text-end ms-3">30  Words</p>
                    </div>
                </div>
            @endforeach
        </div>
    {{-- side bar --}}
        <div class="col-4">
            {{-- dictionary/add word --}}
            <form action="{{ route('word.word.create') }}" method="post" class="my-3">
                @csrf
                @method('GET')
                <p class="text-second">Dictionary / Quick Add</p>
                <div class="input-group my-2">
                    <input type="text" name="word" class="form-control rounded-start-4">
                    <button class="btn btn-search rounded-end-4" type="submit">Search</button>
                  </div>
            </form>
            {{-- Create New Category --}}
            <button type="button" class="btn btn-yellow w-100 p-3 fs-5 border border-second rounded-4 my-3" data-bs-toggle="modal" data-bs-target="#createNewCategoryModal">
                Create New Category
            </button>
            {{-- Sort Category --}}
            <form action="#" method="post" class="my-3 border border-second text-center">
                <p class="bg-second text-yellow fs-3 p-2">Sort</p>
                <ul class="list-unstyled">
                    <button type="submit" name="all" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second">All</button>
                    <button type="submit" name="my_category" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second">My Category</button>
                    <button type="submit" name="liked" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second">Liked</button>
                    <button type="submit" name="popular" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second">Popular</button>
                    <div class="input-group mb-3 m-auto mt-4 w-75">
                        <select class="form-select border rounded-start-4 text-second fs-5 text-center" name="other_user">
                          <option hidden>Other User</option>
                          <option value="1">One</option>
                          <option value="2">Two</option>
                          <option value="3">Three</option>
                        </select>
                        <button class="btn btn-outline-second border rounded-end-4 text-second fs-5" type="button">Button</button>
                    </div>
                </ul>
            </form>
        </div>
    </div>


</div>


{{-- Create New Category Modal --}}
<div class="modal fade" id="createNewCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Category</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.category.store') }}" method="post" class="w-75 m-auto">
            @csrf
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
