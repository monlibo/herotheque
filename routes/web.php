<?php

use App\Models\Company;

use App\Models\Employement;
use GuzzleHttp\Psr7\Request;
use Illuminate\Routing\RouteAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Livewire\SearchComponent;
use App\Http\Controllers\JobController;
use App\Http\Livewire\CompanyComponent;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\WelcomeController;
use App\Http\Controllers\ProposalController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\InternShipController;
use App\Http\Controllers\LoginWithSocialMedia;
use App\Http\Controllers\ApplicationController;
use App\Http\Controllers\EmployementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/pdf-profile', function () {
    $user = Auth::user();
    return view('applicant-dashboard.cv-pdf', compact('user'));
});

Route::get('/', [WelcomeController::class, 'index']);

Route::get('/company', function () {
    return view('companies.index');
})->name('company.index');

Route::get('/company/{company}', [CompanyController::class, 'show'])->name('company.show');


/*** Employement */
Route::get('/employement/{employement}', [EmployementController::class, 'show'])->name('employement.show');

/*** Job */
Route::get('/job/{job}', [JobController::class, 'show'])->name('job.show');

/*** Job */
Route::get('/internship/{internship}', [InternShipController::class, 'show'])->name('internship.show');



Route::get('/search', [SearchController::class, 'search'])->name('search');

/**
 * Les routes d'authentification de Google
 */
Route::get('/auth/google', function () {
    return Socialite::driver('google')->redirect();
})->name('google.redirect');

Route::get('/auth/google/callback', function () {
    $user = Socialite::driver('google')->user();
    LoginWithSocialMedia::LogWithSocial($user);
    return redirect()->intended('dashboard');
    // $user->token
})->name('google.callback');

/**
 * Les routes d'authentification de Google
 */
Route::get('/auth/github', function () {
    return Socialite::driver('github')->redirect();
})->name('github.redirect');

Route::get('/auth/github/callback', function () {
    $user = Socialite::driver('github')->user();
    LoginWithSocialMedia::LogWithSocial($user);
    return redirect()->intended('dashboard');
    // $user->token
})->name('github.callback');




Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/notification', [DashboardController::class, 'notification'])->name('dashboard.notification');



    /* Dashboard Employement */
    Route::group(['prefix' => 'dashboard', 'middleware' => ['role:employer']], function () {



        Route::get('/employement/create', [EmployementController::class, 'create'])
            ->name('employement-create')->middleware('company.profile.completed');


        Route::get('/employement', [EmployementController::class, 'index'])
            ->name('employement');

        Route::get('/employement/{employement}', [EmployementController::class, 'showOnDashboard'])
            ->name('employement-dashboard-show');

        Route::get('/employement/{employement}/edit', [EmployementController::class, 'edit'])
            ->name('employement-edit');

        Route::get('/employement/{employement}/proposal', [EmployementController::class, 'proposal'])->name('employement.proposal.show');



        /* End dashboard employement */

        /* Dashboard internship */

        Route::get('/internship/create', [InternShipController::class, 'create'])
            ->name('internship-create')->middleware('company.profile.completed');

        Route::get('/internship', [InternShipController::class, 'index'])->name('internship');

        Route::get('/internship/{internship}', [InternShipController::class, 'showOnDashboard'])
            ->name('internship-dashboard-show');

        Route::get('/internship/{internship}/edit', [InternShipController::class, 'edit'])
            ->name('internship-dashboard-edit');

        Route::get('/internship/{internship}/proposal', [InternShipController::class, 'proposal'])->name('internship.proposal.show');

        //->name('employement');
        /* End Dashboard Internship*/

        /* Dashboard job */

        Route::get('/job/create', [JobController::class, 'create'])
            ->name('job-create')->middleware('user.profile.completed');
        Route::get('/job', [JobController::class, 'index'])
            ->name('job');
        Route::get('/job/{job}', [JobController::class, 'showOnDashboard'])
            ->name('job-dashboard-show');
        Route::get('/job/{job}/edit', [JobController::class, 'edit'])
            ->name('job-dashboard-edit');

        Route::get('/job/{job}/proposal', [JobController::class, 'proposal'])->name('job.proposal.show');


        /* End dashboard Job */

        Route::get('/my-company', [CompanyController::class, 'showOnDashboard'])
            ->name('my.company');

        Route::get('/user/application', function () {
            return view('employer-dashboard.application');
        })
            ->name('employer.application');
    });



    /* Applicant Dashboard */
    Route::group(['prefix' => 'dashboard', 'middleware' => ['role:applicant']], function () {
        Route::get('/profile', [ProfileController::class, 'showOnDashboard'])->name('profile');

        Route::get('/proposal', [ProposalController::class, 'applicantProposals'])->name('applicant.proposal');
        Route::get('/application', [ApplicationController::class, 'applicantApplications'])->name('applicant.application');
    });
    /* End Applicant Dashboard */
});




Route::get('/alpine', function () {
    return view('alpine-js');
});
