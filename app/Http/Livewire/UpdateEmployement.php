<?php

namespace App\Http\Livewire;

use App\Models\City;
use App\Models\State;
use Livewire\Component;
use App\Models\Employement;
use Illuminate\Validation\Rule;

class UpdateEmployement extends Component
{
    public Int $currentStep = 1;
    public Int $maxStep = 8;
    public $employement;


    public String  $title = "";
    public String $description = "";
    public array $fields = [];
    public array $field = [];
    public array $positions = [];
    public String $offered_position = "";

    public $states;
    public String $department_address = "";
    public $cities;
    public String $city_address = "";


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
            'code' => 'heurs',
            'libelle' => 'Par heure'
        ],

    ];
    public String $payment_frequency = '';
    public $working_hours_per_week = 0;

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
            'code' => 'dti',
            'libelle' => 'DTI'
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
        ],
        [
            'code' => 'd',
            'libelle' => 'Doctorat'
        ]
    ];

    public array $skills = ['ICDL Online Collaboration', 'MS Word', 'MS Excel'];
    public  $skill = [];
    public array $languages = ['Français', 'Anglais'];
    public  $language = [];
    public array $qualities = ['Innovateur', 'Sens de responsabilité'];
    public array $quality = [];
    public String $driver_licence = "default";

    public  $date_of_publication;
    public  $date_of_disability;

    public  $number_position_offered = 0;
    public bool $immediatly_availability = true;
    public bool $submit_resume = true;
    public bool $submit_letter = true;



    protected function  rules()
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
                    'type_of_contract' => ['required', Rule::in(['cdd', 'cdi', 'cde'])],
                    'min_salary' => ['required_if:max_salary,0', 'numeric', 'lt:max_salary'],
                    'max_salary' => ['required_if:min_salary,0', 'numeric', 'gt:min_salary'],
                    'payment_frequency' => ['required','string'],
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


                    'date_of_publication' => [Rule::excludeIf($this->employement->offer->publication_date < now()), 'required', 'date', 'after_or_equal:today'],
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


    public function updateEmployement()
    {
        $this->emit('selectUpdated');
        $rules = $this->rules();
        $rules = collect($rules)->collapse()->toArray();
        $employement1 = $this->validate($rules);

        if ($this->employement->offer->publication_date > now()) {
            $this->date_of_publication = $employement1['date_of_publication'];
        }

        $this->employement->update([
            'offered_position' => $employement1['offered_position'],
            'type_of_contract' => $employement1['type_of_contract'],
            'min_salary' => $employement1['min_salary'],
            'max_salary' => $employement1['max_salary'],
            'payment_frequency' => $employement1['payment_frequency'],
            'working_hours_per_week' => $employement1['working_hours_per_week'],
            'trainings' => $employement1['required_training'],
            'submit_resume' => $employement1['submit_resume'],
            'submit_letter' => $employement1['submit_letter']
        ]);

        $this->employement->offer->update([
            'title' => $employement1['title'],
            'description' => $employement1['description'],
            'department_address' => $employement1['department_address'],
            'city_address' => $employement1['city_address'],
            'skills' => $employement1['skill'],
            'fields' => $employement1['field'],
            'driver_licence' => $employement1['driver_licence'],
            'languages' => $employement1['language'],
            'qualities' => $employement1['quality'],
            'education_levels' => $employement1['level_of_education_required'],
            'experience' => $employement1['experience'],
            'publication_date' => $this->date_of_publication,
            'disability_date' => $employement1['date_of_disability'],
            'number_position_offered' => $employement1['number_position_offered'],
            'immediatly_availability' => $employement1['immediatly_availability'],
        ]);

        session()->flash('message', 'Mise à jour de l\'emploi avec succès.');

        return redirect()->to(route('employement'));
    }

    public function mount(Employement $employement)
    {

        $this->states = State::all();
        $this->cities = City::all();

        $this->employement = $employement;
        $this->title = $this->employement->offer->title;
        $this->description = $this->employement->offer->description;
        $this->field = $this->employement->offer->fields;
        $this->offered_position = $this->employement->offered_position;

        $this->department_address = $this->employement->offer->department_address;
        $this->city_address = $this->employement->offer->city_address;

        $this->type_of_contract = $this->employement->type_of_contract;
        $this->min_salary = $this->employement->min_salary;
        $this->max_salary = $this->employement->max_salary;
        $this->payment_frequency = $this->employement->payment_frequency;
        $this->working_hours_per_week = $this->employement->working_hours_per_week;

        $this->required_training = $this->employement->trainings;
        $this->experience = $this->employement->offer->experience;
        $this->level_of_education_required = $this->employement->offer->education_levels;

        $this->skill = $this->employement->offer->skills;
        $this->language = $this->employement->offer->languages;
        $this->quality  = $this->employement->offer->qualities;
        $this->driver_licence = $this->employement->offer->driver_licence;

        $this->date_of_publication = $this->employement->offer->publication_date;
        $this->date_of_disability = $this->employement->offer->disability_date;

        $this->number_position_offered = $this->employement->offer->number_position_offered;
        $this->immediatly_availability = $this->employement->offer->immediatly_availability;
        $this->submit_resume = $this->employement->submit_resume;
        $this->submit_letter = $this->employement->submit_letter;
    }

    public function render()
    {
        return view('livewire.update-employement');
    }
}
