@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 mb-4 text-center">WELCOME!</h1>

        <div class="container d-flex flex-wrap justify-content-center mt-5">
            <a class="btn btn-primary btn-index" style="font-size: 3rem" href="{{ route('categorie.select') }}">Play</a>
            <a class="btn btn-primary btn-index" style="font-size: 3rem" href="#">Highscores</a>
        </div>

    </div>
@endsection
