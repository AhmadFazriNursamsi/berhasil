<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\ApisController;
use App\Http\Controllers\DivisionControllers;
use App\Http\Controllers\servieController;
use App\Http\Controllers\ListaccessController;
// use App\Http\Controllers\DivisionControllers;


Route::get('/', function () {
return view('welcome');
});

Route::group(['middleware'=>'auth'], function(){
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/users', [UsersController::class, 'index'])->name('users');
Route::get('/users/create', [UsersController::class, 'create']);
Route::get('/users/edit/{id}', [UsersController::class, 'edit']);
Route::post('/users/store', [UsersController::class, 'store']);
Route::post('/users/update/{id}', [UsersController::class, 'update']);
Route::post('/users/delete/{id}', [ApisController::class, 'apideleteuserbyid']);


Route::get('/listaccess', [ListaccessController::class, 'index'])->name('listaccess');
Route::post('/listaccess/delete/{id}', [ApisController::class, 'apiDeleteListAccessById']);


Route::get('/api/users/getdata', [ApisController::class, 'apigetdatauser']);
Route::post('/api/users/getdatabyid/{id}', [ApisController::class, 'apigetdatauserbyid']);
Route::get('/api/getrole', [ApisController::class, 'apigetrole']);


Route::get('/api/listaccess/getdata', [ApisController::class, 'apiGetDataListAccess']);
Route::post('/api/usersaccess/{id}', [ApisController::class, 'apiGetDataUserAccessById']);


Route::post('/api/listaccess/getdatabyid/{id}', [ApisController::class, 'apiGetDataListAccessById']);

Route::post('/api/listaccess/insertdata', [ListaccessController::class, 'apiInsertData']);
Route::post('/api/listaccess/updatedata', [ListaccessController::class, 'apiUpdateData']);

Route::get('/api/divi/getdata', [ApisController::class, 'apigetdatadivi']);
Route::get('/api/getdivision', [ApisController::class, 'apigetdivisi']);
//    CRUD SEVICE
Route::get('/division', [servieController::class, 'index']);
Route::post('/division/store/', [servieController::class, 'apiStore']);
Route::get('/division/delete/{id}', [servieController::class, 'apiDestroy']);
Route::get('/division/detail/{id}', [servieController::class, 'apiDetail']);
Route::get('/division/update/{id}', [servieController::class, 'apiEdit']);
Route::get('/division/update3/{id}', [servieController::class, 'apiUpdate']);

///Division CRUD
Route::get('/divisions/create', [DivisionControllers::class, 'create']);
Route::post('/divisions/store', [DivisionControllers::class, 'store']);
Route::get('/divisions/edit/{id}', [DivisionControllers::class, 'edit']);
Route::post('/divisions/update/{id}', [DivisionControllers::class, 'update']);
Route::get('/divisions', [DivisionControllers::class, 'index']);
Route::get('/api/divisionaccess/{id}', [DivisionControllers::class, 'apiGetDataDivisionAccessById']);

});

require __DIR__.'/auth.php';
