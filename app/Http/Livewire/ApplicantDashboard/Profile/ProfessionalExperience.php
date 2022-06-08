<?php

namespace App\Http\Livewire\ApplicantDashboard\Profile;

use Carbon\Carbon;
use App\Models\Profile;
use Livewire\Component;
use App\Models\ProExperience;

class ProfessionalExperience extends Component
{

    protected $listeners = [
        'onUpdate' => '$refresh',
        'acceptDelete' => 'deleteExperience',
        'experienceUpdated' => 'onExperienceUpdated'
    ];



    public $profile;
    public $showAddForm = false;
    public $showEditForm = false;
    public $showDeleteConfirmation = false;

    public $position_occuped, $company, $date_start,
        $date_end, $city, $country, $description,
        $editId,$deleteId;

    public function updated($fields)
    {
        $this->validateOnly($fields, [
            'position_occuped' => ['required', 'string', 'min:3'],
            'company' => ['required', 'string'],
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
            'position_occuped' => ['required', 'string', 'min:3'],
            'company' => ['required', 'string'],
            'date_start' => ['required', 'date', 'before:today'],
            'date_end' => ['nullable', 'date', 'after:date_start'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:50'],
        ]);

        $experience = new ProExperience();
        $experience->profile_id = $this->profile->id;
        $experience->position_occuped = $data['position_occuped'];
        $experience->company = $data['company'];
        $experience->date_start = $data['date_start'];
        $experience->date_end = $data['date_end'];
        $experience->country = $data['country'];
        $experience->city = $data['city'];
        $experience->description = $data['description'];
        $experience->save();


        $this->reset(['position_occuped', 'company', 'date_start', 'date_end', 'country', 'city', 'description']);

        $this->dispatchBrowserEvent('close-modal');
        //session()->flash('message', 'Votre expérience a été ajoutée avec succès !!');

        //$this->emit('onUpdate');
    }


    public function startEdit(int $id)
    {
        $this->showEditForm = true;

        $experience = ProExperience::where('profile_id', $this->profile->id)
            ->where('id', $id)
            ->first();


        $this->editId = $experience->id;
        $this->position_occuped = $experience->position_occuped;
        $this->company = $experience->company;
        $this->date_start = $experience->date_start;
        $this->date_end = $experience->date_end;
        $this->country = $experience->country;
        $this->city = $experience->city;
        $this->description = $experience->description;
    }

    public function update()
    {
        $data = $this->validate([
            'position_occuped' => ['required', 'string', 'min:3'],
            'company' => ['required', 'string'],
            'date_start' => ['required', 'date', 'before:today'],
            'date_end' => ['nullable', 'date', 'after:date_start'],
            'country' => ['required', 'string'],
            'city' => ['required', 'string'],
            'description' => ['nullable', 'string', 'max:50'],
        ]);

        $experience = ProExperience::where('profile_id', $this->profile->id)
            ->where('id', $this->editId)
            ->first();


        $experience->position_occuped = $data['position_occuped'];
        $experience->company = $data['company'];
        $experience->date_start = $data['date_start'];
        $experience->date_end = $data['date_end'];
        $experience->country = $data['country'];
        $experience->city = $data['city'];
        $experience->description = $data['description'];
        $experience->save();


        $this->reset(['editId', 'position_occuped', 'company', 'date_start', 'date_end', 'country', 'city', 'description']);

        $this->dispatchBrowserEvent('close-modal');
    }

    public function deleteConfirmation(int $id)
    {
        $this->deleteId = $id;
        $this->showDeleteConfirmation = true;
    }

    public function delete()
    {
        $experience = ProExperience::where('profile_id', $this->profile->id)
            ->where('id', $this->deleteId)
            ->first();

        $experience->delete();


        session()->flash('message', 'Expérience supprimée avec succès !!');
        $this->reset('deleteId');
        $this->dispatchBrowserEvent('close-modal');
    }

    public function cancelDelete(){
        $this->reset('deleteId');
    }


    public function mount(Profile $profile)
    {


        //$this->experiences = $this->profile->proExperiences;
    }

    public function render()
    {
        $this->experiences = $this->profile->proExperiences;
        return view('livewire.applicant-dashboard.profile.professional-experience', [
            'experiences' => $this->experiences
        ]);
    }
}
