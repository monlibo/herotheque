<?php

namespace App\Http\Livewire\EmployerDashboard\Jobs;

use App\Models\Job;
use Livewire\Component;

class ShowJobDashboard extends Component
{
    public $job;

    public function mount(Job $job)
    {
        $this->job = $job;

        //$this->employement = Employement::find($this->slug);
    }

    public function render()
    {
        return view('livewire.employer-dashboard.jobs.show-job-dashboard');
    }
}
