<?php

use App\Http\Controllers\Api\CategroyController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthOtpController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'auth'], function ($router) {
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/update/profile/{id}', [AuthController::class, 'update']);
    Route::get('/profile', [AuthController::class, 'profile']);
    Route::post('/logout', [AuthController::class, 'logout']);
    //otp
    Route::Post('/otp/generate', [AuthOtpController::class, 'otpGenerate']);
    Route::Post('/otp/login', [AuthOtpController::class, 'loginWithOtp']);
    Route::Post('/otp/update/password', [AuthOtpController::class, 'updatePassword']);
});
Route::group(['prefix' => 'category'], function ($router) {

    Route::get('/', [CategroyController::class, 'showCategory']);
    Route::get('/subCategory', [SubCategoryController::class, 'showSubCategory']);
    Route::get('/subCategory/gallery/{sub}', [GalleryApiController::class, 'showGallery']);
});
