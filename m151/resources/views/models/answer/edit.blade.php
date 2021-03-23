@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="my-4 mb-4 text-center">Edit Question</h4>

        <form action="{{ route('answer.update', $a) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">Question <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ $a->value }}">
                </div>
                @error('value')
                <div class="offset-4 invalid-feedback">
                    {{ $message == 'x' ? '' : $message }}
                </div>
                @enderror
            </div>

            <div class="form-group row m-0 mt-1">
                <div class="col-form-label col-md-2 offset-2 text-right">
                    Answer is correct:
                </div>
                <div class="col-md-4">
                    <input type="checkbox" class="form-control" name="correct"
                           @if($a->question->c_answer && $a->question->c_answer->id == $a->id) checked @endif>
                </div>
            </div>

            <div class="form-group row mt-4">
                <div class="col-md-1 offset-3"></div>
                <div class="col-md-4 justify-content-center d-flex">
                    <a href="{{ route('models_index') }}" class="btn btn-secondary mr-2">Return</a>
                    <input class="btn btn-primary ml-2" type="submit" value="Update">
                </div>
            </div>

        </form>
    </div>
@endsection

