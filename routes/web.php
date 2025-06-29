<?php

/*use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;               //contrôleur public
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\PurchaseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
*/

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




/*


// Public catalog and detail
Route::get('/',                [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}',      [CarController::class, 'show'])->name('cars.show');


// Auth routes
//Auth::routes(['reset' => true, 'verify' => true, 'login' => true, 'register' => true, 'confirm' => false]);



// Login / Logout
Route::get('login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout',[LoginController::class, 'logout'])->name('logout');

// Registration
Route::get('register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password reset
Route::get('password/reset',       [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email',      [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}',[ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',      [ResetPasswordController::class,'reset'])->name('password.update');



// car catalog

Route::get('/', function(){
    if (auth()->check() && auth()->user()->is_admin) {
        return redirect()->route('admin.cars.index');
    }
    return app(\App\Http\Controllers\CarController::class)->index();
})->name('cars.index');





// Espace Admin
Route::group([
    'prefix'     => 'admin',
    'middleware' => ['auth','admin'],
    'as'         => 'admin.',
    'namespace'  => 'Admin',
], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');




// Confirmation page
	Route::get('cars/{car}/delete', 'CarController@delete')
     	->name('cars.delete');
    Route::resource('cars', 'CarController');
});





// Espace Utilisateur
   Route::middleware('auth')
     ->name('user.')
     ->group(function(){
         Route::resource('bookings',  BookingController::class);
         Route::resource('purchases', PurchaseController::class);
     });



*/






















use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CarController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\PurchaseController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;

/*
|--------------------------------------------------------------------------
| Public car catalog
|--------------------------------------------------------------------------
*/
Route::get('/',               [CarController::class,'index'])->name('cars.index');
Route::get('/cars/{car}',     [CarController::class,'show'])->name('cars.show');

/*
|--------------------------------------------------------------------------
| Authentication
|--------------------------------------------------------------------------
*/
// Login / Logout
Route::get('login',  [LoginController::class, 'showLoginForm'])->name('login');
Route::post('login', [LoginController::class, 'login']);
Route::post('logout',[LoginController::class, 'logout'])->name('logout');

// Registration
Route::get('register',  [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [RegisterController::class, 'register']);

// Password Reset
Route::get('password/reset',          [ForgotPasswordController::class,'showLinkRequestForm'])->name('password.request');
Route::post('password/email',         [ForgotPasswordController::class,'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}',  [ResetPasswordController::class,'showResetForm'])->name('password.reset');
Route::post('password/reset',         [ResetPasswordController::class,'reset'])->name('password.update');

// Home redirect (post‑login/page refresh)
Route::get('/home', function(){
    return redirect()->route('cars.index');
})->name('home');


/*
|--------------------------------------------------------------------------
| Admin area (full CRUD)
|--------------------------------------------------------------------------
*/
Route::prefix('admin')
     ->middleware(['auth','admin'])
     ->name('admin.')
     ->group(function(){
         // Dashboard
         Route::get('dashboard', [DashboardController::class,'index'])->name('dashboard');
         // Delete confirmation
         Route::get('cars/{car}/delete', [AdminCarController::class,'delete'])->name('cars.delete');
         // Full resource
         Route::resource('cars', AdminCarController::class);
     });

/*
|--------------------------------------------------------------------------
| User area (Bookings & Purchases)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')
     ->namespace('App\Http\Controllers\User')
     ->name('user.')
     ->group(function(){
         Route::resource('bookings','BookingController');
	 Route::resource('purchases','PurchaseController');
     });




























