<?php

namespace App\Http\Livewire;

use App\Models\Job;
use App\Models\City;
use App\Models\Offer;
use App\Models\State;
use Livewire\Component;
use App\Models\InternShip;
use App\Models\OfferField;
use App\Models\OfferSkill;
use App\Models\OfferLanguage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class CreateNewJob extends Component
{

    protected $listeners = ['resetForm' => 'resetForm'];

    public function resetForm()
    {
        $this->reset();
    }

    public $currentStep = 1;
    public $maxStep = 6;

    public $title = "";
    public $description = "";
    public $fields = [];
    public $field = [];
    public $types = [
        [
            'code' => 'va',
            'libelle' => 'Job de vacance'
        ],
        [
            'code' => 'et',
            'libelle' => 'Job étudiant'
        ],
        [
            'code' => 'li',
            'libelle' => 'Job libre'
        ],
    ];
    public $type = [];

    public $states;
    public String $department_address = "";
    public  $cities;
    public String $city_address = "";

    public $date_start;
    public $date_end;
    public bool $salary_fixed = true;
    public  $salary = 0;
    public $min_salary = 0;
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
    public  $number_position_offered = 0;



    public array $skills = ['ICDL Online Collaboration', 'MS Word', 'MS Excel'];
    public  $skill = ['MS Project', 'MS Word'];

    public array $languages = ['Français', 'Anglais'];
    public  $language = [];

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
    public String $driver_licence = "default";
    public  $date_of_publication;
    public  $date_of_disability;
    public bool $immediatly_availability = true;


    protected function rules()
    {
        return
            [
                1 => [
                    'title' => ['required', 'string', 'min:3'],
                    'field' => ['required', 'array', 'min:1'],
                    'description' => ['required'],
                    // 'type' => ['required', 'string'],
                ],
                2 => [
                    'department_address' => ['required', 'string'],
                    'city_address' => ['required', 'string']
                ],
                3 => [
                    'date_start' => ['required', 'date', 'after_or_equal:today'],
                    'date_end' => ['required', 'date', 'after:date_start'],
                    'salary_fixed' => ['bool'],
                    'max_salary' => ['exclude_if:salary_fixed,true', 'numeric', 'gt:min_salary'],
                    'min_salary' => ['exclude_if:salary_fixed,true', 'numeric', 'lt:max_salary'],
                    'salary' => ['exclude_if:salary_fixed,false', 'numeric', 'min:1'],
                    'working_hours_per_week' => ['integer', 'max:65'],
                    'payment_frequency' => ['required', Rule::in(['mois', 'jour', 'trimestre', 'semaine', 'heure'])],
                    'number_position_offered' => ['required', 'numeric', 'min:1']
                ],
                4 => [
                    'driver_licence' => ['required', Rule::in(['default', 'A', 'B', 'C', 'D'])],
                    'skill' => ['required', 'array', 'min:1'],
                    'language' => ['required', 'array', 'min:1'],
                    'level_of_education_required' => ['required', 'array', 'min:1'],
                    'immediatly_availability' => ['bool'],
                ],
                5 => [
                    'date_of_publication' => ['required', 'date', 'after_or_equal:today'],
                    'date_of_disability' => ['required', 'date', 'after:date_of_publication']
                ],

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
        if ($this->currentStep < 6) {

            $rules = $this->rules();
            $this->validate($rules[$this->currentStep]);


            $this->currentStep++;
        } elseif ($this->currentStep == 6) {
            $rules = $this->rules();
            $rules = collect($rules)->collapse()->toArray();
            $job = $this->validate($rules);

            $jobb = Job::create([

                'date_start' => $job['date_start'],
                'date_end' => $job['date_end'],
                'salary_fixed' => $job['salary_fixed'],
                'salary' => $this->salary,
                'min_salary' => $this->min_salary,
                'max_salary' => $this->max_salary,
                'payment_frequency' => $job['payment_frequency'],
                //'type' => $job['type'],
                'working_hours_per_week' => $job['working_hours_per_week'],
            ]);

            $offer = new Offer([
                'user_id' => Auth::user()->id,
                'title' => $job['title'],
                'description' => $job['description'],
                'department_address' => $job['department_address'],
                'city_address' => $job['city_address'],
                'skills' => $job['skill'],
                'fields' => $job['field'],
                'driver_licence' => $job['driver_licence'],
                'languages' => $job['language'],
                'education_levels' => $job['level_of_education_required'],
                //'experience' => $job['experience'],
                'immediatly_availability' => $this->immediatly_availability,
                'publication_date' => $job['date_of_publication'],
                'disability_date' => $job['date_of_disability'],
                'number_position_offered' => $job['number_position_offered']
            ]);

            $offer = $jobb->offer()->save($offer);
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
        return view('livewire.create-new-job');
    }
}
