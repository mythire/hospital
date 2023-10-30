
@extends('layouts.staticmain')

@section('content')
<div class="profile-authentication-area">
    <a href="/" class="logo"><img src="{{asset('images/logo-nav.png')}}" alt="logo"  style="width: 200px;" /></a>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="signin-form">
                    <h2>Forgot Password</h2>

                    <div class="mb-3">
                        {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
                    </div>

                    <x-jet-validation-errors class="mb-3 rounded-0" />

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form action="/forgot-password" method="post">
                        @csrf

                        <input type="hidden" name="token" value="{{ $request->route('token') }}">

                        <div class="form-group">
                            <x-jet-input class="{{ $errors->has('email') ? 'is-invalid' : '' }}" type="email"
                                         name="email" :value="old('email')" required  placeholder="Email"/>
                            <x-jet-input-error for="email"></x-jet-input-error>
                        </div>

                        <x-jet-button>
                            {{ __('Email Password Reset Link') }}
                        </x-jet-button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
