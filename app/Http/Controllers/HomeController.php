<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('app');
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
        return view('project');
    }
    
    public function pricing()
    {
        return view('pricing');
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