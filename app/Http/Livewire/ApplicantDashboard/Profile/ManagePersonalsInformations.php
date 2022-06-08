<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Livewire\Component;
use Illuminate\Support\Facades\Storage;
use Livewire\WithFileUploads;

class ManagePersonalsInformations extends Component
{
    use WithFileUploads;

    public $profile;
    public bool $isEditFormOpen = false;

    //// Personals Informations
    public $logo;
    public $newLogo;
    public $temporaryLogo;
    public $firstname;
    public $lastname;
    public $birthdate;
    public $short_bio;
    public $old;


    protected $rules = [
        'firstname' => ['nullable','string'],
        'lastname' => ['nullable','string'],
        'birthdate' => ['nullable','date','before:today'],
        'short_bio' => ['nullable','string','max:50'],
        'newLogo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2024'],
    ];



    public function updatedNewLogo()
    {
        $this->temporaryLogo = $this->newLogo->temporaryUrl();
    }

    public function toggleShow(){
        $this->isEditFormOpen = !$this->isEditFormOpen;
    }

    public function update(){
        $this->validate($this->rules);

        if ($this->newLogo) {
            $path = $this->newLogo->store('profile-photos', 'public');
            $this->profile->user->profile_photo_path = $path;

            $this->logo = $this->profile->user->profile_photo_path ?  env('APP_URL') . Storage::url($path) : '';
        }

        $this->profile->user->firstname = $this->firstname;
        $this->profile->user->lastname = $this->lastname;
        $this->profile->user->birthdate = $this->birthdate;
        $this->profile->user->save();

        $this->profile->short_bio = $this->short_bio;
        $this->profile->save();

        $this->toggleShow();
    }

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->logo = $this->profile->user->profile_photo_path ?  env('APP_URL') . Storage::url($this->profile->user->profile_photo_path) : '';
        $this->firstname = $this->profile->user->firstname;
        $this->lastname = $this->profile->user->lastname;
        $this->birthdate = $this->profile->user->birthdate;
        $this->short_bio = $this->profile->short_bio;


    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.manage-personals-informations');
    }
}
