@extends('layouts.staticmain')

@section('content')
<div class="profile-authentication-area">
    <a href="/" class="logo"><img src="{{asset('images/logo-nav.png')}}" alt="logo"  style="width: 200px;" /></a>
    <div class="d-table">
        <div class="d-table-cell">
            <div class="container">
                <div class="signin-form">
                    <h2>Sign Up</h2>

                    <x-jet-validation-errors class="mb-3 rounded-0" />

                    @if (session('status'))
                        <div class="alert alert-success mb-3 rounded-0" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form action="{{ route('register') }}" method="post">
                        @csrf


                        <div class="form-group">
                            <x-jet-input class="{{ $errors->has('first_name') ? 'is-invalid' : '' }}" type="text"
                                         name="first_name" :value="old('first_name')" required  placeholder="First name"/>
                            <x-jet-input-error for="first_name"></x-jet-input-error>
                        </div>

                        <div class="form-group">
                            <x-jet-input class="{{ $errors->has('last_name') ? 'is-invalid' : '' }}" type="text"
                                         name="last_name" :value="old('last_name')" required  placeholder="Last name"/>
                            <x-jet-input-error for="last_name"></x-jet-input-error>
                        </div>

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
                        <div class="form-group">
                            <x-jet-input class="form-control" type="password"
                             name="password_confirmation" required  placeholder="Confirm Password" />
                        </div>

                        <div class="row align-items-center">
                            <div class="col-lg-12 col-md-12 col-sm-12 remember-me-wrap">
                                <p>
                                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                                    <div class="form-check">
                                     <div class="custom-control custom-checkbox">
                                         <x-jet-checkbox id="terms" name="terms" />
                                         <label class="custom-control-label" for="terms">
                                             {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                         'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'">'.__('Terms of Service').'</a>',
                                                         'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'">'.__('Privacy Policy').'</a>',
                                                 ]) !!}
                                         </label>
                                     </div>
                                    </div>
                                    @endif
                                </p>
                            </div>
                        </div>
                        <x-jet-button>
                            {{ __('Register') }}
                        </x-jet-button>
                        <span class="dont-account">Already Registered? <a href="{{route('login')}}">Sign In Now!</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
