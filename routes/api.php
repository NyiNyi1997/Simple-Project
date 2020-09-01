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
Route::put('/departments','DepartmentController@update');//Department update
Route::delete('/departments/forcedelete/{id}','DepartmentController@forceDelete');// department force delete

//Position
Route::apiResource('/positions','PositionController');
Route::delete('/positions/forcedelete/{id}','PositionController@forceDelete');// position force delete

//employee
Route::apiResource('/employees','EmployeeController');
Route::delete('/employees/forcedelete/{id}','EmployeeController@forceDelete');// employee force delete
Route::post('/employees/search','EmployeeController@search');//  employees search

//EmployeeDepartmentPosition
Route::apiResource('/department_positions','DepartmentPositionController');

//File Export
Route::get('/employee-export','EmployeeController@fileExport');

//File Import
Route::post('/emplopyeeImport/{id}','EmployeeController@fileImport');









