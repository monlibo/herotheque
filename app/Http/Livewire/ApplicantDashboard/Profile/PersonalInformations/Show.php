<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile\PersonalInformations;

use App\Models\City;
use App\Models\State;
use App\Models\Profile;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Show extends Component
{

    use WithFileUploads;
    public $profile;

    public $department_name, $city_name;


    public function mount(Profile $profile)
    {
        $this->profile = $profile;

        $this->department_name = State::find($this->profile->user->department_address)->name;

        $this->city_name = City::find($this->profile->user->city_address)->name;

    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.personal-informations.show');
    }
}
