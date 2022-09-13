<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Foundation\Auth\User;



class UserController extends Controller
{
    //Show Register/Create Form
    public function create()
    {
        return view('users.register');
    }

    //Create New User
    public function store(Request $request){
        $formFields = $request->validate([
            'name' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            //confirmed matches the name of every name that has _confirmation in it
            //npr. password_confirmation
            'password' => 'required|confirmed|min:6'
        ]);

        // Hash Password
        $formFields['password'] = bcrypt($formFields['password']);

        // Create User and Automaticly Log In
        // Create User
        $user = User::create($formFields);

        // Log In User
        auth()->login($user);

        // Redirect
        return redirect('/')->with('message', 'Korisnik stvoren i prijavljen!');
    }

    // Logout User
    public function logout(Request $request){
        auth()->logout();

        // Validate user
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Odjava uspješna!');
    }

    // Show Login Form
    public function login(){
        return view('users/login');
    }

    // Authenticate User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email' => ['required', 'email'],
            'password' => 'required'
        ]);

        // Attempt to Log the User In
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Prijava uspješna!');

        }
        return back()->withErrors(['email' => 'Neispravni podatci'])->onlyInput('email');
    }
}
