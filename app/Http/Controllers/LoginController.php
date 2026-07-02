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

        // select status from users where email = 'requested email';
        $user = User::where('email', $request->email)->first();
        if ($user && $user->status == 1) {
            if (Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ])) {
                return redirect('/home/welcome')
                    ->with('success', 'Login Successful!');
            } else {
                return back()->with(
                    'error',
                    'Invalid Email or Password'
                );
            }
            // redirect to welcome page

            // login failed 
        } else {
            // redirect back with error message
            return back()->with(
                'error',
                'Your account has been deactivated by the administrator.'
            );
        } 
    }
}
