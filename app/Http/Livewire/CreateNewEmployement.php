<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\Offer;
use Livewire\Component;
use App\Models\OfferField;
use App\Models\OfferSkill;
use App\Models\Employement;
use App\Models\OfferQuality;
use App\Models\OfferLanguage;
use App\Models\State;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\RequiredIf;


class CreateNewEmployement extends Component
{

    protected $listeners = ['resetForm' => 'resetForm'];

    public function resetForm()
    {
        $this->reset();
    }

    public Int $currentStep = 1;
    public Int $maxStep = 8;

    public String  $title = "";
    public String $description = "";
    public array $fields = ['Informatique', 'Comptabilité', 'Génie civile'];
    public array $field = [];
    public array $positions = [];
    public String $offered_position = "";

    /////////////////////////////////////////////////////////////////////////////


    public String $department_address = "";

    public String $city_address = "";

    ////////////////////////////////////////////////////////////////////////////

    public array $contracts = [
        [
            'code' => 'cdd',
            'libelle' => 'Contrat à durée déterminée'
        ],
        [
            'code' => 'cdi',
            'libelle' => 'Contrat à durée indéterminée'
        ],
        [
            'code' => 'cee',
            'libelle' => 'Contrat d\'engagement à l\'essai'
        ]
    ];

    public String $type_of_contract = '';
    public  $min_salary = 0;
    public  $max_salary = 0;
    public array $frequencies = [
        [
            'code' => 'trimestre',
            'libelle' => 'Par trimestre'
        ],
        [
            'code' => 'mois',
            'libelle' => 'Par mois'
        ],
        [
            'code' => 'semaine',
            'libelle' => 'Par semaine'
        ],
        [
            'code' => 'jour',
            'libelle' => 'Par jour'
        ],
        [
            'code' => 'heure',
            'libelle' => 'Par heure'
        ],

    ];
    public String $payment_frequency = '';
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
    public  $skill = ['MS Project', 'MS Word'];



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

    //public String $promote_zone="";
    //public String $contact_mode="";


    protected function rules()
    {
        return
            [
                1 => [
                    'title' => ['required', 'string', 'min:3'],
                    'field' => ['required', 'array', 'min:1'],
                    'description' => ['required'],
                    'offered_position' => ['required', 'string']
                ],
                2 => [
                    'department_address' => ['required', 'string'],
                    'city_address' => ['required', 'string']
                ],
                3 => [
                    'type_of_contract' => ['required', Rule::in(['cdd', 'cdi', 'cee'])],
                    'min_salary' => ['required_if:max_salary,0', 'numeric', 'lt:max_salary'],
                    'max_salary' => ['required_if:min_salary,0', 'numeric', 'gt:min_salary'],
                    'payment_frequency' => ['required'],
                    'working_hours_per_week' => ['integer', 'max:65']
                ],
                4 => [
                    'level_of_education_required' => ['required', 'array', 'min:1'],
                    'required_training' => ['required', 'array', 'min:1'],
                    'experience' => ['required', Rule::in(['débutant', 'intermédiaire', 'expérimenté'])],
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
            $employement = $this->validate($rules);


            $employ = Employement::create([
                'offered_position' => $employement['offered_position'],
                'type_of_contract' => $employement['type_of_contract'],
                'min_salary' => $employement['min_salary'],
                'max_salary' => $employement['max_salary'],
                'payment_frequency' => $employement['payment_frequency'],
                'working_hours_per_week' => $employement['working_hours_per_week'],
                'trainings' => $employement['required_training'],
                'submit_resume' => $this->submit_resume,
                'submit_letter' => $this->submit_letter
            ]);

            $offer = new Offer([
                'user_id' => Auth::user()->id,
                'title' => $employement['title'],
                'description' => $employement['description'],
                'department_address' => $employement['department_address'],
                'city_address' => $employement['city_address'],
                'skills' => $employement['skill'],
                'fields' => $employement['field'],
                'driver_licence' => $employement['driver_licence'],
                'languages' => $employement['language'],
                'qualities' => $employement['quality'],
                'education_levels' => $employement['level_of_education_required'],
                'experience' => $employement['experience'],
                'publication_date' => $employement['date_of_publication'],
                'disability_date' => $employement['date_of_disability'],
                'number_position_offered' => $employement['number_position_offered'],
                'immediatly_availability' => $this->immediatly_availability,
            ]);

            $offer = $employ->offer()->save($offer);

            session()->flash('message', 'Offre d\'emploi ajoutée avec succès');
            return redirect()->to(route('dashboard'));


            //return redirect()->to('/contact-form-success');
        }
    }

    public function mount()
    {
        $this->date_of_publication = date('Y-m-d');
        $this->states = State::all();
        $this->cities = City::all();
    }

    public function render()
    {

        return view('livewire.create-new-employement');
    }
}
