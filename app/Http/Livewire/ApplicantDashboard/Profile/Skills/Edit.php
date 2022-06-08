<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile\Skills;

use App\Models\Profile;
use Livewire\Component;
use Illuminate\Validation\Rule;
use Illuminate\Support\Collection;

class Edit extends Component
{
    public Profile $profile;
    public $skill_id, $skills;

    protected $rules;

    protected function rules(){
        return [
            'skills.*.name' => ['required', 'string'],
            'skills.*.level' => ['required', Rule::in(['debutant', 'inter', 'avance'])]
        ];
    }

    public function update(){
        //dd($this->rules);
        $this->validate();
        $this->profile->skills = collect($this->skills);
        $this->profile->save();

        $this->emit('hideEditForm');
    }

    public function updated()
    {
        $this->emit('selectUpdated');
    }

    public function mount(int $skill_id, Collection $skills,Profile $profile)
    {
        $this->profile = $profile;
        $this->skill_id = $skill_id;
        $this->skills = $skills;



    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.skills.edit');
    }
}
