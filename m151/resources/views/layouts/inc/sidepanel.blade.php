<style>
    .class-selector {
        position: absolute;
        right: 0;
    }
</style>
<div class="card class-selector col-2 mr-2 d-inline-block p-2 shadow" style="z-index: 10;">
    <div class="container">
        <div class="row bg-primary rounded-top">
            <div class="col btn text-white w-100" data-toggle="collapse" data-target="#class-select-content">
                <svg class="bi bi-filter-left text-white" width="2em" height="2em" viewBox="0 0 16 16" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M2 10.5a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zm0-3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z"/>
                </svg>
                Optionen
            </div>
        </div>
    </div>
    <div class="collapse pt-3" id="class-select-content">
        <form>
            @csrf
                <label for="class-filter" class="text-primary">Klasse</label>
                <select name="class-filter my-1"  class="form-control form-control-sm border-primary">
                    <option value="0"selected>Alle</option>
                    <option value="1">Kl20-1</option>
                    <option value="2">Kl20-2</option>
                    <option value="3">Kl19-1</option>
                    <option value="4">Kl19-2</option>
                </select>
                @yield('filters')
            <div class="container">
                <div class="row mt-4">
                    <input type="submit" class="col btn btn-primary" value="Filter anwenden">
                </div>
            </div>
        </form>

    </div>
</div>
