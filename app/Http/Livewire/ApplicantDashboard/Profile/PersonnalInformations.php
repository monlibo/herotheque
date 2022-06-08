<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\City;
use App\Models\State;
use App\Models\Profile;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpKernel\HttpCache\Store;

class PersonnalInformations extends Component
{
    use WithFileUploads;
    public $profile;
    public $user;
    public $profileId;
    public $profile2;
    public $department_address, $city_address;
    public $isEditFormOpen = false;

    public $photo;
    public $newPhoto;
    public $temporaryPhoto;

    public $departments, $cities;

    //protected $listeners = ['refreshComponent' => '$refresh'];


    //protected $listeners = ['departmentUpdated' => 'incrementPostCount'];


    public function toogleEditView()
    {
        $this->profile = Profile::find($this->profile->id);
        $this->emit('selectUpdated');
        //$this->emit('refreshComponent');
        $this->isEditFormOpen = !$this->isEditFormOpen;
    }

    public function updatedDepartmentAddress()
    {
        $this->cities = City::whereHas('state', function ($query) {
            $query->where('name', $this->department_address);
        })->get();

        $this->city_address = "";
    }

    public function updatedCityAddress()
    {
        $this->department_address = City::where('name', $this->city_address)->first()->state->name;
    }

    public function updated($fields)
    {
        $this->emit('selectUpdated');
        $this->validateOnly($fields, [
            'user.firstname' => ['required', 'string', 'min:2'],
            'user.lastname' => ['required', 'string', 'min:2'],
            'user.birthdate' => ['nullable', 'date', 'before:today'],
            'department_address' => ['required', 'exists:App\Models\State,name'],
            'city_address' => ['required', 'exists:App\Models\City,name'],
            'user.email' => ['required', 'email', 'unique:users,email'],
            'user.phone_number' => ['required', 'numeric', 'digits:8'],
            'profile.short_bio' => ['required', 'max:40'],
            'profile.education_level' => ['required', 'string'],
            'profile.experience_years' => ['string'],
            'profile.driver_licence' => ['nullable', Rule::in(['', 'A', 'B', 'C', 'D'])],
            'newPhoto' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2024'],
        ]);
    }

    protected function rules()
    {
        return [
            'user.firstname' => ['required', 'string', 'min:2'],
            'user.lastname' => ['required', 'string', 'min:2'],
            'user.birthdate' => ['nullable', 'date', 'before:today'],
            'department_address' => ['required', 'exists:App\Models\State,name'],
            'city_address' => ['required', 'exists:App\Models\City,name'],
            'user.email' => ['required', 'email', 'unique:users,email'],
            'user.phone_number' => ['required', 'numeric', 'digits:8'],
            'profile.short_bio' => ['required', 'max:40'],
            'profile.education_level' => ['required', 'string'],
            'profile.experience_years' => ['string'],
            'profile.driver_licence' => ['nullable', Rule::in(['', 'A', 'B', 'C', 'D'])],
            'newPhoto' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2024'],
        ];
    }


    public array $levels = [
        [
            'code' => 'cep',
            'libelle' => 'CEP'
        ],
        [
            'code' => 'bepc',
            'libelle' => 'BEPC'
        ],
        [
            'code' => 'cap',
            'libelle' => 'CAP'
        ],
        [
            'code' => 'bac',
            'libelle' => 'BAC'
        ],
        [
            'code' => 'l1',
            'libelle' => 'Licence 1'
        ],
        [
            'code' => 'l2',
            'libelle' => 'Licence 2'
        ],
        [
            'code' => 'l3',
            'libelle' => 'Licence 3'
        ],
        [
            'code' => 'm1',
            'libelle' => 'Master 1'
        ],
        [
            'code' => 'm2',
            'libelle' => 'Master 2'
        ]
    ];



    public function updatedNewPhoto()
    {
        $this->temporaryPhoto = $this->newPhoto->temporaryUrl();
    }

    public function update()
    {

        $this->emit('selectUpdated');
        $data = $this->validate();

        $this->user->department_address = $data['department_address'];
        $this->user->city_address = $data['city_address'];

        if ($this->newPhoto) {
            $path = $this->newPhoto->store('profile_photos', 'public');
            $this->user->profile_photo_path = $path;
            $this->photo = $this->user->profile_photo_path ?  env('APP_URL') . Storage::url($path) : '';

            /* Stockage amazone */
            Storage::disk('s3')->put('profile_photos', $this->newPhoto);
            //$s3Path = Storage::disk('s3')->url($path);
        }


        $this->user->save();
        $this->profile->save();

        $this->isEditFormOpen = false;
        //dd($this->isEditFormOpen);
        //dd($this->profile->user->email);

    }

    public function deletePhoto()
    {
        $this->emit('selectUpdated');
        $this->user->profile_photo_path = null;
        $this->user->save();

        $this->reset('photo', 'newPhoto', 'temporaryPhoto');
    }


    public function mount(Profile $profile)
    {
        $this->profile = $profile;

        $this->department_address = $profile->user->department_address;
        $this->city_address = $profile->user->city_address;
        $this->departments = State::all();

        $this->user = $this->profile->user;



        if ($this->profile->user->department_address) {
            $this->cities = City::whereHas('state', function ($query) {
                $query->where('name', $this->profile->user->department_address);
            })->get();
        } else {
            $this->cities = City::all();
        }

        $this->photo = $this->profile->user->profile_photo_path ?  env('APP_URL') . Storage::url($this->profile->user->profile_photo_path) : '';
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.personnal-informations', [
            'profile' => $this->profile,
            'user' => $this->user
        ]);
    }
}
