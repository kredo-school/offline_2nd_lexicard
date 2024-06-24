@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card border rounded-5 bg-white my-5">
                <div class="card-body">
                    <p class="display-6 bg-white text-center fw-bold text-second mt-4 mb-5">Register</p>
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-4">
                                <p class="text-socond">Name</p>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="col-1">

                            </div>
                            <div class="col-md-4">
                                <p class="text-socond">Email</p>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-9">
                                <p class="text-socond">Password</p>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-9">
                                <p class="text-socond">Confirm Password</p>
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mt-4 mb-0 justify-content-center">
                            <div class="col-md-6 mt-2">
                                <button type="submit" class="btn btn-yellow border rounded-5 w-100">
                                    {{ __('Register') }}
                                </button>

                                @if (Route::has('login'))
                                    <div class="text-center mt-3">
                                        <a class="text-decoration-none text-second" href="{{ route('login') }}"><i class="fa-solid fa-arrow-right"></i> have an account?</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
