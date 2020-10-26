@if (count($errors->all()) > 0)

    @foreach ($errors->all() as $error)
        <div class="alert alert-danger">
            {{ $error }}
        </div>
    @endforeach

@endif

@if (session()->has('success_add'))
    <div class="alert alert-success">
        <h3>{{ session('success_add') }}</h3>
    </div>
@endif

@if (session()->has('exist'))
    <div class="alert alert-danger">
        <h3>{{ session('exist') }}</h3>
    </div>
@endif

@if (session()->has('bad_choice'))
    <div class="alert alert-warning">
        <h3>{{ session('bad_choice') }}</h3>
    </div>
@endif

