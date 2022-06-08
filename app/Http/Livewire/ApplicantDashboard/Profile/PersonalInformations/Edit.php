<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile\PersonalInformations;

use App\Models\City;
use App\Models\State;
use App\Models\Profile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Edit extends Component
{


    use WithFileUploads;
    public $profile;
    public $profileId;
    public $profile2;
    public $department_id, $department_name, $city_id, $city_name;
    public $isEditFormOpen = false;

    public $photo;
    public $newPhoto;
    public $temporaryPhoto;

    public $departments, $cities;

    public function updatedDepartmentId()
    {
        $this->cities = City::where('state_id', $this->department_id)->get();
    }

    public function updatedCityId()
    {
        $this->department_id = City::find($this->city_id)->state->id;
    }

    protected $rules = [
        'profile.user.firstname' => ['nullable', 'string'],
        'profile.user.lastname' => ['nullable', 'string'],
        'profile.user.birthdate' => ['nullable', 'date', 'before:today'],
        'department_id' => ['exists:App\Models\State,id'],
        'city_id' => ['exists:App\Models\City,id'],
        'profile.user.email' => ['required', 'email'],
        'profile.user.phone_number' => ['required', 'numeric', 'digits:8'],
        'profile.short_bio' => ['string', 'max:40'],
        'profile.bio' => ['nullable','string', 'max:200'],
        'profile.experience_years' => ['integer', 'max:50'],
        'newPhoto' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2024'],
    ];

    public function updated()
    {
        $this->emit('selectUpdated');
    }

    public function updatedNewPhoto()
    {
        $this->temporaryPhoto = $this->newPhoto->temporaryUrl();
    }

    public function update()
    {

        $this->emit('selectUpdated');
        $data = $this->validate();

        $this->profile->user->department_address = $data['department_id'];
        $this->profile->user->city_address = $data['city_id'];

        if ($this->newPhoto) {

            $path = $this->newPhoto->store('profile-photos', 'public');
            $this->profile->user->profile_photo_path = $path;

            $this->photo = $this->profile->user->profile_photo_path ?  env('APP_URL') . Storage::url($path) : '';
        }


        $this->profile->user->save();
        $this->profile->save();




    }

    public function deletePhoto()
    {
        $this->emit('selectUpdated');
        $this->profile->user->profile_photo_path = null;
        $this->profile->user->save();

        $this->reset('photo', 'newPhoto', 'temporaryPhoto');
    }


    public function mount(Profile $profile)
    {
        $this->profile = $profile;

        $this->department_id = State::find($this->profile->user->department_address)->id;
        $this->department_name = State::find($this->profile->user->department_address)->name;

        $this->city_id = City::find($this->profile->user->city_address)->id;
        $this->city_name = City::find($this->profile->user->city_address)->name;


        $this->departments = State::all();

        if ($this->profile->user->department_address) {
            $this->cities = City::where('state_id', $this->profile->user->department_address)
                ->get();
        }

        $this->photo = $this->profile->user->profile_photo_path ?  env('APP_URL') . Storage::url($this->profile->user->profile_photo_path) : '';
    }


    public function render()
    {
        return view('livewire.applicant-dashboard.profile.personal-informations.edit');
    }
}
