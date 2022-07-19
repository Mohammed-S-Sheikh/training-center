<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeadController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\ForeignTraineeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;

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

Route::view('login', 'pages.login')->name('login');

Route::group([
    'middleware' => ['auth'],
], function () {
    Route::get('/', DashboardController::class)->name('dashboard')->middleware('roles:admin,accountant');

    Route::put('leads/{lead}/promote', [LeadController::class, 'promote'])->name('leads.promote');
    Route::resource('leads', LeadController::class)->middleware('driver');
    Route::resource('users', UserController::class)->middleware('roles:admin');
    Route::resource('settings', SettingController::class)->only('update')->middleware('roles:admin');
    Route::resource('trainees', TraineeController::class)->middleware('has_access:show,edit,update,destroy');
    Route::resource('foreign-trainees', ForeignTraineeController::class);

    Route::fallback(function () {
        return match (Auth::user()->role) {
            'admin', 'accountant' => redirect('/'),
            'driver', 'user' => redirect('/trainees'),
        };
    });
});
