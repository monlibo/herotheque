<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use Livewire\Component;
use Illuminate\Validation\Rule;

class Language extends Component
{
    protected $listeners = [
        'onUpdate' => '$refresh'
    ];
    public $profile;
    public $openAddForm = false, $openEditForm = false, $openDeleteConfirm = false;
    public $languages;

    public $language, $level = 'débutant';
    public $editId, $deleteId;

    public function updatedLanguage()
    {
        $this->validate([
            'language' => ['required', 'string', 'min:3', 'max:40']
        ]);
    }

    public function updatedLevel()
    {
        $this->validate([
            'level' => ['required', Rule::in('débutant', 'intermédiaire', 'expérimenté')]
        ]);
    }

    public function store()
    {
        $this->validate([
            'language' => ['required', 'string', 'min:3', 'max:40'],
            'level' => ['required', Rule::in('débutant', 'intermédiaire', 'expérimenté')]
        ]);

        $newLanguage = ['name' => $this->language, 'level' => $this->level];
        //dd($newlanguage);
        collect($this->profile->languages);
        $this->profile->languages = collect($this->profile->languages)->push($newLanguage);
        $this->profile->save();

        $this->reset(['language', 'level']);
        $languages = collect($this->profile->languages);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function startEdit(int $id)
    {
        $languages1 = $this->languages[$id];
        $this->editId = $id;
        $this->language = $languages1['name'];
        $this->level = $languages1['level'];
        $this->dispatchBrowserEvent('select2');
        $this->openEditForm = true;

        //dd($this->language);
    }

    public function update()
    {
        $this->validate([
            'language' => ['required', 'string', 'min:3', 'max:40'],
            'level' => ['required', Rule::in('débutant', 'intermédiaire', 'expérimenté')]
        ]);

        $newLanguage = [['name' => $this->language, 'level' => $this->level]];

        $this->languages->splice($this->editId, 1, $newLanguage);

        $this->profile->languages = $this->languages;
        $this->profile->save();

        $this->reset(['language', 'level', 'editId']);
        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteConfirmation(int $id)
    {
        $this->deleteId = $id;
        $this->openDeleteConfirm = true;
    }

    public function delete()
    {
        $this->languages->splice($this->deleteId, 1);
        $this->profile->languages = $this->languages;
        $this->profile->save();
        session()->flash('message', 'Langue supprimée avec succès !!');
        $this->reset('deleteId');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancelDelete()
    {
        $this->reset('deleteId');
    }

    public function mount(Profile $profile)
    {
        $this->languages = collect($this->profile->languages);
    }

    public function render()
    {
        $this->languages = collect($this->profile->languages);
        return view('livewire.applicant-dashboard.profile.language');
    }
}
