@extends('layouts.app')

@section('content')

<form 
method="POST"
action="{{ route('login') }}"
class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow" 
>
@csrf
<h1 class="text-2xl font-normal mb-10 text-center">
    Let's login and have fun
</h1>
<div class="form-group row field mb-6">
    <label for="email" class="lable text-sm mb-2 block">{{ __('E-Mail Address') }}</label>
    <div class="control">
        <input 
        id="email" 
        type="email" 
        class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full form-control @error('email') is-invalid @enderror" 
        name="email" 
        value="{{ old('email') }}" required autocomplete="email" autofocus>

        @error('email')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row field mb-6">
    <label 
    for="password" 
    class="lable text-sm mb-2 block">
    {{ __('Password') }}
    </label>

    <div class="col-md-6 control">
        <input 
        id="password" 
        type="password" 
        class="input bg-transparent border border-grey-600 rounded p-2 text-xs w-full form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

        @error('password')
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>

<div class="form-group row">
    <div class="col-md-6 offset-md-4">
        <div class="form-check">
            <input class="form-check-input mr-2 leading-tight" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
                {{ __('Remember Me') }}
            </label>
        </div>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-8 offset-md-4">
        <button type="submit" class="button">
            {{ __('Login') }}
        </button>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="{{ route('password.request') }}">
            {{ __('Forgot Your Password?') }}
        </a>
        @endif
    </div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
@endsection
