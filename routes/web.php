<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SPAController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('login');
});

Route::middleware('guest')->group(function () {
    Route::get('/login', function () {
        return view('authentication.login');
    })->name('login');

    Route::get('/register', function () {
        return view('authentication.register');
    });
});

Route::get('/{any}', SPAController::class)->where('any', '^(?!api).*$')->middleware('auth');
