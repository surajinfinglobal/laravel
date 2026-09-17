<?php

namespace App\Http\Controllers;

use App\Mail\OtpMail;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cache;

class AuthController extends Controller
{
    public function showSignup()
    {
        return view('signup');
    }
    public function showLogin()
    {
        return view('login');
    }
    public function signup(Request $request)
    {

        // dd($request->all());
        $request->validate([
            'name' => 'required|min:3',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->back()->with(
            'success',
            'Account created successfully!'
        );
    }
    public function toggleStatus(User $user)
    {
        $user->status = !$user->status;

        $user->save();

        return back()->with('success', 'User status updated successfully.');
    }

    public function change()
    {

        $email = Auth::user()->email;
        return view('otp-verify', compact('email'));
    }


    public function send(Request $request)
    {
        $request->validate([
            'email' => 'required|email'
        ]);
        $email = $request->email;
        $otp = random_int(100000, 999999);
        // Store OTP in cache for 10 minutes
        Cache::put(
            'otp_' . $email,
            $otp,
            now()->addMinutes(10)
        );
        // Send email
        try {
            Mail::to($email)->send(new OtpMail($otp));
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to send OTP. Please try again.'
            ], 500);
        }
        return response()->json([
            'success' => true,
            'message' => 'OTP sent successfully',
            'otp' => $otp
        ]);
    }

    public function verify(Request $request)
    {
        $request->validate([
            'otp' => 'required|digits:6'
        ]);
        $email = Auth::user()->email ?? session('otp_email');
        $cachedOtp = Cache::get('otp_' . $email);
        // OTP nahi mila = expired
        if (!$cachedOtp) {
            return response()->json([
                'success' => false,
                'message' => 'OTP expired. Please request a new OTP.'
            ], 422);
        }

        if ($cachedOtp == $request->otp) {
            Cache::forget('otp_' . $email);
            session(['password_otp_verified' => true]);
            return response()->json([
                'success' => true,
                'message' => 'OTP verified successfully',
                'redirect' => route('password.reset')
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Invalid OTP. Please try again',
            ]);
        }
    }

    public function resetpassword()
    {
        return view('change-password');
    }


    public function changepassword(Request $request) {
         $request->validate([
            'current_password' => 'required|string',
            'password' => 'required|confirmed', // validates matching 'password_confirmation'
        ]);
        $user = Auth::user();
        if (!$user) {
            return
             response()->json(['success' => false, 'message' => 'Session expired. Please log in again.']);
        }
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'success' => false, 
                'message' => 'Aapka current password galat hai.'
            ], 422);
        }
         $user->password = Hash::make($request->password);
          /** @var \App\Models\User $user */
         $user->save();
         return response()->json([
            'success' => true,
            'message' => 'Password successfully change ho gaya hai!',
            'redirect' => url('/') 
        ]);


    }
        
    
}
