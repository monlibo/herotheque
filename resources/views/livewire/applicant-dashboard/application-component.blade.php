<div class="flex w-full">
    <div class="w-full flex flex-col relative text-[14px]">
        <div class="w-full rounded-md px-4 dark:text-gray-200 py-2 text-[16px]">
            Mes candidatures spontanées
        </div>
        <div
            class="bg-white dark:bg-gray-800 dark:text-gray-200  border-[2px] border-gray-200 dark:border-gray-600 text-gray-800 w-full rounded-md px-6 py-4  flex flex-col space-y-8">
            @if ($applications->count() > 0)
                @foreach ($applications as $application)
                    <!-- Un emploi:Début -->
                    <div class="w-full flex px-4">

                        <div class="flex flex-1 justify-between flex-col md:flex-row space-y-2">
                            <div class="flex flex-col text-[14px]">
                                <a href="">
                                    <div class="text-[15px] font-semibold">
                                        {{ $application->position }}
                                    </div>
                                </a>

                                <div class="text-[13px] font-semibold text-gray-500">
                                    à
                                    <a href="{{ route('company.show', ['company' => $application->company]) }}">
                                        {{ $application->company->name }} </a>
                                </div>

                                <div class="text-[13px] text-blue-500">
                                    @if ($application->created_at < now())
                                        il y a
                                        {{ now()->diffInDays($application->created_at) }}
                                        jour(s)
                                    @else
                                        dans
                                        {{ now()->diffInDays($application->created_at) }}
                                        jour(s)
                                    @endif
                                </div>
                            </div>

                            @if ($application->interview)
                                <div wire:click="showInterview({{ $application->interview->id }})"
                                    class="text-[16px] text-orange-400 flex items-start space-x-2 mr-4">
                                    <i class="bi-calendar-check-fill"></i>
                                </div>
                            @endif
                            <div class="text-[13px] flex items-start space-x-2 mr-4">
                                <a href="">
                                    @if ($application->state == 'loading')
                                        <div class="bg-yellow-400 text-white py-1 px-2 rounded-md">En cours de
                                            validation
                                        </div>
                                    @elseif($application->state == 'accepted')
                                        <div class="bg-green-400 text-white py-1 px-2 rounded-md"> Proposition
                                            acceptée
                                        </div>
                                    @elseif($application->state == 'rejected')
                                        <div class="bg-red-400 text-white py-1 px-2 rounded-md"> Proposition rejetée
                                        </div>
                                    @endif

                                </a>
                            </div>

                        </div>

                    </div>
                    <!-- Un emploi:Fin -->
                @endforeach
            @else
                <div class="w-full rounded-md px-4 py-2">
                    Vous n'avez pas encore de candidatures spontanées.
                </div>
            @endif
        </div>
    </div>

    @if ($openInterview)
        <div>
            <div
                class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
                <div
                    class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                    <div class="flex w-full justify-end text-red-600 text-[13px]">
                        <span wire:click="hideInterview">Fermer</span>
                    </div>
                    <div>
                        Entretien prévu pour le {{ $interview->date }}
                        à {{ $interview->time }}
                    </div>
                    <div class="flex flex-col space-y-3">
                        <p class="font-bold">Informations complémentaires</p>
                        <div>
                            {!! $interview->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
