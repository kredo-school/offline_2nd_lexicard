@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container m-auto">

    <div class="row justify-content-between w-75 m-auto align-items-center">
        <div class="col-1 text-center">
            <a href="{{ route('classroom.classroom.index') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
        </div>
        <div class="col-8">
            <p class="text-second bg-yellow p-3 my-5 text-center w-50 m-auto fs-4">Create Class</p>
        </div>
        <div class="col-1">

        </div>
    </div>

    <form action="{{ route('classroom.classroom.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-9 m-auto">
                <div class="row my-5">
                    <div class="col-5">
                        <p class="text-second fs-4">Classroom name: </p>
                    </div>
                    <div class="col-7">
                        <input type="text" name="name" class="form-control">
                        @error('name')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-5 mb-5">
                        <p class="text-second fs-4">Description: </p>
                    </div>
                    <div class="col-7">
                        <textarea name="description" class="form-control"rows="5"></textarea>
                        @error('description')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-6 form-check align-items-center">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <input type="radio" name="status" value="2" class="form-check-input me-3" id="inlineCheckbox1">
                                <label class="form-check-label fs-4" for="inlineCheckbox1">Private</label>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <input type="radio" name="status" value="1" class="form-check-input me-3" id="inlineCheckbox2">
                                <label class="form-check-label fs-4" for="inlineCheckbox2">Public</label>
                            </div>
                        </div>
                        @error('status')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <div class="d-flex">
                            <p class="text-second fs-4 me-3">Image: </p>
                            <input type="file" name="image" class="form-control">
                        </div>
                        @error('image')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-5">
                        <p class="text-second fs-4 mt-4">Password: </p>
                        <p class="text-second fs-4 mt-4">Conform Password: </p>
                    </div>
                    <div class="col-7">
                        <input type="text" name="password" class="form-control mt-4">
                        <input type="text" name="password_confirmation" class="form-control mt-4">
                        @error('password')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-yellow w-25 p-2 fs-4">Create</button>
        </div>


    </form>
</div>

@endsection
