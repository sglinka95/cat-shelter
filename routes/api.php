<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FilterController;
use App\Http\Controllers\CatController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('breed', [FilterController::class, 'getCatBreed']);
Route::get('sex', [FilterController::class, 'getSex']);
Route::get('position', [FilterController::class, 'getPosition']);

Route::resource('cats', CatController::class);
Route::resource('departments', DepartmentController::class);
Route::resource('employees', EmployeeController::class);
