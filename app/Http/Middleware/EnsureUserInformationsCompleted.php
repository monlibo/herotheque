<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class EnsureUserInformationsCompleted
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
            empty(Auth::user()->firstname) || empty(Auth::user()->lastname) ||
            empty(Auth::user()->phone_number) || empty(Auth::user()->email)
        ) {
            Session::put('editProfileInfo', 'Vous devez remplir vos informations personnelles  avant de publier un job');
            return redirect()->route('profile.show');
        } else {
            Session::forget('editProfileInfo');
        }
        return $next($request);
    }
}
