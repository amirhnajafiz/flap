<?php

namespace App\Http\Controllers\traits;

use Illuminate\Support\Facades\Auth;

trait Login
{
    public function login(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $validate = $request->validate([
            'email' => 'required|max:128',
            'password' => 'required|max:128'
        ]);
        $data = $request->only(['email', 'password']);
        if (Auth::attempt($data))
        {
            return redirect()
                ->route('user.index')
                ->with('message', 'Logged in successfully.');
        } else {
            return back()
                ->with('message', 'Email and password match failed.');
        }
    }
}
