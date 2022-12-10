<?php

use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['web','useractivity'])->group(function () {
    Route::get('/home', [HomeController::class, 'index'])->name('home');

    Route::resource('user', EmployeeController::class);
    Route::get('/product/{id}/qualitys/delete', [EmployeeController::class, 'destroy'])->name('user.delete');

    //Employee Export
    Route::get('/employee/export', [EmployeeController::class, 'export'])->name('employee.export');

    Route::get('/employee/search', [EmployeeController::class, 'search'])->name('employee.search');

    Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

    Route::get('/email/send',[EmployeeController::class,'email'])->name('employee.email');

});
