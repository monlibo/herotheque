<?php

namespace App\Http\Livewire;

use App\Models\Company;
use Livewire\Component;
use Livewire\WithPagination;

class CompanyComponent extends Component
{
    use WithPagination;

    public $search;
    public $geo;
    protected $queryString = [
        'search' => ['except' => ''],
        'geo' => ['except' => '']
    ];

    public function render()
    {
        $companies = Company::where(function ($query) {
            $query->where('name', 'LIKE', '%' . $this->search . '%')
                ->orWhere('description', 'LIKE', '%' . $this->search . '%');
        })
            ->when($this->geo, function ($query) {
                $query->where('city_address', $this->geo)
                    ->orWhere('department_address', $this->geo);
            })
            ->paginate(10);

        return view('livewire.company-component', [
            'companies' => $companies
        ]);
    }
}
