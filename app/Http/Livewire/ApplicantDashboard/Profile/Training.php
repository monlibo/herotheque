<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use App\Models\Profile;
use App\Models\Training as ModelsTraining;
use Livewire\Component;

class Training extends Component
{


    public $profile;
    public $openAddForm = false;
    public $openEditForm = false;
    public $openDeleteConfirm = false;

    public $trainings;

    public $name, $institut, $date_start,
        $date_end, $city, $country, $description,
        $editId, $deleteId;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'name' => ['required', 'string', 'min:3'],
            'institut' => ['required', 'string'],
            'date_start' => ['required', 'date', 'before:today'],
            'date_end' => ['nullable', 'date', 'after:date_start'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:50'],
        ]);
    }

    public function store()
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'min:3'],
            'institut' => ['required', 'string'],
            'date_start' => ['required', 'date', 'before:today'],
            'date_end' => ['nullable', 'date', 'after:date_start'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:50'],
        ]);

        $training = new ModelsTraining();
        $training->profile_id = $this->profile->id;
        $training->name = $data['name'];
        $training->institut = $data['institut'];
        $training->date_start = $data['date_start'];
        $training->date_end = $data['date_end'];
        $training->country = $data['country'];
        $training->city = $data['city'];
        $training->description = $data['description'];
        $training->save();

        $this->reset(['name', 'institut', 'date_start', 'date_end', 'country', 'city', 'description']);

        $this->dispatchBrowserEvent('close-modal');
        //$this->emit('onUpdate');
        //session()->flash('message', 'Votre expérience a été ajoutée avec succès !!');

        //$this->emit('onUpdate');
    }

    public function startEdit(int $id)
    {
        $this->openEditForm = true;

        $training = ModelsTraining::where('profile_id', $this->profile->id)
            ->where('id', $id)
            ->first();


        $this->editId = $training->id;
        $this->name= $training->name;
        $this->institut = $training->institut;
        $this->date_start = $training->date_start;
        $this->date_end = $training->date_end;
        $this->country = $training->country;
        $this->city = $training->city;
        $this->description = $training->description;
    }

    public function update()
    {
        $data = $this->validate([
            'name' => ['required', 'string', 'min:3'],
            'institut' => ['required', 'string'],
            'date_start' => ['required', 'date', 'before:today'],
            'date_end' => ['nullable', 'date', 'after:date_start'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:50'],
        ]);

        $training = ModelsTraining::where('profile_id', $this->profile->id)
            ->where('id', $this->editId)
            ->first();

        $training->name = $data['name'];
        $training->institut = $data['institut'];
        $training->date_start = $data['date_start'];
        $training->date_end = $data['date_end'];
        $training->country = $data['country'];
        $training->city = $data['city'];
        $training->description = $data['description'];
        $training->save();


        $this->reset(['editId', 'name', 'institut', 'date_start', 'date_end', 'country', 'city', 'description']);

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteConfirmation(int $id)
    {
        $this->deleteId = $id;
        $this->openDeleteConfirm = true;
    }

    public function delete()
    {
        $training = ModelsTraining::where('profile_id', $this->profile->id)
            ->where('id', $this->deleteId)
            ->first();

        $training->delete();


        session()->flash('message', 'Expérience supprimée avec succès !!');
        $this->reset('deleteId');
        $this->dispatchBrowserEvent('close-modal');
    }


    public function mount(Profile $profile)
    {
    }

    public function render()
    {
        $this->trainings = $this->profile->trainings;

        return view('livewire.applicant-dashboard.profile.training',
            [
                'trainings' => $this->trainings
            ]
        );
    }
}
