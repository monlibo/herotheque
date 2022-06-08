<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Offer;
use App\Models\Company;
use Illuminate\Http\Request;

class SearchController extends Controller
{


    public function search(Request $request)
    {
        // if ($request->q) {
            return view('search');
        // }
        // else {
        //     $countOffer = Offer::all()->count();

        //     $countUser = User::all()->count();

        //     $countCompany = Company::all()->count();

        //     return view('welcome', [
        //         'countOffer' => $countOffer,
        //         'countUser' => $countUser,
        //         'countCompany' => $countCompany
        //     ]);
        // }
    }
}
