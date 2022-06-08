<?php

namespace App\Actions\Fortify;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    public function update($user, array $input)
    {
        Validator::make($input, [
            //'nickname' => ['required', 'string', 'max:255'],
            //'firstname' => ['required', 'string', 'max:255'],
            //'lastname' => ['required', 'string', 'max:255'],
            //'sex' => ['required', 'string', 'max:255'],
            //'phone_number' => ['required', 'string', 'max:50'],
            //'neighborhood_address' => ['required', 'string', 'max:255'],
            //'city_address' => ['required', 'string', 'max:255'],
            //'department_address' => ['required', 'string', 'max:255'],
            //'country_address' => ['required', 'string', 'max:255'],
            'email' => ['required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');

        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if ($input['email'] !== $user->email &&
            $user instanceof MustVerifyEmail) {
            $this->updateVerifiedUser($user, $input);
        } else {
            $user->forceFill([
                'lastname' => $input['lastname'],
                'firstname' => $input['firstname'],
                'nickname' => $input['nickname'],
                'sex' => $input['sex'],
                'birthdate' => $input['birthdate'],
                'phone_number' => $input['phone_number'],
                'neighborhood_address' => $input['neighborhood_address'],
                'city_address' => $input['city_address'],
                'department_address' => $input['department_address'],
                'country_address' => $input['country_address'],
                'email' => $input['email'],
            ])->save();
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  mixed  $user
     * @param  array  $input
     * @return void
     */
    protected function updateVerifiedUser($user, array $input)
    {
        $user->forceFill([
            'name' => $input['name'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
