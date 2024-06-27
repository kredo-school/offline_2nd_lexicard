@extends('layouts.app')

@section('title', 'Quiz Results')

@section('content')

<div class="container">
    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second p-2 my-5 text-center w-100 m-auto fs-1">3/8</p>
        </div>

        <table class="table w-75 m-auto">
            <thead class="table-second">
                <tr>
                    <th class="table-item1">#</th>
                    <th class="table-item2"></th>
                    <th class="table-item3">Question</th>
                    <th class="table-item4">Your Answer</th>
                    <th class="table-item5">Answer</th>
                </tr>
            </thead>
            <tbody class="table-yellow">
                <tr>
                    <th scope="row">1</th>
                    <th><i class="fa-solid fa-check text-success"></i></th>
                    <td>りんご</td>
                    <td>apple</td>
                    <td>apple</td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <th><i class="fa-solid fa-xmark text-danger"></i></th>
                    <td>みかん</td>
                    <td>banana</td>
                    <td>orange</td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <th><i class="fa-solid fa-xmark text-danger"></i></th>
                    <td>ぶどう</td>
                    <td>orange</td>
                    <td>grape</td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <th><i class="fa-solid fa-check text-success"></i></th>
                    <td>ぶどう</td>
                    <td>grape</td>
                    <td>grape</td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <th><i class="fa-solid fa-xmark text-danger"></i></th>
                    <td>りんご</td>
                    <td>grape</td>
                    <td>apple</td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <th><i class="fa-solid fa-xmark text-danger"></i></th>
                    <td>みかん</td>
                    <td>banana</td>
                    <td>orange</td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <th><i class="fa-solid fa-xmark text-danger"></i></th>
                    <td>ぶどう</td>
                    <td>orange</td>
                    <td>grape</td>
                </tr>
                <tr>
                    <th scope="row">8</th>
                    <th><i class="fa-solid fa-check text-success"></i></th>
                    <td>ぶどう</td>
                    <td>grape</td>
                    <td>grape</td>
                </tr>
        </table>

        <div class="text-center">
            <a href="{{  route('quiz.quiz.index') }}" type="submit" class="btn btn-second w-25 m-auto p-3 fs-5 my-5 fw-semibold">Back to Menu</a>
        </div>
    </div>
</div>

@endsection

