<?php

namespace App\Notifications;

use App\Mail\OfferApplicatedMail;
use App\Models\User;
use App\Models\Offer;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Support\Facades\Auth;

class OfferApplicatedNotification extends Notification implements ShouldQueue
{
    use Queueable;
    public $user;
    public $offer;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(User $user,Offer $offer)
    {
        $this->user = $user;
        $this->offer = $offer;
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
        return (new OfferApplicatedMail($this->user,$this->offer))
            ->to($this->user->email);
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
            'title' => 'Vous avez reçu une nouvelle candidature pour l\'offre intitulée Recherche d\'un(e)'.$this->offer->title,
            'link' => route('employement.proposal.show',['employement'=>$this->offer->offerable])
        ];
    }
}
