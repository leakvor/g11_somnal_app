<?php

use App\Http\Controllers\Api\AdjayController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\MaketPriceofAdjayController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use App\Models\MarketofAdjay;
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
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/updateProfilePicture', [AuthController::class, 'uploadProfile'])->middleware('auth:sanctum');

Route::get('/post/list', [PostController::class, 'index'])->middleware('auth:sanctum');
Route::get('show/user/post', [PostController::class, 'show_post'])->middleware('auth:sanctum');
Route::post('create/user/post', [PostController::class, 'store'])->middleware('auth:sanctum');
Route::post('update/user/post/{id}', [PostController::class, 'update'])->middleware('auth:sanctum');


Route::post('/comment/create', [CommentController::class, 'store'])->middleware('auth:sanctum');
Route::put('/comment/update/{id}', [CommentController::class, 'update'])->middleware('auth:sanctum');
Route::delete('/comment/destory/{id}', [CommentController::class, 'destroy'])->middleware('auth:sanctum');


Route::post('/comment/user/like', [LikeController::class, 'user_like'])->middleware('auth:sanctum');


//send message
Route::post('/chat/send/message', [ChatController::class, 'store'])->middleware('auth:sanctum');
Route::delete('/chat/delete/message/{id}', [ChatController::class, 'destroy'])->middleware('auth:sanctum');
Route::get('/chat/get/message/{receiverId}', [ChatController::class, 'getConversation'])->middleware('auth:sanctum');
Route::post('/chat/update/message/{id}', [ChatController::class, 'updateMessage'])->middleware('auth:sanctum');


//Category
Route::post('/category/create', [CategoryController::class, 'store']);
Route::get('/category/list', [CategoryController::class, 'index']);
Route::get('/category/show/{id}', [CategoryController::class, 'show']);
Route::delete('/category/delete/{id}', [CategoryController::class, 'destroy']);
Route::post('/category/update/{id}', [CategoryController::class, 'update']);


//Item
Route::post('/item/create', [ItemController::class, 'store']);
Route::get('/item/list', [ItemController::class, 'index']);
Route::delete('/item/delete/{id}', [ItemController::class, 'destroy']);
Route::get('/item/show/{id}', [ItemController::class, 'show']);
Route::post('/item/update/{id}', [ItemController::class, 'update']);


Route::post('/imgupload', [ImageController::class, 'imageUpload']);