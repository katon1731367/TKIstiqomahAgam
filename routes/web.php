<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\DashboardNewsController;

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

Route::group(['middleware' => 'prevent-back-history'], function () {
   //Auth Route
   Route::get('/home', [AuthController::class, 'home'])->middleware('auth');
   Route::post('/login', [AuthController::class, 'authenticate']);
   Route::get('/login', [AuthController::class, 'index'])->middleware('guest')->name('login');
   Route::post('/logout', [AuthController::class, 'logout']);

   Route::get('/', function () {
      return view('pages.home', [
         "title" => "Beranda"
      ]);
   });

   //NewsPages
   Route::get('/news', [NewsController::class, 'index']);
   Route::get('/news/{news:slug}', [NewsController::class, 'show']);

   //NewsCategories
   Route::get('/categories', [CategoryNewsController::class, 'index']);
   Route::get('/categories/{categorynews:slug}', [CategoryNewsController::class, 'show']);

   Route::group(['middleware' => 'is_admin'], function () {
      //Dashboard Route
      Route::get('/dashboard', [DashboardController::class, 'index']);

      //Users Route
      Route::resource('/dashboard/users', UserController::class);
      Route::get('/dashboard/fetchuser', [UserController::class, 'fetchUser']);
      Route::get('/dashboard/getuserdata', [UserController::class, 'getUserData'])->name('getUserData');
      Route::post('/dashboard/users/{user:username}/storePassword', [UserController::class, 'storePassword']);
      Route::get('/dashboard/export-users', [UserController::class, 'exportIntoExcel']);

      //News Route
      Route::resource('/dashboard/news', DashboardNewsController::class);
      Route::get('/dashboard/fetchnews', [DashboardNewsController::class, 'fetchNews']);
      Route::get('/dashboard/newscheckslug', [DashboardNewsController::class, 'checkSlug']);
      Route::delete('/dashboard/news/destroyByAjax/{news:slug}', [DashboardNewsController::class, 'destroyByAjax']);
   });
});
