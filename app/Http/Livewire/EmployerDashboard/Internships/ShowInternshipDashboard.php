<?php

namespace App\Http\Livewire\EmployerDashboard\Internships;

use Livewire\Component;
use App\Models\Employement;
use App\Models\InternShip;

class ShowInternshipDashboard extends Component
{

    public $internship;

    public function mount(InternShip $internship)
    {
        $this->internship = $internship;

        //$this->employement = Employement::find($this->slug);
    }
    
    public function render()
    {
        return view('livewire.employer-dashboard.internships.show-internship-dashboard');
    }
}
