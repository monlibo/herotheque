<?php

namespace App\Http\Livewire\EmployerDashboard\Company;

use App\Models\City;
use App\Models\State;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class ManageCompany extends Component
{
    use WithFileUploads;

    public $viewEdit = false, $company, $name, $description, $user_position_held, $phone, $email,
        $ifu, $facebook, $url, $session_message, $logo, $newLogo, $temporaryLogo;

    public $department_address, $city_address;
    public $departments, $cities;

    protected $queryString = ['viewEdit' => ['except' => false]];

    public function updatedNewLogo()
    {
        $this->temporaryLogo = $this->newLogo->temporaryUrl();
    }


    public array $fields = ['Informatique', 'Comptabilité', 'Finance'];
    public $field = [];

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
            'name' => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'user_position_held' => ['required', 'string'],
            'phone' => ['required', 'numeric','digits:8'],
            'email' => ['required', 'email'],
            'department_address' => ['exists:App\Models\State,name'],
            'city_address' => ['exists:App\Models\City,name'],
            'ifu' => ['required', 'numeric'],
            'facebook' => ['nullable', 'url'],
            'url' => ['nullable', 'url'],
            'newLogo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2024'], // 2MB Max
            'field' => ['required','array','min:1']
        ]);
    }

    protected $rules = [
        'name' => ['required', 'string'],
        'description' => ['nullable', 'string'],
        'user_position_held' => ['required', 'string'],
        'phone' => ['required', 'numeric','digits:8'],
        'email' => ['required', 'email'],
        'department_address' => ['exists:App\Models\State,name'],
        'city_address' => ['exists:App\Models\City,name'],
        'ifu' => ['required', 'numeric'],
        'facebook' => ['nullable', 'url'],
        'url' => ['nullable', 'url'],
        'newLogo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:2024'], // 2MB Max
        'field' => ['min:1']
    ];

    public function updateCompanyInformation()
    {
        $this->emit('selectUpdated');

        $this->validate($this->rules);
        $company = Company::find(Auth::user()->company->id);

        if ($company->user_id === Auth::user()->id) {
            $company->name = $this->name;
            $company->description = $this->description;
            $company->user_position_held = $this->user_position_held;
            $company->phone = $this->phone;
            $company->email = $this->email;
            $company->city_address = $this->city_address;
            $company->department_address = $this->department_address;
            $company->ifu = $this->ifu;
            $company->facebook = $this->facebook;
            $company->url = $this->url;
            $company->field = $this->field;
            if ($this->newLogo) {
                // $path = $this->newLogo->store('img', 'public');
                // $company->logo = $path;
                /* Stockage amazone */
                Storage::disk('s3')->put('profile_photos', $this->newPhoto);
                $this->logo = $this->company->logo ?  Storage::url($path) : '';
            }

            $company->save();

            $this->viewEdit = false;
        }
    }



    public function toggleView()
    {

        $this->viewEdit = !$this->viewEdit;
        $this->emit('selectUpdated');
        if (Session::has('editCompanyInfo')) {
            Session::forget('editCompanyInfo');
            $this->session_message = "";
        }
    }

    public function mount(Company $company)
    {

        $this->company = $company;
        $this->name = $this->company->name;
        $this->description = $this->company->description;
        $this->user_position_held = $this->company->user_position_held;
        $this->phone = $this->company->phone;
        $this->email = $this->company->email;

        $this->ifu = $this->company->ifu;
        $this->facebook = $this->company->facebook;
        $this->department_address = $company->department_address;
        $this->city_address = $company->city_address;
        $this->departments = State::all();

        if ($this->company->department_address) {
            $this->cities = City::whereHas('state', function ($query) {
                $query->where('name', $this->company->department_address);
            })->get();
        } else {
            $this->cities = City::all();
        }
        if (!empty($this->company->field)) {
            $this->field = $this->company->field;
        }

        $this->logo = $this->company->logo ?  env('APP_URL') . Storage::url($this->company->logo) : '';
        //dd(env('APP_URL').Storage::url($this->company->logo));


        $this->url = $this->company->url;

        session()->get('editCompanyInfo') ?
            $this->session_message = session()->get('editCompanyInfo')
            : "";
    }

    public function render()
    {
        return view('livewire.employer-dashboard.company.manage-company', [
            'logo' => $this->logo
        ]);
    }
}
