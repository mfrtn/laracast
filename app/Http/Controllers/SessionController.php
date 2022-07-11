<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class SessionController extends Controller
{
    public function create()
    {
        return view('sessions.create');
    }

    public function store()
    {
        // validate the requetr
        $attributes = request()->validate([
            'email' => 'required|email|max:255',
            'password' => ['required', 'min:8', 'max:255'],
        ]);

        // attempt to authenticate and log in the user based on the provided credentials
        if (auth()->attempt($attributes)){
            session()->regenerate();
            // redirect with a suscces flash message
            return redirect('/')->with('success', 'Welcome Back!');
        }

        // auth failed
        // first way
        // return back()
        //     ->withInput()
        //     ->withErrors(['erorrlogin' =>'Your provided credentials could not be verified.']);

        // second way
        throw ValidationException::withMessages([
            'erorrlogin' =>'Your provided credentials could not be verified.'
        ]);
    }
    public function destroy()
    {
        auth()->logout();

        return redirect('/')->with('success', 'Goodbye!');
    }
}
