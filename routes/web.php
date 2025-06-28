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

















