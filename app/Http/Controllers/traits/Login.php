<?php

namespace App\Http\Controllers\traits;

use Illuminate\Support\Facades\Auth;

trait Login
{
    public function login(\Illuminate\Http\Request $request): \Illuminate\Http\RedirectResponse
    {
        $data = $request->only(['email', 'password']);
        if (Auth::attempt($data))
        {
            return redirect()
                ->route('user.index');
        } else {
            return redirect()
                ->route('login.page');
        }
    }
}
