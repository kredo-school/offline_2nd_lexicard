@extends('layouts.app')

@section('title', 'other user category list')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-10 m-auto">
            {{-- sort --}}
            <div class="my-5">
                <p class="bg-second text-yellow text-center p-2 fs-4">Sort</p>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                        <button type="submit" name="liked" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-100 text-second">Most Liked</button>
                    </div>
                    <div class="col-5">
                        <button type="submit" name="recent" class="btn btn-outline-second border rounded-4 mt-4 fs-5 w-100 text-second">Recently Added</button>
                    </div>
                </div>
                <div class="row justify-content-evenly">
                    <div class="col-5">
                        <form action="#" method="post" class="my-3">
                            @csrf
                            @method('GET')
                            <p class="text-second">Search from Username</p>
                            <div class="input-group my-2">
                                <input type="text" name="word" class="form-control rounded-start-4 p-2">
                                <button class="btn btn-search rounded-end-4" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-5">
                        <form action="#" method="post" class="my-3">
                            @csrf
                            @method('GET')
                            <p class="text-second">Search from Category name</p>
                            <div class="input-group my-2">
                                <input type="text" name="word" class="form-control rounded-start-4 p-2">
                                <button class="btn btn-search rounded-end-4" type="submit">Search</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="my-5">
            {{-- category list --}}
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
        </div>
    </div>
</div>

@endsection
