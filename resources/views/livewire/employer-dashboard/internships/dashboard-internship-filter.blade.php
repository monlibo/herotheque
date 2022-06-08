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
            <div class="text-[16px] font-semibold text-left w-full">Liste des stages</div>
            <div class="w-full md:w-auto">
                <a class="flex justify-center" href="{{ route('internship-create') }}">
                    <button class="bg-blue-600 text-gray-100 py-4 lg:w-full w-[70%] px-4 rounded-md">Ajouter</button>
                </a>
            </div>
        </div>
        <div
            class="flex flex-col h-full md:flex-row items-center space-y-2 md:space-y-0 md:space-x-4 w-full md:whitespace-nowrap md:overflow-y-hidden md:overflow-x-auto   py-3 text-gray-600">

            <div class="relative mb-2 h-full w-full md:w-[500px]">
                <input wire:model.debounce.500ms="search"
                    class="w-full h-[35px] text-[14px] border-[1px] border-black rounded-md pl-[10px] bg-white dark:bg-gray-600 dark:text-gray-300"
                    type="text" placeholder="Trouver un stage..." id="search" aria-label="Trouver un emploi..." />
            </div>
            <div class="w-full h-full flex items-center space-x-2">
                <div class="relative">
                    <select wire:model.debounce.200ms="field" name="" id=""
                        class="w-full h-[35px] py-0  text-[14px] font-bold  rounded-md  border-[1px] bg-gray-100 border-black dark:bg-gray-600 dark:text-gray-300 ">
                        <option selected value="">Tous les domaines</option>
                        @foreach ($fields as $field)
                            <option value="{{ $field }}">{{ $field }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="relative">
                    <select wire:model.debounce.200ms="type" name="" id=""
                        class="w-full h-[35px] py-0 font-bold  text-[14px] bg-gray-100  rounded-md  border-[1px] border-black dark:bg-gray-600 dark:text-gray-300 ">
                        <option value="">Tous les types</option>
                        <option value="académique">Académique</option>
                        <option value="professionnel">Professionnel</option>
                    </select>
                </div>
                <div class="relative">
                    <select wire:model="validity" name="" id=""
                        class="w-full h-[35px] py-0 bg-gray-100 dark:bg-gray-600 dark:text-gray-300 font-bold  text-[14px]  rounded-md  border-[1px] border-black ">
                        <option>Tous</option>
                        <option value="true">Valide</option>
                        <option value="false">Invalide</option>
                    </select>
                </div>
            </div>

        </div>
    </div>

    <div class="bg-white dark:bg-gray-800 dark:text-gray-300 md:rounded-md  mx-auto relative">
        <div>
            <!-- le tableau de la liste des emplois -->
            <div class="overflow-hidden md:rounded-b-lg shadow-xs">

                <div class="overflow-x-auto">
                    <div class="flex flex-col space-y-6">
                        @if (count($internships) > 0)
                            @foreach ($internships as $internship)
                                <!-- Un emploi:Début -->
                                <div class="w-full flex px-4">
                                    <div class="w-[30px] md:w-[50px]">
                                        <input type="checkbox" class="rounded-md">
                                    </div>
                                    <div class="flex flex-1 flex-col justify-between  md:flex-row space-y-2">
                                        <div class="flex flex-col text-[14px]">
                                            <div class="text-[15px] font-semibold">{{ $internship->title }}</div>

                                            <div class="text-[13px] text-blue-500">
                                                @if ($internship->publication_date < now())
                                                    il y a
                                                    {{ now()->diffInDays($internship->publication_date) }}
                                                    jour(s)
                                                @else
                                                    dans
                                                    {{ now()->diffInDays($internship->publication_date) }}
                                                    jour(s)
                                                @endif
                                            </div>
                                        </div>
                                        <div class="text-gray-400 text-[14px]">
                                            <a
                                                href="{{ route('internship.proposal.show', [$internship->offerable->id]) }}">
                                                {{ count($internship->proposals) }} proposition(s)
                                            </a>
                                        </div>
                                        <div class="text-[11px] flex items-start space-x-2">
                                            <a
                                                href="{{ route('internship-dashboard-show', [$internship->offerable->id]) }}">
                                                <button class="bg-green-600 text-gray-100 px-2 py-1 rounded-md">
                                                    VOIR PLUS
                                                </button>
                                            </a>

                                            <a
                                                href="{{ route('internship-dashboard-edit', [$internship->offerable->id]) }}">
                                                <button
                                                    class="border-[1px] border-black text-gray-800 px-2 py-1 rounded-md">
                                                    MODIFIER
                                                </button>
                                            </a>
                                            <button wire:click="deleteConfirmation({{ $internship->offerable }})"
                                                class="border-[1px] border-black text-gray-800 px-2 py-1 rounded-md">
                                                SUPPRIMER
                                            </button>
                                        </div>
                                    </div>

                                </div>
                                <!-- Un emploi:Fin -->
                            @endforeach
                        @else
                            <div class="flex flex-col items-center space-y-4 bg-white dark:bg-gray-800 dark:text-gray-300 py-3">
                                <div class="md:w-[300px] md:h-[300px]">
                                    <img src="{{ Storage::url('illustrations/search-error.jpg') }}" alt="">
                                </div>
                                <div class="text-center font-semibold">Nous sommes désolés !</div>
                                <div class="text-center">Aucun résultat ne correspond à votre recherche</div>
                            </div>
                        @endif
                    </div>
                    <div wire:loading
                        class="w-full z-10 h-full bg-white dark:bg-gray-800  text-center rounded-md absolute top-0 left-0 flex justify-center items-center">
                        <div class="flex justify-center items-center h-full">
                            <div
                                class="animate-spin mr-2 w-10 h-10 border-[3px] border-transparent border-t-[3px] border-t-blue-600   rounded-full">
                            </div>
                        </div>

                    </div>
                </div>

                <div
                    class="px-4 py-4 mt-4 font-semibold tracking-wide text-gray-500 uppercase border-t dark:border-gray-700 bg-gray-50 sm:grid-cols-9 dark:text-gray-400 dark:bg-gray-800">
                    {{ $internships->links() }}
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
                    <p class="text-[16px] font-semibold">Etes-vous sûr de vouloir supprimer cette offre de stage ?</p>
                    <p>Une fois supprimée, elle disparaitra de la liste de vos offres.</p>
                </div>
                <div class="w-full py-2 px-4 flex flex-col  items-start">
                    <p class="flex space-x-4 justify-end w-full">
                        <button @click="openDeleteConfirm = false"
                            class="border-[1px] rounded-md text-blue-500 py-1 px-4">Annuler</button>
                        <button wire:click="delete({{ $deleteInternship }})"
                            class="bg-blue-500 text-white rounded-md py-1 px-4">Confirmer</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Confirmation -->

</div>
