@extends('authentication.auth-layout')

@section('form')
    <div class="formbg-outer">
        <div class="formbg">
            <div class="formbg-inner" style="padding: 18px 48px 18px 48px ">
                <span class="padding-bottom--15">Create New Account</span>
                @if ($errors->any())
                    @foreach ($errors->all() as $error)
                        <div class="error">{{$error}}</div>
                    @endforeach
                @endif
                <form action="/register" method="POST" id="stripe-login">
                    @csrf
                    <div class="field padding-bottom--24">
                        <label for="name">name</label>
                        <input type="text"
                               name="name"
                               placeholder="Michel Dobra"
                               required
                               value="{{old('name')}}"
                        >
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="email">Email</label>
                        <input type="email"
                               name="email"
                               placeholder="michel@gmail.com"
                               required
                               value="{{old('email')}}"
                        >
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="password">Password</label>
                        <input type="password"
                               name="password"
                               placeholder="Enter a password"
                               required
                        >
                    </div>
                    <div class="field padding-bottom--24">
                        <label for="password">Password</label>
                        <input name="password_confirmation"
                               type="password"
                               placeholder="Enter your password again"
                               required
                        >
                    </div>
                    <div class="field padding-bottom--24">
                        <input type="submit" name="submit" value="Sign Up">
                    </div>
                </form>
            </div>
        </div>
        <div class="footer-link" style="padding-top:16px ">
            <span>Already have an account? <a href="/login">Sign in</a></span>
            <div class="listing flex-flex center-center" style="padding-top: 10px">
                <span><a href="#">© websolcr</a></span>
                <span><a href="#">Contact</a></span>
                <span><a href="#">Privacy & terms</a></span>
            </div>
        </div>
    </div>

@endsection
