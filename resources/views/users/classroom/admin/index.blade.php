@extends('layouts.app')

@section('content')
<div class="container">



    <div class="p-2 border rounded-3 mx-3">
        <div class="row">
            <div class="col-6">
                <img src="{{ asset('storage/images/classroom.png') }}" alt="" class="w-100">
            </div>
            <div class="col-6 p-4">
                <h1 class="text-second fs-2">TOEIC class <i class="fa-solid fa-lock"></i></h1>
                <p class="text-second">20 students</p>
                <p class="text-second fs-5 pb-5 mt-3 h-50">Let's get high score on the TOEIC</p>
                <form action="{{ route('classroom.admin.edit') }}" method="post" class="text-center">
                    @csrf
                    @method('GET')
                    <button type="submit" class="btn btn-cancel w-50 text-center p-2 border border-second rounded-4 my-3">Edit Profile</button>
                </form>
            </div>
        </div>
    </div>

    <div class="my-5">
        <div class="row">
            @for($i=0;$i< 10;$i++)
            <div class="col-6">
                <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                    <div class="col-8">
                        {{-- if the category is from other user, it will display avatar and username --}}
                        <p class="text-second fs-2 ms-3"><i class="fa-solid fa-circle-user fs-1"></i> Username</p>
                    </div>
                    <div class="col-4 justify-content-end d-flex">
                        <button type="button" class="btn btn-second w-50 p-2 fs-5 border border-second rounded-5 m-3" data-bs-toggle="modal" data-bs-target="#kickoutUser">
                            <i class="fa-solid fa-user-slash"></i> Kick
                        </button>
                    </div>
                </div>
            </div>
            @endfor
        </div>
    </div>



</div>

<!-- Kickout User Modal -->
<div class="modal fade" id="kickoutUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Kick out user</h1>
        </div>
        <div class="modal-body">
          <form action="#" method="post" class="w-75 m-auto">
            @csrf
            @method('DELETE')
            <p class="mb-5">Are you sure you want to kick <span class="fw-bold">Shinsaku Noto</span> ?</p>
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
