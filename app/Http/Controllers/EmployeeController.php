<?php

// app/Http/Controllers/EmployeeController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;

class EmployeeController extends Controller
{
    public function index()
    {
        $employees = User::all();
        return view('employees.index', compact('employees'));
    }

    public function show($id)
    {
        $employee = User::findOrFail($id);
        $tasks = Task::where('assigned_to', $id)->get();
        return view('employees.show', compact('employee', 'tasks'));
    }

    // Другие методы контроллера
}
