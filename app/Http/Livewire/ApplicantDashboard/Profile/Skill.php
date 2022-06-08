<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Illuminate\Validation\Rule;
use Livewire\Component;

class Skill extends Component
{

    public $profile;
    public $openAddForm = false, $openEditForm=false, $openDeleteConfirm = false;
    public $skills;

    public $skill , $level = 'débutant';
    public $editId, $deleteId;

    public function updatedSkill()
    {
        $this->validate([
            'skill' => ['required','string','min:3','max:40']
        ]);
    }

    public function updatedLevel()
    {
        $this->validate([
            'level' => ['required',Rule::in('débutant','intermédiaire','expérimenté')]
        ]);
    }

    public function store(){
        $this->validate([
            'skill' => ['required', 'string', 'min:3', 'max:40'],
            'level' => ['required', Rule::in('débutant', 'intermédiaire', 'expérimenté')]
        ]);

        $newSkill = ['name' => $this->skill, 'level' => $this->level];
        //dd($newSkill);
        collect($this->profile->skills);
        $this->profile->skills = collect($this->profile->skills)->push($newSkill);
        $this->profile->save();

        $this->reset(['skill','level']);
        $skills = collect($this->profile->skills);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function startEdit(int $id)
    {
        $skills1 = $this->skills[$id];
        $this->editId = $id;
        $this->skill = $skills1['name'];
        $this->level = $skills1['level'];
        $this->openEditForm = true;

        $this->dispatchBrowserEvent('select2');

    }

    public function update()
    {
        $this->validate([
            'skill' => ['required', 'string', 'min:3', 'max:40'],
            'level' => ['required', Rule::in('débutant', 'intermédiaire', 'expérimenté')]
        ]);

        $newSkill = [['name' => $this->skill, 'level' => $this->level]];

        $this->skills->splice($this->editId,1,$newSkill);

        $this->profile->skills = $this->skills;
        $this->profile->save();

        $this->reset(['skill', 'level','editId']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteConfirmation(int $id)
    {
        $this->deleteId = $id;
        $this->openDeleteConfirm = true;
    }

    public function delete()
    {
        $this->skills->splice($this->deleteId, 1);
        $this->profile->skills = $this->skills;
        $this->profile->save();
        session()->flash('message', 'Compétence supprimée avec succès !!');
        $this->reset('deleteId');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancelDelete()
    {
        $this->reset('deleteId');
    }

    public function mount(Profile $profile)
    {
        $this->skills = collect($this->profile->skills);
    }

    public function render()
    {
        $this->skills = collect($this->profile->skills);

        return view('livewire.applicant-dashboard.profile.skill');
    }
}
