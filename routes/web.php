<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryNewsController;
use App\Http\Controllers\DashboardNewsController;
use App\Http\Controllers\DashboardSchoolProfileController;
use App\Http\Controllers\DashboardTeacherController;
use App\Http\Controllers\DashboardContactMessageController;
use App\Http\Controllers\UserSideController;

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
   Route::get('/', [UserSideController::class, 'home']);
   
   Route::get('/visimisi', [UserSideController::class, 'visimisi']);
   Route::get('/struktur', [UserSideController::class, 'struktur']);
   Route::get('/pengajar', [UserSideController::class, 'pengajar']);
   Route::get('/fasilitas', [UserSideController::class, 'fasilitas']);
   Route::get('/ekstrakulikuler', [UserSideController::class, 'ekstrakulikuler']);
   
   Route::get('/program', [UserSideController::class, 'program']);
   Route::get('/berita', [UserSideController::class, 'berita']);
   Route::get('/berita/{string:slug}', [UserSideController::class, 'detailBerita']);
   Route::get('/pengajar/{string:id}', [UserSideController::class, 'detailPengajar']);

   Route::get('/prestasi-sekolah', [UserSideController::class, 'prestasiSekolah']);
   Route::get('/prestasi-kepala-sekolah', [UserSideController::class, 'prestasiKepalaSekolah']);
   Route::get('/prestasi-guru', [UserSideController::class, 'prestasiGuru']);

   //Auth Route
   Route::get('/home', [AuthController::class, 'home'])->middleware('auth');
   Route::post('/login', [AuthController::class, 'authenticate']);
   Route::get('/login', [AuthController::class, 'index'])->middleware('guest')->name('login');
   Route::post('/logout', [AuthController::class, 'logout']);

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
      Route::get('/dashboard/fetchusers', [UserController::class, 'fetchUsers']);
      Route::get('/dashboard/getuserdata', [UserController::class, 'getUserData'])->name('getUserData');
      Route::post('/dashboard/users/{user:username}/storePassword', [UserController::class, 'storePassword']);
      Route::get('/dashboard/export-users', [UserController::class, 'exportIntoExcel']);

      //News Route
      Route::resource('/dashboard/news', DashboardNewsController::class);
      Route::get('/dashboard/fetchnews', [DashboardNewsController::class, 'fetchNews']);
      Route::get('/dashboard/newscheckslug', [DashboardNewsController::class, 'checkSlug']);
      Route::delete('/dashboard/news/destroybyajax/{news:slug}', [DashboardNewsController::class, 'destroyByAjax']);

      Route::get('/dashboard/achievement', [DashboardNewsController::class, 'achievementIndex']);
      Route::get('/dashboard/facility', [DashboardNewsController::class, 'facilityIndex']);
      Route::get('/dashboard/extracurricular', [DashboardNewsController::class, 'extracurricularIndex']);
      Route::get('/dashboard/featuredprogram', [DashboardNewsController::class, 'featuredProgramIndex']);
      
      // Route School Profile
      Route::resource('/dashboard/schoolprofile', DashboardSchoolProfileController::class);

      // Route School Profile
      Route::resource('/dashboard/contactmessage', DashboardContactMessageController::class);
      Route::get('/dashboard/fetchmessage', [DashboardContactMessageController::class, 'fetchMessage']);
      Route::delete('/dashboard/contactmessage/destroybyajax/{contactmessage:id}', [DashboardContactMessageController::class, 'destroyByAjax']);
      
      // Route Teacher
      Route::resource('/dashboard/teachers', DashboardTeacherController::class);
      Route::get('/dashboard/fetchteachers', [DashboardTeacherController::class, 'fetchTeachers']);
      Route::delete('/dashboard/teachers/destroybyajax/{teacher:id}', [DashboardTeacherController::class, 'destroyByAjax']);
   });
});
