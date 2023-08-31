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

Route::post("/login",[UserController::class,"login"]);

Route::get("/current-user",[UserController::class,"currentUser"])->middleware('auth:api');



Route::middleware(['verify.role:root,admin','auth:api'])->group(function (){

    Route::get("/role",[RoleController::class,"findAll"])
        ->middleware("verify.access:role_read");

    Route::post("/role/add",[RoleController::class,"add"])
        ->middleware("verify.access:role_add");

    Route::put("/role/update",[RoleController::class,"update"])
        ->middleware("verify.access:role_update");

    Route::delete("/role/delete",[RoleController::class,"delete"])
        ->middleware("verify.access:role_delete");


    Route::get("/access",[AccessControlController::class,"findAll"])
        ->middleware("verify.access:access_read");

    Route::post("/access/add",[AccessControlController::class,"add"])
        ->middleware("verify.access:access_add");

    Route::put("/access/update",[AccessControlController::class,"update"])
        ->middleware("verify.access:access_update");

    Route::delete("/access/delete",[AccessControlController::class,"delete"])
        ->middleware("verify.access:access_delete");

    Route::post("/user-access/assign",[UserAccessControlController::class,"assign"]);
        //->middleware("verify.access:user_access_add");

    Route::delete("/user-access/unassign",[UserAccessControlController::class,"unassign"]);
       // ->middleware("verify.access:user_access_delete");
});

Route::middleware(['verify.role:root,user','auth:api'])->group(function (){
   // add company, service,article, etc routes here
});

