<x-dashboard-layout>
    @livewire('employer-dashboard.internships.proposal-component', ['internship' => $internship], key($internship->id))
</x-dashboard-layout>
