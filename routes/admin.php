<?php

use App\Http\Controllers\BehaveYourselfController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QuoteController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\UserController;
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

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/home', [DashboardController::class, 'index'])->name('dashboard');

Route::resource('profiles', ProfileController::class)->only(['edit', 'update']);
Route::resource('users', UserController::class)->except(['show']);
Route::put('users/{user}/update-password', [UserController::class, 'updatePassword'])->name('users.update-password');

Route::resource('settings', SettingController::class)->except(['show']);
Route::put('settings/{setting}/set', [SettingController::class, 'set'])->name('settings.set');

Route::resource('permissions', PermissionController::class)->except(['show']);

Route::resource('roles', RoleController::class)->except(['show']);

Route::resource('quotes', QuoteController::class)->except(['show']);

Route::get('users/ajax-search', [UserController::class, 'ajaxSearch'])->name('users.ajax-search');
Route::get('settings/ajax-search', [SettingController::class, 'ajaxSearch'])->name('settings.ajax-search');
Route::get('permissions/ajax-search', [PermissionController::class, 'ajaxSearch'])->name('permissions.ajax-search');
Route::get('roles/ajax-search', [RoleController::class, 'ajaxSearch'])->name('roles.ajax-search');
Route::get('quotes/ajax-search', [QuoteController::class, 'ajaxSearch'])->name('quotes.ajax-search');

Route::get('behave-yourself/add-one', [BehaveYourselfController::class, 'store'])->name('behave-yourself.add-one');
