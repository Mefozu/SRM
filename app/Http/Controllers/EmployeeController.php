<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::with('department')->get();
        return view('employees.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = User::with('department')->findOrFail($id);
        $tasks = Task::where('assigned_to', $id)->get();
        return view('employees.show', compact('employee', 'tasks'));
    }
    public function assignDepartment(Request $request, $userId)
    {
        $user = User::find($userId);
        $user->department_id = $request->input('department_id');
        $user->save();

        return redirect()->back()->with('success', 'Отдел назначен');
    }
}
