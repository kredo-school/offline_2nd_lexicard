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
                <form action="#" method="post" class="text-center">
                    <button type="submit" class="btn btn-yellow w-50 text-center p-2 border border-second rounded-4 my-3">Join</button>
                </form>
            </div>
        </div>
    </div>


    <div class="row">
    {{-- category list --}}
        <div class="col-8">
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
    {{-- side bar --}}
        <div class="col-4">
            {{-- Quiz --}}
            <a href="{{ route('classroom.quiz.index') }}" type="button" class="btn btn-yellow w-100 p-3 fs-5 border border-second rounded-4 my-3">
                Quiz
            </a>
            {{-- Sort Category --}}
            <form action="#" method="post" class="my-3 border border-second text-center">
                <p class="bg-second text-yellow fs-3 p-2">Sort</p>
                <ul class="list-unstyled">
                    <button type="submit" name="all" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second">All</button>
                    <button type="submit" name="my_category" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second">Liked</button>
                    <button type="submit" name="liked" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second">Popular</button>
                </ul>
            </form>
            {{-- Admin --}}
            <button type="button" class="btn btn-yellow w-100 p-3 fs-5 border border-second rounded-4 my-3" data-bs-toggle="modal" data-bs-target="#adminPasswordModal">
                Admin
            </button>
        </div>
    </div>


</div>

{{-- Admin Password Modal --}}
<div class="modal fade" id="adminPasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Enter the Password</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('classroom.admin.index') }}" method="post" class="w-75 m-auto">
            @csrf
            @method('GET')
            <input type="text" name="category" class="form-control my-4">
            <div class="row justify-content-between my-4">
                <div class="col-5">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-yellow w-100">Submit</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>

@endsection
