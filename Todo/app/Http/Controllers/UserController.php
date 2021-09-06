<?php

namespace App\Http\Controllers;

use App\Http\Controllers\traits\Login;
use App\Http\Controllers\traits\Logout;
use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use Login;
    use Logout;

    public function index($offset = 0)
    {
        $total = User::query()->count();

        if ($offset % 3 != 0) {
            $offset = $offset - ($offset % 3);
        }
        if ($offset > $total) {
            return back();
        }

        $users = User::query()->limit(3)->offset($offset)->get();

        //return view('index', compact('users')); # Way 1
        return view('components.user.index')
            ->with('users', $users)
            ->with('title', 'users')
            ->with('message', session('message'))
            ->with('offset', $offset)
            ->with('total', $total); # Way 2
    }

    public function create()
    {
        return view('components.user.create')
            ->with('title', 'register');
    }

    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:64',
            'email' => 'required|email:rfc,dns',
            'password' => 'required|min:8'
        ]);

        $user = User::query()->create([
            'name' => $request->get('name', 'NO_NAME'),
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        Task::factory()->create([
            'title' => 'First task',
            'description' => 'This is your first task, a template task.',
            'is_done' => 0,
            'user_id' => $user->id
        ]);

        return redirect()
            ->route('login.page');
    }
}
