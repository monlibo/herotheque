<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Offer;
use Livewire\Component;
use App\Models\InternShip;
use App\Models\OfferField;
use App\Models\OfferSkill;
use App\Models\OfferQuality;
use App\Models\OfferLanguage;
use App\Models\State;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CreateNewInternship extends Component
{



    public Int $currentStep = 1;
    public Int $maxStep = 8;

    public String  $title = "";
    public String $description = "";
    public array $fields = ['Informatique', 'Comptabilité', 'Génie civile'];
    public array $field = [];

    public $states;
    public String $department_address = "";
    public $cities;
    public String $city_address = "";

    public array $types = [
        [
            'code' => 'académique',
            'libelle' => 'Académique'
        ],
        [
            'code' => 'professionnel',
            'libelle' => 'Professionnel'
        ],
    ];

    public $date_start;
    public $date_end;
    public string $type = "";
    public bool $paid = false;
    public $working_hours_per_week = 0;



    ///////////////////////////////////////////////////////////////////////////
    public array $trainings = [];
    public array $required_training = [];
    public String $experience = "default";
    public array $level_of_education_required = [];

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

    //////////////////////////////////////////////////////////////////////////

    public  $date_of_publication;
    public  $date_of_disability;

    /////////////////////////////////////////////////////////////////////////

    public array $skills = ['ICDL Online Collaboration', 'MS Word', 'MS Excel'];
    public  $skill = ['MS Project', 'MS World'];

    /////////////////////////////////////////////////////////////////////////

    public array $languages = ['Français', 'Anglais'];
    public  $language = [];
    public array $qualities = ['Innovateur', 'Sens de responsabilité'];
    public array $quality = [];
    public String $driver_licence = "default";

    ////////////////////////////////////////////////////////////////////////

    public  $number_position_offered = 0;
    public bool $immediatly_availability = true;
    public bool $submit_resume = true;
    public bool $submit_letter = true;
    public bool $acceptTerms = false;


    protected function rules()
    {
        return
            [
                1 => [
                    'title' => ['required', 'string', 'min:3'],
                    'field' => ['required', 'array', 'min:1'],
                    'description' => ['required'],

                ],
                2 => [
                    'department_address' => ['required', 'string'],
                    'city_address' => ['required', 'string']
                ],
                3 => [
                    'type' => ['required', 'string'],
                    'paid' => ['boolean'],
                    'date_start' => ['required', 'date', 'after_or_equal:date_of_disability'],
                    'date_end' => ['required', 'date', 'after:date_start'],
                    'working_hours_per_week' => ['integer', 'max:65']
                ],
                4 => [
                    'level_of_education_required' => ['required', 'array', 'min:1'],
                    'required_training' => ['required', 'array', 'min:1'],
                    'experience' => ['required', Rule::in(['default', 'débutant', 'intermédiaire', 'expérimenté'])],
                ],

                5 => [
                    'driver_licence' => ['required', Rule::in(['default', 'A', 'B', 'C', 'D'])],
                    'skill' => ['required', 'array', 'min:1'],
                    'language' => ['required', 'array', 'min:1'],
                    'quality' => ['required', 'array', 'min:1']
                ],
                6 => [
                    'date_of_publication' => ['required', 'date', 'after_or_equal:today'],
                    'date_of_disability' => ['required', 'date', 'after:date_of_publication']
                ],
                7 => [
                    'number_position_offered' => ['required', 'numeric','min:1'],
                    'immediatly_availability' => ['bool'],
                    'submit_resume' => ['bool'],
                    'submit_letter' => ['bool'],

                ]
            ];
    }

    public function updated()
    {
        $this->emit('selectUpdated');
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

    /**
     * Permet de passer à l'étape précédente
     * @return void
     */
    public function prevStep()
    {
        $this->emit('selectUpdated');
        if ($this->currentStep != 1) {
            $this->currentStep--;
        }
    }

    /**
     * Permet de passer à l'étape suivante
     * @return void
     */
    public function nextStep()
    {

        $this->emit('selectUpdated');
        if ($this->currentStep < 8) {

            $rules = $this->rules();
            $this->validate($rules[$this->currentStep]);


            $this->currentStep++;
        } elseif ($this->currentStep == 8) {
            $rules = $this->rules();
            $rules = collect($rules)->collapse()->toArray();
            $internship = $this->validate($rules);

            $stage = InternShip::create([

                'date_start' => $internship['date_start'],
                'date_end' => $internship['date_end'],
                'type' => $internship['type'],
                'paid' => $internship['paid'],
                'working_hours_per_week' => $internship['working_hours_per_week'],
                'trainings' => $internship['required_training'],

                'submit_resume' => $this->submit_resume,
                'submit_letter' => $this->submit_letter
            ]);

            $offer = new Offer([
                'user_id' => Auth::user()->id,
                'title' => $internship['title'],
                'description' => $internship['description'],
                'department_address' => $internship['department_address'],
                'city_address' => $internship['city_address'],
                'skills' => $internship['skill'],
                'fields' => $internship['field'],
                'driver_licence' => $internship['driver_licence'],
                'languages' => $internship['language'],
                'qualities' => $internship['quality'],
                'education_levels' => $internship['level_of_education_required'],
                'experience' => $internship['experience'],
                'publication_date' => $internship['date_of_publication'],
                'disability_date' => $internship['date_of_disability'],
                'number_position_offered' => $internship['number_position_offered'],
                'immediatly_availability' => $internship['immediatly_availability']
            ]);

            $offer = $stage->offer()->save($offer);

            return redirect()->to(route('dashboard'));
        }
    }


    public function mount()
    {
        $this->date_start = date('Y-m-d');
        $this->states = State::all();
        $this->cities = City::all();
    }

    public function render()
    {
        return view('livewire.create-new-internship');
    }
}
