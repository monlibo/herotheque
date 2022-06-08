<?php

namespace App\Http\Livewire\ApplicantDashboard;

use App\Models\JobInterview;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ProposalComponent extends Component
{
    public $openedTab = "employement";
    public $proposals;
    public $openInterview = false;
    public $jobInterview;

    protected $queryString = [
        'openedTab' => ['except' => 'employement']
    ];

    public function goToTab(string $tab)
    {
        $this->openedTab = $tab;
    }

    public function showInterview(JobInterview $jobInterview)
    {
        $this->jobInterview = $jobInterview;
        $this->openInterview = true;
    }

    public function hideInterview()
    {
        $this->openInterview = false;
        $this->reset('jobInterview');
    }

    public function render()
    {
        if ($this->openedTab ==  "employement") {

            $this->proposals =
                Proposal::whereHas('offer', function ($query) {
                    $query->where('offerable_type', 'App\Models\Employement');
                })
                ->where('user_id', Auth::id())
                ->get();
        } elseif ($this->openedTab ==  "internship") {
            $this->proposals =
                Proposal::whereHas('offer', function ($query) {
                    $query->where('offerable_type', 'App\Models\InternShip');
                })
                ->where('user_id', Auth::id())
                ->get();
        } elseif ($this->openedTab ==  "job") {
            $this->proposals =
                Proposal::whereHas('offer', function ($query) {
                    $query->where('offerable_type', 'App\Models\Job');
                })
                ->where('user_id', Auth::id())
                ->get();
        }

        return view('livewire.applicant-dashboard.proposal-component');
    }
}
