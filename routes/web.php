<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SocialAuthController;
use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminGenreController;
use App\Http\Controllers\Admin\AdminMovieController;
use App\Http\Controllers\Admin\AdminCommentController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\User\UserReviewController;
use App\Http\Controllers\User\UserCommentController;
use App\Http\Controllers\User\UserSettingsController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here you can register web routes for your application.
| These routes are automatically loaded by RouteServiceProvider.
|--------------------------------------------------------------------------
*/

/**
 * 🌐 Public Routes
 */

// Homepage (Landing Page)
Route::get('/', [HomeController::class, 'index'])->name('home');

// Public Search (Global Search for Movies)
Route::get('/search', [UserController::class, 'search'])->name('movies.search');

/**
 * ✅ Authenticated & Verified User Routes
 */
Route::middleware(['auth', 'verified'])->group(function () {

    /**
     * 🎥 User Movie Browsing & Viewing
     */
    Route::get('/movies', [UserController::class, 'index'])->name('movies.index');
    Route::get('/movies/{movie}', [UserController::class, 'show'])->name('movies.show');

    /**
     * ⭐ User Movie Reviews (CRUD)
     */
    Route::resource('movies.reviews', UserReviewController::class)->only(['store']);
    Route::get('/movies/{movie}/reviews', [UserReviewController::class, 'showReviews'])->name('user.reviews');
    Route::get('/reviews/{review}/edit', [UserReviewController::class, 'edit'])->name('reviews.edit');
    Route::put('/reviews/{review}', [UserReviewController::class, 'update'])->name('reviews.update');
    Route::delete('/reviews/{review}', [UserReviewController::class, 'destroy'])->name('reviews.destroy');

    /**
     * 💬 User Comments on Reviews (CRUD)
     */
    Route::resource('reviews.comments', UserCommentController::class)->only(['store']);
    Route::get('/reviews/{review}/comments', [UserCommentController::class, 'showComments'])->name('user.comments');
    Route::get('/comments/{comment}/edit', [UserCommentController::class, 'edit'])->name('comments.edit');
    Route::put('/comments/{comment}', [UserCommentController::class, 'update'])->name('comments.update');
    Route::delete('/comments/{comment}', [UserCommentController::class, 'destroy'])->name('comments.destroy');

    /**
     * ⚙️ User Settings & Profile
     */
    Route::get('/settings', [UserSettingsController::class, 'index'])->name('settings.index');
    Route::post('/settings/update', [UserSettingsController::class, 'update'])->name('settings.update');

    // 📝 **Explicit Profile Routes**
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // User Dashboard
    Route::get('/dashboard', fn() => view('dashboard'))->name('dashboard');

    /**
     * 🔑 Social Authentication (Google, Facebook, GitHub)
     */
    Route::get('/auth/{provider}', [SocialAuthController::class, 'redirect'])->name('social.redirect');
    Route::get('/auth/{provider}/callback', [SocialAuthController::class, 'callback'])->name('social.callback');
});

/**
 * 🛡️ Admin Routes (Protected by 'admin' middleware)
 */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    // 🏠 Admin Dashboard
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    // 🎬 Genre Management (CRUD excluding show, edit, update for simplicity)
    Route::resource('genres', AdminGenreController::class)->except(['show', 'edit', 'update']);

    // 🎥 Movie Management (Full CRUD excluding show)
    Route::resource('movies', AdminMovieController::class)->except(['show']);

    // 💬 Comment Moderation (List, Delete, Restore)
    Route::resource('comments', AdminCommentController::class)->only(['index', 'destroy']);
    Route::post('comments/{comment}/restore', [AdminCommentController::class, 'restore'])->name('comments.restore');

    // ⭐ Review Moderation (List & Delete only)
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']);
});

/**
 * 🔑 Default Authentication Routes (Login, Register, Password, etc.)
 */
require __DIR__ . '/auth.php';
