<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function login()
    {
        return view('frontend.login');
    }

    public function registration()
    {
        return view('frontend.registration');
    }
    public function postRegistration(Request $req)
    {
        $validated = $req->validate([
            'name' => 'required|string|min:3',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
           ]);
           $createUser = $this->create($validated);
           return redirect('admin')->with('success','User register successfully');
        // dd($req->all());
    }
    public function postLogin(Request $req)
    {
        $req->validate([
            'email' => 'required|email',
            'password' => 'required|min:6'
           ]);
        $checkLogin = $req->only('email','password');
        if(Auth::attempt($checkLogin)){
            return redirect('home');
        }
        return redirect('admin')->with('error','Your login credentials are incorrect');
        //    dd($req->all());
    }
    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }
    public function logout( Request $req)
    {
        Session::flush();
        Auth::logout();
        return redirect('admin');
    }
}

