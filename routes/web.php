<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\HookyController;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/{id}/absence', [ProfileController::class, 'storeAbsence'])->name('profile.storeAbsence');
    Route::get('/profile', [TaskController::class, 'showProfile'])->name('profile.show');

    Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    Route::post('/tasks/{id}/submitForReview', [TaskController::class, 'submitForReview'])->name('tasks.submitForReview');
});

Route::middleware(['auth', 'admin_or_manager'])->group(function () {
    Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    Route::get('/tasks/create/additional', [TaskController::class, 'createAdditional'])->name('tasks.createAdditional');
    Route::post('/tasks/storeAdditional', [TaskController::class, 'storeAdditional'])->name('tasks.storeAdditional');
    Route::delete('/tasks/destroy', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/manager/absence/create/{userId}', [ManagerController::class, 'createAbsence'])->name('manager.absence.create');
    Route::post('/manager/hooky/create/{userId}', [ManagerController::class, 'createHooky'])->name('manager.hooky.create');

    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::get('departments/{department}/employees', [DepartmentController::class, 'employees'])->name('departments.employees');
    Route::post('/admin/hooky/{userId}', [HookyController::class, 'create'])->name('admin.hooky.create');
    Route::get('/manager/review-tasks', [ManagerController::class, 'reviewTasks'])->name('manager.reviewTasks')->middleware('auth', 'role:manager');
    Route::put('/tasks/{id}/approve', [ManagerController::class, 'approve'])->name('tasks.approve');
    Route::put('/tasks/{id}/reject', [ManagerController::class, 'reject'])->name('tasks.reject');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/assign-department/{id}', [AdminController::class, 'assignDepartment'])->name('admin.assignDepartment');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::delete('/admin/manager/{id}', [AdminController::class, 'deleteManager'])->name('admin.deleteManager');
    Route::post('/admin/assign-manager-role/{id}', [AdminController::class, 'assignManagerRole'])->name('admin.assignManagerRole');
    Route::post('/admin/{userId}/absence', [AdminController::class, 'createAbsence'])->name('admin.absence.create');
    Route::post('/admin/hooky/{userId}', [HookyController::class, 'create'])->name('admin.hooky.create');

    Route::post('/admin/assign-manager-to-department', [AdminController::class, 'storeManagerToDepartment'])->name('admin.storeManagerToDepartment');

    Route::get('/admin/tasks/create', [AdminController::class, 'createTask'])->name('admin.createTask');
    Route::post('/admin/tasks', [AdminController::class, 'storeTask'])->name('admin.storeTask');
    Route::get('/admin/tasks/{id}/edit', [AdminController::class, 'editTask'])->name('admin.editTask');
    Route::put('/admin/tasks/{id}', [AdminController::class, 'updateTask'])->name('admin.updateTask');
    Route::delete('/admin/tasks/{id}', [AdminController::class, 'destroyTask'])->name('admin.destroyTask');
});

Route::middleware(['auth', 'manager'])->group(function () {
    Route::get('/manager/review-tasks', [ManagerController::class, 'reviewTasks'])->name('manager.reviewTasks');
    Route::post('/manager/{userId}/absence', [ManagerController::class, 'createAbsence'])->name('manager.absence.create');
    Route::post('/manager/hooky/create/{userId}', [ManagerController::class, 'createHooky'])->name('manager.hooky.create');
});

Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');
