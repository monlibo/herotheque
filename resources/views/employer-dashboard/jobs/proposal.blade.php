<x-dashboard-layout>
    @livewire('employer-dashboard.jobs.proposal-component', ['job' => $job], key($job->id))
</x-dashboard-layout>
