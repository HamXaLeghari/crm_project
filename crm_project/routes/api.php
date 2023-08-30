<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\Com_SerController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


Route::get('/services', [ServiceController::class, 'findAllServices']);

Route::post('/service/add', [ServiceController::class, 'add']);

Route::post('/service/update/{id}', [ServiceController::class, 'update']);

Route::post('/service/delete/{id}', [ServiceController::class, 'delete']);




Route::get('/communities', [CommunityController::class, 'findAllCommunities']);

Route::post('/community/add', [CommunityController::class, 'add']);

Route::post('/community/update/{id}', [CommunityController::class, 'update']);

Route::post('/community/delete/{id}', [CommunityController::class, 'delete']);




Route::get('/blogs', [BlogController::class, 'findBlogs']);

Route::post('/blog/add', [BlogController::class, 'add']);

Route::post('/blog/update/{id}', [BlogController::class, 'update']);

Route::post('/blog/delete/{id}', [BlogController::class, 'delete']);


Route::post('/addCom/{id}', [Com_SerController::class, 'addCommunityToService']);
