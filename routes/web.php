<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyOtpController;
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

Route::get('/', function () {
    return view('auth.login');
});

// Auth Routes
Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/verify-otp', [VerifyOtpController::class, 'showVerifyForm'])->name('verify.otp.form');
Route::post('/verify-otp', [VerifyOtpController::class, 'verify'])->name('verify.otp');
Route::post('/verify-otp/resend', [VerifyOtpController::class, 'resend'])->name('verify.otp.resend');


Route::middleware('auth')->get('/logout', [AuthController::class, 'logout'])->name('logout');

// Admin Routes
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // Borrow Management
    Route::prefix('borrows')->name('borrows.')->group(function () {
        Route::get('/pending', [BorrowController::class, 'pendingRequests'])->name('pending');
        Route::post('/{borrow}/approve', [BorrowController::class, 'approve'])->name('approve');
        Route::post('/{borrow}/reject', [BorrowController::class, 'reject'])->name('reject');
        Route::post('/{borrow}/confirm-borrow', [BorrowController::class, 'confirmBorrow'])->name('confirm-borrow');
        Route::post('/{borrow}/confirm-return', [BorrowController::class, 'confirmReturn'])->name('confirm-return');
    });

    // Admin User Management
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AuthController::class, 'adminUsersIndex'])->name('index');
        Route::get('/create', [AuthController::class, 'adminUsersCreate'])->name('create');
        Route::post('/store', [AuthController::class, 'adminUsersStore'])->name('store');
        Route::get('/{user}/edit', [AuthController::class, 'adminUsersEdit'])->name('edit');
        Route::put('/{user}/update', [AuthController::class, 'adminUsersUpdate'])->name('update');
        Route::delete('/{user}/delete', [AuthController::class, 'adminUsersDestroy'])->name('destroy');
    });

    Route::prefix('books')->name('books.')->group(function () {
        Route::get('/', [BookController::class, 'index'])->name('index');
        Route::get('/create', [BookController::class, 'create'])->name('create');
        Route::post('/', [BookController::class, 'store'])->name('store');
        Route::get('/{book}/edit', [BookController::class, 'edit'])->name('edit');
        Route::put('/{book}/update', [BookController::class, 'update'])->name('update');
        Route::delete('/{book}/delete', [BookController::class, 'destroy'])->name('destroy');
        Route::get('/{book}', [BookController::class, 'show'])->name('show');
    });

    Route::prefix('categories')->name('categories.')->group(function () {
        Route::get('/', [CategoryController::class, 'index'])->name('index');
        Route::get('/create', [CategoryController::class, 'create'])->name('create');
        Route::post('/', [CategoryController::class, 'store'])->name('store');
        Route::get('/{category}/edit', [CategoryController::class, 'edit'])->name('edit');
        Route::put('/{category}/update', [CategoryController::class, 'update'])->name('update');
        Route::delete('/{category}/delete', [CategoryController::class, 'destroy'])->name('destroy');
    });
});

// User Routes
Route::middleware(['auth', 'verified.email'])->group(function () {

    // User Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Public/User book listing and detail
    Route::get('/books', [BookController::class, 'userBooks'])->name('user.books');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('user.books.show');

    // User categories (list + books by category)
    Route::get('/categories', [\App\Http\Controllers\CategoryController::class, 'index'])->name('user.categories.index');
    Route::get('/categories/{category}', [\App\Http\Controllers\CategoryController::class, 'show'])->name('user.categories.show');

    // User Borrowing
    Route::prefix('user/borrows')->name('user.borrows.')->group(function () {
        Route::get('/', [BorrowController::class, 'index'])->name('index');
        Route::get('/create', [BorrowController::class, 'create'])->name('create');
        Route::post('/', [BorrowController::class, 'store'])->name('store');
    });

    Route::prefix('user/profile')->name('user.profile.')->group(function () {
        Route::get('/', [UserController::class, 'showProfile'])->name('index');
        Route::get('/edit', [UserController::class, 'editProfile'])->name('edit');
        Route::put('/update', [UserController::class, 'updateProfile'])->name('update');
        Route::put('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
    });
});
