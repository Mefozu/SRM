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

    public function employees($department_id)
    {
        $department = Department::with('manager', 'users')->findOrFail($department_id);
        return view('departments.employees', compact('department'));
    }

    public function show($id)
    {
        $department = Department::with('manager', 'users')->findOrFail($id);
        return view('departments.employees', compact('department'));
    }

    // Другие методы для редактирования и удаления отделов
}
