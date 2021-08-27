<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query()->where('user_id', $request->get('id', 1))->get();
        return view('task')
            ->with('tasks', $tasks);
    }

    public function create()
    {
        return view('task_create');
    }

    public function store(Request $request)
    {
        $task = Task::query()->create($request->all());
        return redirect()
            ->route('task.create')
            ->with('status', 'OK');
    }
}
