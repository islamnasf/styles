<?php

use App\Http\Controllers\Api\CategroyController;
use App\Http\Controllers\Api\GalleryApiController;
use App\Http\Controllers\Api\SubCategoryController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AuthOtpController;
use Illuminate\Support\Facades\Route;

Route::Group(['prefix' => 'auth'], function ($router) {
    Route::match(['get', 'post'] ,'/register', [AuthController::class, 'register']);
    Route::match(['get', 'post'] ,'/login', [AuthController::class, 'login']);
    Route::Post('/update/profile/{id}', [AuthController::class, 'update']);
    Route::Get('/profile', [AuthController::class, 'profile']);
    Route::Post('/logout', [AuthController::class, 'logout']);
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
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods:  POST, GET, OPTIONS, PUT, DELETE');
header('Access-Control-Allow-Headers:  Content-Type, X-Auth-Token, Origin, Authorization'); 