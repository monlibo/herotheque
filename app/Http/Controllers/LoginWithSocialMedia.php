<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginWithSocialMedia extends Controller
{
    /***
     * Cette fonction permet de connecter des utilisateurs
     */
    public static function LogWithSocial($data)
    {
        try {
            $user = User::where('email', $data->email)->first();

            if (!$user) {
                $user = User::create([
                    'nickname' => $data->nickname,
                    'lastname' => $data->name,
                    'email' => $data->email,
                    'email_verified_at' => now(),
                    'avatar' => $data->avatar,
                    'provider_id' => $data->id
                ]);

                Auth::login($user);
                //dd('Utilisateur enregistré');

            } else {
                $user->nickname = $data->nickname;
                $user->lastname = $data->name;
                $user->avatar = $data->avatar;
                $user->email_verified_at = now();
                $user->provider_id = $data->id;
                $user->save();

                Auth::login($user);
                //dd('Utilisateur enregistré');

            }
        } catch (Exception $e) {
            dd($e->getMessage());
        }
    }
}
