<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
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
| Main routes for public, authenticated users, and admin.
|--------------------------------------------------------------------------
*/

/**
 * 🌐 PUBLIC ROUTES
 */
Route::get('/', [HomeController::class, 'index'])->name('home'); // Homepage showing trending and recommended movies
Route::get('/search', [UserController::class, 'search'])->name('movies.search'); // Search feature


/**
 * ✅ AUTHENTICATED USER ROUTES
 * Accessible when logged in & verified
 */
Route::middleware(['auth', 'verified'])->group(function () {

    /**
     * 🎬 User Movies (Listing & Detail)
     */
    Route::get('/movies', [UserController::class, 'index'])->name('movies.index'); // List all movies
    Route::get('/movies/{movie}', [UserController::class, 'show'])->name('movies.show'); // Single movie detail

    /**
     * ⭐ Reviews (User Reviews on Movies)
     */
    Route::resource('movies.reviews', UserReviewController::class)->only(['store']); // Add Review
    Route::get('/movies/{movie}/reviews', [UserReviewController::class, 'showReviews'])->name('user.reviews'); // List reviews for a movie
    Route::get('/reviews/{review}/edit', [UserReviewController::class, 'edit'])->name('reviews.edit'); // Edit Review
    Route::put('/reviews/{review}', [UserReviewController::class, 'update'])->name('reviews.update'); // Update Review
    Route::delete('/reviews/{review}', [UserReviewController::class, 'destroy'])->name('reviews.destroy'); // Delete Review

    /**
     * 💬 Comments (On Reviews)
     */
    Route::resource('reviews.comments', UserCommentController::class)->only(['store']); // Add Comment to Review
    Route::get('/reviews/{review}/comments', [UserCommentController::class, 'showComments'])->name('user.comments'); // List comments on a review
    Route::get('/comments/{comment}/edit', [UserCommentController::class, 'edit'])->name('comments.edit'); // Edit Comment
    Route::put('/comments/{comment}', [UserCommentController::class, 'update'])->name('comments.update'); // Update Comment
    Route::delete('/comments/{comment}', [UserCommentController::class, 'destroy'])->name('comments.destroy'); // Delete Comment

    /**
     * ⚙️ User Profile & Account Settings
     */
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit'); // Edit Profile
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update'); // Update Profile
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy'); // Delete Account
    Route::get('/settings', [UserSettingsController::class, 'index'])->name('settings.index'); // Account Settings Page
    Route::post('/settings/update', [UserSettingsController::class, 'update'])->name('settings.update'); // Update Account Settings

    /**
     * 🏠 User Dashboard
     */
    Route::get('/dashboard', fn () => view('dashboard'))->name('dashboard');
});


/**
 * 🛡️ ADMIN ROUTES
 * For admins only (admin middleware applied)
 */
Route::middleware(['auth', 'admin'])->prefix('admin')->name('admin.')->group(function () {

    /**
     * 🏠 Admin Dashboard
     */
    Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');

    /**
     * 🎬 Admin Movie & Genre Management
     */
    Route::resource('genres', AdminGenreController::class)->except(['show', 'edit', 'update']); // Manage Genres
    Route::resource('movies', AdminMovieController::class)->except(['show']); // Full Movie Management (Add, Edit, Delete)

    /**
     * ⭐ Review Moderation
     */
    Route::resource('reviews', AdminReviewController::class)->only(['index', 'destroy']); // View & Delete Reviews

    /**
     * 💬 Comment Moderation
     */
    Route::resource('comments', AdminCommentController::class)->only(['index', 'destroy']); // View & Delete Comments
    Route::post('comments/{comment}/restore', [AdminCommentController::class, 'restore'])->name('comments.restore'); // Restore deleted comments
});


/**
 * 🔑 AUTHENTICATION ROUTES
 * Includes Login, Register, Forgot Password, Reset, etc.
 */
require __DIR__ . '/auth.php';
