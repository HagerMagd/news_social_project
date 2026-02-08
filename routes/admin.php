<?php

use App\Http\Controllers\Admin\Auth\AdminLoginController;
use App\Http\Controllers\Admin\Auth\Passwords\ForgetPassword;
use App\Http\Controllers\Admin\Auth\Passwords\ResetPassword;
use App\Http\Controllers\Admin\Auth\User\UsersController;
use App\Http\Controllers\Admin\Category\CategoryController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Routing\Route as RoutingRoute;

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

Route::group(['prefix' => 'admin/', 'as' => 'admin.'], function () {
    Route::controller(AdminLoginController::class)->group(function () {
        Route::get('login', 'LoginForm')->name('login.show');
        Route::post('login/check', 'CheckData')->name('login.check');
        Route::post('logout', 'LogOut')->name('logout');
    });

    Route::group(['prefix' => 'password', 'as' => 'password.'], function () {
        //forget password
        Route::controller(ForgetPassword::class)->group(function () {
            Route::get('email', 'ShowEmailForm')->name('email');
            Route::post('email', 'SendOtp')->name('sendotp');
            Route::get('verify/{email}', 'ShowotpForm')->name('showotpform');
            Route::post('verify', 'VreifyOtp')->name('vreifyotp');
        });
        //reset password
        Route::controller(ResetPassword::class)->group(function () {
            Route::get('reset/{email}', 'showResetForm')->name('reset.form');
            Route::post('reset/', 'ResetPassword')->name('reset');
        });
    });
});

Route::group(['prefix' => 'admin/', 'as' => 'admin.', 'middleware' => 'auth:admin'], function () {
    Route::resource('users', UsersController::class);
    Route::resource('category', CategoryController::class);

    Route::get("users/Status/{id}", [UsersController::class, 'UserStatus'])->name("user.status");
    Route::get("categories/Status/{id}", [CategoryController::class, 'CategoriesStatus'])->name("Categories.Status");
    Route::get('home', function () {
        return view('dashbord.index');
    })->name('home');
});
