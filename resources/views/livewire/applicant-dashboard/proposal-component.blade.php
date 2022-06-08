<div class="flex w-full">
    <div class="w-full  flex flex-col relative text-[14px]">
        <ul
            class="hideScroll mt-4 whitespace-nowrap flex bg-white dark:bg-gray-800 dark:text-gray-200 rounded-md w-full overflow-x-auto overflow-y-hidden h-[50px] sticky top-[60px]    z-10 space-x-6 border-b-[2px] border-gray-200 dark:border-gray-600  text-gray-400 ">

            <li wire:click="goToTab('employement')"
                class=" cursor-pointer @if ($openedTab == 'bio') text-blue-600 dark:text-blue-500 @endif font-semibold relative py-3 px-4">
                Offres d'emplois
                @if ($openedTab == 'employement')
                    <span class="h-[3px] rounded-full bg-blue-600  w-full absolute -bottom-[1px] left-0"></span>
                @endif
            </li>
            <li wire:click="goToTab('internship')"
                class=" cursor-pointer @if ($openedTab == 'experience') text-blue-600 dark:text-blue-500 @endif font-semibold relative py-3 px-4">
                Offres de stages
                @if ($openedTab == 'internship')
                    <span class="h-[3px] rounded-full bg-blue-600 w-full absolute -bottom-[1px] left-0"></span>
                @endif
            </li>
            <li wire:click="goToTab('job')"
                class="cursor-pointer relative font-semibold h-full  py-3 px-4 @if ($openedTab == 'skill') text-blue-600 dark:text-blue-500 @endif">
                Jobs
                @if ($openedTab == 'job')
                    <span class="h-[3px] rounded-full bg-blue-600 w-full absolute -bottom-[1px] left-0"></span>
                @endif
            </li>

        </ul>


        @if ($openedTab == 'employement')
            <div
                class="bg-white dark:bg-gray-800 dark:text-gray-200  border-[2px] border-gray-200 dark:border-gray-600 text-gray-800 w-full rounded-md px-6 py-4 mt-6 flex flex-col space-y-8">
                @if ($proposals->count() > 0)
                    @foreach ($proposals as $proposal)
                        <!-- Un emploi:Début -->
                        <div class="w-full flex px-4">

                            <div class="flex flex-1 justify-between flex-col md:flex-row space-y-2">
                                <div class="flex flex-col text-[14px]">
                                    <a href="">
                                        <div class="text-[15px] font-semibold">Recherche d'un(e)
                                            {{ $proposal->offer->title }}
                                        </div>
                                    </a>

                                    <div class="text-[13px] font-semibold text-gray-500">
                                        par
                                        {{ $proposal->offer->user->company->name }}
                                    </div>

                                    <div class="text-[13px] text-blue-500">
                                        @if ($proposal->created_at < now())
                                            il y a
                                            {{ now()->diffInDays($proposal->created_at) }}
                                            jour(s)
                                        @else
                                            dans
                                            {{ now()->diffInDays($proposal->created_at) }}
                                            jour(s)
                                        @endif
                                    </div>
                                </div>

                                @if ($proposal->jobInterview)
                                    <div wire:click="showInterview({{ $proposal->jobInterview->id }})"
                                        class="text-[16px] text-orange-400 flex items-start space-x-2 mr-4">
                                        <i class="bi-calendar-check-fill"></i>
                                    </div>
                                @endif
                                <div class="text-[13px] flex items-start space-x-2 mr-4">
                                    <a href="">
                                        @if ($proposal->state == 'loading')
                                            <div class="bg-yellow-400 text-white py-1 px-2 rounded-md">En cours de
                                                traitement
                                            </div>
                                        @elseif($proposal->state == 'accepted')
                                            <div class="bg-green-400 text-white py-1 px-2 rounded-md"> Candidature
                                                acceptée
                                            </div>
                                        @elseif($proposal->state == 'rejected')
                                            <div class="bg-red-400 text-white py-1 px-2 rounded-md"> Candidature rejetée
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
                        Vous n'avez pas encore de candidatures pour les offres d'emplois
                    </div>
                @endif
            </div>
        @elseif($openedTab == 'internship')
            <div
                class="bg-white dark:bg-gray-800 dark:text-gray-200  border-[2px] border-gray-200 dark:border-gray-600 text-gray-800 w-full rounded-md px-6 py-4 mt-6 flex flex-col space-y-8">
                @if ($proposals->count() > 0)
                    @foreach ($proposals as $proposal)
                        <!-- Un emploi:Début -->
                        <div class="w-full flex px-4">

                            <div class="flex flex-1 justify-between flex-col md:flex-row space-y-2">
                                <div class="flex flex-col text-[14px]">
                                    <a href="">
                                        <div class="text-[15px] font-semibold">Recherche d'un(e)
                                            {{ $proposal->offer->title }}
                                        </div>
                                    </a>

                                    <div class="text-[13px] font-semibold text-gray-500">
                                        par
                                        {{ $proposal->offer->user->company->name }}
                                    </div>

                                    <div class="text-[13px] text-blue-500">
                                        @if ($proposal->created_at < now())
                                            il y a
                                            {{ now()->diffInDays($proposal->created_at) }}
                                            jour(s)

                                        @endif
                                    </div>
                                </div>

                                @if ($proposal->jobInterview)
                                    <div wire:click="showInterview({{ $proposal->jobInterview->id }})"
                                        class="text-[16px] text-orange-400 flex items-start space-x-2 mr-4">
                                        <i class="bi-calendar-check-fill"></i>
                                    </div>
                                @endif
                                <div class="text-[13px] flex items-start space-x-2 mr-4">
                                    <a href="">
                                        @if ($proposal->state == 'loading')
                                            <div class="bg-yellow-400 text-white py-1 px-2 rounded-md">En cours de
                                                validation
                                            </div>
                                        @elseif($proposal->state == 'accepted')
                                            <div class="bg-green-400 text-white py-1 px-2 rounded-md"> Proposition
                                                acceptée
                                            </div>
                                        @elseif($proposal->state == 'rejected')
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
                        Vous n'avez pas encore de candidatures pour les offres de stages
                    </div>
                @endif
            </div>
        @elseif($openedTab == 'job')
            <div
                class="bg-white dark:bg-gray-800 dark:text-gray-200  border-[2px] border-gray-200 dark:border-gray-600 text-gray-800 w-full rounded-md px-6 py-4 mt-6 flex flex-col space-y-8">
                @if ($proposals->count() > 0)
                    @foreach ($proposals as $proposal)
                        <!-- Un emploi:Début -->
                        <div class="w-full flex px-4">

                            <div class="flex flex-1 justify-between flex-col md:flex-row space-y-2">
                                <div class="flex flex-col text-[14px]">
                                    <a href="">
                                        <div class="text-[15px] font-semibold">Recherche d'un(e)
                                            {{ $proposal->offer->title }}
                                        </div>
                                    </a>

                                    <div class="text-[13px] font-semibold text-gray-500">
                                        par
                                        {{ $proposal->offer->user->firstname }}
                                    </div>

                                    <div class="text-[13px] text-blue-500">
                                        @if ($proposal->created_at < now())
                                            il y a
                                            {{ now()->diffInDays($proposal->created_at) }}
                                            jour(s)
                                        @else
                                            dans
                                            {{ now()->diffInDays($proposal->created_at) }}
                                            jour(s)
                                        @endif
                                    </div>
                                </div>

                                @if ($proposal->jobInterview)
                                    <div wire:click="showInterview({{ $proposal->jobInterview->id }})"
                                        class="text-[16px] text-orange-400 flex items-start space-x-2 mr-4">
                                        <i class="bi-calendar-check-fill"></i>
                                    </div>
                                @endif
                                <div class="text-[13px] flex items-start space-x-2 mr-4">
                                    <a href="">
                                        @if ($proposal->state == 'loading')
                                            <div class="bg-yellow-400 text-white py-1 px-2 rounded-md">En cours de
                                                validation
                                            </div>
                                        @elseif($proposal->state == 'accepted')
                                            <div class="bg-green-400 text-white py-1 px-2 rounded-md"> Proposition
                                                acceptée
                                            </div>
                                        @elseif($proposal->state == 'rejected')
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
                        Vous n'avez pas encore de candidatures pour les jobs
                    </div>
                @endif
            </div>
        @endif

        <div wire:loading wire:target='goToTab'
            class="w-full h-full bg-white dark:bg-gray-800  text-center rounded-md absolute top-[70px] left-0 flex items-center justify-center ">
            <div class="flex justify-center items-center h-full">
                <div
                    class="animate-spin mr-2 w-10 h-10 border-[3px] border-transparent border-t-[3px] border-t-blue-600   rounded-full">
                </div>
            </div>
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
                        Entretien prévu pour le {{ $jobInterview->date }}
                        à {{ $jobInterview->time }}
                    </div>
                    <div class="flex flex-col space-y-3">
                        <p class="font-bold">Informations complémentaires</p>
                        <div>
                            {!! $jobInterview->description !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
