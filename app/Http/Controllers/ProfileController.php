<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Absence;

class ProfileController extends Controller
{
    public function show()
    {
        $user = User::find(auth()->id());
        $absences = Absence::where('user_id', $user->id)->get();

        if (!$user) {
            abort(404); // Обработка случая, если пользователь не найден
        }

        $tasks = $user->tasks()->get(); // Получение всех задач пользователя

        $completedTasks = $tasks->filter(function ($task) {
            return $task->is_completed; // Предположим, что у задачи есть поле is_completed
        });

        return view('profile.show', compact('user', 'tasks', 'completedTasks', 'absences'));
    }

    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'passport_number' => 'nullable|string|max:255',
            'phone_number' => 'nullable|string|max:255',
            'age' => 'nullable|integer|min:0',
            'gender' => 'nullable|string|max:10',
            'department' => 'nullable|string|max:255',
            'position' => 'nullable|string|max:255',
        ]);

        $user->update($request->only('passport_number', 'phone_number', 'age', 'gender', 'department', 'position'));

        return redirect()->route('profile.show')->with('success', 'Profile updated successfully.');
    }
}
