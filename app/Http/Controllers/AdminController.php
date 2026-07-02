<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
     public function users()
    {
        $users = User::withCount('projects')->where('email', '!=', 'admin@gmail.com')->latest()->paginate(5);
        return view(
            'admin.users',
            compact('users')
        );
    }

    public function dashboard()
{
    $users = User::withCount('projects')->where('email', '!=', 'admin@gmail.com')
                 ->count();

    $messages = Contact::count();

    $projects = Project::count();

    return view('admin.dashboard', compact(
        'users',
        'messages',
        'projects'
    ));
}

public function messages()
{
    // $contacts = Contact::latest()->paginate(10);
   $contacts = Contact::latest()->paginate(5);

    return view('admin.messages', compact('contacts'));
}



public function showLogin()
{
    return view('admin.login');
}

public function login(Request $request)
{

    $request->validate([

        'email'=>'required|email',

        'password'=>'required'

    ]);

    if(Auth::attempt([

        'email'=>"admin@gmail.com",

        'password'=>"admin123",

    ])){

        return redirect()
                ->route('admin.dashboard');

    }

    return back()->withErrors([

        'email'=>'Invalid Admin Credentials'

    ]);
    

}
public function logout()
{
    Auth::logout();

    return redirect()->route('admin.login');
}
}
