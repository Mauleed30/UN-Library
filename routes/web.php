<?php

use App\Http\Controllers\SubmissionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\LibrarianController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\GuestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Guest/Public Routes
Route::get('/catalogue', [GuestController::class, 'catalogue'])->name('guest.catalogue');
Route::get('/catalogue/{id}', [GuestController::class, 'view'])->name('guest.view');
Route::get('/catalogue/{id}/download', [GuestController::class, 'download'])->name('guest.download');

// Submission Routes
Route::resource('submissions', SubmissionController::class);

// Student Routes
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/submissions', [StudentController::class, 'submissions'])->name('student.submissions');
    Route::get('/create', [StudentController::class, 'create'])->name('student.create');
    Route::post('/store', [StudentController::class, 'store'])->name('student.store');
    Route::get('/track/{id}', [StudentController::class, 'track'])->name('student.track');
    Route::get('/search', [StudentController::class, 'search'])->name('student.search');
});

// Faculty Routes
Route::middleware(['auth', 'role:faculty'])->prefix('faculty')->group(function () {
    Route::get('/dashboard', [FacultyController::class, 'dashboard'])->name('faculty.dashboard');
});

// Librarian Routes
Route::middleware(['auth', 'role:librarian'])->prefix('librarian')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\LibrarianController::class, 'dashboard'])->name('librarian.dashboard');
    Route::get('/submissions', [App\Http\Controllers\LibrarianController::class, 'submissions'])->name('librarian.submissions');
    Route::get('/review/{id}', [App\Http\Controllers\LibrarianController::class, 'review'])->name('librarian.review');
    Route::post('/approve/{id}', [App\Http\Controllers\LibrarianController::class, 'approve'])->name('librarian.approve');
    Route::post('/reject/{id}', [App\Http\Controllers\LibrarianController::class, 'reject'])->name('librarian.reject');
    Route::get('/edit-metadata/{id}', [App\Http\Controllers\LibrarianController::class, 'editMetadata'])->name('librarian.edit-metadata');
    Route::post('/update-metadata/{id}', [App\Http\Controllers\LibrarianController::class, 'updateMetadata'])->name('librarian.metadata.update');
    Route::get('/categories', [App\Http\Controllers\LibrarianController::class, 'categories'])->name('librarian.categories');
    Route::post('/categories', [App\Http\Controllers\LibrarianController::class, 'storeCategory'])->name('librarian.categories.store');
    Route::get('/categories/{id}/edit', [App\Http\Controllers\LibrarianController::class, 'editCategory'])->name('librarian.categories.edit');
    Route::put('/categories/{id}', [App\Http\Controllers\LibrarianController::class, 'updateCategory'])->name('librarian.categories.update');
    Route::delete('/categories/{id}', [App\Http\Controllers\LibrarianController::class, 'deleteCategory'])->name('librarian.categories.delete');
    Route::post('/set-access/{id}', [App\Http\Controllers\LibrarianController::class, 'setAccessLevel'])->name('librarian.set-access');
});
// Faculty Routes
Route::middleware(['auth', 'role:faculty'])->prefix('faculty')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\FacultyController::class, 'dashboard'])->name('faculty.dashboard');
    Route::get('/submissions', [App\Http\Controllers\FacultyController::class, 'submissions'])->name('faculty.submissions');
    Route::get('/assigned', [App\Http\Controllers\FacultyController::class, 'assigned'])->name('faculty.assigned');
    Route::get('/review/{id}', [App\Http\Controllers\FacultyController::class, 'review'])->name('faculty.review');
    Route::post('/endorse/{id}', [App\Http\Controllers\FacultyController::class, 'endorse'])->name('faculty.endorse');
    Route::get('/track/{id}', [App\Http\Controllers\FacultyController::class, 'track'])->name('faculty.track');
    Route::get('/search', [App\Http\Controllers\FacultyController::class, 'search'])->name('faculty.search');
    Route::get('/stats', [App\Http\Controllers\FacultyController::class, 'stats'])->name('faculty.stats');
});
// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
});
// Librarian Routes
Route::middleware(['auth', 'role:librarian'])->prefix('librarian')->group(function () {
    // ... routes zilizopo ...
    Route::get('/publish/{id}', [App\Http\Controllers\LibrarianController::class, 'publish'])->name('librarian.publish');
});
// Guest/Public Routes
Route::get('/catalogue', [App\Http\Controllers\GuestController::class, 'catalogue'])->name('guest.catalogue');
Route::get('/catalogue/{id}', [App\Http\Controllers\GuestController::class, 'view'])->name('guest.view');
Route::get('/catalogue/{id}/download', [App\Http\Controllers\GuestController::class, 'download'])->name('guest.download');
Route::get('/get-next-student-id', function (Request $request) {
    $program = $request->query('program');
    $lastStudent = App\Models\User::where('program', $program)
        ->whereNotNull('student_id')
        ->orderBy('id', 'desc')
        ->first();

    if ($lastStudent && $lastStudent->student_id) {
        $parts = explode('/', $lastStudent->student_id);
        $lastNumber = isset($parts[1]) ? intval($parts[1]) : 0;
        $nextNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
    } else {
        $nextNumber = '0001';
    }

    return response()->json(['next_number' => $nextNumber]);
});
// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');
});
// Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile.show');

    Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');

    // ✅ ONGEZA HII
    Route::put('/profile/update', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.update');
});
// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');

    // User Management
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');

    // Settings
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
    Route::post('/settings', [App\Http\Controllers\AdminController::class, 'updateSettings'])->name('admin.settings.update');

    // Analytics
    Route::get('/analytics', [App\Http\Controllers\AdminController::class, 'analytics'])->name('admin.analytics');

    // Backups
    Route::get('/backups', [App\Http\Controllers\AdminController::class, 'backups'])->name('admin.backups');
    Route::get('/backups/create', [App\Http\Controllers\AdminController::class, 'createBackup'])->name('admin.backups.create');
    Route::get('/backups/{filename}/download', [App\Http\Controllers\AdminController::class, 'downloadBackup'])->name('admin.backups.download');
    Route::delete('/backups/{filename}', [App\Http\Controllers\AdminController::class, 'deleteBackup'])->name('admin.backups.delete');
});
// ==================== LIBRARIAN ROUTES ====================
Route::middleware(['auth', 'role:librarian'])->prefix('librarian')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\LibrarianController::class, 'dashboard'])->name('librarian.dashboard');
    Route::get('/submissions', [App\Http\Controllers\LibrarianController::class, 'submissions'])->name('librarian.submissions');
    Route::get('/review/{id}', [App\Http\Controllers\LibrarianController::class, 'review'])->name('librarian.review');
    Route::post('/approve/{id}', [App\Http\Controllers\LibrarianController::class, 'approve'])->name('librarian.approve');
    Route::post('/reject/{id}', [App\Http\Controllers\LibrarianController::class, 'reject'])->name('librarian.reject');
    Route::get('/publish/{id}', [App\Http\Controllers\LibrarianController::class, 'publish'])->name('librarian.publish');
    Route::get('/edit-metadata/{id}', [App\Http\Controllers\LibrarianController::class, 'editMetadata'])->name('librarian.edit-metadata');
    Route::post('/update-metadata/{id}', [App\Http\Controllers\LibrarianController::class, 'updateMetadata'])->name('librarian.metadata.update');
    Route::get('/categories', [App\Http\Controllers\LibrarianController::class, 'categories'])->name('librarian.categories');
    Route::post('/categories', [App\Http\Controllers\LibrarianController::class, 'storeCategory'])->name('librarian.categories.store');
    Route::delete('/categories/{id}', [App\Http\Controllers\LibrarianController::class, 'deleteCategory'])->name('librarian.categories.delete');
    Route::post('/set-access/{id}', [App\Http\Controllers\LibrarianController::class, 'setAccessLevel'])->name('librarian.set-access');
    Route::get('/stats', [App\Http\Controllers\LibrarianController::class, 'stats'])->name('librarian.stats');
    Route::get('/quick', [App\Http\Controllers\LibrarianController::class, 'quick'])->name('librarian.quick');
    Route::get('/access', [App\Http\Controllers\LibrarianController::class, 'access'])->name('librarian.access');
});
// ==================== STUDENT ROUTES ====================
Route::middleware(['auth', 'role:student'])->prefix('student')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\StudentController::class, 'dashboard'])->name('student.dashboard');
    Route::get('/submissions', [App\Http\Controllers\StudentController::class, 'submissions'])->name('student.submissions');
    Route::get('/create', [App\Http\Controllers\StudentController::class, 'create'])->name('student.create');
    Route::post('/store', [App\Http\Controllers\StudentController::class, 'store'])->name('student.store');
    Route::get('/track/{id}', [App\Http\Controllers\StudentController::class, 'track'])->name('student.track');
    Route::get('/search', [App\Http\Controllers\StudentController::class, 'search'])->name('student.search');
    Route::get('/quick', [App\Http\Controllers\StudentController::class, 'quick'])->name('student.quick');
});
// ==================== FACULTY ROUTES ====================
Route::middleware(['auth', 'role:faculty'])->prefix('faculty')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\FacultyController::class, 'dashboard'])->name('faculty.dashboard');
    Route::get('/pending', [App\Http\Controllers\FacultyController::class, 'pending'])->name('faculty.pending');
    Route::get('/submissions', [App\Http\Controllers\FacultyController::class, 'submissions'])->name('faculty.submissions');
    Route::get('/assigned', [App\Http\Controllers\FacultyController::class, 'assigned'])->name('faculty.assigned');
    Route::get('/review/{id}', [App\Http\Controllers\FacultyController::class, 'review'])->name('faculty.review');
    Route::post('/endorse/{id}', [App\Http\Controllers\FacultyController::class, 'endorse'])->name('faculty.endorse');
    Route::get('/track', [App\Http\Controllers\FacultyController::class, 'track'])->name('faculty.track');
    Route::get('/quick', [App\Http\Controllers\FacultyController::class, 'quick'])->name('faculty.quick');
});
// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/submissions', [App\Http\Controllers\AdminController::class, 'submissions'])->name('admin.submissions');
    Route::get('/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/analytics', [App\Http\Controllers\AdminController::class, 'analytics'])->name('admin.analytics');
    Route::get('/backups', [App\Http\Controllers\AdminController::class, 'backups'])->name('admin.backups');
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
});
// ==================== ADMIN ROUTES ====================
Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
    Route::get('/dashboard', [App\Http\Controllers\AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/users', [App\Http\Controllers\AdminController::class, 'users'])->name('admin.users');
    Route::get('/users/create', [App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.users.create');
    Route::post('/users', [App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store');
    Route::get('/users/{id}/edit', [App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.users.edit');
    Route::put('/users/{id}', [App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update');
    Route::delete('/users/{id}', [App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.delete');
    Route::get('/submissions', [App\Http\Controllers\AdminController::class, 'submissions'])->name('admin.submissions');
    Route::get('/categories', [App\Http\Controllers\AdminController::class, 'categories'])->name('admin.categories');
    Route::post('/categories', [App\Http\Controllers\AdminController::class, 'storeCategory'])->name('admin.categories.store');
    Route::delete('/categories/{id}', [App\Http\Controllers\AdminController::class, 'deleteCategory'])->name('admin.categories.delete');
    Route::get('/analytics', [App\Http\Controllers\AdminController::class, 'analytics'])->name('admin.analytics');
    Route::get('/backups', [App\Http\Controllers\AdminController::class, 'backups'])->name('admin.backups');
    Route::get('/backups/create', [App\Http\Controllers\AdminController::class, 'createBackup'])->name('admin.backups.create');
    Route::get('/backups/{filename}/download', [App\Http\Controllers\AdminController::class, 'downloadBackup'])->name('admin.backups.download');
    Route::delete('/backups/{filename}', [App\Http\Controllers\AdminController::class, 'deleteBackup'])->name('admin.backups.delete');
    Route::get('/settings', [App\Http\Controllers\AdminController::class, 'settings'])->name('admin.settings');
});
