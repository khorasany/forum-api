<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\v1\Auth\AuthController;
use App\Http\Controllers\Api\v1\Channel\ChannelController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1/')->group(function () {

    Route::prefix('/auth')->group(function () {
        Route::post('/register', [AuthController::class, 'register'])->name('auth.register');
        Route::post('/login', [AuthController::class, 'login'])->name('auth.login');
        Route::get('/user', [AuthController::class, 'user'])->name('auth.user');
        Route::post('/logout', [AuthController::class, 'logout'])->name('auth.logout');
    });

    Route::prefix('/channel')->group(function () {
        Route::get('/all', [ChannelController::class, 'getAllChannels'])->name('channel.all');
        Route::post('/create', [ChannelController::class, 'createNewChannel'])->name('channel.create');
        Route::post('/validate', [ChannelController::class, 'createNewChannel'])->name('channel.validate');
        Route::put('/update', [ChannelController::class, 'editChannel'])->name('channel.update');
        Route::delete('/delete', [ChannelController::class, 'deleteChannel'])->name('channel.delete');
    });
});

//Route::prefix('v1/auth')->group(function() {
//    Route::post('/register',[AuthController::class,'register']);
//    Route::post('/register',[AuthControllerTest::class,'testRegister']);
//});
