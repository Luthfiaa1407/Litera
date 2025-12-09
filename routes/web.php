<?php

use App\Http\Controllers\Admin\BookController;
use App\Http\Controllers\Admin\BorrowController as AdminBorrowController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GoogleBooksController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BorrowController;
use App\Http\Controllers\ForgotPasswordController;
use App\Http\Controllers\ResetPasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\VerifyOtpController;
use Illuminate\Support\Facades\Route;

// ===================== LANDING PAGE =====================
Route::get('/', function () {
    return view('landing');
})->name('landing');

// ===================== AUTH (GUEST ONLY) =====================
Route::middleware('guest.redirect')->group(function () {

    Route::get('/register', [AuthController::class, 'showRegister'])->name('register.form');
    Route::post('/register', [AuthController::class, 'register'])->name('register');

    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');

    Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
        ->name('password.request');
    Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
        ->name('password.email');

    Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
        ->name('password.reset');
    Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
        ->name('password.update');

    Route::get('/verify-otp', [VerifyOtpController::class, 'showVerifyForm'])
        ->name('verify.otp.form');
    Route::post('/verify-otp', [VerifyOtpController::class, 'verify'])
        ->name('verify.otp');
    Route::post('/verify-otp/resend', [VerifyOtpController::class, 'resend'])
        ->name('verify.otp.resend');
});

// Logout (harus login)
Route::middleware('auth')->get('/logout', [AuthController::class, 'logout'])->name('logout');

// ===================== ADMIN =====================
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    // ===== Borrow Admin =====
    Route::prefix('borrows')->name('borrows.')->group(function () {
        Route::get('/pending', [AdminBorrowController::class, 'pending'])->name('pending');
        Route::post('/{id}/approve', [AdminBorrowController::class, 'approve'])->name('approve');
        Route::post('/{id}/reject', [AdminBorrowController::class, 'reject'])->name('reject');
    });

    // ===== Users =====
    Route::prefix('users')->name('users.')->group(function () {
        Route::get('/', [AuthController::class, 'adminUsersIndex'])->name('index');
        Route::get('/create', [AuthController::class, 'adminUsersCreate'])->name('create');
        Route::post('/store', [AuthController::class, 'adminUsersStore'])->name('store');
        Route::get('/{user}/edit', [AuthController::class, 'adminUsersEdit'])->name('edit');
        Route::put('/{user}/update', [AuthController::class, 'adminUsersUpdate'])->name('update');
        Route::delete('/{user}/delete', [AuthController::class, 'adminUsersDestroy'])->name('destroy');
    });

    // ===== Books CRUD =====
    Route::resource('books', BookController::class);

    // Google Books integration
    Route::prefix('books/google')->name('books.google.')->group(function () {
        Route::get('/search', [GoogleBooksController::class, 'search'])->name('search');
        Route::get('/detail/{id}', [GoogleBooksController::class, 'detail'])->name('detail');
    });

    // ===== Categories =====
    Route::resource('categories', CategoryController::class);

});

// ===================== USER (LOGIN + VERIFIED) =====================
Route::middleware(['auth', 'verified.email'])->group(function () {

    // Dashboard
    Route::get('/user/dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');

    // Buku
    Route::get('/books', [BookController::class, 'userBooks'])->name('user.books');
    Route::get('/books/{book}', [BookController::class, 'show'])->name('user.books.show');

    // Baca buku
    Route::get('/read/{book}', [BookController::class, 'read'])->name('user.books.read');

    // Borrow
    Route::prefix('borrows')->name('borrows.')->group(function () {
        Route::get('/', [BorrowController::class, 'index'])->name('index');
        Route::get('/create', [BorrowController::class, 'create'])->name('create');
        Route::post('/store', [BorrowController::class, 'store'])->name('store');
        Route::get('/{borrow}', [BorrowController::class, 'show'])->name('show');
        Route::post('/{borrow}/return', [BorrowController::class, 'returnBook'])->name('return');
    });

    // Extra store route
    Route::post('/user/borrows/store', [BorrowController::class, 'store'])
        ->name('user.borrows.store');

    // List borrow user
    Route::get('/user/borrows', [BorrowController::class, 'index'])
        ->name('user.borrows.index');

    // Profile
    Route::prefix('user/profile')->name('user.profile.')->group(function () {
        Route::get('/', [UserController::class, 'showProfile'])->name('index');
        Route::get('/edit', [UserController::class, 'editProfile'])->name('edit');
        Route::put('/update', [UserController::class, 'updateProfile'])->name('update');
        Route::put('/update-password', [UserController::class, 'updatePassword'])->name('update-password');
    });

});
