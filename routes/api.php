<?php

use App\Http\Controllers\Admin\FootballMatchController as AdminFootballMatchController;
use App\Http\Controllers\FootballMatchController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::middleware('auth:sanctum')->group(function () {
    Route::prefix('v1')->name('v1.')->group(function () {
        Route::prefix('matches')->name('matches.')->group(function () {
            Route::get('/', [FootballMatchController::class, 'index'])->name('index');
            Route::post('/{footballMatch}/users/{user}/bet', [FootballMatchController::class, 'storeBet'])->name('storeBet');
        });

        Route::prefix('ranking')->name('ranking.')->group(function () {
            Route::get('/', [UserController::class, 'getRanking'])->name('ranking');
        });
    });
    Route::prefix('admin')->name('admin.')->group(function () {
        Route::prefix('v1')->name('v1.')->group(function () {
            // Matches Admin routes
            Route::prefix('matches')->name('matches.')->group(function () {
                Route::get('/', [AdminFootballMatchController::class, 'index'])->name('index');
                Route::post('/', [AdminFootballMatchController::class, 'store'])->name('store');
                Route::get('/{footballMatch}', [AdminFootballMatchController::class, 'show'])->name('show');
                Route::patch('/{footballMatch}', [AdminFootballMatchController::class, 'update'])->name('update');
                Route::put('/{footballMatch}/result', [AdminFootballMatchController::class, 'submitResult'])->name('submitResult');
            });
        });
    });
});
