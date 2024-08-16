@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container m-auto">
    <form action="{{ route('classroom.admin.update', $classroom->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('GET')
        <div class="row justify-content-between w-75 m-auto align-items-center">
            <div class="col-1 text-center">
                <a href="{{ route('classroom.admin.index', $classroom->id) }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
            </div>
            <div class="col-8">
                <p class="text-second bg-yellow p-3 my-5 text-center w-50 m-auto fs-4">Edit Class</p>
            </div>
            <div class="col-1">

            </div>
        </div>

        <div class="row">
            <div class="col-9 m-auto">
                <div class="row my-5">
                    <div class="col-5">
                        <p class="text-second fs-4">Classroom name: </p>
                    </div>
                    <div class="col-7">
                        <input type="text" name="name" class="form-control" value="{{ $classroom->name }}">
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
                        <textarea name="description" class="form-control"rows="5" >{{ $classroom->description }}</textarea>
                        @error('description')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-6 form-check align-items-center">
                        <div class="row">
                            <div class="col-6 d-flex align-items-center">
                                <input type="radio" name="status" value="2" class="form-check-input me-3" id="inlineCheckbox1" {{($classroom->status_id ==  2) ? 'checked' : '' }}>
                                <label class="form-check-label fs-4" for="inlineCheckbox1">Private</label>
                            </div>
                            <div class="col-6 d-flex align-items-center">
                                <input type="radio" name="status" value="1" class="form-check-input me-3" id="inlineCheckbox2" {{($classroom->status_id ==  1) ? 'checked' : '' }}>
                                <label class="form-check-label fs-4" for="inlineCheckbox2">Public</label>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="d-flex">
                            <p class="text-second fs-4 me-3">Image: </p>
                            <input type="file" name="image" class="form-control" id="">
                        </div>
                        @error('image')
                            <p class="text-danger fw-bold">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
            </div>
        </div>

        <div class="text-center my-5">
            <button type="submit" class="btn btn-yellow border rounded-4 w-25 p-2 fs-4">Save</button>
        </div>


    </form>
</div>

@endsection
