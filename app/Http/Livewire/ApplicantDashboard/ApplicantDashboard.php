<?php

namespace App\Http\Livewire\ApplicantDashboard;

use App\Models\Application;
use App\Models\Proposal;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApplicantDashboard extends Component
{
    public $proposalCount;
    public $applicationCount;
    public function mount()
    {
       $this->proposalCount =  Proposal::where('user_id',Auth::id())->get()->count();
       $this->applicationCount = Application::where('user_id',Auth::id())->get()->count();
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.applicant-dashboard');
    }
}
