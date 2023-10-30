@extends('layouts.staticmain')

@section('content')
<div class="profile-authentication-area">
    <a href="/" class="logo"><img src="{{asset('images/logo-nav.png')}}" alt="logo"  style="width: 200px;" /></a>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="signin-form">
                    <h2>Reset Password</h2>

                    <div class="mb-3  text-sm text-muted">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <x-jet-validation-errors class="mb-3 rounded-0" />

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form action="/reset-password" method="post">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email" name="email"
                             :value="old('email', $request->email)" required autofocus placeholder="Email"/>
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <x-jet-input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" type="password"
                             name="password" required autocomplete="current-password" placeholder="Password" />
                            <x-jet-input-error for="password"></x-jet-input-error>
                        </div>
                        <div class="form-group">
                            <x-jet-input class="{{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}" type="password"
                             name="password_confirmation" required autocomplete="new-password" placeholder="Confirm Password" />
                            <x-jet-input-error for="password_confirmation"></x-jet-input-error>
                        </div>

                        <x-jet-button>
                            {{ __('Reset Password') }}
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
