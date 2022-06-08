<?php

namespace App\Notifications;

use App\Mail\ProposalMail;
use App\Models\User;
use App\Models\Proposal;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class ProposalNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $user;
    public $proposal;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user, Proposal $proposal)
    {
        $this->user = $user;
        $this->proposal = $proposal;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new ProposalMail($this->user, $this->proposal))
            ->to($this->user->email);;
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        return [
            'title' => 'Le status de votre candidature à l\'offre intitulée Recherche d\'un (e) ' . $this->proposal->offer->title . ' a changé',
            'link' => route('applicant.proposal')
        ];
    }
}
