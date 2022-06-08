<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\ProExperience;
use Livewire\Component;

class EditPersonalInformation extends Component
{

    public ProExperience $experience;

    protected $rules = [
        'experience.position_occuped' => ['required', 'string'],
        'experience.company' => ['required', 'string'],
        'experience.date_start' => ['required', 'date'],
        'experience.date_end' => ['date'],
        'experience.country' => ['required', 'string'],
        'experience.city' => ['required', 'string'],
        'experience.description' => ['nullable','string']
    ];

    public function update(){
        $this->validate();

        $this->experience->save();
        $this->emit('experienceUpdated');
    }

    public function mount(ProExperience $experience){
        $this->experience = $experience ;


    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.edit-personal-information');
    }
}
