<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CMSControllers\API\CommonAPIController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\CMSControllers\EmpDepartDesignationController;


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
// Route::get('/', function () {
//     return view('welcome');
// });
function set_active($route) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'hover show' : '';
    }
    return Request::path() == $route ? 'hover show' : '';
}
function set_active1($route) {
    if( is_array( $route ) ){
        return in_array(Request::path(), $route) ? 'active' : '';
    }
    return Request::path() == $route ? 'active' : '';
}

Artisan::call('cache:clear');
Artisan::call('view:clear');
Artisan::call('route:clear');
Artisan::call('config:clear');

Route::get('/', [LoginController::class, 'showLoginForm'])->name('/');
Route::get('login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'authenticate'])->name('authenticate');
Route::get('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('forget-user', [ForgotPasswordController::class, 'showForgetPasswordForm'])->name('forget-user');
Route::post('forget-change', [ForgotPasswordController::class, 'submitForgetPasswordForm'])->name('forgetuser');
Route::get('reset-password/{token}', [ForgotPasswordController::class, 'showResetPasswordForm'])->name('reset-password');
Route::get('update-password', [ForgotPasswordController::class, 'submitResetPasswordForm'])->name('update-password');
Route::get('/reload-captcha', [LoginController::class, 'reloadCaptcha']);

Route::post('mimeimagecheck', [CommonAPIController::class, 'imageMimeCheck'])->name('mimeimagecheck');
Route::post('mimepdfcheck', [CommonAPIController::class, 'pdfMimeCheck'])->name('mimepdfcheck');
// capture analytics
Route::post('analytics', [AnalyticsController::class, 'store'])->name('store-analytics');
Route::post('fetch-designation', [EmpDepartDesignationController::class, 'fetchDesignation'])->name('fetch-designation');

//,->middleware('throttle:custom_Limit')



require __DIR__ .'/cms_web.php';

//default behaviour, always keep as last entry
Route::any('{url}', function(){
    return redirect('login');
})->where('url', '.*');

