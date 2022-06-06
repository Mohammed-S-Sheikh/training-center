<?php

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

Route::group([
    'middleware' => ['auth'],
], function () {
    Route::resources([
        'trainees' => TraineeController::class,
        'delegates' => DelegateController::class,
    ]);

    Route::fallback(function () {
        $delegates = App\Models\User::orderBy('id', 'DESC')->paginate(10);
        return view('pages.delegate.index', compact('delegates'));
    });
});
