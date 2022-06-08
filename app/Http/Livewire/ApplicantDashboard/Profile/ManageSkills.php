<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Livewire\Component;

class ManageSkills extends Component
{

    public $profile;
    public bool $isEditFormOpen = false;
    public $editId;
    public $skillsProfile;

    public bool $isAddFormOpen = false;
    public $newSkill;
    public $newLevel;
    public $skillsUpdate;
    public $skills1;
    public $skills = [
        [
            'name' => 'MS Office',
            'level' => 8
        ],
        [
            'name' => 'Cisco Packet Tracer',
            'level' => 5
        ]
    ];

    protected $rules = [
        'skills.*.name' => ['required', 'string'],
        'skills.*.level' => ['required', 'integer', 'max:10', 'min:1'],
    ];

    public function updated()
    {
        $this->emit('selectUpdated');
        $this->validate($this->rules);
    }





    public function add()
    {
        $this->emit('selectUpdated');
        $this->validate([
            'newSkill' => ['required', 'string'],
            'newLevel' => ['required', 'integer', 'max:10', 'min:1']
        ]);

        $newSkill = ['name' => $this->newSkill, 'level' => $this->newLevel];

        collect($this->profile->skills);
        $this->profile->skills = collect($this->profile->skills)->push($newSkill);
        $this->profile->save();

        $this->skills = collect($this->profile->skills);
        $this->skills1 = $this->skills;
        //$this->reset($this->skill,$this->level);
        $this->resetEdit();
        $this->isAddFormOpen = false;
    }

    public function toggleEditForm()
    {
        $this->emit('selectUpdated');
        $this->isAddFormOpen = false;
        $this->isEditFormOpen = !$this->isEditFormOpen;
    }

    public function toggleAddForm()
    {
        $this->emit('selectUpdated');
        $this->isEditFormOpen = false;
        $this->isAddFormOpen = !$this->isAddFormOpen;
    }

    public function startEdit(int $id)
    {
        $this->emit('selectUpdated');
        $this->editId = $id;
    }

    public function resetEdit()
    {
        $this->reset(['editId']);
    }

    public function update(int $id)
    {
        $this->validate($this->rules);

        $this->skills = collect($this->skills);

        // $this->skills->push([
        //     'name' => 'PhotoShop',
        //     'level' => 11
        // ]);

        $this->profile->skills = $this->skills;
        $this->profile->save();
        $this->skills1 = $this->skills;

            
        //$this->emit('selectUpdated');
        $this->resetEdit();
        $this->isEditFormOpen = !$this->isEditFormOpen;

        $this->isEditFormOpen = false;
    }

    public function supprimerSkill(int $id)
    {

        //$this->resetEdit();
        $this->skills = collect($this->skills);
        $this->skills->splice(0, 1);
        $this->profile->skills = $this->skills;

        $this->profile->save();

        $this->skills1 = $this->skills;;
        $this->resetEdit();
        //dd($this->skills);
    }

    public function mount(Profile $profile)
    {
        $this->profile = $profile;
        $this->skills = collect($this->profile->skills);
        $this->skills1 = collect($this->profile->skills);
        //dd(count($this->skills1));
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.profile.manage-skills');
    }
}
