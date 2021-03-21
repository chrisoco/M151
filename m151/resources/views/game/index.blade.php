@extends('layouts.app')

@section('content')
    <div class="container d-flex flex-wrap justify-content-center mt-5">

        <div class="card text-center" style="width: 100%">
            <div class="card-header">
                <h3>{{ $q->value }}?</h3>
            </div>
            <div class="card-body">

                <div class="container d-flex flex-wrap justify-content-center">
                    @foreach($q->answers as $a) <!-- TODO maybe make Form? // Post? -->
                        <form action="{ { route('') }}" method="POST" id="{{ 'f-'.$a->id }}">
                        @csrf
                        @method('PUT')
                            <input type="hidden" name="" value="{{ $a->id }}">
                        </form>
                        <button type="submit" form="{{ 'f-'.$a->id }}" class="btn btn-primary @if($q->c_answer->id == $a->id) btn-outline-success text-white @endif btn-question">{{ $a->id .' '.$a->value }}</button>

                        @endforeach
                </div>

            </div>
            <div class="card-footer">
                <div class="container d-flex flex-wrap justify-content-center">
                    @if(session('joker'))
                        <a class="btn btn-outline-success font-weight-bold" href="#">50 / 50 Joker</a>
                    @else
                        <button class="btn btn-dark font-weight-bold" disabled>50 / 50 Joker</button>
                    @endif
                </div>
            </div>
        </div>



    </div>
@endsection
