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

    public function myproject(){
// particular user ke kitne project hai vo display karne ke liye 
       $total = Project::where('user_id', Auth::id())->count();
        return view('myproject',compact('total'));
    }
// for ajax to display log in users project
    public function myProjectData(){
        $projects = Project::with('user')
        ->where('user_id', Auth::id())
        ->latest()
        ->get();

    return response()->json($projects);
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
    // app/Http/Controllers/ProjectController.php

public function userindex(Request $request)
{
   $query = Project::with('user')
        ->where('is_published', 1)
        ->latest();

    // Category Filter
    if ($request->filled('category')) {
        $query->where('category', $request->category);
    }

    // Search
    if ($request->filled('q')) {
        $q = $request->q;

        $query->where(function ($qb) use ($q) {

            $qb->where('title', 'like', "%{$q}%")
                ->orWhere('description', 'like', "%{$q}%")
                ->orWhere('technology', 'like', "%{$q}%");

        });
    }

    $totalProjects = (clone $query)->count();

    $projects = $query->get();

    // Logged-in user plan
    $userPlan = Auth::check()
        ? Auth::user()->plan
        : 'free';

    return view('projects', compact(
        'projects',
        'totalProjects',
        'userPlan'
    ));
}

public function usershow($id)
{
    $project = Project::with('user')->findOrFail($id);
    return view('project-show', compact('project'));
}

public function updatePublishStatus(Request $request, $id)
{
    $request->validate([
        'is_published' => 'required|boolean',
    ]);
    $project = Project::findOrFail($id);
    $project->update([
        'is_published' => $request->is_published,
    ]);
    return response()->json([
        'success' => true,
        'message' => 'Publish status updated successfully.'
    ]);
}
public function updateVisibility(Request $request, $id)
{
    $request->validate([
        'visibility' => 'required|in:free,premium',
    ]);
    $project = Project::findOrFail($id);
    $project->update([
        'visibility' => $request->visibility,
    ]);
    return response()->json([
        'success' => true,
        'message' => 'Visibility updated successfully.',
        'visibility' => $project->visibility,
    ]);
}
}
