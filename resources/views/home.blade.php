@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Add Car') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ url('home') }}">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name Car') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('email') is-invalid @enderror" name="name" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="model" class="col-md-4 col-form-label text-md-end">{{ __('Model Car') }}</label>

                            <div class="col-md-6">
                                <input id="model" type="text" class="form-control @error('password') is-invalid @enderror" name="model" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        

                        <div class="row mb-3">
                            <label for="year" class="col-md-4 col-form-label text-md-end">{{ __('Year Car') }}</label>

                            <div class="col-md-6">
                                <input id="year" type="number" class="form-control @error('password') is-invalid @enderror" name="year" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
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
                        </tr>
                      </thead>
                      <tbody>
                        @foreach ($cars as $car)
                        <tr>
                        <th>{{ $car->name }}</th>
                        <th>{{ $car->model }}</th>
                        <th>{{ $car->year }}</th>
                        </tr>
                        @endforeach
                      </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
