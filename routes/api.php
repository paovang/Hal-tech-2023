<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\ProvinceController;
use App\Http\Controllers\UserProfileController;



Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('login', [AuthController::class, 'login']);
    // Route::post('logout', 'AuthController@logout');
    // Route::post('refresh', 'AuthController@refresh');
    // Route::post('me', 'AuthController@me');
});


#  method = get, post, put, delete

Route::group([
    'middleware' => 'auth.jwt',
], function () {

    Route::get('list-provinces', [ProvinceController::class, 'listProvinces']);
    Route::post('add-province', [ProvinceController::class, 'addProvince'])->name('add.province');
    Route::put('edit-province/{id}', [ProvinceController::class, 'editProvince'])->name('edit.province');
    Route::delete('delete-province/{id}', [ProvinceController::class, 'deleteProvince'])->name('delete.province');

    Route::get('list-districts', [DistrictController::class, 'listDistricts'])->name('list.district');
    Route::post('add-district', [DistrictController::class, 'addDistrict'])->name('add.district');
    Route::put('edit-district/{id}', [DistrictController::class, 'editDistrict'])->name('edit.district');
    Route::delete('delete-district/{id}', [DistrictController::class, 'deleteDistrict'])->name('delete.district');

});

Route::get('list-user-profile', [UserProfileController::class, 'listUserProfile'])->name('list.user.profile');
Route::post('add-user-profile', [UserProfileController::class, 'addUserProfile'])->name('add.user.profile');

Route::post('send-email', [MailController::class, 'sendEmail']);

Route::post('check-data', [MailController::class, 'checkData'])->name('check.data');

<<<<<<< HEAD
// paovang testtt
=======
// paovang test
// test


// phonpadid
>>>>>>> 5a79d71115521df2b4e6acb58a569f23e5ecd098
