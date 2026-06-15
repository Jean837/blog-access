<?php
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\PostController as AdminPostController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// ─── Blog public ──────────────────────────────────────────────────────────────
Route::get('/', [BlogController::class, 'index'])->name('blog.index');
Route::get('/article/{slug}', [BlogController::class, 'show'])->name('blog.show');

// ─── Auth (Breeze) ────────────────────────────────────────────────────────────
require __DIR__.'/auth.php';

// ─── Espace utilisateur connecté + vérifié ────────────────────────────────────
Route::middleware(['auth'])->group(function () {

    // Redirection dashboard selon rôle
    Route::get('/dashboard', function () {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        }
        return redirect()->route('blog.index');
    })->name('dashboard');

    // Profil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Commentaires
    Route::post('/article/{post}/comment', [BlogController::class, 'comment'])->name('blog.comment');
});

// ─── Admin (admin uniquement) ─────────────────────────────────────────────────
Route::middleware(['admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('posts', AdminPostController::class);
    Route::resource('categories', CategoryController::class)->only(['index', 'store', 'destroy']);
    Route::post('/comments/{comment}/approve', [CommentController::class, 'approve'])->name('comments.approve');
    Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});