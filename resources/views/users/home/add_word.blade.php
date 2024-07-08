@extends('layouts.app')

@section('title', 'Add Word')

@section('content')


<div class="container m-auto">
    <form action="{{ route('word.word.store') }}" method="post">
        @csrf

        <input type="hidden" name="word" value="{{ $word }}">
        <input type="hidden" name="meaning" value="{{ $meaning }}">
        <input type="hidden" name="definition" value="{{ $definition }}">
        <input type="hidden" name="example" value="{{ $example_with_it }}">

        <div class="row justify-content-between w-75 m-auto align-items-center">
            <div class="col-1 text-center">
                <a href="{{ route('home') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
            </div>
            <div class="col-8">
                <p class="text-second bg-yellow p-3 my-5 text-center w-50 m-auto fw-semibold fs-4">{{ $word }}</p>
            </div>
            <div class="col-1">

            </div>
        </div>
        <table class="table w-75 m-auto my-5 table-sm">
            <tr>
                <td class="text-end text-second pb-4 w-25 fw-semibold">意味:</td>
                <td class="text-second w-75">
                    {{ $meaning }}
                </td>
            </tr>
            <tr>
                <td class="text-end text-second pb-5 w-25 fw-semibold">definition:</td>
                <td class="text-second w-75">{{ $definition }}</td>
            </tr>
            <tr>
                <td class="text-end text-second pb-5 w-25 fw-semibold">example sectence:</td>
                <td class="text-second w-75">{{ $example }}</td>
            </tr>
        </table>
        @if(isset($current_category))
            <div class="col-5 p-0 m-auto">
                <input type="hidden" name="category" value="{{ $current_category->id }}">
                <input type="hidden" name="page" value="0">
                <button type="submit" class="btn btn-yellow w-100">Add to {{ $current_category->name }} Category</button>
            </div>
        @else
            <p class="fs-small p-2 w-75 m-auto">Choose category if you want to add to the category</p>
            <div class="row w-75 mx-auto mb-5">
                <div class="col-5 p-0 text-second">
                    <select class="form-select text-second" name="category">
                        <option selected hidden>Choose the category</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-2"></div>
                <input type="hidden" name="page" value="1">
                <div class="col-5 p-0">
                    <button type="submit" class="btn btn-yellow w-100">Add to Category</button>
                </div>
            </div>
        @endif
    </form>
</div>

@endsection
