@extends('layouts.app')

@section('content')
    <script>

        var initComplete = false;

        function setCookie(cname, cvalue) {

            if (initComplete) {
                var cookie = getCookie("cat");

                if(cvalue == cookie) {
                    // Reset Sub Cat
                    if(cvalue.includes("-")) {
                        var cat = cvalue.split("-");
                        document.cookie = cname + "=" + cat[0] + ";";
                    } else {
                        // Reset Cat if only Cat was selected
                        document.cookie = cname + "=" + 0 + ";";
                    }
                } else {

                    if(cookie.includes("-")) {
                        var cat = cookie.split("-");

                        if(cvalue == cat[0]) {
                            // Reset Cat if sub Cat was selected and Cat is pressed.
                            document.cookie = cname + "=" + 0 + ";";
                        } else {
                            // Set new Cat if sub Cat was selected and other Cat is pressed.
                            document.cookie = cname + "=" + cvalue + ";";
                        }

                    } else {
                        // Set new Cat if other Cat is pressed.
                        document.cookie = cname + "=" + cvalue + ";";
                    }

                }
            }

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

        $( document ).ready(function() {

            var str = getCookie("cat");

            if(str) {

                var x = str.split("-");
                $("#btn-" + x[0]).trigger('click');

                if (x.length > 1) {
                    setTimeout(function () {
                        $("#btn-" + str).trigger('click');
                        initComplete = true; // complete Load if sub Cat was selected.
                    }, 500);
                } else {
                    initComplete = true; // complete Load is only Cat was selected.
                }
            } else {
                initComplete = true; // complete Load if Cat == 0. (none Selected).
            }

        });

    </script>
    <!-- TODO:

    var myCollapsible = document.getElementById('myCollapsible')
    myCollapsible.addEventListener('hidden.bs.collapse', function () {
        // do something...
    })

    -->

    <!-- TODO: Input Validation Question + Category unique!! -->
    <!-- TODO: Input Validation Question + Answers unique!! -->

    <div class="container pb-2">
        <h5 class="my-4 mb-4 text-center">Categoriy, Questions & Answers <button class="btn btn-primary" onclick="displayModeSwap()"><i class="fas fa-exchange-alt"></i></button></h5>

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
                                <div class="offset-3 invalid-feedback">

                                    <?php $duplicateCat = \App\Models\Category::withTrashed()->where('name', old('name'))->first() ?>
                                    @if($duplicateCat->trashed())
                                        <span>Category '{{ $duplicateCat->name }}' has been Deleted at {{ $duplicateCat->deleted_at }} <a href="{{ route('category.restore', $duplicateCat) }}" class="btn btn-warning">Restore</a></span>
                                    @else
                                        {{ $message }}
                                    @endif
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
                                <h4>
                                    @if($cat->not_valid)
                                        <span class="text-danger ml-n3">!!</span>
                                    @endif
                                    {{ $cat->id .'. '. $cat->name }}
                                </h4>
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
                                                <button id="{{ 'btn-' . $cat->id . '-' . $q->id }}" class="btn btn-link custom-btn-link @if(count($q->answers) != 4 || is_null($q->c_answer)) btn-outline-danger @endif text-left shadow-none" type="button" data-toggle="collapse" data-target="{{ '#collapse-' . $cat->id . '-' . $q->id }}" aria-expanded="false" aria-controls="{{ '#collapse-' . $cat->id . '-' . $q->id }}" onclick="setCookie('cat', '{{ $cat->id . '-' . $q->id }}')">
                                                    <h5>Q: {{ $q->value }}</h5>
                                                </button>
                                                @if(count($q->answers) != 4) <span class="text-danger custom-err-msg">4 Answers needed..</span> @endif
                                                @if(is_null($q->c_answer)) <span class="text-danger custom-err-msg">No correct Answer..</span> @endif
                                                <span style="z-index: 3; position: relative" class="edit_del_span">
                                                    <form class="d-inline" action="{{ route('question.destroy', $q) }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button class="btn btn-danger float-right mr-3" type="submit" value="Löschen"><i class="fas fa-ban"></i></button>
                                                    </form>
                                                    <a href="{{ route('question.edit', $q) }}" class="btn btn-primary float-right mr-3"><i class="fas fa-edit"></i></a>
                                                </span>
                                            </h2>
                                        </div>

                                        <div id="{{ 'collapse-' . $cat->id . '-' . $q->id }}" class="collapse hidden" aria-labelledby="{{ 'header-' . $cat->ic . '-' . $q->id }}" data-parent="#accordionCatQuestion">
                                            <div class="card-body">

                                                @if(count($q->answers) < 4)
                                                    <form action="{{ route('answer.store') }}" method="Post">
                                                        @csrf
                                                        @method('POST')

                                                        <div class="card edit_del_span_block">
                                                            <div class="card-header">
                                                                <div class="form-group row m-0">
                                                                    <div class="col-form-label col-md-3">
                                                                        Create Answer:
                                                                    </div>
                                                                    <div class="col-md-7">
                                                                        <input type="hidden" name="qID" value="{{ $q->id }}">
                                                                        <input type="text" class="form-control @if(old('qID') == $q->id) @error('answer') is-invalid @enderror @endif" name="answer" placeholder="Answer" value="{{ old('answer') }}">
                                                                    </div>
                                                                    <button type="submit" class="offset-1 btn btn-success"><i class="far fa-plus-square"></i></button>
                                                                    @if(old('qID') == $q->id)
                                                                        @error('question')
                                                                        @if($message != 'x')
                                                                            <div class="offset-2 invalid-feedback">
                                                                                {{ $message }}
                                                                            </div>
                                                                        @endif
                                                                        @enderror
                                                                    @endif
                                                                </div>

                                                                @if(!$q->c_answer)
                                                                    <div class="form-group row m-0 mt-1">
                                                                        <div class="col-form-label col-md-3">
                                                                            Answer is correct:
                                                                        </div>
                                                                        <div class="col-md-7">
                                                                            @if(count($q->answers) == 3)
                                                                                <input type="hidden" name="correct" value="on">
                                                                            @endif
                                                                            <input type="checkbox" class="form-control" @if(count($q->answers) == 3) checked disabled @else name="correct" @endif>
                                                                        </div>
                                                                    </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </form>

                                                @endif

                                                @foreach($q->answers as $a)
                                                    <div class="card text-left mb-1 @if(!is_null($q->c_answer) && $q->c_answer->id == $a->id) border-success @endif">
                                                        <div class="card-header">
                                                            <form class="d-inline" action="{{ route('answer.destroy', $a) }}" method="POST">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger float-right mr-3 edit_del_span"style="z-index: 3; position: relative" type="submit" value="Löschen"><i class="fas fa-ban"></i></button>
                                                            </form>
                                                            <p class="card-title m-0">{{ $a->value }}</p>
                                                            <a href="{{ route('answer.edit', $a) }}" class="stretched-link"></a>
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
