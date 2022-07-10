<?php

namespace App\Http\Controllers;

use App\Models\User;
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
            'name' => 'required|max:255',
            'username' => 'required|min:6|max:255',
            'email' => 'required|email|max:255',
            // 'password' => 'required|min:8|max:255'
            'password' => ['required', 'min:8', 'max:255'],
            'remember_token' => Str::random(10),
        ]);

        User::create($attributes);

        return redirect('/');
    }   
}
