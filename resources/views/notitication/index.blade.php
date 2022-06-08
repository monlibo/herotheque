<x-dashboard-layout>
    @if (Auth::user()->hasRole('employer'))
        @livewire('employer-dashboard.notification')
    @elseif (Auth::user()->hasRole('applicant'))
        @livewire('applicant-dashboard.notification')
    @endif
</x-dashboard-layout>
