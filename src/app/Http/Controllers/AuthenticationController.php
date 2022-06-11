<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\View;

class AuthenticationController extends Controller
{
    public function login(): View
    {
        return view('authentication.login');
    }

    public function register(): View
    {
        return view('authentication.register');
    }
}
