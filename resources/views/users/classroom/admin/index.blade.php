@extends('layouts.app')

@section('content')
<div class="container">

    <div class="p-2 border rounded-3 mx-3">
        <div class="row">
            <div class="col-6">
                <img src="{{ $classroom->image }}" alt="" class="w-100 logo-xl">
            </div>
            <div class="col-6 p-4">
                <h1 class="text-second fs-2">
                    {{ $classroom->name }}
                    @if($classroom->status_id == 1)
                        <i class="fa-solid fa-unlock"></i>
                    @else
                        <i class="fa-solid fa-lock"></i>
                    @endif
                </h1>
                <p class="text-second">{{ $classroom->userClassroom->count() }} students</p>
                <p class="text-second fs-5 pb-5 mt-3 h-50">{{ $classroom->description }}</p>
                <div class="d-flex justify-content-center">
                    <form action="{{ route('classroom.admin.edit', $classroom->id) }}" method="post" class="text-center">
                        @csrf
                        @method('GET')
                        <button type="submit" class="btn btn-cancel text-center p-2 px-5 me-4 border border-second rounded-4 my-3">Edit Profile</button>
                    </form>
                    <button type="button" class="btn btn-delete text-center p-2 px-5 ms-4 border border-second rounded-4 my-3" data-bs-toggle="modal" data-bs-target="#deleteClassroom-{{ $classroom->id }}">
                        Delete Classroom
                    </button>
                </div>
            </div>
        </div>
    </div>



    <div class="my-5">
        <div class="row">
            @forelse($classroom->userClassroom as $user)
            <div class="col-6">
                <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                    <div class="col-8">
                        {{-- if the category is from other user, it will display avatar and username --}}
                        <a href="{{ route('profile.profile.show', $user->user->id) }}" class="text-second fs-5 text-decoration-none"><i class="fa-solid fa-circle-user fs-3"></i> {{ $user->user->name }}</a>
                    </div>
                    <div class="col-4 justify-content-end d-flex">
                        <button type="button" class="btn btn-second w-50 p-2 fs-5 border border-second rounded-5 m-3" data-bs-toggle="modal" data-bs-target="#kickoutUser-{{ $user->user->id }}-{{ $classroom->id }}">
                            <i class="fa-solid fa-user-slash"></i> Kick
                        </button>
                    </div>
                </div>
            </div>
            @empty
                <div class="col-12 text-center">
                    No students yet.
                </div>
            @endforelse
        </div>
    </div>



</div>

<!-- Kickout User Modal -->
@foreach($classroom->userClassroom as $user)
    <div class="modal fade" id="kickoutUser-{{ $user->user->id }}-{{ $classroom->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header justify-content-center">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Kick out user</h1>
            </div>
            <div class="modal-body">
            <form action="{{ route('classroom.admin.user.delete', $classroom->id) }}" method="post" class="w-75 m-auto">
                @csrf
                @method('GET')
                <p class="mb-5">Are you sure you want to kick <span class="fw-bold">{{ $user->user->name }}</span> ?</p>
                <div class="row justify-content-between my-4">
                    <div class="col-5">
                        <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                    </div>
                    <div class="col-5">
                        <input type="hidden" name="user_id" value="{{ $user->user->id }}">
                        <button type="submit" class="btn btn-delete w-100">Delete</button>
                    </div>
                </div>
            </form>

            </div>
        </div>
        </div>
    </div>
@endforeach

<!-- Delete Classroom Modal -->
<div class="modal fade" id="deleteClassroom-{{ $classroom->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header justify-content-center">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Kick out user</h1>
        </div>
        <div class="modal-body">
        <form action="{{ route('classroom.admin.delete', $classroom->id) }}" method="post" class="w-75 m-auto">
            @csrf
            @method('GET')
            <p class="mb-5">Are you sure you want to delete <span class="fw-bold">{{ $classroom->name }}</span> classroom ?</p>
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

@endsection
