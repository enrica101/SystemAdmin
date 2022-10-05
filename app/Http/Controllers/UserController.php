<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Traits\Date;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Auth\Events\Logout;

class UserController extends Controller
{
    //Register/Create Form
    public function create(){
        return view('register');
    }

    // Create New User
    public function store(Request $request, ){

        $formInputs = $request->validate([ 
            // 'uuid' => 'nullable',
            'accountType' => ['required'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
            'password' => ['required', 'confirmed', 'min:6'],
            'fname' => ['required', 'min:3'],
            'mname' => ['nullable', 'min:3'],
            'lname' => ['required', 'min:3'],
            'gender' => ['required'],
            'birthdate' => ['required'],
            'contactNumber' => ['nullable', 'regex:/^(09|\+639)\d{9}$/', 'max:13',  Rule::unique('users', 'contactNumber')],
            'avatar'  => 'nullable|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        // Hash Password
        $formInputs['password'] = bcrypt($formInputs['password']);
        
        if($request->hasFile('avatar')){
            $formInputs['avatar'] = $request->file('avatar')->store('avatars', 'public');
        }
        
        // Create User
        $user = User::create($formInputs);
        // Login
        auth()->login($user, true); 
        // $formInputs['uuid'] = Controller::generateID(auth()->user()->accountType, auth()->id());

        // $user->update($formInputs);
        
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

            return redirect('/dashboard');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    

}
