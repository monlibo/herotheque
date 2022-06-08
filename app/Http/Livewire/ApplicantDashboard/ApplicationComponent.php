<?php

namespace App\Http\Livewire\ApplicantDashboard;

use Livewire\Component;
use App\Models\Application;
use App\Models\JobInterview;
use App\Models\ApplicationInterview;
use Illuminate\Support\Facades\Auth;

class ApplicationComponent extends Component
{
    public $openedTab = "employement";
    public $proposals;
    public $openInterview = false;
    public $interview;

    protected $queryString = [
        'openedTab' => ['except' => 'employement']
    ];

    public function goToTab(string $tab)
    {
        $this->openedTab = $tab;
    }

    public function showInterview(ApplicationInterview $interview)
    {
        $this->interview = $interview;
        $this->openInterview = true;
    }

    public function hideInterview()
    {
        $this->openInterview = false;
        $this->reset('interview');
    }

    public function render()
    {
        $applications = Application::where('user_id',Auth::id())->get();
        return view('livewire.applicant-dashboard.application-component',[
            'applications' => $applications
        ]);
    }
}
