<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Livewire\Component;

class ManageLanguages extends Component
{

    public $profile;

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.manage-languages');
    }
}
