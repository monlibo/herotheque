<x-dashboard-layout>
    @if (Auth::user()->hasRole('employer'))
        @livewire('employer-dashboard.employer-dashboard')
    @elseif (Auth::user()->hasRole('applicant'))
        @livewire('applicant-dashboard.applicant-dashboard')
    @endif
</x-dashboard-layout>
