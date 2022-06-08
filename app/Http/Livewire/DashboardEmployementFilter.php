<?php

namespace App\Http\Livewire;

use App\Models\User;
use App\Models\Offer;
use App\Models\Company;
use Livewire\Component;

use App\Models\Employement;
use Carbon\Carbon;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use phpDocumentor\Reflection\Types\This;

class DashboardEmployementFilter extends Component
{
    use WithPagination;

    public $search = "";
    public $field = "";
    public $contract = "";
    public $validity = "";
    public $company;
    public $fields = [];
    public $user;

    public $deleteEmployement;
    public $openDeleteConfirm;

    public string $orderField = "publication_date";
    public string $orderDirection = "DESC";

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
        'contract' => ['except' => ''],
        'validity' => ['except' => ''],
        'orderDirection' => ['except' => 'DESC'],
        'orderField' => ['except' => 'publication_date']
    ];

    public function deleteConfirmation(Employement $employement)
    {
        $this->deleteEmployement = $employement;
        $this->openDeleteConfirm = true;
    }

    public function delete(Employement $employement)
    {
        $employement->offer->delete();
        $employement->delete();

        $this->reset('deleteEmployement');
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
        // Pour récupérer toutes les offres où il y a un domaine donné
        //dd(Offer::whereJsonContains('fields', 'Hotellerie')->get());

        $employements = $this->user->offers()
            ->whereHasMorph('offerable', 'App\Models\Employement', function (Builder $q) {
                $q->when($this->contract, function ($q) {
                    $q->where('type_of_contract', htmlspecialchars(trim($this->contract)));
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


        return view('livewire.dashboard-employement-filter', [
            'employements' => $employements
        ]);
    }
}
