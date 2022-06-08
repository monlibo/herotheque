<?php

namespace App\Http\Livewire\Employement;

use App\Models\Offer;
use App\Models\Profile;
use App\Models\User;
use Livewire\Component;
use App\Models\Employement;
use App\Models\Proposal;
use App\Notifications\OfferApplicatedNotification;
use Illuminate\Support\Facades\Auth;

class ShowComponent extends Component
{
    public $employement;
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
                    ->where('offer_id', $this->employement->offer->id)
                    ->first();

                if ($proposal) {
                    session()->flash('message', 'Vous avez déjà postulé à cette offre !!');
                    $this->emit('flash');
                } elseif (!Auth::user()->profile->canPostulate() || !Auth::user()->isVailable()) {
                    session()->flash('message', 'Veuillez remplir votre profil pour pouvoir postuler à cette offre');
                    $this->emit('flash');
                } else {
                    $this->openProposalForm = true;
                }
            } elseif (Auth::user()->hasRole('employer')) {
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

        $proposal = Proposal::create([
            'user_id' => Auth::id(),
            'offer_id' => $this->employement->offer->id,
            'motivation' => $this->motivation,
            'state' => 'loading'
        ]);

        $user = $this->employement->offer->user;
        $user->notify(new OfferApplicatedNotification($user,$this->employement->offer));

        return redirect()->route('dashboard');
    }


    public function mount(Employement $employement)
    {
    }

    public function render()
    {
        return view('livewire.employement.show-component');
    }
}
