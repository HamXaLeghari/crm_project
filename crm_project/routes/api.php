<?php

use App\Http\Controllers\AccessControlController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Com_SerController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\UserAccessControlController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CommunityMembersController;
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



Route::middleware(['verify.role:root,admin','auth:api'])->group(function (){

    Route::get("/current-user",[UserController::class,"currentUser"]);

    Route::get("/users",[UserController::class,"findAll"]);

    Route::post("/users/id",[UserController::class,"findById"]);

    Route::post("/user/update",[UserController::class,"updateUser"]);

    Route::post("/user/add",[UserController::class,"addUser"]);

    Route::delete("/user/delete",[UserController::class,"deleteUser"]);

    Route::get("/logout",[UserController::class,"logout"]);

    Route::get("/role",[RoleController::class,"findAll"]);

    Route::post("/role/name",[RoleController::class,"findByName"]);

    Route::post("/role/id",[RoleController::class,"findById"]);
        //->middleware("verify.access:role_read");

    Route::post("/role/add",[RoleController::class,"add"]);
        //->middleware("verify.access:role_add");

    Route::put("/role/update",[RoleController::class,"update"]);
       // ->middleware("verify.access:role_update");

    Route::delete("/role/delete",[RoleController::class,"delete"]);
        //->middleware("verify.access:role_delete");

    Route::get("/access",[AccessControlController::class,"findAll"]);
        //->middleware("verify.access:access_read");

    Route::post("/access/add",[AccessControlController::class,"add"]);
       // ->middleware("verify.access:access_add");

    Route::put("/access/update",[AccessControlController::class,"update"]);
        //->middleware("verify.access:access_update");

    Route::delete("/access/delete",[AccessControlController::class,"delete"]);
       // ->middleware("verify.access:access_delete");


    Route::post("/user-access/assign",[UserAccessControlController::class,"assign"]);
        //->middleware("verify.access:user_access_add");

    Route::delete("/user-access/unassign",[UserAccessControlController::class,"unassign"]);
       // ->middleware("verify.access:user_access_delete");

    Route::post("/user-access/user/id",[UserAccessControlController::class,"findByUserId"]);

    Route::get("/user-access",[UserAccessControlController::class,"findAll"]);
      //  ->middleware("verify.access:user_access_read");

    Route::get("/user-access/user",[UserAccessControlController::class,"findByCurrentUser"]);
       // ->middleware("verify.access:user_access_read");




    Route::get('/services', [ServiceController::class, 'findAllServices']);

    Route::post('/service/add', [ServiceController::class, 'add']);

    Route::post('/service/update/{id}', [ServiceController::class, 'update']);

    Route::post('/service/delete/{id}', [ServiceController::class, 'delete']);


    Route::get('/communities', [CommunityController::class, 'findAllCommunities']);

    Route::post('/community/add', [CommunityController::class, 'add']);

    Route::post('/community/update/{id}', [CommunityController::class, 'update']);

    Route::post('/community/delete/{id}', [CommunityController::class, 'delete']);

    Route::get('/blogs', [BlogController::class, 'findBlogs']);

    Route::post('/blog/add/{id}', [BlogController::class, 'add']);

    Route::post('/blog/update/{id}', [BlogController::class, 'update']);

    Route::post('/blog/delete/{id}', [BlogController::class, 'delete']);

    Route::post('/showbycategory/{id}', [BlogController::class, 'showbyCategory']);


    Route::post('/addCom/{id}', [Com_SerController::class, 'addCommunityToService']);

    Route::get('/categories', [CategoryController::class, 'findAllCategories']);

    Route::post('/category/add', [CategoryController::class, 'add']);

    Route::post('/category/update/{id}', [CategoryController::class, 'update']);

    Route::post('/category/delete/{id}', [CategoryController::class, 'delete']);



    Route::get('/show/members', [CommunityMembersController::class, 'findAllMembers']);

    Route::post('/add/member/community', [CommunityMembersController::class, 'add']);

    Route::post('/member/update/{id}', [CommunityMembersController::class, 'update']);

    Route::post('/member/delete/{id}', [CommunityMembersController::class, 'delete']);





});
