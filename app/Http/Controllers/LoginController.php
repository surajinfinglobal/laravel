<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

public function showLogin()
{
    return view('login');
}
    public function login(Request $request)
    {

    // dd($request->all());
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
             if(Auth::attempt([
        'email' => $request->email,
        'password' => $request->password
          ]))
          {

            return redirect('/home/welcome')
            ->with('success','Login Successful!');
        }
 return back()->with(
        'error',
        'Invalid Email or Password'
    );
       
    }
}