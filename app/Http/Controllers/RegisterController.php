<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function create()
    {
        return view('register.create');
    }

    public function store()
    {
        $attributes = request()->validate([
            'name' => 'required|min:3|max:255',
            'username' => 'required|alpha_dash|min:6|max:255|unique:users,username',
            // 'username' => ['required', 'alpha_dash', 'min:6', 'max:255', Rule::unique('users', 'username') ],
            'email' => 'required|email|max:255|unique:users,email',
            // 'password' => 'required|min:8|max:255'
            'password' => ['required', 'min:8', 'max:255'],
            'remember_token' => Str::random(10),
        ]);

        User::create($attributes);

        // session()->flash('success', 'Your account has been created.');

        return redirect('/')->with('success', 'Your account has been created.');
    }   
}
