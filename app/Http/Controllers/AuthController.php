<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $rules = [
            'username' => 'required|unique:users',
            'email' => 'email|required|unique:users',
            'password' => 'required|same:password2|min:8',
            'password2' => 'required'
        ];
        $valid = Validator::make($request->all(), $rules);

        if ($valid->fails()) {
            return redirect()->route('login')->withFragment('register')->withErrors($valid)->withInput();
        }

        User::create([
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Berhasil Daftar');
    }

    public function login(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        $cre = [
            'username' => $request->username,
            'password' => $request->password
        ];
        if (Auth::attempt($cre)) {
            // if ($user && $user->role == 1) {
            //     return redirect()->route('admin.dashboard');
            // } else 
            if ($user) {
                return redirect()->route('home');
            }
        } else {
            return redirect()->route('login')->with('error', 'Username atau Password anda salah');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('home');
    }
}
