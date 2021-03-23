@extends('layouts.app')

@section('content')

    <div class="container d-flex flex-wrap justify-content-center mt-5">

        <div class="card text-center" style="width: 100%">

            <div class="card-body btn-outline-success">
                <h1>You have scored {{ $h->points }} Points! => {{ $h->points_s }} / sec</h1>
            </div>
            <a href="{{ route('highscores.index') }}" class="btn btn-outline-primary">View Highscores</a>

        </div>

    </div>
@endsection
