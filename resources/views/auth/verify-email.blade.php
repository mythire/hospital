@extends('layouts.staticmain')

@section('content')
<div class="profile-authentication-area">
    <a href="/" class="logo"><img src="{{asset('images/logo-nav.png')}}" alt="logo"  style="width: 200px;" /></a>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="signin-form">
                    <h2>Verify Email Address</h2>

                    <div class="mb-3 small text-muted">
                        {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
                    </div>

                    <x-jet-validation-errors class="mb-3 rounded-0" />

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('verification.send') }}" method="post">
                        @csrf

                        <div class="button">
                             <x-jet-button type="submit">
                                {{ __('Resend Verification Email') }}
                            </x-jet-button>
                        </div>
                    </form>
                    <form method="POST" action="/logout">
                        @csrf

                        <div class="button">
                            <button type="submit" class="btn btn-link">
                                {{ __('Log Out') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
