<?php

namespace App\Http\Livewire\ApplicantDashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;

class Notification extends Component
{
    public $notifications;

    public function mount()
    {
        $this->notifications = Auth::user()->notifications;
        Auth::user()->unreadNotifications->markAsRead();
    }

    public function render()
    {
        return view('livewire.applicant-dashboard.notification');
    }
}
