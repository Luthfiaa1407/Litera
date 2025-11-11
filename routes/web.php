<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BorrowController;

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

Route::get('/', function () {
    return view('welcome');
});

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth')->get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
    
    // Admin Borrow Management
    Route::prefix('borrows')->name('borrows')->group(function () {
        Route::get('/pending', [BorrowController::class, 'pendingRequests'])->name('pending');
        Route::post('/{borrow}/approve', [BorrowController::class, 'approve'])->name('approve');
        Route::post('/{borrow}/reject', [BorrowController::class, 'reject'])->name('reject');
        Route::post('/{borrow}/confirm-borrow', [BorrowController::class, 'confirmBorrow'])->name('confirm-borrow');
        Route::post('/{borrow}/confirm-return', [BorrowController::class, 'confirmReturn'])->name('confirm-return');
    });
    
    // User Management
    Route::prefix('users')->name('user.')->group(function () {
        Route::get('/', [AuthController::class, 'adminUsersIndex'])->name('index');
        Route::get('/create', [AuthController::class, 'adminUsersCreate'])->name('create');
        Route::post('/store', [AuthController::class, 'adminUsersStore'])->name('store');
        Route::get('/{user}/edit', [AuthController::class, 'adminUsersEdit'])->name('edit');
        Route::put('/{user}/update', [AuthController::class, 'adminUsersUpdate'])->name('update');
        Route::delete('/{user}/delete', [AuthController::class, 'adminUsersDestroy'])->name('destroy');
    });
});

// User Routes
Route::middleware('auth')->group(function () {
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    
    // User Borrow Routes
    Route::prefix('user/borrows')->name('user.borrows.')->group(function () {
        Route::get('/', [BorrowController::class, 'index'])->name('index');
        Route::get('/create', [BorrowController::class, 'create'])->name('create');
        Route::post('/', [BorrowController::class, 'store'])->name('store');
    });
});