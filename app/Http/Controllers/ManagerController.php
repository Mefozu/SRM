<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Task;
use App\Models\Absence;
use Illuminate\Support\Facades\Auth;

class ManagerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware(function ($request, $next) {
            if (auth()->user()->role != 'manager') {
                return redirect('/')->with('error', 'У вас нет доступа к этой странице.');
            }
            return $next($request);
        });
    }

    public function index()
    {
        $tasks = Task::where('assigned_to', auth()->id())->get();
        return view('manager.index', compact('tasks'));
    }

    public function create()
    {
        return view('manager.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
            'assigned_to' => 'required|integer|exists:users,id',
        ]);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'due_date' => $request->due_date,
            'assigned_to' => $request->assigned_to,
            'created_by' => auth()->id(),
        ]);

        return redirect()->route('manager.index')->with('success', 'Задача успешно создана.');
    }

    public function show(Task $task)
    {
        return view('manager.show', compact('task'));
    }

    public function edit(Task $task)
    {
        return view('manager.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'due_date' => 'required|date',
        ]);

        $task->update($request->only(['title', 'description', 'due_date']));

        return redirect()->route('manager.index')->with('success', 'Задача успешно обновлена.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('manager.index')->with('success', 'Задача успешно удалена.');
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

    public function reviewTasks()
    {
        $tasks = Task::where('reviewer_id', auth()->id())->where('status', 'in_review')->get();
        return view('manager.review_tasks', compact('tasks'));
    }

    public function approve($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->status = 'completed';
        $task->completed_at = now();
        $task->save();

        return redirect()->back()->with('success', 'Задача одобрена и завершена.');
    }

    public function reject($taskId)
    {
        $task = Task::findOrFail($taskId);
        $task->status = 'rejected';
        $task->save();

        return redirect()->back()->with('error', 'Задача отклонена.');
    }
    public function createHooky(Request $request, $userId)
    {
        $request->validate([
            'date' => 'required|date',
        ]);

        Absence::create([
            'user_id' => $userId,
            'date' => $request->date,
            'type' => 'absent',
        ]);

        return redirect()->back()->with('success', 'Прогул успешно отмечен');
    }

}
