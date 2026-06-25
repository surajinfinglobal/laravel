<?php

// use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('home');
// });
// Route::get('/welcome', function () {
//     return view('welcome');
// });
// Route::get('/project', function () {
//     return view('project');
// });


// Route:: get('aboutus',function(){
//     return view('about');
// });


// this is a group routes 
// Route::get('/', function () {
//     return view('home');
// });
// Route::prefix('home')->group(function () {

//     Route::get('/welcome', function () {
//         return view('welcome');
//     });

//     Route::get('/about', function () {
//         return view('about');
//     });

//     Route::get('/project', function () {
//         return view('project');
//     });

// });

use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;

Route::get('/', [HomeController::class, 'index']);

Route::prefix('home')->group(function () {


    Route::middleware('auth')->group(function () {
        // ye line routs ko protect karne ke liye use hui hai is function ke andar jitne routs honge vo witout log in access nahi honge 
    
    // Route::get('/welcome/{name}', [HomeController::class, 'welcome']);
    Route::get('/welcome', [HomeController::class, 'welcome']);

    Route::get('/about', [HomeController::class, 'about']);

    Route::get('/project', [HomeController::class, 'project']);

    Route::get('/pricing',[HomeController::class,'pricing']);

    Route::get('/contact',[HomeController::class,'contact']);

    Route::get('admin/messages',[ContactController::class,'index'])
        ->name('messages');

    Route::post('/home/contact/store',[ContactController::class,'store'])
           ->name('contact.store');
    
    });
    
// ye sare routs without log in access ho jayenge 
    Route::post('/login',[LoginController::class,'login'])
    ->name('login');

    Route::get('/login',[LoginController::class,'showlogin'])
    ->name('login.store');
    
    Route::post('/logout', [LogoutController::class,'logout'])
    ->name('logout');

   
    // Route::get('/contact',[HomeController::class,'contact']);

    Route::get('/signup', [AuthController::class,'showSignup'])
        ->name('signup');

    Route::post('/signup', [AuthController::class, 'signup'])
        ->name('signup.store');
});