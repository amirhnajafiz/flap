<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query()->where($request->get('id', 1))->get();
        return view('index')
            ->with('tasks', $tasks);
    }

    public function create()
    {
        return view('index');
    }

    public function store(Request $request)
    {
        $task = Task::query()->create($request->all());
        return redirect('task.index')
            ->with('status', 'OK');
    }
}
