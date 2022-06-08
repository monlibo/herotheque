<?php

namespace App\Http\Livewire\EmployerDashboard;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

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
        return view('livewire.employer-dashboard.notification');
    }
}
