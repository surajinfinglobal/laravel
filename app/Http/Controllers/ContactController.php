<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;



class ContactController extends Controller
{

            
        public function index()
        {
            $contacts = Contact::latest()->get();
             
            return view(
                'admin.messages',
                compact('contacts')
            );
        }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'subject' => 'required',
            'message' => 'required|min:10'
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        return redirect()
            ->back()
            ->with('success', 'Message sent successfully!');
    }
}