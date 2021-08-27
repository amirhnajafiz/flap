<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        if (session('user_id'))
            $tasks = Task::query()->where('user_id',session('user_id'))->get();
        else
            $tasks = [];
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
            ->route('task.index')
            ->with('user_id', $request->get('user_id'));
    }
}
