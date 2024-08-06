<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\LoginController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['verify' => true]);

Route::group(['middleware' => ['auth', 'verified']], function() {
    Route::get('/home', [HomeController::class, 'index'])->name('home');
});

Route::get('login/keycloak', [LoginController::class, 'redirectToKeycloak'])->name('login.keycloak');
Route::get('login/keycloak/callback', [LoginController::class, 'handleKeycloakCallback']);
Route::get('logout/callback', [LoginController::class, 'handleLogoutCallback'])->name('logout.callback');
/*
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
*/