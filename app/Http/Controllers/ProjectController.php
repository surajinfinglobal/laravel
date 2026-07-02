<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Facades\Auth;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::latest()->get();

        return view('projects.index', compact('projects'));
    }

    public function create()
    {
        return view('projects.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'category'=>'required',
            'image'=>'required|image|mimes:jpg,jpeg,png|max:2048',
            'github'=>'nullable|url',
            'demo'=>'nullable|url',
            'technology'=>'required',
            'description'=>'required',
            'status'=>'required'
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('uploads/projects'),$imageName);

        Project::create([
            'user_id' => Auth::id(),

            'title'=>$request->title,

            'category'=>$request->category,

            'image'=>$imageName,

            'github'=>$request->github,

            'demo'=>$request->demo,

            'technology'=>$request->technology,

            'description'=>$request->description,

            'status'=>$request->status,

        ]);

        return view('projects.success');
    }
}
