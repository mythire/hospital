@extends('layouts.staticmain')

@section('title', 'Login')

@section('content')
<div class="profile-authentication-area">
    <a href="/" class="logo"><img src="{{asset('images/logo-nav.png')}}" alt="logo"  style="width: 200px;" /></a>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="signin-form">
                    <h2>Sign In</h2>
                    <form action="{{ route('login') }}" method="post">
                        @csrf
                        <x-jet-validation-errors class="mb-3 rounded-0" />

                        @if (session('status'))
                            <div class="alert alert-success mb-3 rounded-0" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <div class="form-group">
                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                             name="email" :value="old('email')" required  placeholder="Email"/>
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>
                        <div class="form-group">
                           <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                            name="password" required autocomplete="current-password" placeholder="Password" />
                           <x-jet-input-error for="password"></x-jet-input-error>
                       </div>
                        <div class="row align-items-center">
                            <div class="col-lg-6 col-md-6 col-sm-6 remember-me-wrap">
                                <p>
                                    <div class="form-check">
                                        <div class="custom-control custom-checkbox">
                                            <x-jet-checkbox id="remember_me" name="remember" />
                                            <label class="custom-control-label" for="remember_me">
                                                {{ __('Remember Me') }}
                                            </label>
                                        </div>
                                    </div>
                                </p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-6 lost-your-password-wrap">
                                @if (Route::has('password.request'))
                                    <a class="lost-your-password" href="{{ route('password.request') }}">
                                        {{ __('Forgot your password?') }}
                                    </a>
                                @endif
                            </div>
                        </div>
                        <x-jet-button>
                            {{ __('Log in') }}
                        </x-jet-button>
                        <span class="dont-account">Don't have an account? <a href="{{route('register')}}">Sign Up Now!</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
