<!-- CHECKBOX ABT FILTER -->
<div class="col-lg-12 bg-white pt-2">
    <div class="row justify-content-center mb-5">
        <form action="{{ route('settings.setDepartmentFilter') }}" method="POST">
            @csrf
            <div class="form-group row">
                <h4 class="col-12 text-center mb-2">Abteilungsfilter</h4>
                <div class="col">
                    @foreach($departments as $dep)
                        <input type="checkbox" name="abt_filters[]" value="{{ $dep->id }}" class="ml-3"
                               @if(auth()->user()->department_filters->contains($dep)) checked @endif>
                        <label class="col-form-label ml-2 p-0">{{ $dep->name }}</label><br>
                    @endforeach
                    <button type="submit" class="btn btn-block btn-primary mt-3">
                        Speichern
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>
