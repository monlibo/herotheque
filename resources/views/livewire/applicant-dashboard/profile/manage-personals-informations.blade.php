<div>
    <!-- Start: Personals Informations -->
    <div class="flex flex-col relative space-y-6">
        <div class="flex space-x-4 text-[18px] absolute top-4 right-4">
            <button wire:click="toggleShow" class="text-black">
                <i class="bi-pencil"></i>
            </button>
        </div>

        <div class="w-[200px] mx-auto !mb-6 h-[200px] rounded-lg rotate-6 bg-blue-200 overflow-visible shadow-2xl">
            <div class="w-[200px] mx-auto h-[200px] rounded-lg -rotate-12 bg-blue-300 overflow-visible shadow-2xl">
                <div class="w-[200px] mx-auto h-[200px] rounded-lg rotate-6 bg-blue-400 overflow-hidden">
                    @if ($logo)
                        <img src="{{ $logo }}" class="h-full w-auto">
                    @endif
                </div>
            </div>
        </div>

        <div class="flex flex-col space-y-2 w-full items-center px-4">
            <div class="text-[18px] text-gray-600">{{ $firstname }} {{ $lastname }} <span
                    class="text-[14px]">({{ now()->diffInYears($birthdate) }} ans)</span> </div>
            <div class="w-full text-center text-gray-500">{{ $short_bio }}</div>
        </div>
    </div>
    <!-- End: Personals Informations -->





    <!-- Start: EditForm -->
    @if ($isEditFormOpen)
        <div
            class="bg-[#000000d3] flex  p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white shadow-2xl rounded-md w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4">Modifier les informations personnelles</div>
                <div class="flex flex-col w-full space-y-4 items-center">
                    <div class="col-span-6 !mb-6 sm:col-span-4 flex w-full md:w-[90%] justify-start items-end">
                        <div
                            class="w-[100px] h-[100px] lg:h-[100px] lg:min-w-[100px] rounded-full overflow-hidden flex bg-red-500">
                            @if (!$temporaryLogo)
                                <img src="{{ $logo }}" class="w-full">
                            @else
                                <img src="{{ $newLogo->temporaryUrl() }}">
                            @endif
                        </div>

                        <label for="newLogo"
                            class="text-[14px]  text-gray-600 mx-4 py-1 px-3  h-[30px] rounded-md flex  items-center border-2 border-gray-600">
                            Choisir une photo
                        </label>
                        <label for=""
                            class="text-[14px]  text-gray-600 mx-4 py-1 px-3  h-[30px] rounded-md flex  items-center border-2 border-gray-600">
                            Supprimer la photo
                        </label>


                        <input wire:model="newLogo" class="!hidden" id="newLogo" name="newLogo" type="file">
                        @error('newLogo')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="firstname">
                            Prénom(s)
                        </label>
                        <input wire:model="firstname" id="firstname" name="firstname" class="input"
                            type="text">
                        @error('firstname')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="lastname">
                            Nom
                        </label>
                        <input wire:model="lastname" id="lastname" name="lastname" class="input" type="text">
                        @error('lastname')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Date de naissance
                        </label>
                        <input wire:model="birthdate" id="birthdate" name="birthdate" class="input"
                            type="date">
                        @error('birthdate')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="short_bio">
                            Courte description de ce que vous faîtes
                        </label>
                        <textarea wire:model="short_bio" name="short_bio" class="input" id="short_bio" cols="30" rows="1"></textarea>
                        @error('short_bio')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <!-- Les boutons pour la submission du formulaire -->
                    <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                        <div class="h-16 flex w-full  justify-between">

                            <button
                                class="border-blue-600 border-[1px] rounded-md text-blue-600 py-2 mx-4 px-3  h-[40px] flex items-center "
                                wire:click="toggleShow">
                                <div wire:loading wire:target=""
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
                                </div>
                                <span>Annuler</span>
                            </button>


                            <button wire:loading.attr="disabled"  wire:target="newLogo"
                                class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-2 px-3  h-[40px] flex  items-center"
                                wire:click="update">
                                <div wire:loading wire:target=""
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                                    type="button"></div>
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- End: EditForm -->

</div>
