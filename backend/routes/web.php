<?php
use Illuminate\Support\Facades\Mail;
use App\Mail\WelcomeMail;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\{
    ProfileController,
    MailSettingController,
    CompanyController,
    CategoryController,
    ItemController,
    
    HistoryMarketprices,
    RevenueController
};


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/test-email/{email}', function ($email) {
    $user = User::where('email', $email)->first();

    if ($user) {
        try {
            Mail::to($email)->send(new WelcomeMail($user));
            return 'Test email sent to ' . $email;
        } catch (\Exception $e) {
            return 'Failed to send email: ' . $e->getMessage();
        }
    } else {
        return 'User not found';
    }
});


Route::get('/dashboard', function () {
    return view('front.dashboard');
})->middleware(['front'])->name('dashboard');


require __DIR__.'/front_auth.php';

// Admin routes
Route::get('/admin/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('admin.dashboard');

require __DIR__.'/auth.php';




Route::namespace('App\Http\Controllers\Admin')->name('admin.')->prefix('admin')
    ->group(function(){
        Route::resource('roles','RoleController');
        Route::resource('permissions','PermissionController');
        Route::resource('users','UserController');
        Route::resource('posts','PostController');
        Route::resource('posts','PostController');
        Route::resource('revenues','RevenueController');
        Route::resource('categories',CategoryController::class);
        Route::resource('companies', CompanyController::class);
        Route::resource('items',ItemController::class);
        Route::resource('history',HistoryMarketprices::class);

 

        Route::get('/profile',[ProfileController::class,'index'])->name('profile');
        Route::put('/profile-update',[ProfileController::class,'update'])->name('profile.update');
        Route::get('/mail',[MailSettingController::class,'index'])->name('mail.index');
        Route::put('/mail-update/{mailsetting}',[MailSettingController::class,'update'])->name('mail.update');


        
        
});


