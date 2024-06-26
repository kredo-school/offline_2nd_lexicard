@extends('layouts.app')

@section('title', 'Add Word')

@section('content')

<div class="container m-auto">
    <form action="#" method="post">
        <div class="row justify-content-between w-75 m-auto align-items-center">
            <div class="col-1 text-center">
                <a href="{{ route('home') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
            </div>
            <div class="col-8">
                <p class="text-second bg-yellow p-3 my-5 text-center w-50 m-auto">Word</p>
            </div>
            <div class="col-1">

            </div>
        </div>
        <table class="table w-75 m-auto my-5 table-sm">
            <tr>
                <td class="text-end text-second pb-4 w-25">意味:</td>
                <td class="text-second w-75">意味、語</td>
            </tr>
            <tr>
                <td class="text-end text-second pb-5 w-25">definition:</td>
                <td class="text-second w-75">a single unit of language that has meaning and can be spoken or written</td>
            </tr>
            <tr>
                <td class="text-end text-second pb-5 w-25">example sectence:</td>
                <td class="text-second w-75">Your paper should be no more than two thousand words long.</td>
            </tr>
        </table>
        <p class="fs-small p-2 w-75 m-auto">Choose category if you want to add to the category</p>
        <div class="row w-75 mx-auto mb-5">
            <div class="col-5 p-0 text-second">
                <select class="form-select text-second" name="category">
                    <option selected hidden>Choose the category</option>
                    <option value="1">TOEIC</option>
                    <option value="2">Food</option>
                    <option value="3">Drink</option>
                </select>
            </div>
            <div class="col-2"></div>
            <div class="col-5 p-0">
                <button type="submit" class="btn btn-yellow w-100">Add to Category</button>
            </div>
        </div>
    </form>
</div>

@endsection
