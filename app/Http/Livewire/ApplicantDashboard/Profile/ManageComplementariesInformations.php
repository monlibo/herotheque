<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Livewire\Component;

class ManageComplementariesInformations extends Component
{

    public $profile;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.manage-complementaries-informations');
    }
}
