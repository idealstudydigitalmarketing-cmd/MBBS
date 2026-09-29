<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ContentController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ===== PUBLIC ROUTES =====
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

// ===== ADMIN ROUTES =====
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login',  [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout',[AuthController::class, 'logout'])->name('logout');

    // Protected admin routes
    Route::middleware('admin.auth')->group(function () {

        // Dashboard
        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Enquiries
        Route::get('/enquiries',               [DashboardController::class, 'enquiries'])->name('enquiries');
        Route::get('/enquiries/export',        [ContentController::class, 'exportEnquiries'])->name('enquiries.export');
        Route::get('/enquiries/{id}',          [DashboardController::class, 'show'])->name('enquiries.show');
        Route::patch('/enquiries/{id}/status', [DashboardController::class, 'updateStatus'])->name('enquiries.status');
        Route::delete('/enquiries/{id}',       [DashboardController::class, 'destroy'])->name('enquiries.destroy');

        // Site Settings
        Route::get('/settings',  [ContentController::class, 'settings'])->name('settings');
        Route::post('/settings', [ContentController::class, 'settingsSave'])->name('settings.save');

        // Countries
        Route::get('/countries',                    [ContentController::class, 'countries'])->name('countries');
        Route::get('/countries/create',             [ContentController::class, 'countryCreate'])->name('countries.create');
        Route::post('/countries',                   [ContentController::class, 'countryStore'])->name('countries.store');
        Route::get('/countries/{country}/edit',     [ContentController::class, 'countryEdit'])->name('countries.edit');
        Route::put('/countries/{country}',          [ContentController::class, 'countryUpdate'])->name('countries.update');
        Route::delete('/countries/{country}',       [ContentController::class, 'countryDestroy'])->name('countries.destroy');

        // Universities
        Route::get('/universities',                     [ContentController::class, 'universities'])->name('universities');
        Route::get('/universities/create',              [ContentController::class, 'universityCreate'])->name('universities.create');
        Route::post('/universities',                    [ContentController::class, 'universityStore'])->name('universities.store');
        Route::get('/universities/{university}/edit',   [ContentController::class, 'universityEdit'])->name('universities.edit');
        Route::put('/universities/{university}',        [ContentController::class, 'universityUpdate'])->name('universities.update');
        Route::delete('/universities/{university}',     [ContentController::class, 'universityDestroy'])->name('universities.destroy');

        // Testimonials
        Route::get('/testimonials',                     [ContentController::class, 'testimonials'])->name('testimonials');
        Route::get('/testimonials/create',              [ContentController::class, 'testimonialCreate'])->name('testimonials.create');
        Route::post('/testimonials',                    [ContentController::class, 'testimonialStore'])->name('testimonials.store');
        Route::get('/testimonials/{testimonial}/edit',  [ContentController::class, 'testimonialEdit'])->name('testimonials.edit');
        Route::put('/testimonials/{testimonial}',       [ContentController::class, 'testimonialUpdate'])->name('testimonials.update');
        Route::delete('/testimonials/{testimonial}',    [ContentController::class, 'testimonialDestroy'])->name('testimonials.destroy');

        // Blog Posts
        Route::get('/blog',             [ContentController::class, 'blog'])->name('blog');
        Route::get('/blog/create',      [ContentController::class, 'blogCreate'])->name('blog.create');
        Route::post('/blog',            [ContentController::class, 'blogStore'])->name('blog.store');
        Route::get('/blog/{post}/edit', [ContentController::class, 'blogEdit'])->name('blog.edit');
        Route::put('/blog/{post}',      [ContentController::class, 'blogUpdate'])->name('blog.update');
        Route::delete('/blog/{post}',   [ContentController::class, 'blogDestroy'])->name('blog.destroy');
    });
});
