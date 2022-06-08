<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Livewire\Component;

class Biographie extends Component
{

    public $profile;
    public $openEditForm = false;
    public $bio;

    protected $rules = [
        'bio' => ['nullable','string']
    ];

    public function update()
    {


        $this->validate();
        $this->profile->bio = $this->bio;
        $this->profile->save();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function mount(Profile $profile)
    {

    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.biographie');
    }
}
