@extends('layouts.app')

@section('title', 'EtoJ FlashCard')

@section('content')

<div class="container">
    <div class="row w-100 align-items-center">
        <div class="col-4 m-auto">
            <p class="text-second bg-yellow p-2 my-5 text-center w-100 m-auto fs-3">{{ $num+1 }}/{{ count(session('flashcards')) }}</p>
        </div>
        <div class="text-center py-5">
            <button class="btn btn-yellow w-50 py-5 fs-1" id="flashcard" onclick="translateText()">
                {{ $flashcard['word']  }}
            </button>
        </div>
        <form action="{{ route('quiz.quiz.etoj', $num) }}" method="post">
            @csrf
            @method('GET')
            <div class="text-center">
                <button type="submit" class="btn btn-second w-25 m-auto fs-4 my-5 fw-semibold">Next</button>
            </div>
        </form>
    </div>
</div>



<script>
    function translateText() {
        var text = document.getElementById("flashcard").innerText;

        if(text == "{{ $flashcard['word']  }}") {
            document.getElementById("flashcard").innerText = "{{ $flashcard['meaning']  }}";
        } else {
            document.getElementById("flashcard").innerText = "{{ $flashcard['word']  }}";
        }
    };
</script>

@endsection

