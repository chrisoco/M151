@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="my-4 mb-4 text-center">Edit Question</h4>

        <form action="{{ route('question.update', $q) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">Question <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('value') is-invalid @enderror" name="value" value="{{ $q->value }}" required>
                </div>
                @error('value')
                <div class="offset-4 invalid-feedback">
                    {{ $message == 'x' ? '' : $message }}
                </div>
                @enderror
            </div>

            <div class="form-group row">
                <label class="col-md-2 col-form-label offset-2 text-right">CorrectAnswer
                    @if(count($q->answers) > 0)
                        <span class="text-danger">*</span>
                    @endif
                </label>

                <div class="col-md-4">
                    <select class="custom-select @error('correct_answer') is-invalid @enderror" name="correct_answer">
                        @if(!$q->c_answer)
                            <option value="" selected>No Answer Selected...</option>
                        @endif
                        @foreach($q->answers as $a)
                            <option value="{{ $a->id }}"
                                    @if($q->c_answer && $q->c_answer->id == $a->id) selected @endif>{{ $a->value }}
                            </option>
                        @endforeach
                    </select>
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

