<?php

use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\AuthController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/login', [AuthController::class, 'login']);
Route::get('/me', [AuthController::class, 'index'])->middleware('auth:sanctum');
Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');


//Comment===================
Route::get('/comment/list', [CommentController::class, 'index'])->middleware('auth:sanctum');
Route::post('/comment/create', [CommentController::class, 'createComment'])->middleware('auth:sanctum');