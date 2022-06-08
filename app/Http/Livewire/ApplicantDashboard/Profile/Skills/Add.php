<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile\Skills;

use App\Models\Profile;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Add extends Component
{

    public $newSkill, $newLevel, $skill,$profile;



    public function add()
    {
        $this->emit('selectUpdated');
        $data = $this->validate([
            'newSkill' => ['required', 'string'],
            'newLevel' => ['required', Rule::in(['debutant','inter','avance'])]
        ]);

        $newSkill = ['name' => $data['newSkill'], 'level' => $data['newLevel']];


        $this->profile->skills = collect($this->profile->skills)->push($newSkill);
        $this->profile->save();

        $this->emit('skillAdded');

        $this->reset();
    }

    public function hideAddForm(){
        $this->emit('hideAddForm');
    }


    public function updated(){
        $this->emit('selectUpdated');
    }

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.skills.add');
    }
}
