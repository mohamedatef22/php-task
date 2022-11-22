<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerActionController;
use App\Http\Controllers\UserController;
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
})->name('home');

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('login', [AuthController::class, 'auth'])->name('auth');

Route::post('/logout', [UserController::class, 'logout'])->name('logout');

Route::prefix('dashboard')->middleware('auth')->group(function () {

    Route::get('/', function () {
        return view('Dashboard.home');
    })->name('dashboard');

    Route::get('/add/employee', [UserController::class, 'addEmployee'])->name('employee.add')->can('add-employee');
    Route::post('/add/employee', [UserController::class, 'store'])->name('employee.store')->can('add-employee');

    Route::get('/customer/add', [UserController::class, 'addCustomer'])->name('customer.add')->can('add-customer');
    Route::post('/customer/add', [UserController::class, 'storeCustomer'])->name('customer.store')->can('add-customer');


    Route::get('/customer/all', [UserController::class, 'getCustomers'])->name('customer.all')->can('get-customers');
    Route::get('/customer/{customer}', [UserController::class, 'showCustomer'])->name('customer.show')->can('show-customer','customer')->where(['id' => '[0-9]+']);
    Route::post('/customer/{customer}/assign', [UserController::class, 'assignEmployee'])->name('customer.assign')->can('can-assign')->where(['id' => '[0-9]+']);

    Route::post('/customer/{customer}/action/add',[CustomerActionController::class,'store'])->where(['id' => '[0-9]+'])->can('can-add-action','customer')->name('action.add');
});
