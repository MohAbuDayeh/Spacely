<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\WorkspaceController as AdminWorkspaceController;
use App\Http\Controllers\Lessor\QuoteController;
use App\Http\Controllers\Lessor\DashboardController as LessorDashboardController;
use App\Http\Controllers\Lessor\WorkspaceController as LessorWorkspaceController;
use App\Http\Controllers\Lessor\InvoiceController as LessorInvoiceController;
use App\Http\Controllers\Lessor\ReviewController as LessorReviewController; // أضف هذا السطر
use App\Http\Controllers\Renter\DashboardController as RenterDashboardController;
use App\Http\Controllers\Renter\WorkspaceController as RenterWorkspaceController;
use App\Http\Controllers\Renter\BookingController;
use App\Http\Controllers\Renter\FavoriteController;
use App\Http\Controllers\Renter\ReviewController;
use App\Http\Controllers\Renter\ContactController;
use Illuminate\Support\Facades\Route;


Route::get('login', [LoginController::class, 'showLoginForm'])->name('auth.login');
Route::post('login', [LoginController::class, 'login']);
Route::get('register', [RegisterController::class, 'showRegistrationForm'])->name('auth.register');
Route::post('register', [RegisterController::class, 'register']);
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::get('forgot-password', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('forgot-password', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');


Route::get('/', [HomeController::class, 'index'])->name('home');


Route::group(['middleware' => ['auth', 'role:admin']], function () {
     Route::get('admin/dashboard', [DashboardController::class, 'index'])->name('admin.dashboard');
     Route::resource('admin/users', UserController::class);
     Route::resource('admin/workspaces', AdminWorkspaceController::class);
});

Route::group(['middleware' => ['auth', 'role:lessor']], function () {
    Route::get('lessor/dashboard', [LessorDashboardController::class, 'index'])->name('lessor.dashboard');
    Route::resource('lessor/workspaces', LessorWorkspaceController::class);
    Route::get('lessor/workspaces', [LessorWorkspaceController::class, 'index'])->name('lessor.workspaces.index');
    Route::get('lessor/workspaces/create', [LessorWorkspaceController::class, 'create'])->name('lessor.workspaces.create');
    Route::post('lessor/workspaces/edit', [LessorWorkspaceController::class, 'edit'])->name('lessor.workspaces.edit');
    Route::delete('lessor/workspaces/{id}', [LessorWorkspaceController::class, 'destroy'])->name('lessor.workspaces.delete');
    Route::post('lessor/workspaces', [LessorWorkspaceController::class, 'store'])->name('lessor.workspaces.store');

    Route::post('/workspaces/upload-image', [LessorWorkspaceController::class, 'uploadImage']) ->name('lessor.workspaces.upload');
    Route::delete('/workspaces/delete-image', [LessorWorkspaceController::class, 'deleteImage']) ->name('lessor.workspaces.delete-image');

    Route::get('lessor/reviews', [LessorReviewController::class, 'index'])->name('lessor.reviews');
    Route::get('lessor/request-quotes', [QuoteController::class, 'index'])->name('lessor.request-quotes'); // رابط لطلبات الاقتباس
        // ✅ Routes for Lessor Invoices
        Route::get('lessor/invoices', [LessorInvoiceController::class, 'index'])->name('lessor.invoices.index');
        Route::get('lessor/invoices/{id}', [LessorInvoiceController::class, 'show'])->name('lessor.invoices.show');
        Route::get('lessor/invoices/{id}/download', [LessorInvoiceController::class, 'download'])->name('lessor.invoices.download');

        // tmp\
        Route::post('lessor/upload', [LessorWorkspaceController::class, 'upload'])->name('moh');
});



Route::group(['middleware' => ['auth', 'role:renter']], function () {
    Route::get('renter/dashboard', [RenterDashboardController::class, 'index'])->name('renter.dashboard');
    Route::get('renter/workspaces', [RenterWorkspaceController::class, 'index'])->name('renter.workspaces.index');
    Route::resource('renter/bookings', BookingController::class);
    Route::resource('renter/favorites', FavoriteController::class);
    Route::resource('renter/reviews', ReviewController::class);

    Route::get('renter/contact', [ContactController::class, 'show'])->name('renter.contact');
    Route::post('renter/contact', [ContactController::class, 'submit'])->name('renter.contact.submit');


});

