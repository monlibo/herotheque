<?php

namespace App\Http\Livewire\EmployerDashboard\Jobs;

use App\Models\Job;
use Livewire\Component;
use App\Models\Proposal;
use App\Models\JobInterview;

class ProposalComponent extends Component
{

    public $job;
    public $openShow = false;
    public $proposalShow;
    public $openApplicantProfile = false;
    public $openRejectConfirm = false;
    public $rejectId;

    public array $selection = [];

    public $date, $time, $description;
    public int $descriptionLength = 0;

    public function show(Proposal $proposal)
    {
        $this->resetInterview();
        $this->proposalShow = $proposal;
        $this->openShow = true;
    }

    public function resetProposalShow()
    {
        $this->reset('proposalShow');
        $this->openShow = false;
    }

    public function accept(Proposal $proposal)
    {
        $proposal->state = "accepted";
        $proposal->save();
        $this->proposalShow = $proposal;
    }



    public function rejectConfirmation(Proposal $proposal)
    {
        $this->openRejectConfirm = true;
    }

    public function reject(Proposal $proposal)
    {

        $proposal->state = "rejected";

        $proposal->save();
        $this->resetProposalShow();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function resetInterview()
    {
        $this->reset(['selection', 'time', 'date', 'description', 'descriptionLength']);
    }

    public function schedule()
    {
        $this->validate([
            'time' => ['required', 'date_format:H:i'],
            'date' => ['required', 'date'],
            'descriptionLength' => ['integer', 'max:200']
        ]);

        for ($i = 0; $i < count($this->selection); $i++) {
            $interview = JobInterview::where('proposal_id', $this->selection[$i])->get();

            if (count($interview) < 1 && Proposal::find($this->selection[$i])->state == "accepted") {
                JobInterview::create([
                    'proposal_id' => $this->selection[$i],
                    'date' => $this->date,
                    'time' => $this->time,
                    'description' => $this->description
                ]);
            }
        }

        $this->reset(['selection', 'time', 'date', 'description', 'descriptionLength']);
    }

    public function mount(Job $job)
    {
    }


    public function render()
    {
        $proposals = $this->job->offer->proposals->where('state', '!=', 'rejected');
        return view('livewire.employer-dashboard.jobs.proposal-component', [
            'proposals' => $proposals,
            'proposalShow' => $this->proposalShow
        ]);
    }
}
