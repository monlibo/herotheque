@component('mail::message')
# Le status de votre candidature à l'offre intitulée {{ $proposal->offer->title }} a changé

@component('mail::button', ['url' => route('applicant.proposal')])
Cliquez ici pour en savoir plus
@endcomponent
Thanks,<br>
{{ config('app.name') }}
@endcomponent
