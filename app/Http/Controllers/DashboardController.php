<?php

namespace App\Http\Controllers;

use App\Models\Employement;
use App\Models\Offer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }

    public function notification()
    {
        return view('notitication.index');
    }
}
