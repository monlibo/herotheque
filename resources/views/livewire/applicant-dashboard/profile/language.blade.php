<div>
    <div x-init="" x-data="{ openAddForm: @entangle('openAddForm'), openEditForm: @entangle('openEditForm'), openDeleteConfirm: @entangle('openDeleteConfirm') }"
        @close-modal.window="openAddForm = false; openEditForm = false; openDeleteConfirm = false;">
        <!-- Start: Compétences -->
        <div
            class="bg-white dark:bg-gray-800 dark:text-gray-200  border-[2px] border-gray-200 dark:border-gray-600  text-gray-400 w-full rounded-md px-6 py-4 mt-6 flex flex-col space-y-8">
            <div class="text-gray-500 flex items-center justify-between">
                <span>{{ count($languages) }} Langues</span>
                <button @click="openAddForm = !openAddForm"
                    class="text-[12px] text-gray-600 border-[1px] border-gray-500 rounded-full px-3 py-1 hover:bg-blue-600 hover:text-gray-100 hover:border-none">+
                    Ajouter</button>
            </div>

            <div class="w-full flex flex-col space-y-4">
                @if (count($languages) > 0)
                    @php
                        $i = 0;
                    @endphp

                    @foreach ($languages as $language1)
                        <div
                            class="w-full flex flex-col @if ($i !== count($languages)-1) border-b-[2px] border-gray-200 dark:border-gray-600 @endif space-y-2 relative  justify-between pb-4">
                            <div class="w-full flex space-x-4  justify-between relative">
                                <div class="flex-1 w-full flex-col flex md:flex-row justify-between md:space-x-6">
                                    <div class="flex flex-1 flex-col">
                                        <span class="font-semibold dark:text-gray-200 text-black">{{ $language1['name'] }}</span>

                                    </div>
                                    <div class="flex flex-col space-y-1 h-full  text-gray-500">

                                        <span>{{ $language1['level'] }}</span>
                                    </div>
                                </div>
                                <div x-data="{ open: false }" class="flex flex-col space-y-1 h-full  text-gray-800">
                                    <button @click="open = true"
                                        class="hover:bg-gray-100 dark:hover:bg-gray-600 dark:text-gray-200 rounded-md text-[16px] "><i
                                            class="bi-three-dots-vertical"></i></button>
                                    <div x-cloak x-show="open" @click.away="open = false"
                                        class="w-32 bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md absolute top-[18px] right-4 md:right-0 z-20">
                                        <ul class="flex flex-col space-y-2 py-2">
                                            <li class="hover:bg-gray-100 dark:hover:bg-gray-600  px-4 py-1">
                                                <button wire:click="startEdit({{ $i }})"> <i
                                                        class="bi-pencil"></i> Modifer</button>
                                            </li>
                                            <li class="hover:bg-gray-100 dark:hover:bg-gray-600 px-4 py-1">
                                                <button wire:click="deleteConfirmation({{ $i }})">
                                                    <i class="bi-trash"></i> Supprimer
                                                </button>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>


                        @php
                            $i++;
                        @endphp
                    @endforeach
                @else
                    <div>Aucune langue </div>
                @endif
            </div>
        </div>
        <!-- End: Compétences -->


        <!-- Start: Formulaire d'ajout -->
        <div x-cloak x-show="openAddForm"
            class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div wire:click="" class="w-full py-2 px-4 flex justify-between items-center">
                    <span>Ajouter une langue</span>
                    <span @click="openAddForm = false;"
                        class="text-[12px] text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
                        <div wire:loading wire:target="hideAddForm"
                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full"
                            type="button"></div>
                        Fermer
                    </span>
                </div>

                <form wire:submit.prevent="store" method="POST" class="flex flex-col w-full space-y-4 items-center">
                    @csrf
                    <div class="flex justify-between w-full space-x-3">
                        <div
                            class="flex flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%]">
                            <div class="input-container">
                                <label class="label" for="">
                                    Nom de la langue
                                </label>

                                <div x-data="{ language: @entangle('language') }" x-init="select2 = $('#language0').select2({ tags: true, width: '100%', });
                                select2.on('select2:select', (event) => {
                                    language = event.target.value;
                                });
                                select2.on('select2:unselect', (event) => {
                                    language = event.target.value;
                                });" wire:ignore class="w-full">
                                    <select x-ref="language" wire:model.debounce.1000s="language" class="input"
                                        name="language" id="language0">
                                        <option value="{{ $language }}">{{ $language }}</option>
                                    </select>
                                </div>

                                @error('language')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-container">
                                <label class="label" for="department_address">
                                    Niveau de maitrîse
                                </label>

                                <select wire:model="level" class="input" name="language" id="newLevel">
                                    <option value="débutant">Débutant</option>
                                    <option value="intermédiaire">Intermédiaire</option>
                                    <option value="expérimenté">Avancée</option>
                                </select>

                                @error('level')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <!-- Les boutons pour la submission du formulaire -->
                    <div class="w-full  text-[14px] flex justify-end">
                        <div class="flex w-full  justify-end py-4">


                            <button @click="openAddForm = false" role="none" type="button"
                                class="border-blue-600 border-[1px] rounded-md text-blue-600 py-1 mx-4 px-3   flex items-center ">
                                <div wire:loading wire:target="hideAddForm"
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full">
                                </div>
                                <span>Annuler</span>
                            </button>


                            <button type="submit"
                                class="bg-blue-600 rounded-md shadow-lg text-white mx-4 py-1 px-3   flex  items-center">
                                <div wire:loading wire:target=""
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                                    type="button"></div>
                                Ajouter
                            </button>

                        </div>
                    </div>
                </form>

            </div>
        </div>
        <!-- End: Formulaire d'ajout -->


        <!-- Start: Formulaire de modification -->
        <div x-cloak x-show="openEditForm"
            class="bg-[#000000d3] flex  p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4 flex justify-between items-center">
                    <span>Modifier une langue</span>
                    <span @click="openEditForm = false"
                        class="text-[12px] text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
                        <div wire:loading wire:target="hideAddForm"
                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full"
                            type="button"></div>
                        Fermer
                    </span>
                </div>
                <div class="flex flex-col w-full space-y-4 items-center">
                    <div class="flex flex-col  space-y-3 w-full bg-gray-50 p-2 rounded-b-md">
                        <form wire:submit.prevent="update" method="POST">
                            @csrf
                            <div class="flex justify-between w-full space-x-3">
                                <div class="input-container !w-[70%]">
                                    <label class="label" for="">
                                        Nom de la langue
                                    </label>

                                    <div x-data="{
                                        language: @entangle('language'),
                                    }" @select2.window="

                                        select2 = $('#language1').select2({ tags: true, width: '100%' });

                                        select2.on('select2:select', (event) => {
                                            language = event.target.value;
                                        });
                                        select2.on('select2:unselect', (event) => {
                                            language = event.target.value;
                                        });
                                        " wire:ignore class="w-full">

                                        <select wire:model="language" class="input" name="language"
                                            id="language1">
                                            <option :value="language" x-text="language"></option>
                                            <option value="">mmmmm</option>
                                            <option value="espagnol">espagnol</option>
                                        </select>
                                    </div>

                                    @error('language')
                                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-container !w-[30%] ">
                                    <label class="label" for="department_address">
                                        Niveau de maitrîse
                                    </label>

                                    <select wire:model="level" class="input" name="language" id="newLevel">
                                        <option value="débutant">Débutant</option>
                                        <option value="intermédiaire">Intermédiaire</option>
                                        <option value="expérimenté">Avancée</option>
                                    </select>

                                    @error('level')
                                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <!-- Les boutons pour la submission du formulaire -->
                            <div class="w-full  text-[14px] flex justify-end">
                                <div class="flex w-full  justify-end py-4">


                                    <button @click="openEditForm = false;" role="none" type="button"
                                        class="border-blue-600 border-[1px] rounded-md text-blue-600 py-1 mx-4 px-3   flex items-center ">
                                        <div wire:loading wire:target="hideAddForm"
                                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full">
                                        </div>
                                        <span>Annuler</span>
                                    </button>


                                    <button type="submit"
                                        class="bg-blue-600 rounded-md shadow-lg text-white mx-4 py-1 px-3   flex  items-center">
                                        <div wire:loading wire:target=""
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
        </div>
        <!-- End: Formulaire de modification -->


        <!-- Start: Confirmation -->
        <div x-cloak x-show="openDeleteConfirm">
            <div
                class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
                <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                    <div class="w-full py-2 px-4 flex flex-col  items-start">
                        <p class="text-[16px] font-semibold">Etes-vous sûr de vouloir supprimer cette langue ?</p>
                        <p>Une fois supprimée, elle disparaitra de votre profil</p>
                    </div>
                    <div class="w-full py-2 px-4 flex flex-col  items-start">
                        <p class="flex space-x-4 justify-end w-full">
                            <button @click="openDeleteConfirm = false" wire:click="cancelDelete"
                                class="border-[1px] rounded-md text-blue-500 py-1 px-4">Annuler</button>
                            <button wire:click="delete"
                                class="bg-blue-500 text-white rounded-md py-1 px-4">Confirmer</button>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <!-- End: Confirmation -->

    </div>

</div>
