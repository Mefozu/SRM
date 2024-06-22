<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\User;

class DepartmentController extends Controller
{
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    public function create()
    {
        return view('departments.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:departments',
        ]);

        $department = Department::create([
            'name' => $request->name,
        ]);

        return redirect()->route('departments.employees', $department->id)->with('success', 'Отдел успешно создан.');
    }
    public function employees(Department $department)
    {
        $employees = User::where('department', $department->id)->get();

        return view('departments.employees', compact('department', 'employees'));
    }

    // Другие методы для редактирования и удаления отделов
}
