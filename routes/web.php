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

// Route content layout

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Auth::routes();

/**
 * Admin Resource Routes
 */
Route::resource('admin/roles', 'RoleController');
Route::resource('admin/users/', 'UserController');

Auth::routes();

Route::get('user/update/password', 'Auth\SetPasswordAfterRegisterController@showUpdatePasswordForm')
    ->name('password-update-form');
Route::post('user/update/password', 'Auth\SetPasswordAfterRegisterController@updatePassword')
    ->name('password.update');
Route::post('admin/users/roles', 'UserRoleController@assignRole')->name('user.roles.assign-role');
Route::get('admin/users/roles', 'UserRoleController@index')->name('user.roles.index');
Route::get('admin/users/roles/assign', 'UserRoleController@assignRoleForm')->name('user.roles.assign.form');


Route::get('/home', 'HomeController@index')->name('home');

Route::get('givings/dashboard', 'GivingController@index')->name('givings.dashboard');
Route::get('giving/successful', 'GivingController@successful')->name('giving.successful');
Route::get('giving/error', 'GivingController@errorState')->name('giving.error');
Route::get('giving/complete', 'GivingController@completion')->name('giving.completion');
Route::post('giving/mobile-money/process', 'GivingController@mobileMoneyPayment')->name('giving.momo');
Route::post('giving/credit-card/process', 'GivingController@cardPayment')->name('giving.card');
Route::get('giving/credit-card/vbv-confirmation', 'GivingController@vbvConfirmation')->name('giving.vbv.confirmation');
Route::post('giving', 'GivingController@store')->name('giving.store');
Route::get('giving', 'GivingController@showGivingForm')->name('giving.create');
Route::get('giving/{giving}/confirm', 'GivingController@confirm')->name('giving.confirm');
