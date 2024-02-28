<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function login(){
        if(Auth::check()){
            return redirect()->route('product.index');
        }
        return view('auth.login');
    }

    public function post(Request $request){
        $credentials = [
            'username' => $request->username,
            'password' => $request->password
        ];

        if(Auth::attempt($credentials)){
            return redirect()->route('product.index');
        }
        return back()->with('error', 'Incorrect User User Name or Password');
    }

    public function register(){
        if(Auth::check()){
            return redirect()->route('product.index');
        }
        return view('auth.register');
    }

    public function postRegister(Request $request){
        $check_email = User::where('email', $request->email)->first();
        if($check_email){
            return back()->with('error', 'Email already in use');
        }

        $user = User::create([
            'username' => $request->username,
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $credentials = [
            'username' => $user->username,
            'password' => $request->password,
        ];

        Auth::attempt($credentials);

        return redirect()->route('profile.index')->with('success', 'Congratulations, your account can be used! After exiting, Login using User ID and Password');
    }

    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }
}
