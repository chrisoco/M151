@extends('layouts.app')

@section('content')

    <div class="container d-flex flex-wrap justify-content-center mt-5">

        <div class="card text-center" style="width: 100%">
            <div class="card-header">
                <h3>{{ $q->value }}?</h3>
            </div>

            <div class="progress">
                @if($q->correct_answered_percent == 0 && $q->false_answered_percent == 0)
                    <div class="progress-bar bg-dark" style="width: 100%; font-weight: bold">Question hasn't been answered yet.</div>
                @else
                    <div class="progress-bar bg-success" style="width: {{ $q->correct_answered_percent }}%; font-weight: bold">{{ $q->correct_answered_percent }}%</div>
                    <div class="progress-bar bg-danger"  style="width: {{ $q->false_answered_percent   }}%; font-weight: bold">{{ $q->false_answered_percent   }}%</div>
                @endif
            </div>

            <div class="card-body">

                <div class="container d-flex flex-wrap justify-content-center">
                    @foreach($q->answers as $a)
                        @error('answer')
                            <button class="btn btn-primary @if($message == $a->id) btn-danger @endif @if($q->c_answer->id == $a->id) btn-success text-white @endif btn-question">{{ $a->id .' '.$a->value }}</button>
                        @else
                            <form action="{{ route('play.answer') }}" method="POST" id="{{ 'f-'.$a->id }}">
                            @csrf
                            @method('POST')
                                <input type="hidden" name="question_id" value="{{ $q->id }}">
                                <input type="hidden" name="answer_id"   value="{{ $a->id }}">
                            </form>
                            <button type="submit" form="{{ 'f-'.$a->id }}" class="btn btn-primary
                                @auth @if($q->c_answer->id == $a->id)
                                    btn-outline-success text-white
                                @endif @endauth btn-question"

                                @if(array_key_exists('jokerAnswers', session()->all()) && in_array($a->id, session('jokerAnswers')))
                                    disabled
                                @endif

                            >{{ $a->id .' '.$a->value }}</button>
                        @enderror
                    @endforeach
                </div>

            </div>
            <div class="card-footer">
                <div class="container d-flex flex-wrap justify-content-center">
                    @error('answer')
                        @if($message == 'c')
                            <span class="btn btn-primary btn-question-footer">Points: {{ session('points') }}</span>
                            <a class="btn btn-outline-success btn-question-footer" href="{{ route('play.next', $q->id) }}">Continue Next Question</a>
                        @else
                            <span class="btn btn-primary btn-question-footer">Points: {{ session('points') }}</span>
                            <a class="btn btn-outline-danger btn-question-footer" href="#">Continue End Screen</a> <!-- TODO: End This.-->
                        @endif
                    @else
                        @if(session('joker'))
                            <a class="btn btn-outline-success btn-question-footer" href="{{ route('joker') }}">50 / 50 Joker</a>
                        @else
                            <button class="btn btn-dark btn-question-footer" disabled>50 / 50 Joker</button>
                        @endif
                        <span class="btn btn-primary btn-question-footer">Points: {{ session('points') }}</span>
                        <a class="btn btn-outline-primary btn-question-footer">Finish Quiz</a>
                    @enderror
                </div>
            </div>
        </div>

    </div>
@endsection
