@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 mb-4 text-center">SELECT Category:</h1>

        <div class="container d-flex flex-wrap justify-content-center mt-5">
            @foreach($categories as $cat)
            <a class="btn btn-primary btn-cat" href="{{ route('start_play.cat', $cat) }}">{{ $cat->name }}</a>
            @endforeach
        </div>

    </div>
@endsection
