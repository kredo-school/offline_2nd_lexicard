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
                    <p class="display-4">{{ $user->name }}</p>
                    <p class="fs-3">{{ $user->email }}</p>
                </div>
                @if($user->id == Auth::id())
                    <a href="{{ route('profile.profile.edit') }}" class="btn btn-second d-flex h-100 mx-5 my-4">Edit Profile</a>
                @else
                    @if($user->isFollowed())
                        <form action="{{ route('follow.destroy', $user->id) }}" method="post" class="mb-0">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-outline-yellow d-flex mx-5 my-4">Unfollow</button>
                        </form>
                    @else
                        <form action="{{ route('follow.store') }}" method="post" class="mb-0">
                            @csrf
                            <input type="hidden" value="{{ $user->id }}" name="following_id">
                            <button type="submit" class="btn btn-outline-yellow d-flex mx-5 my-4">follow</button>
                        </form>
                    @endif
                @endif
            </div>
            <div class="d-flex mt-3">
                <a href="{{ route('profile.profile.index') }}" class="text-decoration-none text-second me-4">{{ $user->categories->count() }} categories</a>
                <a href="{{ route('profile.follow') }}" class="text-decoration-none text-second me-4">{{ $user->follower()->count() }} follower</a>
                <a href="{{ route('profile.follow') }}" class="text-decoration-none text-second me-4">{{ $user->following()->count() }} following</a>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-8">
            <p class="text-yellow bg-second text-center p-2 mx-2 fs-5">My Category</p>
            @for($i=0;$i< 10;$i++)
                <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                    <div class="col-4">
                        {{-- if the category is from other user, it will display avatar and username --}}
                        <p class="text-second fs-5"><i class="fa-solid fa-circle-user fs-3"></i> Username</p>
                    </div>
                    <div class="col-4 text-center">
                        <a href="{{ route('category.category.index') }}" class="text-second text-decoration-none fw-bold fs-3">TOEIC</a>
                    </div>
                    <div class="col-4 justify-content-end d-flex">
                        <p class="text-second text-end"><i class="fa-regular fa-heart"></i>  0</p>
                        <p class="text-second text-end ms-3">30  Words</p>
                    </div>
                </div>
            @endfor
        </div>
        <div class="col-4">
            <p class="text-yellow bg-second text-center p-2 mx-2 fs-5">My Class</p>
            @for($i=0; $i<3; $i++)
                <div class="mb-3">
                    <a href="{{ route('classroom.classroom.show') }}" class="card m-2 shadow-sm p-3 rounded text-start text-decoration-none">
                        <img src="{{ asset('storage/images/classroom.png') }}" alt="" class="logo-lg">
                        <p class="text-second fs-5 my-2">TOEIC class</p>
                        <p class="mb-2">Let's get high score on the TOEIC</p>
                    </a>
                </div>
            @endfor
        </div>
    </div>
</div>

@endsection
