@extends('layouts.app')

@section('content')
<div class="container">
    <div class="p-2 border rounded-3 mx-3">
        <div class="row">
            <div class="col-6">
                <p class="fs-4 fw-bold m-3">Learning Progress</p>
                <div class="list-group-horizontal d-flex">
                    <a href="{{ route('home') }}" class="list-group-item btn btn-outline-second border rounded-2 text-second m-auto p-1 px-3 {{ request()->is('/')?'active':'' }}">today</a>
                    <a href="{{ route('home.day', "week") }}" class="list-group-item btn btn-outline-second border rounded-2 text-second m-auto p-1 px-3 {{ request()->is('progress/week')?'active':'' }}">week</a>
                    <a href="{{ route('home.day', "month") }}" class="list-group-item btn btn-outline-second border rounded-2 text-second m-auto p-1 px-3 {{ request()->is('progress/month')?'active':'' }}">month</a>
                    <a href="{{ route('home.day', "year") }}" class="list-group-item btn btn-outline-second border rounded-2 text-second m-auto p-1 px-3 {{ request()->is('progress/year')?'active':'' }}">year</a>
                    <a href="{{ route('home.day', "all") }}" class="list-group-item btn btn-outline-second border rounded-2 text-second m-auto p-1 px-3 {{ request()->is('progress/all')?'active':'' }}">all</a>
                </div>
                <div class="row my-3">
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        <p class="">Words Adeed</p>
                    </div>
                    <div class="col-6 d-flex align-items-center justify-content-center">
                        <p class="text-center">Answered Correctly/Quiz You Take</p>
                    </div>
                </div>
                <div class="row my-3">
                    <div class="col-6">
                        <p class="text-center fs-2">{{ $learning_data['added_words'] }}</p>
                    </div>
                    <div class="col-6">
                        <p class="text-center fs-2">{{ $learning_data['quiz_score'] }}/{{ $learning_data['quiz_answered'] }}</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-1 d-flex justify-content-center align-items-center p-0">
                        <form action="{{ route('home') }}" method="post">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="prev" value="{{ $date[0] }}">
                            <button type="submit" class="btn"><i class="fa-solid fa-caret-left fa-3x"></i></button>
                        </form>
                    </div>
                    <div class="col-10">
                        <canvas id="myChart" class=""></canvas>
                    </div>
                    <div class="col-1 d-flex justify-content-center align-items-center p-0">
                        <form action="{{ route('home') }}" method="post">
                            @csrf
                            @method('GET')
                            <input type="hidden" name="next" value="{{ $date[0] }}">
                            @if($date[0]!= date('Y-m-d'))
                                <button type="submit" class="btn"><i class="fa-solid fa-caret-right fa-3x"></i></button>
                            @endif
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <p class="fs-4 fw-bold m-3">Quiz Results</p>
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
                            <tr>
                                <td colspan="6" class="text-center">Quiz not taken yet</td>
                            </tr>
                        @endforelse
                        <tr>
                            <td colspan="6" class="text-center"><a href="{{ route('quiz.result.list') }}">Check more</a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>


      <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

      <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
          type: 'bar',
          data: {
            labels: ['<?php echo $date[6] ?>', '<?php echo $date[5] ?>', '<?php echo $date[4] ?>', '<?php echo $date[3] ?>', '<?php echo $date[2] ?>', '<?php echo $date[1] ?>', '<?php echo $date[0] ?>'],
            datasets: [{
              label: 'Number of Words Added',
              data: ['<?php echo $added_words[6] ?>', '<?php echo $added_words[5] ?>', '<?php echo $added_words[4] ?>', '<?php echo $added_words[3] ?>', '<?php echo $added_words[2] ?>', '<?php echo $added_words[1] ?>', '<?php echo $added_words[0] ?>'],
              borderWidth: 0.5
            }, {
              label: 'Number of Words Answered Correctly',
              data: ['<?php echo $quiz_score_total[6] ?>', '<?php echo $quiz_score_total[5] ?>', '<?php echo $quiz_score_total[4] ?>', '<?php echo $quiz_score_total[3] ?>', '<?php echo $quiz_score_total[2] ?>', '<?php echo $quiz_score_total[1] ?>', '<?php echo $quiz_score_total[0] ?>'],
              borderWidth: 0.5
            }]
          },
          options: {
            scales: {
              y: {
                beginAtZero: true
              }
            }
          }
        });
      </script>


    <div class="row">
    {{-- category list --}}
        <div class="col-8">
            @forelse($categories as $category)
                <div class="row bg-yellow border rounded-4 p-3 mx-2 my-3 align-items-center">
                    <div class="col-4">
                        @if($category->classroom_id == null)
                            @if($category->user_id == Auth::id())
                            @else
                                @if($category->user->image)
                                    <a href="{{ route('profile.profile.show', $category->user->id) }}" class="text-second fs-4 text-decoration-none d-flex align-items-center"><img src="{{ $category->user->image }}" alt="" class="rounded-circle avatar-sm me-2">{{ $category->user->name }}</a>
                                @else
                                    <a href="{{ route('profile.profile.show', $category->user->id) }}" class="text-second fs-4 text-decoration-none"><i class="fa-solid fa-circle-user fs-2 me-2"></i>{{ $category->user->name }}</a>
                                @endif
                            @endif
                        @else
                            <a href="{{ route('profile.profile.show', $category->classroom->id) }}" class="text-second fs-4 text-decoration-none"><i class="fa-solid fa-graduation-cap"></i> {{ $category->classroom->name }}</a>
                        @endif
                    </div>
                    <div class="col-4 text-center">
                        <a href="{{ route('category.category.show', $category) }}" class="text-second text-decoration-none fw-bold fs-3">{{ $category->name }}</a>
                    </div>
                    <div class="col-2 justify-content-end d-flex align-items-center">
                        @if($category->isliked())
                            <form action="{{ route('like.destroy', $category->id) }}" method="post" class="mb-0 me-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn p-0 text-danger"><i class="fa-solid fa-heart"></i></button>
                            </form>
                        @else
                            <form action="{{ route('like.store') }}" method="post" class="mb-0 me-2">
                                @csrf
                                <input type="hidden" value="{{ $category->id }}" name="category_id">
                                <button type="submit" class="btn p-0 text-second"><i class="fa-regular fa-heart"></i></button>
                            </form>
                        @endif
                        <p class="text-second">{{ $category->like->count() }}</p>
                    </div>
                    <div class="col-2 justify-content-end d-flex align-items-center">
                        <p class="text-second text-end ms-3">{{ $category->categoryWord->count() }}  Words</p>
                    </div>
                </div>
            @empty
                <p class="text-second text-center my-5">No category yet.</p>
            @endforelse
        </div>
    {{-- side bar --}}
        <div class="col-4">
            {{-- dictionary/add word --}}
            <form action="{{ route('word.word.create') }}" method="post" class="my-3">
                @csrf
                @method('GET')
                <p class="text-second">Dictionary / Quick Add</p>
                <div class="input-group my-2">
                    <input type="text" name="word" class="form-control rounded-start-4">
                    <button class="btn btn-search rounded-end-4" type="submit">Search</button>
                  </div>
            </form>
            @if (session('error'))
                <p class="text-danger text-center">{{ session('error') }}</p>
            @endif
            {{-- Create New Category --}}
            <button type="button" class="btn btn-yellow w-100 p-3 fs-5 border border-second rounded-4 my-3" data-bs-toggle="modal" data-bs-target="#createNewCategoryModal">
                Create New Category
            </button>
            @if ($errors->has('category'))
                <p class="text-danger text-center">{{ $errors->first('category') }}</p>
            @endif
            {{-- Sort Category --}}
            <div class="my-3 border border-second text-center">
                <p class="bg-second text-yellow fs-3 p-2">Sort</p>
                <ul class="list-group">
                    <a href="{{ route('home') }}" class="list-group-item btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second m-auto {{ \Route::is('home')?'active':'' }}">ALL</a>
                    <a href="{{ route('home.my_category') }}" class="list-group-item btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second m-auto {{ \Route::is('home.my_category')?'active':'' }}">My Category</a>
                    <a href="{{ route('home.liked') }}" class="list-group-item btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second m-auto {{ \Route::is('home.liked')?'active':'' }}">Liked</a>
                    <a href="{{ route('home.popular') }}" class="list-group-item btn btn-outline-second border rounded-4 mt-4 fs-5 w-75 text-second m-auto {{ \Route::is('home.popular')?'active':'' }}">Popular</a>

                    <form action="{{ route('home.other.user') }}" method="post">
                        @csrf
                        @method('GET')
                        <div class="input-group mb-3 m-auto mt-4 w-75">
                            <select class="form-select border rounded-start-4 text-second fs-5 text-center" name="other_user">
                                <option hidden value="null">Other User</option>
                                @forelse (Auth::user()->following as $following)
                                    <option value="{{ $following->following->id }}">{{ $following->following->name }}</option>
                                @empty

                                @endforelse
                            </select>
                            <button class="btn border rounded-end-4 text-second fs-5 {{ \Route::is('home.other.user')?'btn-yellow':'btn-outline-second' }}" type="submit">Button</button>
                        </div>
                        @if ($errors->has('other_user'))
                            <p class="text-danger text-center">{{ $errors->first('other_user') }}</p>
                        @endif
                    </form>

                </ul>
            </div>
        </div>
    </div>


</div>


{{-- Create New Category Modal --}}
<div class="modal fade" id="createNewCategoryModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header justify-content-center">
          <h1 class="modal-title fs-5" id="exampleModalLabel">Create New Category</h1>
        </div>
        <div class="modal-body">
          <form action="{{ route('category.category.store') }}" method="post" class="w-75 m-auto">
            @csrf
            <input type="text" name="category" class="form-control my-4">
            <div class="row justify-content-between my-4">
                <div class="col-5">
                    <button type="button" class="btn btn-cancel w-100" data-bs-dismiss="modal">Close</button>
                </div>
                <div class="col-5">
                    <button type="submit" class="btn btn-yellow w-100">Add</button>
                </div>
            </div>
          </form>

        </div>
      </div>
    </div>
</div>
@endsection
