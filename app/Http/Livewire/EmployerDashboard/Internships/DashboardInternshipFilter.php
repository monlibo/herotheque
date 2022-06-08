<?php

namespace App\Http\Livewire\EmployerDashboard\Internships;

use App\Models\Offer;
use App\Models\Company;
use App\Models\InternShip;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;

class DashboardInternshipFilter extends Component
{


    public $search = "";
    public $field = "";
    public $type = "";
    public $validity = "";
    public $company;
    public $fields = [];
    public $user;

    public string $orderField = "publication_date";
    public string $orderDirection = "DESC";

    public $deleteInternship;
    public $openDeleteConfirm;

    public function setOrderField(string $name)
    {
        if ($name === $this->orderField) {
            $this->orderDirection = $this->orderDirection === 'ASC' ? 'DESC' : 'ASC';
        } else {
            $this->orderField = $name;
            $this->reset('orderDirection');
            $this->orderDirection = "ASC";
        }
    }

    protected $queryString =  [
        'search' => ['except' => ''],
        'field' => ['except' => ''],
        'type' => ['except' => ''],
        'validity' => ['except' => ''],
        'orderDirection' => ['except' => 'DESC'],
        'orderField' => ['except' => 'publication_date']
    ];

    public function deleteConfirmation(InternShip $internship)
    {
        $this->deleteInternship = $internship;
        $this->openDeleteConfirm = true;
    }

    public function delete(InternShip $internship)
    {
        $internship->offer->delete();

        $internship->delete();

        $this->reset('deleteInternship');
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

        $internships = $this->user->offers()
            ->whereHasMorph('offerable', 'App\Models\InternShip', function (Builder $q) {
                $q->when($this->type, function ($q) {
                    $q->where('type', htmlspecialchars(trim($this->type)));
                });
            })
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


            return view('livewire.employer-dashboard.internships.dashboard-internship-filter',[
            'internships' => $internships
        ]);

    }
}
