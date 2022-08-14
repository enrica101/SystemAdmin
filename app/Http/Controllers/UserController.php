<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    //Register/Create Form
    public function create(){
        return view('register');
    }

    // Create New User
    public function store(Request $request){
        $formInputs = $request->validate([
            'firstName' => ['required', 'min:3'],
            'lastName' => ['required', 'min:3'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6']
        ]);

        // Hash Password
        $formInputs['password'] = bcrypt($formInputs['password']);

        // Create USer
        $user = User::create($formInputs);

        // Login
        auth()->login($user);

        return redirect('dashboard');
    }

    // Logout
    public function logout(Request $request){
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }

    // Show Login Form
    public function login(){
        return view('login');
    }

    // Authenticate User
    public function authenticate(Request $request){
        $formInputs = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);

        if(auth()->attempt($formInputs)){
            $request->session()->regenerate();

            return redirect('dashboard');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

}
