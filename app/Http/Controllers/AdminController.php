<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (!Auth::user()->is_admin) {
                return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
            }
            return $next($request);
        });
    }

    // Метод для отображения всех пользователей
    public function index()
    {
        $users = User::all();
        $departments = Department::all();

        return view('admin.index', compact('users', 'departments'));
    }

    // Метод для назначения отдела пользователю
    public function assignDepartment(Request $request, $userId)

    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);

        $user = User::findOrFail($userId);
        $user->department_id = $request->input('department_id');
        $user->save();

        return redirect()->back()->with('success', 'Отдел успешно назначен пользователю.');
    }

    // Метод для удаления пользователя
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Пользователь удален.');
    }
    public function assignManagerRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = 'manager'; // Устанавливаем роль "менеджер"
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Роль менеджера успешно назначена пользователю.');
    }
}
