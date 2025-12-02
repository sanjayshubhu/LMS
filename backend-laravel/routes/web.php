<?php
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\ResetPasswordController;
use App\Http\Controllers\Auth\ForgotPasswordController;


Route::get('/', function () {
    if(auth()->check()) {
        return auth()->user()->role === 'admin' 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('login.view');
});


// Auth routes
Route::get('/register', [AuthController::class,'showRegister'])->name('register.view');
Route::post('/register', [AuthController::class,'register'])->name('register');
Route::get('/login', [AuthController::class,'showLogin'])->name('login.view');
Route::post('/login', [AuthController::class,'login'])->name('login');
Route::post('/logout', [AuthController::class,'logout'])->name('logout');

// Dashboard (authenticated)
Route::middleware('auth')->group(function () {
    // Route::get('/', [BookController::class,'index'])->name('dashboard');
    Route::get('/books/create', [BookController::class,'create'])->name('books.create');
    Route::post('/books', [BookController::class,'store'])->name('books.store');
    Route::post('/borrow/{book}', [BookController::class,'borrow'])->name('books.borrow');
    Route::post('/return/{book}', [BookController::class,'return'])->name('books.return');
});

// User Dashboard
Route::middleware(['auth'])->group(function () {
    Route::get('/user-dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
});

// Admin Dashboard
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

    // Books routes
    Route::resource('books', BookController::class)->except(['edit']);
    Route::put('/books/{book}', [BookController::class, 'update'])->name('books.update');
    Route::delete('/books/{book}', [BookController::class, 'destroy'])->name('books.destroy');
    Route::get('/books', [BookController::class, 'index'])->name('books.index');

    // Users routes
    Route::delete('/users/{user}', [AdminController::class, 'destroyUser'])->name('users.destroy');
    Route::get('/users', [AdminController::class, 'users'])->name('users.index'); // list all users
});

// Forgot Password
Route::get('/forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])
    ->name('password.request');

Route::post('/forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])
    ->name('password.email');

// Reset Password
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'showResetForm'])
    ->name('password.reset');

Route::post('/reset-password', [ResetPasswordController::class, 'reset'])
    ->name('password.update');


    // routes/web.php
Route::patch('/admin/books/{id}/return', [BookController::class, 'markReturn'])->name('admin.books.markReturn');


Route::get('/test-admin', function () {
    $user = \App\Models\User::where('email', 'admin@example.com')->first();
    return [
        'exists' => $user !== null,
        'password_matches' => Hash::check('123456', $user->password),
        'role' => $user->role
    ];
});

