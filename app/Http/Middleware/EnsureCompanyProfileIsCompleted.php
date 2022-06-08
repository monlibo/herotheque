<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EnsureCompanyProfileIsCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {

        if (
            empty(Auth::user()->company->name) || empty(Auth::user()->company->ifu) ||
            empty(Auth::user()->company->phone) || empty(Auth::user()->company->email)
            || empty(Auth::user()->company->city_address) || empty(Auth::user()->company->field)
        ){
            session()->flash('editCompanyInfo', 'Vous devez remplir les informations de votre entreprise avant de publier une offre');
            return redirect()->route('my.company');
        }

        return $next($request);
    }
}
