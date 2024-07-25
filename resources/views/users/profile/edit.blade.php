@extends('layouts.app')

@section('title', 'Edit Profile')

@section('content')

<div class="container m-auto">
    <form action="{{ route('profile.profile.update', $user->id) }}" method="post" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="row justify-content-between w-75 m-auto align-items-center">
            <div class="col-1 text-center">
                <a href="{{ route('profile.index', $user->id) }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
            </div>
            <div class="col-8">
                <p class="text-second bg-yellow p-3 my-5 text-center w-50 m-auto fs-4">Edit Profile</p>
            </div>
            <div class="col-1">

            </div>
        </div>

        <div class="row">
            <div class="col-9 m-auto">
                <div class="row my-5">
                    <div class="col-5">
                        <p class="text-second fs-4">Username: </p>
                    </div>
                    <div class="col-7">
                        <input type="text" class="form-control" value="{{ $user->name }}" name="name">
                    </div>
                </div>
                <div class="row my-5">
                    <div class="col-5">
                        <p class="text-second fs-4">Email: </p>
                    </div>
                    <div class="col-7">
                        <input type="text" class="form-control" value="{{ $user->email }}" name="email">
                    </div>
                </div>

                <div class="row my-5">
                    <div class="col-5">
                        <p class="text-second fs-4">Image: </p>
                    </div>
                    <div class="col-7">
                        <input type="file" name="image" class="form-control" id="">
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
