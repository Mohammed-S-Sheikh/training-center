<?php

use App\Models\User;
use App\Models\Trainee;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TraineeController;
use App\Http\Controllers\DelegateController;

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
    Route::resource('trainees', TraineeController::class);
    Route::resource('delegates', DelegateController::class)->middleware('admin');

    Route::fallback(function () {
        if (Auth::user()->is_admin) {
            $delegates = User::orderBy('id', 'DESC')->paginate(10);
            return view('pages.delegate.index', compact('delegates'));
        } else {
            $trainees = Trainee::orderBy('id', 'DESC')->paginate(10);
            return view('pages.trainee.index', compact('trainees'));
        }
    });
});
