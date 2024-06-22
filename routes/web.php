<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
<<<<<<< Updated upstream
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//
//Route::get('/',function (){
//    return view('welcome');
//});
=======
use App\Http\Controllers\ManagerController;
use App\Http\Controllers\TaskController;
>>>>>>> Stashed changes

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');



Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');

<<<<<<< Updated upstream


Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
});



Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/assign-department/{id}', [AdminController::class, 'assignDepartment'])->name('admin.assignDepartment');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
=======
    Route::middleware('admin_or_manager')->group(function () {
        Route::resource('employees', EmployeeController::class);
        Route::resource('departments', DepartmentController::class);
        Route::get('departments/{department}/employees', [DepartmentController::class, 'employees'])->name('departments.employees');
        Route::get('employees/{employee}', [EmployeeController::class, 'show'])->name('employees.show'); // Маршрут для профиля сотрудника
        Route::resource('tasks', TaskController::class);
    });

    Route::middleware('admin')->group(function () {
        Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
        Route::post('/admin/assign-department/{id}', [AdminController::class, 'assignDepartment'])->name('admin.assignDepartment');
        Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
        Route::post('/admin/assign-manager-role/{id}', [AdminController::class, 'assignManagerRole'])->name('admin.assignManagerRole');
    });

    Route::middleware('manager')->group(function () {
        Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
        Route::resource('tasks', TaskController::class);
    });
>>>>>>> Stashed changes
});


Route::get('/employees', [EmployeeController::class, 'index'])->name('employees.index');
Route::get('/departments', [DepartmentController::class, 'index'])->name('departments.index');
Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');
