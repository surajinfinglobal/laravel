<?php


use App\Models\Project;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\PaymentController;

use Illuminate\Support\Facades\Route;

// Admin Authentication
Route::get('/admin', [AdminController::class, 'showLogin'])->name('admin.login');
Route::post('/admin', [AdminController::class, 'login'])->name('admin.login.store');

// Protected Admin Routes
Route::middleware('auth')->prefix('admin')->group(function () {

    Route::post('/logout', [AdminController::class, 'logout'])
        ->name('admin.logout');

    Route::get('/dashboard', [AdminController::class, 'dashboard'])
        ->name('admin.dashboard');

    Route::get('/users', [AdminController::class, 'users'])
        ->name('admin.users');

// AJAX search/filter ke liye
    Route::get('/display', [AdminController::class, 'display'])
    ->name('admin.display');

    // Projects
    Route::get('/projects', [AdminController::class, 'projects'])
        ->name('admin.projects');
// contact form show karne ke liye 
    Route::get('/contact', [AdminController::class, 'contact'])
        ->name('admin.contact');
        //  contact form ka data store karne ke liye 
    Route::post('/contacts/store', [EmployeeController::class, 'store'])
    ->name('contacts.store');
     
    Route::put('/users/{user}/status', [AdminController::class, 'updateStatus'])
    ->name('users.status.update');

    Route::get('/projects/data', [AdminController::class, 'projectData'])
        ->name('admin.projects.data');

    Route::get('/messages', [AdminController::class, 'messages'])
        ->name('admin.messages');

Route::patch('/projects/publish-status/{id}', [ProjectController::class, 'updatePublishStatus']);
Route::patch('/projects/visibility/{id}', [ProjectController::class, 'updateVisibility']);

        // delete profile user 
    
    Route::put('/users/update/{user}', [AdminController::class, 'update'])
    ->name('users.update');
    
     Route::delete('/users/{user}', [AdminController::class, 'destroy'])
    ->name('users.destroy');

    Route::get('/display',[AdminController::class,'display_user']);
       


    Route::delete('/move/{id}', [AdminController::class, 'move'])->name('move');
        // searching route 
    Route::get('/projects/search', [AdminController::class, 'searchProjects'])
    ->name('admin.projects.search');

});

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {

    Route::get('/projects', [ProjectController::class, 'index'])
        ->name('projects.index');

    Route::get('/projects/my', [ProjectController::class, 'myProjects'])
        ->name('projects.my');

    Route::get('/projects/upload', [ProjectController::class, 'create'])
        ->name('projects.upload');

    Route::post('/projects/store', [ProjectController::class, 'store'])
        ->name('projects.store');
});





Route::prefix('home')->group(function () {


    Route::middleware('auth')->group(function () {
        // ye line routs ko protect karne ke liye use hui hai is function ke andar jitne routs honge vo witout log in access nahi honge 
    
    // Route::get('/welcome/{name}', [HomeController::class, 'welcome']);
    Route::get('/welcome', [HomeController::class, 'welcome']);




    // Route::get('/project', [HomeController::class, 'project']);
    Route::get('/project', [ProjectController::class, 'userindex'])->name('projects.userindex');
    Route::get('/home/project/{id}', [ProjectController::class, 'usershow'])->name('project.usershow');
    
    Route::get('/myproject', [ProjectController::class, 'myproject'])
        ->name('/myproject');

        
    Route::get('/projects/my-data', [ProjectController::class, 'myProjectData'])
        ->name('Project.mydata');

    Route::get('/pricing',[HomeController::class,'pricing']);

    Route::get('/contact',[HomeController::class,'contact']);

    Route::get('admin/messages',[ContactController::class,'index'])
        ->name('messages');

    Route::post('/home/contact/store',[ContactController::class,'store'])
           ->name('contact.store');

    // for paymnet controller 
    Route::get('/payment', [PaymentController::class, 'index'])->name('home.payment');

    Route::get('/invoice/{invoice}/pdf', [PaymentController::class, 'downloadPdf'])
    ->name('invoice.pdf');
    
    Route::post('/payment/process',[PaymentController::class,'process'])
    ->name('payment.process');
    
    Route::get('/payment/invoice{invoice}',[PaymentController::class,'showInvoice'])
    ->name('invoice.show');

    Route::get('/projects/{project}', [ProjectController::class, 'show'])->name('projects.show');


    
    });
    
    Route::get('/about', [HomeController::class, 'about']);
   
    // Route::get('/contact',[HomeController::class,'contact']);
});

// Public auth routes
Route::get('/login', [LoginController::class, 'showlogin'])
    ->name('login');

Route::post('/login', [LoginController::class, 'login'])
    ->name('login.store');

Route::post('/logout', [LogoutController::class, 'logout'])
    ->name('logout');

Route::get('/signup', [AuthController::class, 'showSignup'])
    ->name('signup');

Route::post('/signup', [AuthController::class, 'signup'])
    ->name('signup.store');

// Backward-compatible aliases
Route::get('/register', [AuthController::class, 'showSignup'])
    ->name('register');

Route::post('/register', [AuthController::class, 'signup'])
    ->name('register.store');