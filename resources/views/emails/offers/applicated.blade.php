@component('mail::message')
# Recherche d'un(e) {{ $offer->title }}

Vous avez reçu une nouvelle candidature pour l'offre intitulée Recherche d'un(e) {{ $offer->title }}

@component('mail::button', ['url' => route('employement.proposal.show',['employement' => $offer->offerable])])
Cliquez-ici pour voir la candidature
@endcomponent
Merci,<br>
{{ config('app.name') }}
@endcomponent


