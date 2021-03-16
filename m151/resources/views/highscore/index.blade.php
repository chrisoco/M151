@extends('layouts.app')

@section('content')
    <div class="container">
        <h3 class="my-4 text-center">Highscores!</h3>

        <!-- https://examples.bootstrap-table.com/#view-source -->
        <table class="table table-hover">
            <thead>
            <tr>
                <th scope="col">##</th>
                <th scope="col">Name</th>
                <th scope="col">Points</th>
                <th scope="col">Duration</th>
                <th scope="col">Points / s</th>
                <th scope="col">Category</th>
                @auth
                    <th scope="col"></th>
                @endauth
            </tr>
            </thead>
            <tbody>

            <?php $i = 1; ?>
            @foreach($list as $score)
                <tr @if(session('player_name') && $score->player_name == session('player_name')) style="background-color: darkseagreen" @endif>
                    <th scope="row">{{ $i < 10 ? '0'.$i : $i }}</th>
                    <td>{{ $score->player_name }}</td>
                    <td>{{ $score->points }}</td>
                    <td>{{ $score->duration }}</td>
                    <td>{{ $score->points_s }}</td>
                    <td>{{ $score->category->name }}</td>
                    @auth
                        <td>
                            <form class="d-inline" action="{{ route('highscore.destroy', $score) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="btn-sm btn-danger" type="submit" value="Löschen"><i class="fas fa-trash-alt"></i></button>

                            </form>
                        </td>
                    @endauth
                </tr>
                <?php $i++; ?>
            @endforeach

            </tbody>
        </table>

    </div>
@endsection
