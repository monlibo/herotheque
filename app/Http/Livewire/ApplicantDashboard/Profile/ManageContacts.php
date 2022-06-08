<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\City;
use App\Models\Profile;
use App\Models\State;
use Hamcrest\Type\IsInteger;
use Livewire\Component;
use Illuminate\Support\Facades\DB;

class ManageContacts extends Component
{
    public $profile;
    public $isEditFormOpen = false;
    public $email;
    public $phone_number;
    public $whatsapp;
    public $department_address;
    public $city_address;
    public $department_name;
    public $city_name;

    public array $cities;
    public array $departments;

    protected $rules = [
        'email' => ['required', 'email'],
        'phone_number' => ['integer'],
        'whatsapp' => ['integer'],
        'department_address' => ['required', 'integer'],
        'city_address' => ['required', 'integer']
    ];

    public function toggleShow()
    {
        $this->isEditFormOpen = !$this->isEditFormOpen;
    }

    public function update()
    {
        $data = $this->validate($this->rules);

        $this->profile->user->email = $data['email'];
        $this->profile->user->phone_number = $data['phone_number'];
        $this->profile->whatsapp = $data['whatsapp'];
        $this->profile->user->department_address = $data['department_address'];
        $this->profile->user->city_address = $data['city_address'];

        $this->profile->user->save();
        $this->profile->save();

        $this->toggleShow();

        $this->department_name = State::find($this->department_address)->name;
        $this->city_name = City::find($this->city_address)->name;
    }

    public function updatedDepartmentAddress()
    {
        $this->cities = collect(City::where('state_id', $this->department_address)->get())
            ->toArray();
    }

    public function updatedCityAddress()
    {
        $this->department_address = City::find($this->city_address)->state->id;
    }

    public function updated()
    {
        $this->emit('selectUpdated');
    }

   

    public function mount(Profile $profile)
    {

        $this->profile = $profile;
        $this->email = $this->profile->user->email;
        $this->phone_number = $this->profile->user->phone_number;
        $this->whatsapp = $this->profile->whatsapp;
        $this->department_address = $this->profile->user->department_address;
        if($this->department_address){
            $this->department_name = State::find($this->department_address)->name;
        }
        $this->city_address = $this->profile->user->city_address;

        if ($this->city_address) {
            $this->city_name = City::find($this->city_address)->name;
        }

        if ($this->department_address) {

            $this->cities = collect(City::select('id', 'name')
                ->where('state_id', $this->department_address)
                ->get())
                ->toArray();
        } else {
            $this->cities = collect(City::all())->toArray();
        }

        $this->departments = collect(State::all())->toArray();
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.manage-contacts');
    }
}
