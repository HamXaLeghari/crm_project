<?php

use App\Http\Controllers\AccessControlController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserAccessControlController;
use App\Http\Controllers\UserController;
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

/*Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});*/

Route::post("/signup",[UserController::class,"signup"]);

Route::get("/role",[RoleController::class,"findAll"]);
Route::post("/role/add",[RoleController::class,"add"]);
Route::put("/role/update",[RoleController::class,"update"]);
Route::delete("/role/delete",[RoleController::class,"delete"]);


Route::get("/access",[AccessControlController::class,"findAll"]);
Route::post("/access/add",[AccessControlController::class,"add"]);
Route::put("/access/update",[AccessControlController::class,"update"]);
Route::delete("/access/delete",[AccessControlController::class,"delete"]);


Route::get("/user-access/assign",[UserAccessControlController::class,"assign"]);
Route::post("/user-access/unassign",[UserAccessControlController::class,"unassign"]);

