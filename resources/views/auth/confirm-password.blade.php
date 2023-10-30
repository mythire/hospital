@extends('layouts.staticmain')

@section('content')
<div class="profile-authentication-area">
    <a href="/" class="logo"><img src="{{asset('images/logo-nav.png')}}" alt="logo"  style="width: 200px;" /></a>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="signin-form">
                    <h2>Confirm Password</h2>

                    <div class="mb-3  text-sm text-muted">
                        {{ __('This is a secure area of the application. Please confirm your password before continuing.') }}
                    </div>

                    <x-jet-validation-errors class="mb-3 rounded-0" />

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif


                    <form action="{{ route('password.confirm') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <x-jet-input id="password" type="password" name="password" required autocomplete="current-password" autofocus />
                        </div>

                        <div class="button">
                            <x-jet-button>
                                {{ __('Confirm') }}
                            </x-jet-button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
