<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

 
//department
Route::apiResource('/departments','DepartmentController');
Route::put('/departments','DepartmentController@update');
Route::delete('/departments/forcedelete/{id}','DepartmentController@forceDelete');

//Position
Route::apiResource('/positions','PositionController');

//employee
Route::apiResource('/employees','EmployeeController');

//DepartmentPosition
Route::apiResource('/department_positions','DepartmentPositionController');







