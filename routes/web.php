<?php

use App\Http\Controllers\Authenticate\AuthenticationController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('dashboard');
})->name('dashboard')->middleware(['auth']);

Route::get('/register/page', [AuthenticationController::class, 'register_page'])->name('register.page');
Route::post('/register/store', [AuthenticationController::class, 'register_process'])->name('register.store');
Route::get('/login/page', [AuthenticationController::class, 'login_page'])->name('login.page');
Route::post('/login/store', [AuthenticationController::class, 'login_process'])->name('login.store');
Route::post('/logout', [AuthenticationController::class, 'logout_process'])->name('logout');

Route::get('/forget-password/page', [AuthenticationController::class, 'forgot_password_page'])->name('forget-pass.page');
Route::post('/forgot-password/sendlink', [AuthenticationController::class, 'send_reset_link_email'])->name('forgot-pass.email');
Route::get('/reset-password/{token}', [AuthenticationController::class, 'show_reset_password_form'])->name('password.reset');
Route::post('/reset-password/form', [AuthenticationController::class, 'reset_password_process'])->name('password.update');
