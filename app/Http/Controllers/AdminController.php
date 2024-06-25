<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;
use App\Models\Task;
use App\Models\Absence;

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

    // Метод для отображения всех пользователей и задач
    public function index()
    {
        $users = User::with('department')->get();
        $departments = Department::all();
        $managers = User::where('role', 'manager')->get();
        $tasks = Task::all();

        \Log::info('Users:', $users->toArray());
        \Log::info('Departments:', $departments->toArray());
        \Log::info('Managers:', $managers->toArray());

        return view('admin.index', compact('users', 'departments', 'managers', 'tasks'));
    }

    // Метод для назначения отдела пользователю
    public function assignDepartment(Request $request, $userId)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
        ]);

        $user = User::find($userId);
        $user->department_id = $request->input('department_id');
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Отдел успешно назначен пользователю.');
    }

    // Метод для удаления пользователя
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'Пользователь удален.');
    }
    public function deleteManager($id)
    {
        // Получить количество менеджеров
        $managersCount = User::where('role', 'manager')->count();

        if ($managersCount <= 1) {
            return redirect()->route('admin.index')->with('error', 'Невозможно удалить последнего менеджера.');
        }

        // Найти пользователя и удалить его, если он менеджер
        $user = User::findOrFail($id);
        if ($user->role == 'manager') {
            $user->delete();
            return redirect()->route('admin.index')->with('success', 'Менеджер успешно удален.');
        }

        return redirect()->route('admin.index')->with('error', 'Пользователь не найден или не является менеджером.');
    }

    // Метод для назначения роли менеджера
    public function assignManagerRole(Request $request, $id)
    {
        $user = User::findOrFail($id);
        $user->role = 'manager'; // Устанавливаем роль "менеджер"
        $user->save();

        return redirect()->route('admin.index')->with('success', 'Роль менеджера успешно назначена пользователю.');
    }

    // Метод для назначения менеджера отделу
    public function assignManagerToDepartment()
    {
        $departments = Department::all();
        $users = User::all(); // Получаем всех пользователей

        return view('admin.index', compact('departments', 'users'));
    }

    // Метод для сохранения назначения менеджера отделу
    public function storeManagerToDepartment(Request $request)
    {
        $request->validate([
            'department_id' => 'required|exists:departments,id',
            'manager_id' => 'required|exists:users,id',
        ]);

        $department = Department::findOrFail($request->department_id);
        $department->manager_id = $request->manager_id;

        // Назначаем пользователя менеджером
        $manager = User::findOrFail($request->manager_id);
        $manager->role = 'manager';
        $manager->save();

        $department->save();

        return redirect()->back()->with('success', 'Manager assigned to department successfully');
    }

    // Методы для управления задачами
    public function createTask()
    {
        return view('admin.create_task');
    }

    public function storeTask(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        Task::create([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.index')->with('success', 'Task created successfully.');
    }

    public function editTask($id)
    {
        $task = Task::findOrFail($id);
        return view('admin.edit_task', compact('task'));
    }

    public function updateTask(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $task = Task::findOrFail($id);
        $task->update([
            'title' => $request->input('title'),
            'description' => $request->input('description'),
        ]);

        return redirect()->route('admin.index')->with('success', 'Task updated successfully.');
    }

    public function destroyTask($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return redirect()->route('admin.index')->with('success', 'Task deleted successfully.');
    }

    public function createAbsence(Request $request, $userId)
    {
        \Log::info('createAbsence called with userId: ' . $userId);

        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date',
            'type' => 'required|in:sick,absent',
        ]);

        \Log::info('Validation passed');

        Absence::create([
            'user_id' => $userId,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'type' => $request->type,
        ]);

        \Log::info('Absence created successfully');

        return redirect()->back()->with('success', 'Absence recorded successfully');
    }
}
