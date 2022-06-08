<div x-data="{ openAddForm: @entangle('showAddForm'), openEditForm: @entangle('showEditForm'), openDeleteConfirm: @entangle('showDeleteConfirmation')  }" @close-modal.window="openAddForm = false; openEditForm = false; openDeleteConfirm = false;">
    <!-- Start: Expérience Professionnel -->
    <div
        class="bg-white dark:bg-gray-800 dark:text-gray-200  border-[2px] border-gray-200 dark:border-gray-600 text-gray-400 w-full rounded-md px-6 py-4 mt-6 flex flex-col space-y-8">

        @if (session()->has('message'))
            <div class="text-gray-800 flex items-center justify-between text-[12px]">
                {{ session('message') }}
            </div>
        @endif

        <div class="text-gray-500 flex items-center justify-between">
            <span>{{ count($experiences) }} Expériences professionnelles</span>
            <button @click="openAddForm = !openAddForm"
                class="text-[12px] text-gray-600 border-[1px] border-gray-500 rounded-full px-3 py-1 hover:bg-blue-600 hover:text-gray-100 hover:border-none">+
                <div wire:loading wire:target="toogleShowView"
                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
                </div>
                Ajouter
            </button>
        </div>

        <div class="w-full flex flex-col space-y-4">
            @if (count($experiences) > 0)
                @php
                    $i = 0;
                @endphp
                @foreach ($profile->proExperiences as $experience)
                    @php
                        $i++;
                    @endphp
                    <div
                        class="w-full flex flex-col  @if ($i !== count($profile->proExperiences)) border-b-[2px] border-gray-200 @endif  space-y-2 relative  justify-between pb-4">

                        <div class="w-full flex space-x-4  justify-between relative">
                            <div class="flex-1 w-full flex-col flex md:flex-row justify-between md:space-x-6">
                                <div class="flex flex-1 flex-col">
                                    <span class="font-semibold dark:text-gray-200 text-black">{{ $experience->position_occuped }}</span>
                                    <span class="text-gray-400">{{ $experience->company }}</span>
                                </div>
                                <div class="flex flex-col space-y-1 h-full  text-gray-500">
                                    <span><i class="bi-clock-history "></i> {{ $experience->date_start }} -
                                        {{ $experience->date_end }}</span>
                                    <span><i class="bi-geo-alt"></i> {{ $experience->city }} ,
                                        {{ $experience->country }}</span>
                                </div>
                            </div>
                            <div x-data="{ open: false }" class="flex flex-col space-y-1 h-full  text-gray-800">
                                <button @click="open = true" class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 rounded-md text-[16px]"><i
                                        class="bi-three-dots-vertical"></i></button>
                                <div x-cloak x-show="open" @click.away="open = false"
                                    class="w-32 bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md absolute top-[18px] z-10 right-4 md:right-0">
                                    <ul class="flex flex-col space-y-2 py-2">
                                        <li class="hover:bg-gray-100 dark:hover:bg-gray-600  px-4 py-1">
                                            <button wire:click="startEdit({{ $experience->id }})"> <i
                                                    class="bi-pencil"></i> Modifier</button>
                                        </li>
                                        <li class="hover:bg-gray-100 dark:hover:bg-gray-600 px-4 py-1">
                                            <button wire:click="deleteConfirmation({{ $experience->id }})"><i
                                                    class="bi-trash"></i> Supprimer</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="text-gray-500">
                            @if ($experience->description)
                                {{ $experience->description }}
                            @endif
                        </div>
                    </div>
                @endforeach
            @else
                <div>Aucune expérience professionnelle</div>
            @endif


        </div>
    </div>
    <!-- End: Expérience Professionnel -->


    <!-- Start: Formulaire d'ajout -->
    <div x-cloak x-show="openAddForm">
        <div
            class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4 flex justify-between items-center">
                    <span>Ajouter une expérience professionnelle</span>
                    <span @click="openAddForm = false"
                        class="text-[12px] cursor-pointer text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
                        <div wire:loading wire:target="toogleShowView"
                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full"
                            type="button"></div>
                        Fermer
                    </span>
                </div>
                <form wire:submit.prevent="store" method="post" class="flex flex-col w-full space-y-4 items-center">
                    @csrf

                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Poste occupé
                        </label>
                        <input wire:model.debounce.1000ms="position_occuped" id="birthdate" name="birthdate"
                            class="input" type="text">
                        @error('position_occuped')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Nom de la structure
                        </label>
                        <input wire:model.debounce.1000ms="company" id="birthdate" name="birthdate"
                            class="input" type="text">
                        @error('company')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div
                        class="flex flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%]">
                        <div class="input-container ">
                            <label class="label" for="firstname">
                                Pays
                            </label>
                            <input wire:model.debounce.1000ms="country" id="country" name="country"
                                class="input" type="text">
                            @error('country')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-container ">
                            <label class="label" for="lastname">
                                Ville
                            </label>
                            <input wire:model.debounce.1000ms="city" id="city" name="city"
                                class="input" type="text">
                            @error('city')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="flex flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%]">
                        <div class="input-container ">
                            <label class="label" for="firstname">
                                Date début
                            </label>
                            <input wire:model.debounce.1000ms="date_start" id="firstname" name="firstname"
                                class="input" type="month">
                            @error('date_start')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-container ">
                            <label class="label" for="lastname">
                                Date de fin
                            </label>
                            <input wire:model.debounce.1000ms="date_end" id="lastname" name="lastname"
                                class="input" type="month">
                            @error('date_end')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>



                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Décrivez un peu ce que vous avez accompli lors de cette expérience
                        </label>
                        <textarea wire:model.debounce.1000ms="description" class="input" name="" id="" cols="30" rows="4"></textarea>
                        @error('description')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>



                    <!-- Les boutons pour la submission du formulaire -->
                    <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                        <div class="h-16 flex w-full  justify-between px-4">
                            <button role="button" type="submit" wire:loading.attr="disabled" wire:target="store"
                                class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-1 px-3  h-[40px] flex  items-center">
                                <div wire:loading wire:target="store"
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                                    type="button"></div>
                                Ajouter
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: Formlaire d'ajout -->

    <!-- Start: Formulaire de modification -->
    <div x-cloak x-show="openEditForm" x-transition:enter="ease-out duration-300"
        x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100"
        x-transition:leave="ease-in duration-300" x-transition:leave-start="opacity-100 scale-100"
        x-transition:leave-end="opacity-0 scale-90">
        <div
            class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4 flex justify-between items-center">
                    <span>Ajouter une expérience professionnelle</span>
                    <span @click="openEditForm = false"
                        class="text-[12px] cursor-pointer text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
                        <div wire:loading wire:target="toogleShowView"
                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full"
                            type="button"></div>
                        Fermer
                    </span>
                </div>
                <form wire:submit.prevent="update" method="post" class="flex flex-col w-full space-y-4 items-center">
                    @csrf

                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Poste occupé
                        </label>
                        <input wire:model.debounce.1000ms="position_occuped" id="birthdate" name="birthdate"
                            class="input" type="text">
                        @error('position_occuped')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Nom de la structure
                        </label>
                        <input wire:model.debounce.1000ms="company" id="birthdate" name="birthdate"
                            class="input" type="text">
                        @error('company')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div
                        class="flex flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%]">
                        <div class="input-container ">
                            <label class="label" for="firstname">
                                Date début
                            </label>
                            <input wire:model.debounce.1000ms="date_start" id="firstname" name="firstname"
                                class="input" type="month">
                            @error('date_start')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-container ">
                            <label class="label" for="lastname">
                                Date de fin
                            </label>
                            <input wire:model.debounce.1000ms="date_end" id="lastname" name="lastname"
                                class="input" type="month">
                            @error('date_end')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div
                        class="flex flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%]">
                        <div class="input-container ">
                            <label class="label" for="firstname">
                                Pays
                            </label>
                            <input wire:model.debounce.1000ms="country" id="firstname" name="firstname"
                                class="input" type="text">
                            @error('country')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-container ">
                            <label class="label" for="lastname">
                                Ville
                            </label>
                            <input wire:model.debounce.1000ms="city" id="lastname" name="lastname"
                                class="input" type="text">
                            @error('city')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Décrivez un peu ce que vous avez accompli lors de cette expérience
                        </label>
                        <textarea wire:model.debounce.1000ms="description" class="input" name="" id="" cols="30" rows="4"></textarea>
                        @error('description')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>



                    <!-- Les boutons pour la submission du formulaire -->
                    <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                        <div class="h-16 flex w-full  justify-between px-4">



                            <button role="button" type="submit" wire:loading.attr="disabled" wire:target="store"
                                class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-1 px-3  h-[40px] flex  items-center">
                                <div wire:loading wire:target="store"
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                                    type="button"></div>
                                Modifier
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: Formulaire de modification -->

    <!-- Start: Confirmation -->
    <div x-cloak x-show="openDeleteConfirm">
        <div
            class="bg-[#07141fd4]  flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4 flex flex-col  items-start">
                    <p class="text-[16px] font-semibold">Etes-vous sur de vouloir supprimer cette expérience professionnelle ?</p>
                    <p>Une fois supprimée, elle disparaitra de votre profil</p>
                </div>
                <div class="w-full py-2 px-4 flex flex-col  items-start">
                    <p class="flex space-x-4 justify-end w-full">
                        <button @click="openDeleteConfirm = false" wire:click="cancelDelete" class="border-[1px] rounded-md text-blue-500 py-1 px-4">Annuler</button>
                        <button wire:click="delete" class="bg-blue-500 text-white rounded-md py-1 px-4">Confirmer</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Confirmation -->

</div>
