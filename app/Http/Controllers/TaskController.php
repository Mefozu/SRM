<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Department;
use App\Models\Task;
use Illuminate\Support\Facades\Log;

class TaskController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Получение всех пользователей и отделов
        $users = User::all();
        $departments = Department::all();

        // Задачи, назначенные текущему пользователю
        $tasks = Task::where('assigned_to', $user->id)
            ->where('status', '!=', 'completed')
            ->where('is_additional', false)
            ->with(['assignedTo', 'creator'])
            ->get();

        // Дополнительные задачи, назначенные текущему пользователю
        $additionalTasks = Task::where('assigned_to', $user->id)
            ->where('status', '!=', 'completed')
            ->where('is_additional', true)
            ->with(['assignedTo', 'creator'])
            ->get();

        Log::info('Tasks retrieved for user:', ['user_id' => $user->id, 'tasks' => $tasks, 'additionalTasks' => $additionalTasks]);

        return view('tasks.index', compact('tasks', 'additionalTasks', 'users', 'departments'));
    }

    public function show(Task $task)
    {
        $user = Auth::user();

        // Проверка, что задача назначена текущему пользователю
        if ($task->assigned_to !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        return view('tasks.show', compact('task'));
    }

    public function create()
    {
        $users = User::all();
        $departments = Department::all();
        return view('tasks.create', compact('users', 'departments'));
    }

    public function createAdditional()
    {
        $users = User::all();
        $departments = Department::all();
        return view('tasks.create_additional', compact('users', 'departments'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'nullable|string',
                'due_date' => 'required|date',
                'assigned_to' => 'required|integer|exists:users,id',
                'is_additional' => 'boolean',
            ]);

            Log::info('Task creation request:', $request->all());

            $taskData = [
                'title' => $request->title,
                'description' => $request->description,
                'due_date' => $request->due_date,
                'created_by' => auth()->id(),
                'status' => 'pending',
                'is_additional' => $request->has('is_additional') ? $request->is_additional : false,
                'assigned_to' => $request->assigned_to,
            ];

            $task = Task::create($taskData);
            Log::info('Task created:', $task->toArray());

            return redirect()->route('tasks.index')->with('success', 'Задача успешно создана.');
        } catch (\Exception $e) {
            Log::error('Error creating task:', ['message' => $e->getMessage(), 'stack' => $e->getTraceAsString()]);
            return redirect()->back()->with('error', 'Ошибка при создании задачи: ' . $e->getMessage());
        }
    }

    public function submitForReview($taskId)
    {
        $task = Task::findOrFail($taskId);
        $user = Auth::user();

        // Проверка, что задача назначена текущему пользователю
        if ($task->assigned_to !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $manager = User::where('role', 'manager')->first();

        if ($manager) {
            $task->status = 'in_review';
            $task->reviewer_id = $manager->id;
            $task->save();

            return redirect()->back()->with('success', 'Задача отправлена на проверку.');
        } else {
            return redirect()->back()->with('error', 'Нет доступных менеджеров для проверки задачи.');
        }
    }

    public function approve($taskId)
    {
        $task = Task::findOrFail($taskId);
        $user = Auth::user();

        // Проверка, что задача назначена текущему пользователю
        if ($task->assigned_to !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $task->status = 'completed';
        $task->completed_at = now();
        $task->save();

        return redirect()->back()->with('success', 'Задача одобрена и завершена.');
    }

    public function reject(Request $request, $taskId)
    {
        $request->validate([
            'reason' => 'required|string|max:255',
        ]);

        $task = Task::findOrFail($taskId);
        $user = Auth::user();

        // Проверка, что задача назначена текущему пользователю
        if ($task->assigned_to !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $task->status = 'rejected';
        $task->rejection_reason = $request->reason;
        $task->save();

        return redirect()->back()->with('error', 'Задача отклонена.');
    }

    public function reviewTasks()
    {
        $tasks = Task::where('reviewer_id', auth()->id())->where('status', 'in_review')->get();
        return view('manager.review_tasks', compact('tasks'));
    }

    public function destroy(Request $request)
    {
        $task = Task::findOrFail($request->task_id);
        $user = Auth::user();

        // Проверка, что задача назначена текущему пользователю
        if ($task->assigned_to !== $user->id) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Задача успешно удалена.');
    }

    public function showProfile()
    {
        $user = Auth::user();

        // Основные задачи, которые не завершены
        $tasks = Task::where('assigned_to', $user->id)
            ->where('status', '!=', 'completed')
            ->where('is_additional', false)
            ->with(['assignedTo', 'creator'])
            ->get();

        // Завершенные задачи
        $completedTasks = Task::where('assigned_to', $user->id)
            ->where('status', 'completed')
            ->where('is_additional', false)
            ->with(['assignedTo', 'creator'])
            ->get();

        // Дополнительные задачи
        $additionalTasks = Task::where('assigned_to', $user->id)
            ->where('is_additional', true)
            ->with(['assignedTo', 'creator'])
            ->get();

        Log::info('Tasks retrieved for user:', [
            'user_id' => $user->id,
            'tasks' => $tasks,
            'completedTasks' => $completedTasks,
            'additionalTasks' => $additionalTasks
        ]);

        return view('profile.show', compact('tasks', 'completedTasks', 'additionalTasks'));
    }
}
