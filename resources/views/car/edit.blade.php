@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Car') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('car.update', $car->id) }}">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name Car') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $car->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="model" class="col-md-4 col-form-label text-md-end">{{ __('Model Car') }}</label>

                            <div class="col-md-6">
                                <input id="model" type="text" class="form-control @error('model') is-invalid @enderror" name="model" value="{{ $car->model }}" required>
                                @error('model')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-3">
                            <label for="year" class="col-md-4 col-form-label text-md-end">{{ __('Year Car') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="number" class="form-control @error('year') is-invalid @enderror" name="year" value="{{ $car->year }}" required >
                                @error('year')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Year Category') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" id="category" aria-label="Default select example" name="category_id" required>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" @if($car->category_id == $category->id) selected @endif>{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="driver" class="col-md-4 col-form-label text-md-end">{{ __('Year Drivers') }}</label>

                            <div class="col-md-6">
                                <div class="bd-example-snippet bd-code-snippet">
                                    <div class="bd-example @error('drivers') is-invalid @enderror">
                                        @foreach($drivers as $driver)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="dirver{{ $driver->id }}" name="drivers[]" value="{{ $driver->id }}"
                                            @foreach($car->drivers as $carDriver)
                                            {{ $driver->id === $carDriver->id ? 'checked' : '' }}
                                            @endforeach
                                            >
                                            <label class="form-check-label" for="dirver{{ $driver->id }}">{{ $driver->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    
                                    @error('drivers')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}
                                            </strong>
                                    </span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Submit') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    let radios = document.querySelectorAll('input[name="add"]');
    let div = document.querySelector('div.car');

    function clic(){
        let radioChet;

        for (const radio of radios) {
            if (radio.checked) {
                radioChet = radio.value;
                break;
            }
        }

        div.classList.remove('action');

        div = document.querySelector('div.' + radioChet);
        div.classList.add('action');
        console.log(div);
    }
</script>
@endsection
