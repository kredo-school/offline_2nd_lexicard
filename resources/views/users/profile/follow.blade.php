@extends('layouts.app')

@section('titel', 'Profile')

@section('content')

<div class="container">
    <div class="row my-5">
        <div class="col-4">
            <div class="d-flex justify-content-end me-4">
                <i class="fa-solid fa-circle-user text-second fa-9x"></i>
            </div>
        </div>
        <div class="col-8">
            <div class="d-flex">
                <div class="">
                    <p class="display-4">Shinsaku</p>
                    <p class="fs-3">shinsaku32823@gmail.com</p>
                </div>
                <a href="{{ route('profile.profile.edit') }}" class="btn btn-second d-flex h-100 mx-5 my-4">Edit Profile</a>
            </div>
            <div class="d-flex mt-3">
                <a href="{{ route('profile.profile.index') }}" class="text-decoration-none text-second me-4">10 category</a>
                <a href="{{ route('profile.follow') }}" class="text-decoration-none text-second me-4">0 follower</a>
                <a href="{{ route('profile.follow') }}" class="text-decoration-none text-second me-4">3 following</a>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-6">
            <p class="text-yellow bg-second text-center p-2 mx-2 fs-5">Following</p>
            @for($i=0;$i< 10;$i++)
                <div class="row bg-yellow border rounded-4 p-2 mx-2 my-3 align-items-center">
                    <div class="col-7">
                        {{-- if the category is from other user, it will display avatar and username --}}
                        <p class="text-second fs-2 ms-3"><i class="fa-solid fa-circle-user fs-1"></i> Username</p>
                    </div>
                    <div class="col-5 justify-content-end d-flex">
                        <button type="button" class="btn btn-second w-50 p-2 fs-6  m-3" data-bs-toggle="modal" data-bs-target="#kickoutUser">
                            <i class="fa-solid fa-user-slash"></i> Unfollow
                        </button>
                    </div>
                </div>
            @endfor
        </div>
        <div class="col-6">
            <p class="text-yellow bg-second text-center p-2 mx-2 fs-5">Followed</p>
            @for($i=0; $i<10; $i++)
                <div class="row bg-yellow border rounded-4 p-2 mx-2 my-3 align-items-center">
                    <div class="col-7">
                        {{-- if the category is from other user, it will display avatar and username --}}
                        <p class="text-second fs-2 ms-3"><i class="fa-solid fa-circle-user fs-1"></i> Username</p>
                    </div>
                    <div class="col-5 justify-content-end d-flex">
                        <button type="button" class="btn btn-second w-50 p-2 fs-6 m-3" data-bs-toggle="modal" data-bs-target="#kickoutUser">
                            <i class="fa-solid fa-user-plus"></i> Follow
                        </button>
                    </div>
                </div>
            @endfor
        </div>
        </div>
</div>

@endsection
