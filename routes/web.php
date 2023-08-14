<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\StateController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PurchasecategoryController;
use App\Http\Controllers\PurchaseController;

use App\Http\Controllers\PDFController;
use App\Http\Controllers\UserroleController;
use App\Http\Controllers\ProfileController;


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
   return view('/auth/login');
   //return view('login',LoginController::class);
   
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/userroles', [UserroleController::class, 'index']);



Route::resource('users', UserController::class);
Route::resource('companies', CompanyController::class);
Route::resource('locations', LocationController::class);
Route::resource('states', StateController::class);
Route::resource('projects', ProjectController::class);
Route::resource('purchasecategories', PurchasecategoryController::class);
Route::resource('purchases', PurchaseController::class);

Route::post('/roleconnect/update', [RoleConnectController::class, 'update'])->name('roleconnect.update');


Route::get('/userroles', [UserroleController::class, 'index'])->name('userroles.index');
Route::post('/userroles/update', [UserroleController::class, 'updateRoleConnect'])->name('userroles.updateRoleConnect');

Route::any('purchases/search', [PurchaseController::class, 'search'])->name('purchases.search');

Route::get('/generate-pdf', [PDFController::class, 'generatePdf'])->name('purchases.pdf');

// routes/web.php



// Route to display the profile editing form
Route::get('/users/profile', [ProfileController::class, 'editProfile'])->name('profile.edit');

// Route to handle the form submission and update the user's profile data
Route::post('/users/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
