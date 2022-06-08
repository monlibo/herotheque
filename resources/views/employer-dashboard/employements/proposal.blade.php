<x-dashboard-layout>
    @livewire('employer-dashboard.employements.proposal-component', ['employement' => $employement], key($employement->id))
</x-dashboard-layout>
