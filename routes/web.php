<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\DepartmentController;
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

Route::get('/', function (){
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin/assign-department/{id}', [AdminController::class, 'assignDepartment'])->name('admin.assignDepartment');
    Route::delete('/admin/delete-user/{id}', [AdminController::class, 'deleteUser'])->name('admin.deleteUser');
    Route::post('/admin/assign-manager-role/{id}', [AdminController::class, 'assignManagerRole'])->name('admin.assignManagerRole');


    Route::resource('employees', EmployeeController::class);
    Route::resource('departments', DepartmentController::class);
    Route::get('departments/{department}/employees', [DepartmentController::class, 'employees'])->name('departments.employees');

});
Route::middleware(['auth', 'manager'])->group(function () {
    // Ваши маршруты для менеджера
    Route::get('/manager', [ManagerController::class, 'index'])->name('manager.index');
    Route::resource('tasks', TaskController::class);
    // Добавьте другие маршруты для менеджера
});

// Если нужно предоставить доступ к отдельным маршрутам без защиты middleware
Route::get('/departments/{id}', [DepartmentController::class, 'show'])->name('departments.show');
