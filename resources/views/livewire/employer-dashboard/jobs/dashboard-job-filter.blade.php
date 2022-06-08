<div x-data="{ openDeleteConfirm: @entangle('openDeleteConfirm') }" @close-modal.window="openDeleteConfirm = false;" class="w-full">

    <div class="w-full bg-white dark:bg-gray-800 dark:text-gray-200 py-4 rounded-t-md flex flex-col space-y-2  px-4 mt-4 ] mx-auto">
        @if (session()->has('message'))
            <div x-data="{ shown: false, timeout: null }" x-init="() => {
                clearTimeout(timeout);
                shown = true;
                timeout = setTimeout(() => { shown = false }, 2000);
            }" x-show.transition.out.opacity.duration.1500ms="shown"
                x-transition:leave.opacity.duration.1500ms
                class="text-[14px] font-semibold text-left px-4 py-2 rounded-md bg-green-100 text-green-600">
                {{ session('message') }}
            </div>
        @endif



        <div
            class="text-[14px] py-4 border-b-[1px] border-black flex flex-col md:flex-row space-y-2 justify-between items-center w-full ">
            <div class="text-[16px] font-semibold text-left w-full">Jobs</div>
            <div class="w-full md:w-auto">
                <a href="{{ route('job-create') }}">
                    <button class="bg-blue-600 text-gray-100 py-2 w-full px-4 rounded-md">Ajouter</button>
                </a>
            </div>
        </div>
        <div
            class="flex flex-col h-full md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4 w-full md:whitespace-nowrap md:overflow-y-hidden md:overflow-x-auto   py-3 text-gray-600">

            <div class="relative  h-full w-full md:w-[500px]">
                <input wire:model.debounce.500ms="search"
                    class="w-full h-[30px] text-[14px] border-[1px] dark:bg-gray-600 dark:text-gray-200 border-black rounded-md pl-[10px] bg-white"
                    type="text" placeholder="Trouver un stage..." id="search" aria-label="Trouver un emploi..." />
            </div>
            <div class="w-full h-full flex items-center lg:justify-between md:justify-start space-x-2">
                <div class="relative">
                    <select wire:model.debounce.200ms="field" name="" id=""
                        class="w-full h-[30px] py-0  text-[14px] dark:bg-gray-600 dark:text-gray-200 font-bold  rounded-md  border-[1px] bg-gray-100 border-black ">
                        <option selected value="">Domaine</option>
                        @foreach ($fields as $field)
                            <option value="{{ $field }}">{{ $field }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="relative">
                    <select wire:model="validity" name="" id=""
                        class="w-full h-[30px] py-0 bg-gray-100 dark:bg-gray-600 dark:text-gray-200 font-bold  text-[14px]  rounded-md  border-[1px] border-black ">
                        <option>Validité</option>
                        <option value="true">Valide</option>
                        <option value="false">Invalide</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 dark:text-gray-200 md:rounded-md  mx-auto relative">
        <div>
            <!-- le tableau de la liste des emplois -->
            <div class="overflow-hidden md:rounded-b-lg shadow-xs">

                <div class="overflow-x-auto">



                    <div class="flex flex-col space-y-6">

                        @if (count($jobs) > 0)
                            @foreach ($jobs as $job)
                                <!-- Un emploi:Début -->
                                <div class="w-full flex px-4">
                                    <div class="w-[30px] md:w-[50px]">
                                        <input type="checkbox"  class="rounded-md">
                                    </div>
                                    <div class="flex flex-1 flex-col justify-between md:flex-row space-y-2">
                                        <div class="flex flex-col text-[14px]">
                                            <div class="text-[15px] font-semibold">{{ $job->title }}</div>

                                            <div class="text-[13px] text-blue-500">
                                                @if ($job->publication_date < now())
                                                    il y a
                                                    {{ now()->diffInDays($job->publication_date) }} jour(s)
                                                @else
                                                    dans
                                                    {{ now()->diffInDays($job->publication_date) }} jour(s)
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-gray-400 text-[14px]">
                                            <a href="{{ route('job.proposal.show', [$job->offerable->id]) }}">
                                                {{ count($job->proposals) }} proposition(s)
                                            </a>
                                        </div>
                                        <div class="text-[11px] flex items-start space-x-2">
                                            <a href="{{ route('job-dashboard-show', [$job->offerable->id]) }}">
                                                <button class="bg-green-600 text-gray-100 px-2 py-1 rounded-md">
                                                    VOIR PLUS
                                                </button>
                                            </a>

                                            <a href="{{ route('job-dashboard-edit', [$job->offerable->id]) }}">
                                                <button
                                                    class="border-[1px] border-black text-gray-800 px-2 py-1 rounded-md">
                                                    MODIFIER
                                                </button>
                                            </a>
                                            <button wire:click="deleteConfirmation({{ $job->offerable }})"
                                                class="border-[1px] border-black text-gray-800 px-2 py-1 rounded-md">
                                                SUPPRIMER
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <!-- Un emploi:Fin -->
                            @endforeach
                        @else
                            <div class="w-full px-4 py-4 dark:bg-gray-800 dark:text-gray-200">Vous n'avez encore aucun job</div>
                        @endif



                    </div>

                </div>

                <div
                    class="px-4 py-4 mt-4 font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    {{ $jobs->links() }}
                </div>

            </div>
        </div>
    </div>

    <!-- Start: Confirmation -->
    <div x-cloak x-show="openDeleteConfirm">
        <div
            class="bg-[#07141fd4]  flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div
                class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4 flex flex-col  items-start">
                    <p class="text-[16px] font-semibold">Etes-vous sûr de vouloir supprimer ce job ?</p>
                    <p>Une fois supprimée, elle disparaitra de la liste de vos offres.</p>
                </div>
                <div class="w-full py-2 px-4 flex flex-col  items-start">
                    <p class="flex space-x-4 justify-end w-full">
                        <button @click="openDeleteConfirm = false"
                            class="border-[1px] rounded-md text-blue-500 py-1 px-4">Annuler</button>
                        <button wire:click="delete({{ $deleteJob }})"
                            class="bg-blue-500 text-white rounded-md py-1 px-4">Confirmer</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Confirmation -->

</div>
