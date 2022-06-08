<?php

namespace App\Http\Livewire\EmployerDashboard\Jobs;

use App\Models\Job;
use App\Models\City;
use App\Models\State;
use Livewire\Component;
use Illuminate\Validation\Rule;

class UpdateJob extends Component
{

    public $job;
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

    public $date_start;
    public $date_end;
    public bool $salary_fixed = true;
    public  $salary = 0;
    public $min_salary;
    public  $max_salary;

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
    public  $number_position_offered = 0;

    public array $skills = ['ICDL Online Collaboration', 'MS Word', 'MS Excel'];
    public  $skill = ['MS Project', 'MS World'];

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
                    'payment_frequency' => ['required', Rule::in(['mois', 'jour', 'année', 'trimestre', 'semaine', 'heure'])],
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
                    'date_of_publication' => [Rule::excludeIf($this->job->offer->publication_date < now()), 'required', 'date', 'after_or_equal:today'],
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

    public function updateJob()
    {

        $this->emit('selectUpdated');
        $rules = $this->rules();
        $rules = collect($rules)->collapse()->toArray();
        $job1 = $this->validate($rules);

        if ($this->job->offer->publication_date > now()) {
            $this->date_of_publication = $job1['date_of_publication'];
        }

        if ($job1['salary_fixed'] == true) {
            $this->min_salary = 0;
            $this->max_salary = 0;
        } else {
            $this->salary = 0;
        }

        $this->job->update([
            'date_start' => $job1['date_start'],
            'date_end' => $job1['date_end'],
            'salary_fixed' => $job1['salary_fixed'],
            'salary' => $this->salary,
            'min_salary' => $this->min_salary,
            'max_salary' => $this->max_salary,
            'working_hours_per_week' => $job1['working_hours_per_week'],
            //'trainings' => json_encode($job1['required_training']),
            //'submit_resume' => $this->submit_resume,
            //'submit_letter' => $this->submit_letter
        ]);

        $this->job->offer->update([
            'title' => $job1['title'],
            'description' => $job1['description'],
            'department_address' => $job1['department_address'],
            'city_address' => $job1['city_address'],
            'skills' => $job1['skill'],
            'fields' => $job1['field'],
            'driver_licence' => $job1['driver_licence'],
            'languages' => $job1['language'],
            //'qualities' => json_encode($job1['quality']),
            'education_levels' => $job1['level_of_education_required'],
            //'experience' => $job1['experience'],
            'publication_date' => $this->date_of_publication,
            'disability_date' => $job1['date_of_disability'],
            'number_position_offered' => $job1['number_position_offered'],
            'immediatly_availability' => $job1['immediatly_availability']
        ]);

        session()->flash('message', 'Mise à jour du job avec succès.');

        return redirect()->to(route('job'));
    }

    public function mount(Job $job)
    {

        $this->states = State::all();
        $this->cities = City::all();

        $this->job = $job;
        $this->title = $this->job->offer->title;
        $this->description = $this->job->offer->description;
        $this->field = $this->job->offer->fields;

        $this->department_address = $this->job->offer->department_address;
        $this->city_address = $this->job->offer->city_address;

        $this->date_start = $this->job->date_start;
        $this->date_end = $this->job->date_end;
        $this->salary_fixed = $this->job->salary_fixed;
        $this->salary = $this->job->salary;
        $this->min_salary = $this->job->min_salary;
        $this->payment_frequency = $this->job->payment_frequency;
        $this->number_position_offered = $this->job->offer->number_position_offered;
        $this->working_hours_per_week = $this->job->working_hours_per_week;

        $this->skill = $this->job->offer->skills;
        $this->language = $this->job->offer->languages;
        $this->level_of_education_required = $this->job->offer->education_levels;
        $this->driver_licence = $this->job->offer->driver_licence;

        $this->date_of_publication = $this->job->offer->publication_date;
        $this->date_of_disability = $this->job->offer->disability_date;
    }

    public function render()
    {
        return view('livewire.employer-dashboard.jobs.update-job');
    }
}
