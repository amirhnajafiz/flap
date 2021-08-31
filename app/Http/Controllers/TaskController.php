<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Task::query()->join('users', 'users.id', '=', 'tasks.user_id')
            ->orderBy('tasks.updated_at')->get();
        return view('components/task/task')
            ->with('tasks', $tasks)
            ->with('status', session('status'));
    }

    public function create()
    {
        $users = User::all();
        return view('components/task/task_create')
            ->with('users', $users);
    }

    public function store(Request $request)
    {
        $task = Task::query()->create($request->all());
        return redirect()
            ->route('task.index')
            ->with('status', (bool)$task);
    }
}
