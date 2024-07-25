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
                <a href="{{ route('profile.index', $user->id) }}" class="text-decoration-none text-second me-4">{{ $user->categories->count() }} category</a>
                <a href="{{ route('profile.follow', $user->id) }}" class="text-decoration-none text-second me-4">{{ $user->follower()->count() }} follower</a>
                <a href="{{ route('profile.follow', $user->id) }}" class="text-decoration-none text-second me-4">{{ $user->following()->count() }} following</a>
            </div>
        </div>
    </div>

    <div class="row my-5">
        <div class="col-6">
            <p class="text-yellow bg-second text-center p-2 mx-2 fs-5">Follower</p>
            @forelse($user->follower as $follower)
                <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                    <div class="col-7">
                        @if($follower->follower->image)
                            <a href="{{ route('profile.profile.show', $follower->follower->id) }}" class="text-second fs-4 text-decoration-none d-flex align-items-center"><img src="{{ $follower->follower->image }}" alt="" class="rounded-circle avatar-md me-2">{{ $follower->follower->name }}</a>
                        @else
                        <a href="{{ route('profile.profile.show', $follower->follower->id) }}" class="text-second fs-4 text-decoration-none d-flex align-items-center"><i class="fa-solid fa-circle-user fa-2x me-2"></i>{{ $follower->follower->name }}</a>
                        @endif
                    </div>
                    <div class="col-5 justify-content-end d-flex">
                        @if($follower->follower->id != Auth::id())
                            @if($follower->follower->isFollowed())
                                <form action="{{ route('follow.destroy', $follower->follower->id) }}" method="post" class="mb-0">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-second p-2 fs-6">Unfollow</button>
                                </form>
                            @else
                                <form action="{{ route('follow.store') }}" method="post" class="mb-0">
                                    @csrf
                                    <input type="hidden" value="{{ $follower->follower->id }}" name="following_id">
                                    <button type="submit" class="btn btn-second p-2 fs-6">follow</button>
                                </form>
                            @endif
                        @endif
                    </div>
                </div>
            @empty
                <div class="my-5 col-12 text-center fs-5">
                    No users followed yet.
                </div>
            @endforelse
        </div>
        <div class="col-6">
            <p class="text-yellow bg-second text-center p-2 mx-2 fs-5">Following</p>
            @forelse($user->following as $following)
                <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                    <div class="col-7">
                        @if($following->following->image)
                            <a href="{{ route('profile.profile.show', $following->following->id) }}" class="text-second fs-4 text-decoration-none d-flex align-items-center"><img src="{{ $following->following->image }}" alt="" class="rounded-circle avatar-md me-2">{{ $following->following->name }}</a>
                        @else
                            <a href="{{ route('profile.profile.show', $following->following->id) }}" class="text-second fs-4 text-decoration-none d-flex align-items-center"><i class="fa-solid fa-circle-user fa-2x me-2"></i>{{ $following->following->name }}</a>
                        @endif
                    </div>
                    <div class="col-5 justify-content-end d-flex">
                        @if($following->following->id != Auth::id())
                            <form action="{{ route('follow.destroy', $following->following->id) }}" method="post" class="mb-0">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-second p-2 fs-6">Unfollow</button>
                            </form>
                        @endif
                    </div>
                </div>
            @empty
                <div class="col-12 text-center my-5 fs-5">
                    No users following yet.
                </div>
            @endforelse
        </div>
    </div>
</div>

@endsection
