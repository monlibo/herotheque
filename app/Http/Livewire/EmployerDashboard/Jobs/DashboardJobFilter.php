<?php

namespace App\Http\Livewire\EmployerDashboard\Jobs;

use App\Models\Offer;
use App\Models\Company;
use App\Models\Job;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class DashboardJobFilter extends Component
{
    public $search = "";
    public $field = "";
    //public $type = "";
    public $validity = "";
    public $company;
    public $fields = [];
    public $user;

    public string $orderField = "publication_date";
    public string $orderDirection = "DESC";

    public $deleteJob;
    public $openDeleteConfirm;

    protected $queryString =  [
        'search' => ['except' => ''],
        'field' => ['except' => ''],
        //'type' => ['except' => ''],
        'validity' => ['except' => ''],
        'orderDirection' => ['except' => 'DESC'],
        'orderField' => ['except' => 'publication_date']
    ];

    public function deleteConfirmation(Job $job)
    {
        $this->deleteJob = $job;
        $this->openDeleteConfirm = true;
    }

    public function delete(Job $job)
    {
        $job->offer->delete();
        $job->delete();

        $this->reset('deleteJob');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function mount()
    {
        $this->company = Company::find(Auth::user()->id);
        $this->user = Auth::user();

        $this->fields = Offer::getOfferFieldByCompany();
    }



    public function render()
    {

        $jobs = $this->user->offers()
            ->whereHasMorph('offerable', 'App\Models\Job')
            ->where(function ($q) {
                $q->where('title', 'LIKE', "%" . htmlspecialchars(trim($this->search)) . "%")
                    ->orWhere('description', 'LIKE', "%" . htmlspecialchars(trim($this->search)) . "%");
            })
            ->when($this->validity === "true", function ($query) {
                $query->where('disability_date', '>', date('Y-m-d'));
            })
            ->when($this->validity === "false", function ($query) {
                $query->where('disability_date', '<', date('Y-m-d'));
            })
            ->when($this->field, function ($query) {
                $query->whereJsonContains('fields', htmlspecialchars(trim($this->field)));
            })
            ->orderBy($this->orderField, $this->orderDirection)
            ->paginate(10);

        return view('livewire.employer-dashboard.jobs.dashboard-job-filter',[
            'jobs' => $jobs
        ]);
    }
}
