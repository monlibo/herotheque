<?php

namespace App\Http\Livewire;

use App\Models\Employement;
use Livewire\Component;

class ShowEmployementDashboard extends Component
{
    
    public $employement;
    
    public function mount(Employement $employement){
        $this->employement = $employement;

        //$this->employement = Employement::find($this->slug);
    }

    public function render()
    {
        return view('livewire.show-employement-dashboard');
    }
}
