@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="my-4 text-center">Playing...!</h3>

        {{ ddd($q) }}
        {{ ddd(session()->all()) }}

    </div>
@endsection
