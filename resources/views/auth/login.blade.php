@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4 mt-5">
            <div class="card bg-white border rounded-5">
                <div class="card-body p-5">
                    <p class="display-6 bg-white text-center fw-bold text-second mt-4 mb-5">Login</p>

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="row mb-3 justify-content-center">
                            <div class="col-md-10 mt-5">
                                <p class="text-second fw-bold">email</p>
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-4 justify-content-center">
                            <div class="col-md-10">
                                <p class="text-second fw-bold">password</p>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mt-4 mb-0 justify-content-center">
                            <div class="col-md-10 mt-2">
                                <button type="submit" class="btn btn-yellow border rounded-5 w-100">
                                    {{ __('Login') }}
                                </button>

                                @if (Route::has('register'))
                                    <div class="text-center">
                                        <a class="text-decoration-none text-second" href="{{ route('register') }}"><i class="fa-solid fa-arrow-right"></i> create new account</a>
                                    </div>
                                @endif

                                @if (Route::has('password.request'))
                                    <div class="text-center fs-small">
                                        <a class="text-decoration-none text-second" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
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
