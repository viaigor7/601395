@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Edit Driver') }}
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <form method="POST" action="{{ route('driver.update', $driver->id) }}">
                        @csrf
                        @method('patch')

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name Driver') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ $driver->name }}" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="driver" class="col-md-4 col-form-label text-md-end">{{ __('Year Drivers') }}</label>

                            <div class="col-md-6">
                                <div class="bd-example-snippet bd-code-snippet">
                                    <div class="bd-example @error('cars') is-invalid @enderror">
                                        @foreach($cars as $car)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox" id="dirver{{ $car->id }}" name="cars[]" value="{{ $car->id }}"
                                            @foreach($driver->cars as $carDriver)
                                            {{ $car->id === $carDriver->id ? 'checked' : '' }}
                                            @endforeach
                                            >
                                            <label class="form-check-label" for="dirver{{ $car->id }}">{{ $car->name }}</label>
                                        </div>
                                        @endforeach
                                    </div>
                                    @error('cars')
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
