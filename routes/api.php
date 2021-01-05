<?php

use Illuminate\Http\Request;

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

Route::post('login', 'API\UsersController@login');
Route::group(['middleware' => ['auth:api']], function(){
// Route::group(['middleware' => []], function(){
Route::post('logout', 'API\UsersController@logout');
    Route::resource('users', 'UserController');
        Route::post('users/{user}/restore', 'UserController@restore')->name('users.restore');
        Route::delete('users/{user}/permdelete', 'UserController@deletePermanent')->name('users.permdelete');
    Route::resource('companies', 'CompanyController');
    Route::resource('employees', 'EmployeeController');
    Route::resource('entitlements', 'EntitlementController');
    Route::resource('employments', 'EmploymentController');
    Route::resource('positions', 'PositionController');
    Route::resource('holidays', 'HolidayController');
    Route::resource('leave', 'LeaveController');
        Route::post('leave/{leave}/setapproval', 'LeaveController@setApproval')->name('leave.setApproval');
        Route::get('whosout', 'LeaveController@whosOut')->name('whosout');
});
