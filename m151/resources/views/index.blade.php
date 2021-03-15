@extends('layouts.app')

@section('content')
    <script>
        @error('player_name')
            $(document).ready(function () {
                $("#modalButton").click();
            });
        @enderror

    </script>

    <div class="container">
        <h1 class="my-4 mb-4 text-center">WELCOME! @if(session('player_name')) {{ session('player_name') }} @endif</h1>

        <div class="container d-flex flex-wrap justify-content-center mt-5">

            @if(!session('player_name'))
                <button type="button" id="modalButton" class="btn btn-primary btn-index" style="font-size: 3rem" data-toggle="modal" data-target="#ModalCenter">
                    Play
                </button>
            @else
                <a class="btn btn-primary btn-index" style="font-size: 3rem" href="{{ route('start_play') }}">Play</a>
            @endif
            <a class="btn btn-primary btn-index" style="font-size: 3rem" href="{{ route('highscores.index') }}">Highscores</a>
        </div>
        <div class="row">
            <a class="col offset-3" style="min-width: 100px" href="{{ route('session.destroy') }}">Reset User-Name</a>
        </div>

        <!-- Modal -->
        @if(!session('player_name'))
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

                            <form action="{{ route('playername.set') }}" method="Post" id="playerNameForm">
                                @csrf
                                @method('POST')

                                <div class="form-group row">
                                    <div class="col-8 offset-2">
                                        <input type="text" class="form-control @error('player_name') is-invalid @enderror" name="player_name" value="{{ old('player_name') }}">
                                    </div>
                                </div>

                                @error('player_name')
                                    <div class="invalid-feedback offset-2">
                                        {{ $message }}
                                    </div>
                                @enderror

                            </form>

                        </div>
                        <div class="modal-footer justify-content-center">
                            <button type="submit" form="playerNameForm" class="btn btn-success btn-modal">Play!</button>
                            <!-- <button type="button" class="btn btn-secondary btn-modal" data-dismiss="modal">Close</button> -->
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
@endsection
