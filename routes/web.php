<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\ClientController;
use Illuminate\Support\Facades\Auth;
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

Auth::routes();
Route::get('/', [LoginController::class, 'index']);
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['IsAdmin']], function () {
    Route::prefix('admin')->group(function() {
        Route::get('/', [AdminController::class, 'index'])->name('admin.index');
        Route::get('/client', [AdminController::class, 'clientIndex'])->name('admin.client.index');
        Route::get('/campaign', [AdminController::class, 'campaignIndex'])->name('admin.campaign.index');

        Route::post('client', [AdminController::class, 'clientStore'])->name('admin.client.store');
    });
});


Route::group(['middleware' => ['IsClient']], function () {
    Route::prefix('client')->group(function () {
        Route::get('/', [ClientController::class, 'index'])->name('client.index');
        Route::get('/campaign', [ClientController::class, 'campaignIndex'])->name('client.campaign.index');
        Route::post('campaign', [ClientController::class, 'campaignStore'])->name('client.campaign.store');
    });
});
