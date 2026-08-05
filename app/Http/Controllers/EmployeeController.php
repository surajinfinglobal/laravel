<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;   
class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
   public function store(Request $request)
{

// dd($request->all());
 $validator = Validator::make($request->all(), [
    // pure array mein validation karne ke liye 
        'first_name' => 'required|array',
        'first_name.*' => 'required|string|min:3',

        'last_name' => 'required|array',
        'last_name.*' => 'required|string|min:3',

        'designation' => 'required|array',
        'designation.*' => 'required|string',

        'email' => 'required|array',
        'email.*' => 'required|email',

        'phone' => 'required|array',
        'phone.*' => 'required|numeric|digits:10',
        'image' => 'required|array',
        'image.*' => 'required|image|mimes:jpg,jpeg,png|max:2048',
    ],
    [
        // custome message likhne ke liye 
         'first_name.*.required' => 'First Name is required.',
         'first_name.*.string'   => 'First Name must be text.',
          'last_name.*.required' => 'Last Name is required.',
         'last_name.*.string'   => 'Last Name must be text.',
          'designation.*.required' => 'Designation is required.',
        'designation.*.min'      => 'Designation must be at least 2 characters.',
         'email.*.required' => 'Email is required.',
        'email.*.email'    => 'Please enter a valid email address.',
        'phone.*.required' => 'Phone Number is required.',
        'phone.*.digits'   => 'Phone Number must be exactly 10 digits.',
        'phone.*.numeric'   => 'Phone Number must be numeric.',
        'image.required' => 'Please select at least one image.',
    ]);
    
    if($validator->fails()){
    return response()->json([
        'status'=>false,
        'errors'=>$validator->errors()

    ],422);

}
      foreach ($request->first_name as $key => $value) {

        $imagePath = null;
        $justFileName = null;
        if ($request->hasFile("image.$key")) {
            $image = $request->file("image.$key");
            $filename = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
            // store() ki jagah storeAs() ka use 
            $imagePath = $image->storeAs('contacts', $filename, 'public');
            $justFileName = basename($imagePath);
        }

        Employee::create([

            'first_name'  => $request->first_name[$key],
            'last_name'   => $request->last_name[$key],
            'designation' => $request->designation[$key],
            'email'       => $request->email[$key],
            'phone'       => $request->phone[$key],
            'img'       => $justFileName,

        ]);
    }

    return response()->json([
        
        'status' => true,
        'message' => 'All Employees Saved Successfully'
    ]);

    }
  
}

    /**
     * Display the specified resource.
     */
   
    /**
     * Show the form for editing the specified resource.
     */

