<?php

namespace App\Http\Livewire;

use App\Models\BookMark;
use App\Models\Company;
use App\Models\Offer;
use Livewire\Component;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Livewire\WithPagination;

class SearchComponent extends Component
{
    use WithPagination;

    public $q = "";
    public $geo = "";
    public $type = "";
    public $field = "";
    public $fields = [];
    public $skill = "";
    public $skills = [];
    public $experience = "";
    public $level = "";
    public $levels = [];



    protected $queryString = [
        'q' => ['except' => ''],
        'geo' => ['except' => ''],
        'type' => ['except' => ''],
        'field' => ['except' => ''],
        'skill' => ['except' => ''],
        'experience' => ['except' => ''],
        'level' => ['except' => '']
    ];

    public function setTyp(string $type)
    {
        $this->type = $type;
    }

    public function getCompany(int $id)
    {
        return Company::where('user_id', $id)->get();
    }

    public function bookMark(Offer $offer)
    {
        if ($offer->isMarked()) {

            $offer->removeMark();
        } elseif (Auth::user()) {
            $offer->bookMarks()->create([
                'user_id' => auth()->id(),
            ]);
        } else {
            return redirect()->route('login');
        }
    }

    public function mount(Request $request, Company $company)
    {

        $fields = Offer::select('fields')->get();


        foreach ($fields as $field) {
            $this->fields = collect($this->fields)->merge($field->fields);
        }

        $this->fields = collect($this->fields)->unique()->values()->all();

        $skills = Offer::select('skills')->get();
        foreach ($skills as $skill) {
            $this->skills = collect($this->skills)->merge($skill->skills);
        }
        $this->skills = collect($this->skills)->unique()->values()->all();

        $levels = Offer::select('education_levels')->get();
        foreach ($levels as $level) {
            $this->levels = collect($this->levels)->merge($level->education_levels);
        }
        $this->levels = collect($this->levels)->unique()->values()->all();
    }

    public function render(Request $request)
    {

        $offers = Offer::where(function ($q) {
            $q->where('title', 'LIKE', '%' . $this->q . '%')
                ->orWhere('description', 'LIKE', '%' . $this->q . '%');
        })
            ->when($this->type, function ($query) {
                if ($this->type == "emploi") {
                    $query->where('offerable_type', 'App\Models\Employement');
                } elseif ($this->type == "internship") {
                    $query->where('offerable_type', 'App\Models\Internship');
                } elseif ($this->type == "job") {
                    $query->where('offerable_type', 'App\Models\Job');
                }
            })
            ->when(!empty($this->geo), function ($q) {
                $q->where(function ($q) {
                    $q->where('department_address', $this->geo)
                        ->orWhere('city_address', $this->geo);
                });
            })
            ->when($this->field, function ($query) {
                $query->whereJsonContains('fields', htmlspecialchars(trim($this->field)));
            })
            ->when($this->skill, function ($query) {
                $query->whereJsonContains('skills', htmlspecialchars(trim($this->skill)));
            })
            ->when($this->experience, function ($query) {
                $query->where('experience', htmlspecialchars(trim($this->experience)));
            })
            ->when($this->level, function ($query) {
                $query->whereJsonContains('education_levels', htmlspecialchars(trim($this->level)));
            })
            ->where('disability_date','>',now())
            ->orderBy('publication_date','desc')
            ->paginate(6);

        return view('livewire.search-component', [
            'offers' => $offers,
        ]);
    }
}
