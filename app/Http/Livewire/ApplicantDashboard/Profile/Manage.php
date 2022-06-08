<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Manage extends Component
{
    public $profile1;
    public $openedTab = "biographie";
    public $percent;

    protected $queryString = [
        'openedTab' => ['except', 'biographie']
    ];

    public function goToTab(string $tabName)
    {

        $this->validate(['openedTab' => Rule::in(['experience', 'skill', 'training', 'activity', 'language', 'quality', 'link', 'biographie'])]);
        $this->openedTab = $tabName;
    }

    public function mount(Profile $profile)
    {
        $this->profile1 = $profile;
        $this->percent = 0;
        if (
            $profile->user->firstname && $profile->user->lastname && $profile->user->phone_number
            && $profile->user->email && $profile->user->profile_photo_path && $profile->short_bio
        ) {
            $this->percent += 20;
        }

        if ($profile->bio) {
            $this->percent += 20;
        }
        if (collect($profile->skills)->isNotEmpty() && collect($profile->trainings)->isNotEmpty()) {
            $this->percent += 20;
        }

        if ($profile->experience_years && $profile->education_level) {
            $this->percent += 20;
        }

        if (collect($profile->languages)->isNotEmpty()) {
            $this->percent += 20;
        }
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.manage', [
            'profile' => Profile::firstWhere('user_id', Auth::user()->id)
        ]);
    }
}
