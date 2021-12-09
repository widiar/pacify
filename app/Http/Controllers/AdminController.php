<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);
        $user = User::where('username', $request->username)->first();
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            if ($user && $user->role == 1)
                return redirect()->route('admin.dashboard');
        }
        return redirect()->route('admin.login')->with('status', 'Username atau Password anda salah')->withInput();
    }
}
