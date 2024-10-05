<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaceController;
use App\Http\Controllers\WorkRecordController;
use App\Http\Controllers\ReportController;
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


Route::get('/', [PlaceController::class, 'ViewPlaces'])->name('index');
Route::POST('/createplaces', [PlaceController::class, 'CreatePlace'])->name('createplaces');
Route::get('/deleteplace{id}', [PlaceController::class, 'DeletePlace'])->name('deleteplace');



Route::get('/viewrecord', [WorkRecordController::class, 'ViewRecord'])->name('viewrecord');
Route::POST('/createrecord', [WorkRecordController::class, 'CreateRecord'])->name('createrecord');
Route::POST('/editrecord{id}', [WorkRecordController::class, 'EditRecord'])->name('editrecord');
Route::get('/deleterecord{id}', [WorkRecordController::class, 'DeleteRecord'])->name('deleterecord');
Route::get('/filterwork', [WorkRecordController::class, 'FilterWork'])->name('filterwork');


Route::get('/report', [ReportController::class, 'ViewReport'])->name('report');
Route::get('/filterreport', [ReportController::class, 'FilterReport'])->name('filterreport');
