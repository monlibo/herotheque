<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Livewire\Component;

class ManageSocialLinks extends Component
{

    public $profile;
    public $isEditFormOpen = false;
    public $facebook;
    public $instagram;
    public $twitter;
    public $github;

    public function toggleShow()
    {
        $this->isEditFormOpen = !$this->isEditFormOpen;
    }

    protected $rules = [
        'facebook' => ['nullable','url'],
        'instagram' => ['nullable', 'url'],
        'twitter' => ['nullable', 'url'],
        'github' => ['nullable', 'url'],
    ];

    public function update(){
        $data = $this->validate($this->rules);

        $this->profile->facebook = $data['facebook'];
        $this->profile->instagram = $data['instagram'];
        $this->profile->twitter = $data['twitter'];
        $this->profile->github = $data['github'];

        $this->profile->save();

        $this->toggleShow();
    }



    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->facebook = $this->profile->facebook;
        $this->instagram = $this->profile->instagram;
        $this->twitter = $this->profile->twitter;
        $this->github = $this->profile->github;
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.manage-social-links');
    }
}
