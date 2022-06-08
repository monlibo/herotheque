<?php

namespace App\Http\Livewire\Company;

use App\Models\Application;
use App\Models\Offer;
use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;

class ShowComponent extends Component
{
    use WithPagination;

    public $company;
    public $type = '';
    public $openProposalForm = false;
    protected $queryString = ['type' => ['except' => '']];

    public $motivation;
    public int $motivationLength = 0;
    public $position;

    public function setTyp(string $type)
    {
        $this->type = $type;
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


    public function openCandidateForm()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('applicant')) {
                if (Auth::user()->profile->canPostulate() || Auth::user()->isVailable()) {
                    $this->openProposalForm = true;
                } else {
                    session()->flash('message', 'Veuillez remplir votre profil pour pouvoir postuler à cette offre');
                    $this->emit('flash');
                }
            } elseif (Auth::user()->hasRole('employer')) {
                session()->flash('message', 'Vous ne pouvez pas postuler à cette offre d\'emploi');
                $this->emit('flash');
            }
        } else {
            return redirect()->route('login');
        }
    }

    public function hideCandidateForm()
    {
        $this->reset(['position', 'motivationLength', 'openProposalForm']);
    }

    protected $rules = [
        'motivationLength' => ['integer', 'min:200', 'max:700'],
        'position' => ['required', 'string', 'min:3']
    ];

    public function applicate()
    {

        $this->validate();

        Application::create([
            'user_id' => Auth::id(),
            'company_id' => $this->company->id,
            'motivation' => $this->motivation,
            'position' => $this->position,
            'state' => 'loading'
        ]);

        return redirect()->route('dashboard');
    }

    public function mount(Company $company)
    {
        $this->company = $company;
    }

    public function render()
    {
        $user = $this->company->user;
        $offers =  $user->offers()->when($this->type, function ($query) {
            if ($this->type == "employement") {
                $query->whereHasMorph('offerable', 'App\Models\Employement');
            } elseif ($this->type == "internship") {
                $query->whereHasMorph('offerable', 'App\Models\InternShip');
            }
        })->paginate(10);


        return view('livewire.company.show-component', [
            'offers' => $offers
        ]);
    }
}
