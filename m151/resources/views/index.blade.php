@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 mb-4 text-center">WELCOME!</h1>
        <!--
        <div class="container d-flex flex-wrap justify-content-center mt-5">
            <a class="btn btn-primary btn-index" style="font-size: 3rem" href="{{ route('start_play') }}">Play</a>
            <a class="btn btn-primary btn-index" style="font-size: 3rem" href="{{ route('highscores.index') }}">Highscores</a>
        </div>
        -->
        <div class="container d-flex flex-wrap justify-content-center mt-5">
            <button type="button" class="btn btn-primary btn-index" style="font-size: 3rem" data-toggle="modal" data-target="#ModalCenter">
                Play
            </button>
            <a class="btn btn-primary btn-index" style="font-size: 3rem" href="{{ route('highscores.index') }}">Highscores</a>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="ModalCenter" tabindex="-1" role="dialog" aria-labelledby="ModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Please Enter your Username<span class="text-danger">*</span></h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <form action="{ { route('school.store') }}" method="Post">
                            @csrf
                            @method('POST')

                            <div class="form-group row">
                                <div class="col">
                                    <input type="text" class="form-control @error('player_name') is-invalid @enderror" name="player_name" value="{{ old('player_name') }}">
                                </div>
                            </div>

                            @error('player_name')
                                <div class="invalid-feedback">
                                    {{ $message == 'x' ? '' : $message }}
                                </div>
                            @enderror

                        </form>

                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="btn btn-success btn-modal">Play!</button>
                        <!-- <button type="button" class="btn btn-secondary btn-modal" data-dismiss="modal">Close</button> -->
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection
