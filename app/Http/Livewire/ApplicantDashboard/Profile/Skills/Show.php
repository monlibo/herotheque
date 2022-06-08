<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile\Skills;

use App\Models\Profile;
use Livewire\Component;

class Show extends Component
{
    public Profile $profile;
    public $skills;
    public $editId=0;
    public $idDelete;

    public bool $isAddFormOpen = false;

    public function showAddForm()
    {
        $this->emit('selectUpdated');
        //$this->emit('refreshComponent');
        $this->isAddFormOpen = !$this->isAddFormOpen;
    }

    public function hideAddForm(){
        $this->skills = collect($this->profile->skills);
        $this->isAddFormOpen = !$this->isAddFormOpen;
    }

    public function hideEditForm()
    {

        $this->reset('editId');

        $this->skills = collect($this->profile->skills);
    }

    protected $listeners = [
        'skillAdded' => 'hideAddForm',
        'refreshComponent' => '$refresh',
        'hideAddForm' => 'hideAddForm',
        'hideEditForm' => 'hideEditForm',
        'acceptDelete' => 'delete',
    ];

    public function getConfirmationToDelete(int $id)
    {
        $this->idDelete = $id;

        $this->emit('canDelete');
    }

    public function delete()
    {
        $this->skills = collect($this->profile->skills);
        $this->skills->splice($this->idDelete, 1);
        $this->profile->skills = $this->skills;
        $this->profile->save();
    }

    protected $rules = [
        'skills.*.name' => ['required', 'string'],
        'skills.*.level' => ['required', 'integer', 'max:10', 'min:1'],
    ];

    public function startEdit(int $id)
    {
        $this->editId = $id+1;
    }

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->skills = collect($this->profile->skills);
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.skills.show');
    }
}
