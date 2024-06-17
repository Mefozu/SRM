<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

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
        return view('admin.index', compact('users'));
    }

    // Метод для назначения отдела пользователю
    public function assignDepartment(Request $request, $id)
    {
        $user = User::find($id);
        $user->department = $request->input('department');
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Отдел назначен пользователю.');
    }

    // Метод для удаления пользователя
    public function deleteUser($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Пользователь удален.');
    }
}
