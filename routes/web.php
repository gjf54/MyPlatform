<?php

use App\Http\Controllers\MainLayoutController;
use App\Http\Controllers\CatalogController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\EditProfileController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::post('/checkAuth', [MainLayoutController::class, 'check'])->name('checkAuth');

Route::get('/', [HomeController::class, 'load'])->name('home');

Route::get('/catalog', [CatalogController::class, 'display_categories'])->name('catalog');

Route::group(['middleware' => 'guest:web'], function ($router) {
    Route::get('/register', function() {
        return view('auth.register');
    })->name('register');
    Route::post('/register', [AuthController::class, 'register']);

    Route::get('/login', function() {
        return view('auth.login');
    })->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::group(['middleware' => 'auth'], function ($router) {
    Route::get('/profile', [AuthController::class, 'profile'])->name('profile');
    Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    
    Route::group(['prefix' => 'profile'], function ($router) {
        
        Route::get('/edit/data', function () {
            return view('edit_profile.data', ['user' => auth()->user(),]);    
        })->name('edit_data');
        
        Route::get('/edit/password', function () {
            return view('edit_profile.password');
        })->name('edit_password');
        
        Route::get('/edit/email', function () {
            return view('edit_profile.email', ['user' => auth()->user(),]);    
        })->name('edit_email');

        Route::post('edit/data', [EditProfileController::class, 'fresh_data'])->name('fresh_profile_data');
        Route::post('edit/password', [EditProfileController::class, 'fresh_password'])->name('fresh_profile_password');
        Route::post('edit/email', [EditProfileController::class, 'fresh_email'])->name('fresh_profile_email');
    });
});

Route::group(['middleware' => 'auth', 'prefix' => 'dashboard',], function () {
    Route::get('/', [DashboardController::class, 'generate_home_page'])->name('dashboard');
    
    // Links to contorll posts. Min. access role: writer.

    Route::group(['middleware' => 'role:admin|manager|super_admin|writer', 'prefix' => 'writers_posts',], function () {
        Route::get('/', [DashboardController::class, 'generate_writer_page'])->name('dashboard_writers_posts');
        Route::get('/post/{id}/edit', [DashboardController::class, 'generate_edit_form_of_post'])->name('dashboard_edit_post');
        Route::post('/post/{id}/edit', [DashboardController::class, 'edit_writers_post'])->name('dashboard_send_edit_post');
        Route::get('/post/{id}/delete', [DashboardController::class, 'delete_writers_post'])->name('dashboard_delete_post');
        Route::get('/create', [DashboardController::class, 'generate_create_form_of_post'])->name('dashboard_create_post');
        Route::post('/create', [DashboardController::class, 'add_writers_post'])->name('dashboard_send_created_post');
        Route::post('/post/{id}/get_creator', [DashboardController::class, 'get_creator_of_post'])->name('dashboard_get_post_creator');
    });
    
    Route::group(['middleware' => 'role:admin|super_admin', 'prefix' => 'users'], function () {
        Route::get('/', [DashboardController::class, 'generate_users_page'])->name('dashboard_users');
    });
});



