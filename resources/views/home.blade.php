@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="add" id="btnradio1" autocomplete="off" checked onclick="clic()"  value="car">
                        <label class="btn btn-outline-primary" for="btnradio1">{{ __('Add Car') }}</label>

                        <input type="radio" class="btn-check" name="add" id="btnradio2" autocomplete="off" onclick="clic()" value="category">
                        <label class="btn btn-outline-primary" for="btnradio2">{{ __('Add Category') }}</label>
                    </div>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                    <div class="car action">
                    <form method="POST" action="{{ url('home') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name Car') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="name" value="{{ old('email') }}" required autocomplete="email" autofocus>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="model" class="col-md-4 col-form-label text-md-end">{{ __('Model Car') }}</label>

                            <div class="col-md-6">
                                <input id="model" type="text" class="form-control @error('password') is-invalid @enderror" name="model" required autocomplete="current-password">
                            </div>
                        </div>

                        

                        <div class="row mb-3">
                            <label for="year" class="col-md-4 col-form-label text-md-end">{{ __('Year Car') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="number" class="form-control @error('password') is-invalid @enderror" name="year" required autocomplete="current-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="category" class="col-md-4 col-form-label text-md-end">{{ __('Year Category') }}</label>

                            <div class="col-md-6">
                                <select class="form-select" id="category" aria-label="Default select example" name="category_id" required>
                                    <option selected>Select a category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
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
                    <table class="table">
                    <thead>
                      <tr>
                        <th scope="col"><a href="{{ $urls['name'] }}">{{ __('Name Car') }}</a></th>
                        <th scope="col"><a href="{{ $urls['model'] }}">{{ __('Model Car') }}</a></th>
                        <th scope="col"><a href="{{ $urls['year'] }}">{{ __('Year Car') }}</a></th>
                        <th scope="col">{{ __('Category') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cars as $car)
                        <tr>
                        <th>{{ $car->name }}</th>
                        <th>{{ $car->model }}</th>
                        <th>{{ $car->year }}</th>
                        <th>@if (isset($car->category->name)) {{ $car->category->name }} @endif</th>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
                    <div class="category">
                    <form method="POST" action="{{ route('categiry') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name Category') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="name" value="{{ old('email') }}" required autocomplete="email" autofocus>
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
                    <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">{{ __('Name Category') }}</th>
                        </tr>
                      </thead>
                      <tbody>
                        @foreach($categories as $category)
                        <tr>
                        <th>{{ $category->name }}</th>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                    </div>
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
