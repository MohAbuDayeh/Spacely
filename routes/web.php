<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\WorkspaceController as AdminWorkspaceController;
// Make sure the file exists at app/Http/Controllers/Admin/WorkspaceController.php
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Lessor\QuoteController;
use App\Http\Controllers\Lessor\DashboardController as LessorDashboardController;
use App\Http\Controllers\Lessor\WorkspaceController as LessorWorkspaceController;
use App\Http\Controllers\Lessor\InvoiceController as LessorInvoiceController;
use App\Http\Controllers\Lessor\ReviewController as LessorReviewController;
use App\Http\Controllers\Lessor\BookingController as LessorBookingController;
use App\Http\Controllers\Renter\DashboardController as RenterDashboardController;
use App\Http\Controllers\Renter\WorkspaceController as RenterWorkspaceController;
use App\Http\Controllers\Renter\BookingController;
use App\Http\Controllers\Renter\FavoriteController;
use App\Http\Controllers\Renter\ReviewController;
use App\Http\Controllers\Renter\ContactController;
use App\Http\Controllers\Renter\PaymentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Authentication Routes
Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Public Routes
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/workspaces/{workspace}', [HomeController::class, 'showWorkspace'])->name('workspaces.show');

// // Shared Authenticated Routes (for all roles)
// Route::middleware(['auth'])->group(function () {

//     Route::prefix('profile')->group(function () {
//         Route::get('/{id}', [UserController::class, 'profile'])->name('profile.show');
//         Route::get('/{id}/edit', [UserController::class, 'edit'])->name('profile.edit');
//         Route::put('/{id}/update', [UserController::class, 'update'])->name('profile.update');
//     });
// });

// Admin Routes
Route::group(['middleware' => ['auth', 'role:admin'], 'prefix' => 'admin', 'as' => 'admin.'], function () {
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Users Management (Full CRUD)
    Route::resource('users', AdminUserController::class)->except(['show']);

    // Workspaces Management (View and Delete only)
    Route::get('workspaces', [AdminWorkspaceController::class, 'index'])->name('workspaces.index');
    Route::delete('workspaces/{workspace}', [AdminWorkspaceController::class, 'destroy'])->name('workspaces.destroy');

    // Bookings Management (View and Delete only)
    Route::get('bookings', [AdminBookingController::class, 'index'])->name('bookings.index');
    Route::delete('bookings/{booking}', [AdminBookingController::class, 'destroy'])->name('bookings.destroy');

    // Admin Profile
    Route::get('profile/{id}', [UserController::class, 'profile'])->name('profile');

        Route::prefix('admin/profile')->middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/{id}', [UserController::class, 'profile'])->name('admin.profile.show');
    Route::put('/{id}/update', [UserController::class, 'update'])->name('admin.profile.update');
});
});
// Lessor Routes
Route::group(['middleware' => ['auth', 'role:lessor']], function () {
    // Dashboard
    Route::get('lessor/dashboard', [LessorDashboardController::class, 'index'])->name('lessor.dashboard');

    // Workspaces
    Route::get('lessor/workspaces', [LessorWorkspaceController::class, 'index'])->name('lessor.workspaces.index');
    Route::get('lessor/workspaces/create', [LessorWorkspaceController::class, 'create'])->name('lessor.workspaces.create');
    Route::get('lessor/workspaces/{workspace}', [LessorWorkspaceController::class, 'show'])->name('lessor.workspaces.show');
    Route::put('lessor/workspaces/{workspace}', [LessorWorkspaceController::class, 'update'])->name('lessor.workspaces.update');
    Route::get('lessor/workspaces/{workspace}/edit', [LessorWorkspaceController::class, 'edit'])->name('lessor.workspaces.edit');
    Route::delete('lessor/workspaces/{workspace}', [LessorWorkspaceController::class, 'destroy'])->name('lessor.workspaces.destroy');
    Route::post('lessor/workspaces', [LessorWorkspaceController::class, 'store'])->name('lessor.workspaces.store');
    Route::post('/workspaces/upload-image', [LessorWorkspaceController::class, 'uploadImage'])->name('lessor.workspaces.upload');
    Route::delete('/workspaces/delete-image', [LessorWorkspaceController::class, 'deleteImage'])->name('lessor.workspaces.delete-image');

     Route::prefix('lessor/workspaces/{workspace}')->group(function () {
        Route::post('bookings/{booking}/status', [LessorBookingController::class, 'updateStatus'])
            ->name('lessor.workspaces.bookings.status');
        Route::get('bookings/export', [LessorBookingController::class, 'export'])
            ->name('lessor.workspaces.bookings.export');
    });

    // Lessor Bookings Routes
Route::prefix('lessor/bookings')->group(function () {
    Route::get('/', [LessorBookingController::class, 'index'])->name('lessor.bookings.index');
    Route::put('/{booking}/status', [LessorBookingController::class, 'updateStatus'])->name('lessor.bookings.status');
    Route::post('/{booking}/message', [LessorBookingController::class, 'sendMessage'])->name('lessor.bookings.message');
    Route::get('/export', [LessorBookingController::class, 'export'])->name('lessor.bookings.export');
});

    // Reviews
    Route::get('lessor/reviews', [LessorReviewController::class, 'index'])->name('lessor.reviews');

    // Quotes
    Route::get('lessor/request-quotes', [QuoteController::class, 'index'])->name('lessor.request-quotes');

    // Invoices
    Route::get('lessor/invoices', [LessorInvoiceController::class, 'index'])->name('lessor.invoices.index');
    Route::get('lessor/invoices/{id}', [LessorInvoiceController::class, 'show'])->name('lessor.invoices.show');
    Route::get('lessor/invoices/{id}/download', [LessorInvoiceController::class, 'download'])->name('lessor.invoices.download');

    // Temporary Upload
    Route::post('lessor/upload', [LessorWorkspaceController::class, 'upload'])->name('moh');

    // Lessor Profile Routes
    Route::prefix('lessor/profile')->middleware(['auth', 'role:lessor'])->group(function () {
    Route::get('/{id}', [UserController::class, 'profile'])->name('lessor.profile.show');
    Route::put('/{id}/update', [UserController::class, 'update'])->name('lessor.profile.update');

});
});

// Renter Public Routes
Route::get('renter/workspaces', [RenterWorkspaceController::class, 'index'])->name('renter.workspaces.index');
Route::get('renter/workspaces/{workspace}', [RenterWorkspaceController::class, 'show'])->name('renter.workspaces.show');

// Renter Authenticated Routes
Route::group(['middleware' => ['auth', 'role:renter']], function () {
    // Dashboard
    Route::get('renter/dashboard', [RenterDashboardController::class, 'index'])->name('renter.dashboard');

    // Bookings
    Route::resource('renter/bookings', BookingController::class);
    Route::get('renter/bookings', [BookingController::class, 'index'])->name('renter.bookings.index');
    Route::get('renter/bookings/{booking}', [BookingController::class, 'show'])->name('renter.bookings.show');

    // Favorites
    Route::resource('renter/favorites', FavoriteController::class);
    Route::get('renter/favorites', [FavoriteController::class, 'index'])->name('renter.favorites.index');
    Route::get('renter/favorites/{workspace}', [FavoriteController::class, 'show'])->name('renter.favorites.show');
    Route::post('renter/favorites/{workspace}', [FavoriteController::class, 'store'])->name('renter.favorites.store');
    Route::delete('renter/favorites/{workspace}', [FavoriteController::class, 'destroy'])->name('renter.favorites.destroy');

    // Reviews
    Route::resource('renter/reviews', ReviewController::class);
    Route::post('renter/reviews/{workspace}', [ReviewController::class, 'store'])->name('renter.reviews.store');
    Route::get('renter/reviews/{workspace}', [ReviewController::class, 'show'])->name('renter.reviews.show');
    Route::get('renter/reviews/{workspace}/edit', [ReviewController::class, 'edit'])->name('renter.reviews.edit');
    Route::put('renter/reviews/{workspace}', [ReviewController::class, 'update'])->name('renter.reviews.update');

    // Contact
    Route::get('renter/contact', [ContactController::class, 'show'])->name('renter.contact');
    Route::post('renter/contact', [ContactController::class, 'submit'])->name('renter.contact.submit');

    // Quotes
    Route::post('renter/quotes', [QuoteController::class, 'store'])->name('renter.quotes.store');

    // Payment
    Route::get('renter/workspaces/{workspace}/payment', [PaymentController::class, 'show'])->name('renter.payment.show');
    Route::resource("payment", PaymentController::class);

    // Renter Profile Routes
    Route::get('renter/profile/{id}', [UserController::class, 'profile'])->name('renter.profile');

});
