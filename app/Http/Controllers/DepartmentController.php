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

    public function show($id)
    {
        $department = Department::findOrFail($id);
        $employees = User::where('department', $department->name)->get();
        return view('departments.show', compact('department'));
    }
}
