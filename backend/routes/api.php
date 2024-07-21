<?php

use App\Http\Controllers\Api\FavoriteController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\NotificationConControlller;
use App\Http\Controllers\API\OptionPaidController;
use App\Http\Controllers\Api\PaymentController;
use App\Models\OptionPaid;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\LikeController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\CompaniesListController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\HistoryMarketPriceController;
// use App\Http\Controllers\Admin\DashboardController;


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

// Route::get('/admin/dashboard', [DashboardController::class, 'getData']);


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Public routes
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/check-email', [AuthController::class, 'checkEmailUnique']);

//list all company
Route::get('/company', [AuthController::class, 'getCompany']);

//list all post
Route::get('/post/list', [PostController::class, 'index']);
Route::get('/post/sell', [PostController::class, 'sell']);

//show each post of user====
Route::get('/post/each/user/{id}', [PostController::class, 'show_one_post']);

//update statusof post
Route::post('/post/update/status/{id}', [PostController::class, 'update_status']);

//get company nearbyme
Route::post('/company/near', [AuthController::class,'getNearbyCompanies']);


//update notification status
Route::get('/notification/status/{id}',[NotificationConControlller::class,'markAsSeen']);

//list all payment
Route::get('/payment/list', [PaymentController::class, 'index']);

//list all option
Route::get('/option/list', [OptionPaidController::class, 'index']);
Route::post('/forgotPassword', [AuthController::class, 'forgotPassword']);
Route::post('/resetPassword', [AuthController::class, 'resetPassword']);

// Routes that require authentication
Route::middleware('auth:sanctum')->group(function () {
    // User profile routes
    Route::get('/me', [AuthController::class, 'index']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/updateProfile', [AuthController::class, 'uploadProfile']);

  


    // Post routes
    Route::prefix('post')->group(function () {
        Route::get('/show/user', [PostController::class, 'show_post']);
        Route::post('/create/user', [PostController::class, 'store']);
        Route::post('/update/user/{id}', [PostController::class, 'edit']);
        Route::delete('/delete/user/{id}', [PostController::class, 'destroy']);
        Route::get('/to_company', [PostController::class, 'post_add_to_company']);
        Route::get('/company/buy', [PostController::class, 'post_buy']);
        //update statusof post
        Route::post('/update/status/{id}', [PostController::class, 'update_status']);

        // get all posts
        Route::get('/company/history', [PostController::class, 'historyPost']);
    });

    // Comment routes
    Route::prefix('comment')->group(function () {
        Route::post('/create', [CommentController::class, 'store']);
        Route::put('/update/{id}', [CommentController::class, 'update']);
        Route::delete('/destroy/{id}', [CommentController::class, 'destroy']);
        Route::post('/user/like', [LikeController::class, 'user_like']);
    });

    // Chat routes
    Route::prefix('chat')->group(function () {
        Route::post('/send/message', [ChatController::class, 'store']);
        Route::delete('/delete/message/{id}', [ChatController::class, 'destroy']);
        Route::get('/get/message/{receiverId}', [ChatController::class, 'getConversation']);
        Route::post('/update/message/{id}', [ChatController::class, 'updateMessage']);
    });

    Route::prefix('fav')->group(function () {
        Route::get('/list', [FavoriteController::class, 'index']);
        Route::post('/create', [FavoriteController::class, 'store']);
        Route::delete('/delete/{id}', [FavoriteController::class, 'destroy']);

    });

    //payment
    Route::prefix('payment')->group(function () {
        Route::post('/create', [PaymentController::class, 'store']);
    });

    //notification
    Route::prefix('notification')->group(function () {
        Route::get('/company/list',[NotificationConControlller::class,'company_notifications']);
        Route::get('/user/list',[NotificationConControlller::class,'user_notification']);
        Route::get('/user/list/alert',[NotificationConControlller::class,'user_notification_alert']);
        Route::get('/company/list/alert',[NotificationConControlller::class,'company_notification_alert']);
    });

});




// Category routes
Route::prefix('category')->group(function () {
    Route::post('/create', [CategoryController::class, 'store']);
    Route::get('/list', [CategoryController::class, 'index']);
    Route::get('/show/{id}', [CategoryController::class, 'show']);
    Route::delete('/delete/{id}', [CategoryController::class, 'destroy']);
    Route::post('/update/{id}', [CategoryController::class, 'update']);
});

// Item routes
Route::prefix('item')->group(function () {
    Route::post('/create', [ItemController::class, 'store']);
    Route::get('/list', [ItemController::class, 'index']);
    Route::delete('/delete/{id}', [ItemController::class, 'destroy']);
    Route::get('/show/{id}', [ItemController::class, 'show']);
    Route::post('/update/{id}', [ItemController::class, 'update']);
    Route::get('/relate/{id}', [ItemController::class, 'getRelatedProducts']);
});

// History Market Price routes
Route::prefix('history')->group(function () {
    Route::get('/list', [HistoryMarketPriceController::class, 'index']);
    Route::delete('/delete/{id}', [HistoryMarketPriceController::class, 'destroy']);
});


//update image
Route::post('/images/update/{id}', [ImageController::class, 'update'])->name('images.update');

//add image to post
Route::post('posts/{id}/add-image', [PostController::class, 'add_image_post']);
