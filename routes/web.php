<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Party\PartiesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Authenticate\AuthenticationController;
use App\Http\Controllers\Party\PartiesInformationController;

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


Route::get('/register/page', [AuthenticationController::class, 'register_page'])->name('register.page');
Route::post('/register/store', [AuthenticationController::class, 'register_process'])->name('register.store');
Route::get('/login/page', [AuthenticationController::class, 'login_page'])->name('login.page');
Route::post('/login/store', [AuthenticationController::class, 'login_process'])->name('login.store');


Route::middleware(['guest'])->group(function(){
    // password forgot and reset
    Route::get('/forget-password/page', [AuthenticationController::class, 'forgot_password_page'])->name('forget-pass.page');
    Route::post('/forgot-password/sendlink', [AuthenticationController::class, 'send_reset_link_email'])->name('forgot-pass.email');
    Route::get('/reset-password/{token}', [AuthenticationController::class, 'show_reset_password_form'])->name('password.reset');
    Route::post('/reset-password/form', [AuthenticationController::class, 'reset_password_process'])->name('password.update');
});




Route::middleware(['auth'])->group(function(){
    // logout
    Route::post('/logout', [AuthenticationController::class, 'logout_process'])->name('logout');

    Route::get('/dashboard', [DashboardController::class, 'dashboard_page'])->name('dashboard');

    // parties type creation routes
    Route::get('/parties/type/info', [PartiesController::class, 'parties_index'])->name('parties.type.info');
    Route::get('/parties/type/form', [PartiesController::class, 'parties_create_form_view'])->name('parties.type.form.view');
    Route::post('/parties/type/form/store', [PartiesController::class, 'parties_create_form_store'])->name('parties.type.form.store');
    Route::get('/parties/type/form/edit/{id}', [PartiesController::class, 'parties_edit_form_view'])->name('parties.type.form.edit');
    Route::post('/parties/type/form/update/{id}', [PartiesController::class, 'parties_update_form_store'])->name('parties.type.form.update');
    Route::get('/parties/type/form/delete/{id}', [PartiesController::class, 'parties_delete_record'])->name('parties.type.form.delete');
    Route::get('/parties/type/update-party-status/{table}/{id}/{value}', [PartiesController::class, 'update_party_status'])->name("parties.type.update.status");
    Route::get('/parties/type/search', [PartiesController::class, 'search_process'])->name('parties.type.search');


    // parties info creation routes
    Route::get('/parties/info', [PartiesInformationController::class, 'parties_info_index'])->name('parties.info');
    Route::get('/parties/form', [PartiesInformationController::class, 'parties_info_create_form_view'])->name('parties.form.view');
    Route::post('/parties/form/store', [PartiesInformationController::class, 'parties_info_create_form_store'])->name('parties.form.store');
    Route::get('/parties/search', [PartiesInformationController::class, 'search_info_process'])->name('parties.search');

});

