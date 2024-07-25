@extends('layouts.app')

@section('titel', 'Profile')

@section('content')

<div class="container">
    <div class="row my-5">
        <div class="col-4">
            <div class="d-flex justify-content-end me-4">
                @if($user->image)
                    <img src="{{ $user->image }}" class="avatar-lg rounded-circle">
                @else
                    <i class="fa-solid fa-circle-user text-second fa-9x"></i>
                @endif
            </div>
        </div>
        <div class="col-8">
            <div class="d-flex">
                <div class="">
                    <p class="display-4">{{ $user->name }}</p>
                    <p class="fs-3">{{ $user->email }}</p>
                </div>
                @if($user->id == Auth::id())
                    <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-second d-flex h-100 mx-5 my-4">Edit Profile</a>
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
                <a href="{{ route('profile.index', $user->id) }}" class="text-decoration-none text-second me-4">{{ $user->categories->count() }} categories</a>
                <a href="{{ route('profile.follow', $user->id) }}" class="text-decoration-none text-second me-4">{{ $user->follower()->count() }} follower</a>
                <a href="{{ route('profile.follow', $user->id) }}" class="text-decoration-none text-second me-4">{{ $user->following()->count() }} following</a>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-8">
        {{-- Category --}}
            <p class="text-yellow bg-second text-center p-2 mx-2 fs-5">My Category</p>
            @forelse($user->categories as $category)
                <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                    <div class="col-4">
                    </div>
                    <div class="col-4 text-center">
                        <a href="{{ route('profile.category', $category) }}" class="text-second text-decoration-none fw-bold fs-3">{{ $category->name }}</a>
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
        <div class="col-4">
        {{-- Classroom --}}
            <p class="text-yellow bg-second text-center p-2 mx-2 fs-5">My Class</p>
            @forelse($classrooms as $classroom)
                <div class="mb-3">
                    <a href="{{ route('classroom.classroom.show', $classroom->id) }}" class="card m-2 shadow-sm p-3 rounded text-start text-decoration-none">
                        <img src="{{ $classroom->image }}" alt="" class="logo-lg">
                        <p class="text-second fs-5 my-2">{{ $classroom->name }}</p>
                        <p class="mb-2">{{ $classroom->description }}</p>
                    </a>
                </div>
            @empty
                <p class="text-second text-center p-5">No class yet.</p>
            @endforelse
        </div>
    </div>
</div>

@endsection
