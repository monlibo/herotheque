<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Offer;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function index()
    {
        $countOffer = Offer::all()->count();

        $countUser = User::all()->count();

        $countCompany = Company::all()->count();

        return view('welcome',[
            'countOffer' => $countOffer,
            'countUser' => $countUser,
            'countCompany' => $countCompany
        ]);
    }
}
