<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ManageCompanyAccount extends Component
{
    public $viewEdit = false;
    private $company;


    public $name;
    public $description;
    public $user_position_held;
    public $phone;
    public $email;
    public $city_address;
    public $department_address;
    public $ifu;
    public $facebook;
    public $url;
    public $session_message;



    public array $fields = ['Informatique', 'Comptabilité', 'Finance'];
    public $field = [];

    private $rules = [
        'name' => ['required', 'string'],
        'description' => ['nullable', 'string'],
        'user_position_held' => ['nullable', 'string'],
        'phone' => ['nullable', 'numeric'],
        'email' => ['nullable', 'email'],
        'city_address' => ['nullable', 'string'],
        'department_address' => ['nullable', 'string'],
        'ifu' => ['required', 'numeric'],
        'facebook' => ['nullable', 'url'],
        'url' => ['nullable', 'url']
    ];

    public function updateCompanyInformation()
    {

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
            $company->field = json_encode($this->field);
            $company->save();

            $this->viewEdit = false;
        }
    }

    /***
     * Ajoute une autre compétence au formulaire
     */
    public function addField()
    {
        array_push($this->fields, $this->field);
        $this->field = "";
    }


    /***
     * Supprime une compétence au formualaire
     */
    public function removeField($key)
    {
        array_splice($this->fields, $key, 1);
    }

    public function toggleView()
    {
        $this->viewEdit = !$this->viewEdit;

        if (Session::has('editCompanyInfo')) {
            Session::forget('editCompanyInfo');
            $this->session_message = "";
        }
    }

    public function mount()
    {
        $this->user_id = Auth::id();
        $this->company = Auth::user()->company;
        $this->name = $this->company->name;
        $this->description = $this->company->description;
        $this->user_position_held = $this->company->user_position_held;
        $this->phone = $this->company->phone;
        $this->email = $this->company->email;
        $this->city_address = $this->company->city_address;
        $this->department_address = $this->company->department_address;
        $this->ifu = $this->company->ifu;
        $this->facebook = $this->company->facebook;
        if(!empty($this->company->field)){
            $this->field = json_decode($this->company->field);
        }
        
        $this->url = $this->company->url;



        session()->get('editCompanyInfo') ?
            $this->session_message = session()->get('editCompanyInfo')
            : "";
    }

    public function render()
    {
        return view('livewire.manage-company-account');
    }
}
