<?php

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

Route::get('/', 'HomeController@index')
        ->name('home');

Auth::routes(['verify' => true]);

Route::prefix('web')->group(function() {
    // Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/profile/changepassword', 'web\ProfileController@changePassword')->name('web.profile.changepassword');
    Route::put('/profile/updatepassword', 'web\ProfileController@updatePassword')->name('web.profile.updatepassword');

    Route::middleware(['change.pw'])->group(function() {

        // START DASHBOARD

        Route::get('/', 'web\DashboardController@index')->name('web.dashboard.index');

        // END DASHBOARD

        // START PROFILE

        // Route::get('/profile/changepassword', 'web\ProfileController@changePassword')->name('web.profile.changepassword');

        Route::get('/profile/requests', 'web\ProfileController@requests')->name('web.profile.requests');

        // Route::put('/profile/updatepassword', 'web\ProfileController@updatePassword')->name('web.profile.updatepassword');

        Route::put('/profile/cancel/{leave}', 'web\ProfileController@cancelLeave')->name('web.profile.cancel.leave');

        Route::get('/profile/employment', 'web\ProfileController@viewEmployment')->name('web.profile.employment');

        Route::resource('/profile', 'web\ProfileController', [
            'as'    =>  'web'
        ])->except([
            'destroy', 'create', 'store'
        ]);


        // END PROFILE

        // USERS

        Route::resource('/users', 'web\UsersController', [
            'as'    => 'web',
            'middleware'    =>  ['auth.superuser'],
        ]);
        // END USERS

        Route::resource('/notifications', 'web\NotifcationsController', [
            'as'    =>  'web'
        ])->except([
            'create', 'store', 'edit', 'update'
        ]);

        Route::get('/notifications/markallread', 'web\NotificationsController@markallasread')->name('web.notifications.markallasread');

        // EMPLOYEES


        Route::resource('/employees', 'web\EmployeeController', [
            'as'    => 'web',
            'middleware'    =>  ['auth.superuser']
        ]);

        Route::get('/employees/{employee}/resendverification', 'web\EmployeeController@resendVerification')
                ->name('web.employees.resendverification');

        Route::put('/employees/{employee}/update/employmentrecord', 'web\EmployeeController@updateEmploymentRecord')
                ->name('web.employees.update.employment');

        Route::put('/employees/{employee}/update/entitlementrecord', 'web\EmployeeController@updateEntitlementRecord')
                ->name('web.employees.update.entitlement');

        // END EMPLOYEES

        // LEAVE

        Route::resource('/requests', 'web\LeaveController', [
            'as'    => 'web',
        ]);

        Route::get('/requests/{leave}/{status}', 'web\LeaveController@changeLeaveStatus')
                ->name('web.requests.change.status');

        Route::put('/requests/{leave}/{status}', 'web\LeaveController@updateLeaveStatus')
                ->name('web.requests.update.status');

        // END LEAVE

        // HOLIDAYS AND EVENTS

        Route::get('/holidays/calendar/get', 'web\HolidaysController@calendarGet')
                ->name('web.holidays.calendar.get');

        Route::put('settings/holidays/updateholidays', 'web\HolidaysController@updateHolidays', [
            'middleware'    =>  ['auth.superuser']
        ])->name('web.settings.holidays.calendar.updateholidays');

        Route::get('settings/holidays/updateHolidayCommand', 'web\HolidaysController@updateHolidayCommand', [
            'middleware'    =>  ['auth.superuser']
        ])->name('web.settings.holidays.calendar.updateHolidayCommand');

        Route::resource('/settings/holidays', 'web\HolidaysController', [
            'as'    => 'web.settings',
            'middleware'    =>  ['auth.superuser']
        ]);


        // END HOLIDAYS AND EVENTS

        // POSITIONS
        Route::resource('settings/positions', 'web\PositionsController', [
            'as'    => 'web',
            'middleware'    =>  ['auth.superuser']
        ]);
        // END POSITIONS

        // CLIENTS
        Route::resource('settings/clients', 'web\ClientsController', [
            'as'    => 'web',
            'middleware'    =>  ['auth.superuser']
        ]);
        // END CLIENTS

        // TEAMS
        Route::resource('settings/teams', 'web\TeamsController', [
            'as'    => 'web',
            'middleware'    =>  ['auth.superuser']
        ]);
        // END TEAMS

    });
});

Route::prefix('app')->group(function() {

	// Admin Dashboard Web App
	Route::get('/', 'DashboardController@index')->name('app.dashboard.index');

});
