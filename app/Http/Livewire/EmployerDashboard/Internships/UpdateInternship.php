<?php

namespace App\Http\Livewire\EmployerDashboard\Internships;

use App\Models\City;
use App\Models\Offer;
use App\Models\State;
use Livewire\Component;
use App\Models\InternShip;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;

class UpdateInternship extends Component
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
    public bool $paid;
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

    /////////////////////////////////////////////////////////////////////////

    public array $languages = ['Français', 'Anglais'];
    public  $language = [];
    public array $qualities = ['Innovateur', 'Sens de resposabilité'];
    public array $quality = [];
    public String $driver_licence = "default";

    ////////////////////////////////////////////////////////////////////////

    public  $number_position_offered = 0;
    public bool $immediatly_availability = true;
    public bool $submit_resume;
    public bool $submit_letter;
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
                    'date_start' => ['required', 'date', 'after:date_of_disability'],
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
                    'date_of_publication' => [Rule::excludeIf($this->internship->offer->publication_date < now()), 'required', 'date', 'after_or_equal:today'],
                    'date_of_disability' => ['required', 'date', 'after:date_of_publication']
                ],
                7 => [
                    'number_position_offered' => ['required', 'numeric'],
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




    public function updateInternship()
    {
        $this->emit('selectUpdated');
        $rules = $this->rules();
        $rules = collect($rules)->collapse()->toArray();
        $internship1 = $this->validate($rules);

        if ($this->internship->offer->publication_date > now()) {
            $this->date_of_publication = $internship1['date_of_publication'];
        }

        $this->internship->update([
            'date_start' => $internship1['date_start'],
            'date_end' => $internship1['date_end'],
            'type' => $internship1['type'],
            'paid' => $internship1['paid'],
            'working_hours_per_week' => $internship1['working_hours_per_week'],
            'trainings' => $internship1['required_training'],
            'submit_resume' => $this->submit_resume,
            'submit_letter' => $this->submit_letter
        ]);

        $this->internship->offer->update([
            'title' => $internship1['title'],
            'description' => $internship1['description'],
            'department_address' => $internship1['department_address'],
            'city_address' => $internship1['city_address'],
            'skills' => $internship1['skill'],
            'fields' => $internship1['field'],
            'driver_licence' => $internship1['driver_licence'],
            'languages' => $internship1['language'],
            'qualities' => $internship1['quality'],
            'education_levels' => $internship1['level_of_education_required'],
            'experience' => $internship1['experience'],
            'publication_date' => $this->date_of_publication,
            'disability_date' => $internship1['date_of_disability'],
            'number_position_offered' => $internship1['number_position_offered'],
            'immediatly_availability' => $internship1['immediatly_availability']
        ]);

        session()->flash('message', 'Mise à jour du stage avec succès.');

        return redirect()->to(route('internship'));
    }

    public function mount(InternShip $internship)
    {

        $this->states = State::all();
        $this->cities = City::all();

        $this->internship = $internship;
        $this->title = $this->internship->offer->title;
        $this->description = $this->internship->offer->description;
        $this->field = $this->internship->offer->fields;
        $this->offered_position = $this->internship->offered_position;

        $this->department_address = $this->internship->offer->department_address;
        $this->city_address = $this->internship->offer->city_address;

        $this->type = $this->internship->type;
        $this->date_start = $this->internship->date_start;
        $this->date_end = $this->internship->date_end;
        $this->paid = $this->internship->paid;

        $this->required_training = $this->internship->trainings;
        $this->experience = $this->internship->offer->experience;
        $this->level_of_education_required = $this->internship->offer->education_levels;

        $this->skill = $this->internship->offer->skills;
        $this->language = $this->internship->offer->languages;
        $this->quality  = $this->internship->offer->qualities;
        $this->driver_licence = $this->internship->offer->driver_licence;

        $this->date_of_publication = $this->internship->offer->publication_date;
        $this->date_of_disability = $this->internship->offer->disability_date;

        $this->number_position_offered = $this->internship->offer->number_position_offered;
        $this->immediatly_availability = $this->internship->offer->immediatly_availability;
        $this->submit_resume = $this->internship->submit_resume;
        $this->submit_letter = $this->internship->submit_letter;
    }

    public function render()
    {
        return view('livewire.employer-dashboard.internships.update-internship');
    }
}
