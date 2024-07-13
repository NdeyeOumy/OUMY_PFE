<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AuthController;
use App\Models\Vente;
use App\Http\Controllers\ProduitController; 
use App\Http\Controllers\ClientController; 
use App\Http\Controllers\VenteController; 
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Route::get('/', function () {
  //  return view('welcome');
//});
 // authentification

Route::get('/', [AuthController::class, 'loginForm'])->name('bo.login.form');
Route::get('/auth', [AuthController::class, 'loginForm'])->name('bo.auth');
Route::post('/login', [AuthController::class, 'loginAuth'])->name('bo.login.auth');
Route::get('/logout', [AuthController::class, 'logout'])->name('bo.logout');

//route protégée par middleware web
Route::group(['middleware' => 'auth'], function () {
  // Dashboard route tableu de bord
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('bo.dashboard');
  Route::resource('/produits', ProduitController::class)->middleware('auth');
  Route::resource('/clients', ClientController::class)->middleware('auth');
  Route::resource('/ventes', VenteController::class)->middleware('auth');
  Route::resource('user', UserController::class)->middleware('auth');
});


