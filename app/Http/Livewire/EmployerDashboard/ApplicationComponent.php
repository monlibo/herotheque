<?php

namespace App\Http\Livewire\EmployerDashboard;

use App\Models\Application;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class ApplicationComponent extends Component
{
    public $openShow = false;
    public $applicationShow;
    public $openApplicantProfile = false;
    public $openRejectConfirm = false;
    public $rejectId;
    public $openInterviewForm = false;

    public $date, $time, $description;
    public int $descriptionLength = 0;

    public function show(Application $application)
    {
        //$this->resetInterview();
        $this->applicationShow = $application;
        $this->openShow = true;
    }

    public function resetApplicationShow()
    {
        $this->reset('applicationShow');
        $this->openShow = false;
    }

    public function accept(Application $application)
    {
        $application->state = "accepted";
        $application->save();
        $this->applicationShow = $application;
    }

    public function rejectConfirmation(Application $application)
    {
        $this->openRejectConfirm = true;
    }

    public function reject(Application $application)
    {

        $application->state = "rejected";

        $application->save();
        $this->resetApplicationShow();
        $this->dispatchBrowserEvent('close-modal');
    }

    public function startInterview()
    {
        $this->openInterviewForm = true;
    }

    public function schedule()
    {
        $this->validate([
            'time' => ['required', 'date_format:H:i'],
            'date' => ['required', 'date'],
            'descriptionLength' => ['integer', 'max:200']
        ]);

        $this->applicationShow->interview()->create([
            'application_id' => $this->applicationShow->id,
            'date' => $this->date,
            'time' => $this->time,
            'description' => $this->description
        ]);



        $this->reset(['time', 'date', 'description', 'descriptionLength', 'applicationShow']);

        $this->openShow = false;
    }


    public function render()
    {
        $applications = Auth::user()->company->applications->where('state', '!=', 'rejected');

        return view('livewire.employer-dashboard.application-component', [
            'applications' => $applications
        ]);
    }
}
