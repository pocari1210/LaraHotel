<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\UserController;

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

// Route::get('/', function () {
//   return view('welcome');
// });

// トップページのroute
Route::get('/', [UserController::class, 'Index']);

// UserDashboard疎通のroute
Route::get('/dashboard', function () {
  return view('frontend.dashboard.user_dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

  // UserProfileページ疎通のroute
  Route::get('/profile', [UserController::class, 'UserProfile'])
    ->name('user.profile');

  // UserProfileの更新処理のroute
  Route::post('/profile/store', [UserController::class, 'UserStore'])
    ->name('profile.store');

  // ログアウトのroute
  Route::get('/user/logout', [UserController::class, 'UserLogout'])
    ->name('user.logout');
});

require __DIR__ . '/auth.php';

// Admin権限のログインページ遷移のroute
Route::get('/admin/login', [AdminController::class, 'AdminLogin'])
  ->name('admin.login');

// Admin Group Middleware 
Route::middleware(['auth', 'roles:admin'])->group(function () {

  Route::get('/admin/dashboard', [AdminController::class, 'AdminDashboard'])
    ->name('admin.dashboard');

  // Admindashboardからのログアウトのroute
  Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])
    ->name('admin.logout');

  // adminのプロフィールページ遷移のroute
  Route::get('/admin/profile', [AdminController::class, 'AdminProfile'])
    ->name('admin.profile');

  // adminのプロフィール情報更新のroute
  Route::post('/admin/profile/store', [AdminController::class, 'AdminProfileStore'])
    ->name('admin.profile.store');

  // パスワード更新ページ遷移のroute
  Route::get('/admin/change/password', [AdminController::class, 'AdminChangePassword'])
    ->name('admin.change.password');

  // パスワード更新処理のroute    
  Route::post('/admin/password/update', [AdminController::class, 'AdminPasswordUpdate'])
    ->name('admin.password.update');
}); // End Admin Group Middleware 
