<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\JobsController;
use Illuminate\Support\Facades\Route;

// Registration and Login routes (accessible to everyone)
Route::get('/forgot-password', [AccountController::class, 'forgotPassword'])->name('account.forgotPassword');

Route::get('/reset-password{token}', [AccountController::class, 'resetPassword'])->name('account.resetPassword');

Route::post('/process-forgot-password', [AccountController::class, 'processForgotPassword'])->name('account.processForgotPassword');


Route::post('/process-reset-password', [AccountController::class, 'processResetPassword'])->name('account.processResetPassword');


Route::get('/account/register', [AccountController::class, 'registration'])->name('account.registration');

Route::post('/account/process-register', [AccountController::class, 'processRegistration'])->name('account.processRegistration');

Route::get('/account/login', [AccountController::class, 'login'])->name('account.login');

Route::post('/account/authenticate', [AccountController::class, 'authenticate'])->name('account.authenticate');
// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/jobs', [JobsController::class, 'index'])->name('jobs');
Route::get('/jobs/detail/{id}', [JobsController::class, 'detail'])->name('jobDetail');
Route::post('/apply-job', [JobsController::class, 'applyJob'])->name('applyJob');
Route::get('/create-job', [AccountController::class, 'createJob'])->name('account.createJob');
Route::get('saved-jobs', [AccountController::class, 'savedJobs'])->name('account.savedJobs');

Route::post('/save-job', [JobsController::class,'saveJob'])->name('saveJob');
Route::post('/save-job', [AccountController::class, 'saveJob'])->name('account.saveJob');//may be issue occured here

// Group middleware for authenticated routes
Route::middleware([\App\Http\Middleware\RedirectIfAuthenticated::class])->group(function () {
    // Profile route (only accessible to authenticated users) 
    Route::get('/profile', [AccountController::class, 'profile'])
         ->name('account.profile');

    // Logout route (only accessible to authenticated users)
    Route::get('/account/logout', [AccountController::class, 'logout'])->name('account.logout');
    
    Route::put('/update-profile', [AccountController::class, 'updateProfile'])->name('account.updateProfile');
    
    Route::post('/update-profile-pic', [AccountController::class, 'updateProfilePic'])->name('account.updateProfilePic');

    Route::get('/create-job', [AccountController::class, 'createJob'])->name('account.createJob');
    
    Route::post('/save-job', [AccountController::class, 'saveJob'])->name('account.saveJob');//may be issue occured here

    Route::get('/my-jobs', [AccountController::class, 'myJobs'])->name('account.myJobs');

    Route::get('/my-jobs/edit/{jobId}', [AccountController::class, 'editJob'])->name('account.editJob');

    Route::post('/update-job/{jobId}', [AccountController::class, 'updateJob'])->name('account.updateJob');

    Route::post('/delete-job', [AccountController::class, 'deleteJob'])->name('account.deleteJob');

    Route::get('account/my-job-applications', [AccountController::class, 'myJobApplications'])->name('account.myJobApplications');

    Route::post('remove-job-application', [AccountController::class, 'removeJobs'])->name('account.removeJobs');

    Route::post('/save-job-', [JobsController::class,'saveJob'])->name('saveJob');
    

    Route::post('/remove-saved-job', [AccountController::class, 'removeSavedJob'])->name('account.removeSavedJob');

    Route::post('/update-password', [AccountController::class, 'updatePassword'])->name('account.updatePassword');
    
});                                                