<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    // show create/register from
    public function create() {
        return view('users.register');
    }

    public function store(Request $request) {

        $formData = $request->validate([
            'name' => ['required', 'min:3'],
            'password' => ['required', 'confirmed', 'min:6'],
            'email' => ['required', 'email', Rule::unique('users', 'email')],
        ]);

        //hash password
        $formData['password'] = bcrypt($formData['password']);

        //create user
        $user = User::create($formData);

        //login
        auth()->login($user);

        return redirect('/')->with('message', 'User created and logged in!');
    }

    //logout
    public function logout(Request $request){
        auth()->logout();

        //regenerate token
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('message', 'Logged out!');
    }

    // Show Login Form
    public function login() {
        return view('users.login');
    }

    //authenticate
    public function authenticate(Request $request){
        $formData = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        if(auth()->attempt($formData)){
            $request->session()->regenerate();

            return redirect('/')->with('message', 'Welcome ' . auth()->user()->name . '!');

        }else{

            return back()->withErrors(
                ['email'=> 'Invalid Credentials']
            );
        }
    }
}
