@extends('layouts.app')

@section('title', 'quiz result list')

@section('content')

    <div class="container">
        <div class="row w-100 m-auto align-items-center">
            {{-- back --}}
            <div class="col-2 text-center">
                <a href="{{ route('home') }}" class="text-decoration-none text-second fs-1"><i class="fa-solid fa-angle-left"></i></a>
            </div>
            <div class="col-2">

            </div>
            {{-- category title --}}
            <div class="col-4">
                <p class="text-yellow bg-second p-2 my-5 text-center w-100 m-auto fs-3">Quiz Results</p>
            </div>
            {{-- edit --}}
            <div class="col-2">

            </div>
            {{-- delete --}}
            <div class="col-2">

            </div>
        </div>

        <table class="table">
            <thead class="table-second">
                <th>category</th>
                <th class="text-center">format</th>
                <th class="text-center">score</th>
                <th></th>
                <th></th>
                <th></th>
            </thead>
            <tbody  class="table-yellow">
                @forelse($quiz_datas as $quiz_data)
                    <tr>
                        <td class="align-middle">{{ $quiz_data->category->name }}</td>
                        <td class="text-center align-middle">{{ $quiz_data->format }}</td>
                        <td class="text-center align-middle">{{ $quiz_data->score }}/{{ $quiz_data->category->categoryWord->count() }}</td>
                        <td class="text-center align-middle">{{ $quiz_data->times_taken }} times</td>
                        <td class="text-center align-middle">
                            {{ $quiz_data->updated_at->diffForHumans() }}
                        </td>
                        <td>
                            <form action="{{ route('quiz.quiz.show') }}" method="post">
                                @csrf
                                @method('GET')
                                <input type="hidden" name="category" value="{{ $quiz_data->category->id }}">
                                <input type="hidden" name="format" value="{{ $quiz_data->format }}">
                                <button type="submit" class="btn text-second p-0 text-decoration-underline">take again</button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <td colspan="6" class="text-center">Quiz not taken yet</td>
                @endforelse
            </tbody>
        </table>
    </div>

@endsection
