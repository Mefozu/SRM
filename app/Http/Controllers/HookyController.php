<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hooky;

class HookyController extends Controller
{
    public function create(Request $request, $userId)
    {
        \Log::info('Hooky request data:', $request->all()); // Добавлено логирование

        $request->validate([
            'date' => 'required|date',
        ]);

        Hooky::create([
            'user_id' => $userId,
            'date' => $request->date,
        ]);

        return redirect()->back()->with('success', 'Hooky recorded successfully');
    }
}
