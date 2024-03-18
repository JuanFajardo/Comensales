<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\MesaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\SubmenuController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\AlmacenController;
use App\Http\Controllers\PisqawarmisController;
use App\Http\Controllers\UserController;

Auth::routes();
/*
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Rutas de inicio de sesión
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// Rutas de restablecimiento de contraseña
Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
Route::post('password/reset', 'Auth\ResetPasswordController@reset')->name('password.update');

// Rutas de verificación de correo electrónico
Route::get('email/verify', 'Auth\VerificationController@show')->name('verification.notice');
Route::get('email/verify/{id}', 'Auth\VerificationController@verify')->name('verification.verify');
Route::get('email/resend', 'Auth\VerificationController@resend')->name('verification.resend');
*/


Route::middleware(['auth'])->group(function () {

    Route::get('/', function () {
        
        if (auth()->user()->tipo == "mesero") {
            return  redirect('/PhisqaWarmis');
        } else {
            return  redirect('/');
        }
        //return view('pisqa');
    });

    Route::resource('usuarios', UserController::class);
    Route::resource('almacen', AlmacenController::class);
    Route::resource('menus', MenuController::class);
    Route::resource('mesas', MesaController::class);
    Route::resource('clientes', ClienteController::class);
    Route::resource('submenus', SubmenuController::class);
    Route::resource('productos', ProductoController::class);

    Route::get('PhisqaWarmis', [PisqawarmisController::class, 'index']);
    Route::get('PhisqaWarmis/{id}', [PisqawarmisController::class, 'detalle']);
    Route::get('PhisqaWarmis/detalle/{id}', [PisqawarmisController::class, 'detallePedido']);
    Route::get('Phisqa/comprasVer', [PisqawarmisController::class, 'comprasVer']);
    Route::post('Phisqa/comprasSet', [PisqawarmisController::class, 'comprasSet']);

    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
});