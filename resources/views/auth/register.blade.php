@extends('layouts.app')

@section('content')

    <form 
        method="POST"
        action="{{ route('register') }}"
        class="lg:w-1/2 lg:mx-auto bg-card p-6 md:py-12 md:px-16 rounded shadow text-default" 
    >
    @csrf

    <h1 class="text-2xl font-normal mb-10 text-center">
        Hmm, What you are waiting for!!
    </h1>

    <div class="form-group row field mb-4">
        <label for="name" class="lable text-sm mb-2 block">{{ __('Name') }}</label>

        <div class="control">
            <input id="name" type="text" class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-4">
        <label for="email" class="lable text-sm mb-2 block">{{ __('E-Mail Address') }}</label>

        <div class="col-md-6">
            <input id="email" type="email" class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

            @error('email')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-4">
        <label for="password" class="lable text-sm mb-2 block">{{ __('Password') }}</label>

        <div class="col-md-6">
            <input id="password" type="password" class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

            @error('password')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror
        </div>
    </div>

    <div class="form-group row mb-4">
        <label for="password-confirm" class="lable text-sm mb-2 block">{{ __('Confirm Password') }}</label>

        <div class="col-md-6">
            <input id="password-confirm" type="password" class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full form-control" name="password_confirmation" required autocomplete="new-password">
        </div>
    </div>

    <div class="form-group row mb-0 mt-4">
            <button type="submit" class="button w-full">
                {{ __('Register') }}
            </button>
    </div>

    </form>
@endsection
