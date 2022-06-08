<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Livewire\Component;

class Link extends Component
{
    public $profile;
    public $openEditForm = false;
    public $website, $facebook, $twitter, $instagram, $github;

    protected $rules = [
        'website' => ['nullable', 'url'],
        'facebook' => ['nullable', 'url'],
        'twitter' => ['nullable', 'url'],
        'instagram' => ['nullable', 'url'],
        'github' => ['nullable', 'url']
    ];

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'website' => ['nullable', 'url'],
            'facebook' => ['nullable', 'url'],
            'twitter' => ['nullable', 'url'],
            'instagram' => ['nullable', 'url'],
            'github' => ['nullable', 'url'],
        ]);
    }

    public function update(){
        $data = $this->validate();

        $this->profile->website =  $data['website'];
        $this->profile->facebook = $data['facebook'];
        $this->profile->twitter = $data['twitter'];
        $this->profile->instagram = $data['instagram'];
        $this->profile->github = $data['github'];
        $this->profile->save();

        $this->dispatchBrowserEvent('close-modal');
    }

    public function mount(Profile $profile)
    {
        $this->website = $this->profile->website;
        $this->facebook = $this->profile->facebook;
        $this->twitter = $this->profile->twitter;
        $this->instagram = $this->profile->instagram;
        $this->github = $this->profile->github;
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.link');
    }
}
