<?php

namespace App\Http\Livewire\Job;

use App\Models\Job;
use App\Models\Offer;
use Livewire\Component;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;

class ShowComponent extends Component
{

    public $job;
    public $openProposalForm = false;
    public $motivation;
    public int $motivationLength = 0;


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

    public function showPostulateForm()
    {
        if (Auth::check()) {
            if (Auth::user()->hasRole('applicant')) {
                $proposal = Proposal::where('user_id', Auth::id())
                    ->where('offer_id', $this->job->offer->id)
                    ->first();

                if ($proposal) {
                    session()->flash('message', 'Vous avez déjà postulé à cette offre !!');
                    $this->emit('flash');
                } else {
                    $this->openProposalForm = true;
                }
            } else {
                session()->flash('message', 'Vous ne pouvez pas postuler à cette offre');
                $this->emit('flash');
            }
        } else {
            return redirect()->route('login');
        }
    }

    protected $rules = [
        'motivationLength' => ['integer', 'min:200', 'max:700'],
    ];



    public function postulate()
    {

        $this->validate();

        Proposal::create([
            'user_id' => Auth::id(),
            'offer_id' => $this->job->offer->id,
            'motivation' => $this->motivation,
            'state' => 'loading'
        ]);

        return redirect()->route('dashboard');
    }

    public function mount(Job $job)
    {
    }

    public function render()
    {
        return view('livewire.job.show-component');
    }
}
