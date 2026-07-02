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
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;

// Admin Authentication
Route::get('/admin', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'login'])->name('admin.login.store');

// Protected Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {
    
    Route::post('logout', [AdminController::class, 'logout'])
    ->name('admin.logout');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])
        ->name('admin.users');

    Route::get('/messages', [AdminController::class, 'messages'])
        ->name('admin.messages');
    Route::patch('/users/{user}/status',[AuthController::class,'toggleStatus'])
    ->name('users.toggleStatus');
});

Route::get('/', [HomeController::class, 'index']);


Route::middleware('auth')->group(function () {
        Route::view('/projects/upload-success', 'projects.success')
    ->name('projects.success');
    
    Route::get('/projects/create', [ProjectController::class, 'create'])
    ->name('projects.create');

    Route::post('/projects/store', [ProjectController::class, 'store'])
    ->name('projects.store');
});
Route::prefix('home')->group(function () {


    Route::middleware('auth')->group(function () {
        // ye line routs ko protect karne ke liye use hui hai is function ke andar jitne routs honge vo witout log in access nahi honge 
    
    // Route::get('/welcome/{name}', [HomeController::class, 'welcome']);
    Route::get('/welcome', [HomeController::class, 'welcome']);



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

    Route::get('/about', [HomeController::class, 'about']);
   
    // Route::get('/contact',[HomeController::class,'contact']);

    Route::get('/signup', [AuthController::class,'showSignup'])
        ->name('signup');

    Route::post('/signup', [AuthController::class, 'signup'])
        ->name('signup.store');
});