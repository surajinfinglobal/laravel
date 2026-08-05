<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Project;
use App\Models\Employee;
use App\Models\Contact;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{

   public function users(Request $request)
{
    $search = $request->search;
    $status = $request->status;
    $project = $request->project;

    $users = User::withCount('projects')
        ->where('email', '!=', 'admin@gmail.com')
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'LIKE', "%{$search}%")
                    ->orWhere('email', 'LIKE', "%{$search}%");
            });
        })
        ->when($status, function ($query) use ($status) {
            $query->where('status', $status == 'active' ? 1 : 0);
        })
        ->when($project, function ($query) use ($project) {
            $query->having('projects_count', '=', $project);
        })
        ->latest()
        ->paginate(5);

    return view('admin.users', compact('users'));
}

public function updateStatus(Request $request, User $user)
{
    $user->update([
        'status' => $user->status == 1 ? 0 : 1,
    ]);

    return redirect()->back()->with('success', 'Status updated successfully.');
}

//     public function users()
// {
//     $users = User::withCount('projects')projects
//         ->where('email', '!=', 'admin@gmail.com')
//         ->latest()
//         ->paginate(5);

//     return view('admin.users', compact('users'));
// }


    public function display_user(Request $request)
    {
        if ($request->ajax()) {
            $employees = Employee::all()->map(function ($employee) {
                // map function koi new value return karta hai 
                // get employee api path via api 
                $employee->img_url = asset('storage/contacts/' . $employee->img);
                return $employee;
            });

            return response()->json([
                'status' => true,
                'employees' => $employees
            ]);
        }

        return view('admin.users');
    }
    // display user project and message on admin side dashboard
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
    // dispaly contact us messages 
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
    // user login 
    public function login(Request $request)
    {

        $request->validate([

            'email' => 'required|email',

            'password' => 'required'

        ]);

        if (Auth::attempt([

            'email' => "admin@gmail.com",

            'password' => "admin123",

        ])) {

            return redirect()
                ->route('admin.dashboard');
        }

        return back()->withErrors([

            'email' => 'Invalid Admin Credentials'

        ]);
    }

    // log out user 
    public function logout()
    {
        Auth::logout();

        return redirect()->route('admin.login');
    }
    // delete user 
    public function destroy(User $user)
    {
        $user->delete();

        return redirect()->back()
            ->with('success', 'User deleted successfully.');
    }

    // delet profile users 
    public function move($id)
    {
        $user = Employee::find($id);
        if (!$user) {

            return response()->json([
                'status' => false,
                'message' => 'User not found.'
            ], 404);
        }

        $user->delete();

        return response()->json([
            'status' => true,
            'message' => 'User deleted successfully.'
        ]);
    }

    // update user
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'status' => 'required|boolean',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'status' => $request->status,
        ]);

        return redirect()->back()
            ->with('success', 'User updated successfully.');
    }

    // display porjects 
    public function projects()
    {
        return view('admin.projects');
    }

    // display contact page
    public function contact()
    {
        return view('admin.contact');
    }



    // user profile 
    public function index()
    {
        $employees = Employee::all();

        return view('admin.users', compact('employees'));
    }



    public function projectData()
    {
        $projects = Project::with('user')->orderBy('id', 'desc')->get();
        return response()->json($projects);
    }

    // title description and user name searching 
    public function searchProjects(Request $request)
    {
        $search = trim($request->search);
        $categories = $request->categories;
        $projects = Project::with('user')
            ->when($search, function ($query) use ($search) {
                // for searching title, description and user name
                $query->where('title', 'LIKE', "%{$search}%")
                    ->orWhere('description', 'LIKE', "%{$search}%")
                    ->orWhere('technology', 'LIKE', "%{$search}%")
                    ->orWhereHas('user', function ($q) use ($search) {
                        $q->where('name', 'LIKE', "%{$search}%");
                    });
            })
            //         $q->where('title', 'LIKE', "%{$search}%")
            //   ->orWhere('description', 'LIKE', "%{$search}%")
            //   ->orWhereHas('user', function ($subQ) use ($search) {
            //       $subQ->where('name', 'LIKE', "%{$search}%");
            //   })
            //   ->orWhereHas('technology', function ($subQ) use ($search) {
            //       // 'name' ko badal kar aap apni technology table ka column name dal sakte hain (jaise title, slug)
            //       $subQ->where('name', 'LIKE', "%{$search}%");
            //   });
            // for category filter
            ->when($categories, function ($query) use ($categories) {

                $query->whereIn('category', $categories);
            })

            ->latest()
            ->get();

        return response()->json($projects);
    }
}
