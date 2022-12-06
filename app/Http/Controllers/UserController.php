<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function registerPage()
    {
        return view('auth.register');
    }

    public function store()
    {
        $attributes = request()->validate([
            'username' => 'required|min:3|max:20|unique:users,username|regex:/^[a-zA-Z0-9]+$/u',
            'email' => 'required|email|max:255|unique:users,email',
            'password' => 'required|min:5'
        ]);

        $attributes['password'] = bcrypt($attributes['password']);
        $attributes['rights'] = 'user';

        $user = User::create($attributes);

        auth()->login($user);

        return redirect('home');
    }

    public function loginPage()
    {
        return view('auth.login');
    }

    public function login()
    {
        $attributes = request()->validate([
            'username' => 'required|exists:users,username',
            'password' => 'required'
        ]);

        if (auth()->attempt($attributes)) {
            return redirect('home');
        }
    }

    public function logout()
    {
        auth()->logout();

        return view('auth.login');
    }
}
