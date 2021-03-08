@extends('layouts.app')

@section('content')

    <link href="{{ asset('css/login.css') }}" rel="stylesheet">

    <div class="container mt-5">

        <form class="form-signin" method="POST" action="{{ route('login') }}">
            @csrf

            <img class="border border-light rounded my-3 ml-n1" src="{{ asset('media/logo.png') }}" alt="Alludo Logo" width="400">

            @error('email')
            <div class="alert alert-dismissible alert-danger">
                <button type="button" class="close" data-dismiss="alert">&times;</button>
                Incorrect Username or Password.
            </div>
            @enderror

            <div class="form-label-group">
                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" autocomplete="email" autofocus required>
                <label for="email">{{ __('E-Mail Adresse') }}</label>
            </div>


            <div class="form-label-group">
                <input id="password" type="password" class="form-control" name="password" autocomplete="current-password" required>
                <label for="password">{{ __('Password') }}</label>
            </div>

            <button class="btn btn-lg btn-success btn-block" type="submit">{{ __('Anmelden') }}</button>

        </form>
        @if (Route::has('password.request'))
            <div class="d-flex justify-content-center">
                <a class="btn btn-link" href="{{ route('password.request') }}">
                    {{ __('Passwort vergessen?') }}
                </a>
            </div>
        @endif

    </div>
@endsection
