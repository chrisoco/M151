@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="my-4 mb-4 text-center">Highscores!</h1>

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
                </tr>
                <?php $i++; ?>
            @endforeach

            </tbody>
        </table>

    </div>
@endsection
