@extends('authentication.auth-layout')

@section('form')
    <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner padding-horizontal--48">
                <span class="padding-bottom--15">Sign in to your account</span>
                @if ($errors->has('email'))
                    <span class="error">{{ $errors->first('email') }}</span>
                @endif
                <form action="/login" method="POST" id="stripe-login">
                    @csrf
                    <div class="field padding-bottom--24">
                        <label for="email">Email</label>
                        @isset($invitationData)
                            <input type="email"
                                   name="email"
                                   readonly
                                   value="{{$invitationData['email']}}"
                            >
                            <input type="hidden" name="invitation_token" value="{{$invitationData['invitation_token']}}">
                        @else
                            <input type="email"
                                   name="email"
                                   placeholder="michel@gmail.com"
                                   required
                                   value="{{old('email')}}"
                            >
                        @endisset
                    </div>
                    <div class="field padding-bottom--24">
                        <div class="grid--50-50">
                            <label for="password">Password</label>
                            <div class="reset-pass">
                                <a href="#">Forgot your password?</a>
                            </div>
                        </div>
                        <input type="password"
                               name="password"
                               placeholder="Enter a password"
                               required
                        >
                    </div>
                    <div class="field padding-bottom--24">
                        <input type="submit" name="submit" value="Sign In">
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-link padding-top--24">
            <span>Don't have an account? <a href="/register">Sign up</a></span>
            <div class="listing padding-top--24 padding-bottom--24 flex-flex center-center">
                <span><a href="#">© websolcr</a></span>
                <span><a href="#">Contact</a></span>
                <span><a href="#">Privacy & terms</a></span>
            </div>
        </div>
    </div>

@endsection
