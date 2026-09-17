<?php

namespace App\Http\Controllers;

use App\Models\Invoice;
use App\Models\Project;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
          $totalUsers = User::count();
         $totalProjects = Project::count();

         $phpProjects = Project::where('category', 'PHP')->count();
         $laravelProjects = Project::where('category', 'Laravel')->count();
         $uiuxProjects = Project::where('category', 'UI/UX Design')->count();
         $webProjects = Project::where('category', 'Web Development')->count();

         $mlProjects = Project::where('category', 'Machine Learning')->count();
         $mobileProjects = Project::where('category', 'Mobile App')->count();
         $reactProjects = Project::where('category', 'React')->count();
         $flutterProjects = Project::where('category', 'Flutter')->count();
        
         return view('app', compact('totalUsers', 'totalProjects', 'uiuxProjects', 'phpProjects',
          'laravelProjects', 'webProjects', 'mlProjects', 'mobileProjects', 'reactProjects','flutterProjects'));
    }

    public function welcome()
    {
        return view('welcome');
    }

    public function about()
    {
        return view('about');
    }

    public function project()
    {
          $projects = Project::with('user')
        ->latest()
        ->get();

    return view('project', compact('projects'));
    }
    
    public function pricing()
    {

        $user = Auth::user();
        $amount = Invoice::where('user_id', $user->id)->latest('id')->value('amount'); 
        $membershipStatus = $user ? $user->plan : null;
        return view('pricing', compact('membershipStatus','amount'));
    }
    public function signup()
    {
        return view('signup');
    }

    public function contact()
    {
        return view('contact');
    }
}