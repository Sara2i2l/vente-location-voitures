<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\CarController;               //contrôleur public
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CarController as AdminCarController;
use App\Http\Controllers\User\BookingController;
use App\Http\Controllers\User\PurchaseController;


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
// Authentification
Auth::routes();


// Routes publiques (logue)
Route::get('/', [CarController::class, 'index'])->name('cars.catalog');
Route::get('/cars/{car}', [CarController::class, 'show'])->name('cars.view');

Route::get('/home', [HomeController::class, 'index'])->name('home');
*/

Route::get('/',                [CarController::class, 'index'])->name('cars.index');
Route::get('/cars/{car}',      [CarController::class, 'show'])->name('cars.show');



Auth::routes(['reset' => true, 'verify' => true, 'login' => true, 'register' => true, 'confirm' => false]);

// Redirect any /home hits to our public catalog
Route::get('/home', function () {
    return redirect()->route('cars.index');
})->name('home');




// Espace Admin
Route::group([
    'prefix'     => 'admin',
    'middleware' => ['auth','admin'],
    'as'         => 'admin.',
    'namespace'  => 'Admin',
], function(){
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::resource('cars', 'CarController');
});

/*
// Espace Utilisateur
Route::group([
    'middleware' => 'auth',
    'as'         => 'user.',
    'namespace'  => 'User',
], function(){
    Route::resource('bookings','BookingController');
    Route::resource('purchases','PurchaseController');
});

*/

















