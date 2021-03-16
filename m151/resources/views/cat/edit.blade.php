@extends('layouts.app')

@section('content')
    <div class="container">
        <h4 class="my-4 mb-4 text-center">{{ $cat->name }} edit</h4>


        <form action="{{ route('category.update', $cat) }}" method="POST">
        @csrf
        @method('PUT')

            <div class="form-group row">
                <label class="col-md-1 col-form-label offset-3">Name <span class="text-danger">*</span></label>
                <div class="col-md-4">
                    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $cat->name }}">
                </div>
                @error('name')
                    <div class="offset-4 invalid-feedback">
                        {{ $message == 'x' ? '' : $message }}
                    </div>
                @enderror
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

