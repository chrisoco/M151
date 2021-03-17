@extends('layouts.app')

@section('content')
    <script>
        function setCookie(cname, cvalue) {
            document.cookie = cname + "=" + cvalue + ";";
        }

        function getCookie(cname) {
            var name = cname + "=";
            var ca = document.cookie.split(';');
            for(var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
        }

        function displayModeSwap() {
            var e = $(".edit_del_span" );
            var f = $(".edit_del_span_block");

            if  (e.css("display") == "none") {
                 e.css("display", "inline");
                 f.css("display", "block");
            } else  {
                 e.css("display", "none");
                 f.css("display", "none");
            }
        }
/*
        $( document ).ready(function() {

            var str = getCookie("cat");

            if(str) {

                var x = str.split("-");
                $("#btn-" + x[0]).trigger('click');

                if (x.length > 1) {
                    setTimeout(function () {
                        $("#btn-" + str).trigger('click');
                    }, 500);
                }
            }

        });*/

    </script>

    <div class="container pb-2">
        <h5 class="my-4 mb-4 text-center">Categoriy, Questions & Answers <button class="btn btn-primary" onclick="displayModeSwap()"><i class="fas fa-edit"></i></button></h5>

        <div class="accordion" id="accordionCat">
            <form action="{{ route('category.store') }}" method="Post">
                @csrf
                @method('POST')

                <div class="card edit_del_span_block">
                    <div class="card-header">
                        <div class="form-group row m-0">
                            <div class="col-form-label col-md-3">
                                Create Category:
                            </div>
                            <div class="col-md-7">
                                <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Category Name" value="{{ old('name') }}">
                            </div>
                            <button type="submit" class="offset-1 btn btn-success"><i class="far fa-plus-square"></i></button>
                            @error('name')
                            @if($message != 'x')
                                <div class="offset-2 invalid-feedback">
                                    {{ $message }}
                                </div>
                            @endif
                            @enderror
                        </div>
                    </div>
                </div>
            </form>

            @foreach($categories as $cat)
                <div class="card">

                    <div class="card-header" id="{{ 'header-' . $cat->id }}">
                        <h2 class="mb-0">
                            <button id="{{ 'btn-' . $cat->id }}" class="btn btn-link text-left shadow-none" type="button" data-toggle="collapse" data-target="{{ '#collapse-' . $cat->id }}" aria-expanded="false" aria-controls="{{ '#collapse-' . $cat->id }}" onclick="setCookie('cat', '{{ $cat->id }}')">
                                <h4>{{ $cat->id .'. '. $cat->name }}</h4>
                            </button>
                            <span style="z-index: 3; position: relative" class="edit_del_span">
                                <form class="d-inline" action="{{ route('category.destroy', $cat) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger float-right mr-3" type="submit" value="Löschen"><i class="fas fa-ban"></i></button>
                                </form>
                                <a href="{{ route('category.edit', $cat) }}" class="btn btn-primary float-right mr-3"><i class="fas fa-edit"></i></a>
                            </span>

                        </h2>
                    </div>

                    <div id="{{ 'collapse-' . $cat->id }}" class="collapse hidden" aria-labelledby="{{ 'header-' . $cat->id }}" data-parent="#accordionCat">
                        <div class="card-body">

                            <!-- TODO: error only if error id == this Question. -->
                            <form action="{{ route('question.store') }}" method="Post">
                                @csrf
                                @method('POST')

                                <div class="card edit_del_span_block">
                                    <div class="card-header">
                                        <div class="form-group row m-0">
                                            <div class="col-form-label col-md-3">
                                                Create Question:
                                            </div>
                                            <div class="col-md-7">
                                                <input type="hidden" name="catID" value="{{ $cat->id }}">
                                                <input type="text" class="form-control @if(old('catID') == $cat->id) @error('question') is-invalid @enderror @endif" name="question" placeholder="Question" value="{{ old('question') }}">
                                            </div>
                                            <button type="submit" class="offset-1 btn btn-success"><i class="far fa-plus-square"></i></button>
                                            @if(old('catID') == $cat->id)
                                                @error('question')
                                                    @if($message != 'x')
                                                        <div class="offset-2 invalid-feedback">
                                                            {{ $message }}
                                                        </div>
                                                    @endif
                                                @enderror
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>


                            @foreach($cat->questions as $q)

                                <div class="accordion" id="accordionCatQuestion">
                                    <div class="card">
                                        <div class="card-header" id="{{ 'header-' . $cat->id . '-' . $q->id }}">
                                            <h2 class="mb-0">
                                                <button id="{{ 'btn-' . $cat->id . '-' . $q->id }}" class="btn btn-link @if(count($q->answers) != 4) btn-outline-danger @endif text-left shadow-none" type="button" data-toggle="collapse" data-target="{{ '#collapse-' . $cat->id . '-' . $q->id }}" aria-expanded="false" aria-controls="{{ '#collapse-' . $cat->id . '-' . $q->id }}" onclick="setCookie('cat', '{{ $cat->id . '-' . $q->id }}')">
                                                    <h5>Q: {{ $q->value }}</h5>
                                                </button>
                                                <span style="z-index: 3; position: relative" class="edit_del_span">
                                                    <a href="#" class="btn btn-danger float-right mr-3"><i class="fas fa-ban"></i></a>
                                                    <a href="#" class="btn btn-primary float-right mr-3"><i class="fas fa-edit"></i></a>
                                                </span>
                                            </h2>
                                        </div>

                                        <div id="{{ 'collapse-' . $cat->id . '-' . $q->id }}" class="collapse hidden" aria-labelledby="{{ 'header-' . $cat->ic . '-' . $q->id }}" data-parent="#accordionCatQuestion">
                                            <div class="card-body">

                                                @foreach($q->answers as $a)

                                                    <div class="card text-left mb-1 @if($q->c_answer->id == $a->id) border-success @endif">
                                                        <div class="card-header">
                                                            <p class="card-title m-0">{{ $a->value }}<a href="{ { route('template.delete', [$dep->id, $task->id, $goal->id]) }}" style="z-index: 3; position: relative" class="btn btn-danger float-right mr-3 edit_del_span"><i class="fas fa-ban"></i></a></p>
                                                            <a href="{ { route('template.goal.edit', $goal) }}" class="stretched-link"></a>
                                                        </div>
                                                    </div>

                                                @endforeach




                                            </div>
                                        </div>



                                    </div>
                                </div>
                            @endforeach






                        </div>
                    </div>
                </div>
            @endforeach

        </div>

    </div>
@endsection
