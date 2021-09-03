<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index($id = -1)
    {
        if($id == -1)
        {
            $id = Auth::id();
        }
        $tasks = Task::query()->where('user_id', '=', $id)->get();
        return view('components/task/task')
            ->with('tasks', $tasks)
            ->with('status', session('status'))
            ->with('title', 'task');
    }

    public function create()
    {
        $users = User::all();
        return view('components/task/task_create')
            ->with('users', $users)
            ->with('title', 'task - create');
    }

    public function store(Request $request)
    {
        $task = Task::query()->create($request->all());
        return redirect()
            ->route('task.index')
            ->with('status', (bool)$task);
    }

    public function show($id)
    {
        return Task::query()->findOrFail($id);
    }
}
