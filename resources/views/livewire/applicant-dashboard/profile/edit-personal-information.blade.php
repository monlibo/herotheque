<div>
    <div
        class="bg-[#07141fd4] flex text-black   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
            <div class="w-full py-2 px-4 flex justify-between items-center">
                <span>Modifier une expérience professionnelle</span>
                <span wire:click="toogleShowView"
                    class="text-[12px] text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
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
                    <input wire:model.defer="experience.position_occuped" id="birthdate" name="birthdate"
                        class="input" type="text">
                    @error('experience.position_occuped')
                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div class="input-container ">
                    <label class="label" for="birthdate">
                        Nom de la structure
                    </label>
                    <input wire:model.defer="experience.company" id="birthdate" name="birthdate" class="input"
                        type="text">
                    @error('experience.company')
                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>

                <div
                    class="flex flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%]">
                    <div class="input-container ">
                        <label class="label" for="firstname">
                            Date début
                        </label>
                        <input wire:model.defer="experience.date_start" id="firstname" name="firstname"
                            class="input" type="month">
                        @error('experience.date_start')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="lastname">
                            Date de fin
                        </label>
                        <input wire:model.defer="experience.date_end" id="lastname" name="lastname"
                            class="input" type="month">
                        @error('experience.date_end')
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
                        <input wire:model.defer="experience.country" id="firstname" name="firstname"
                            class="input" type="text">
                        @error('experience.country')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="lastname">
                            Ville
                        </label>
                        <input wire:model.defer="experience.city" id="lastname" name="lastname" class="input"
                            type="text">
                        @error('experience.city')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>

                <div class="input-container ">
                    <label class="label" for="birthdate">
                        Décrivez un peu ce que vous avez accompli lors de cette expérience
                    </label>
                    <textarea wire:model.defer="experience.description" class="input" name="" id="" cols="30" rows="4"></textarea>
                    @error('experience.description')
                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                    @enderror
                </div>



                <!-- Les boutons pour la submission du formulaire -->
                <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                    <div class="h-16 flex w-full  justify-between px-4">

                        <button role="none" type="button" wire:loading.attr="disabled" wire:target="add"
                            class="border-blue-600 border-[1px] rounded-md text-blue-600 py-2 mx-4 px-3  h-[40px] flex items-center "
                            wire:click="toogleShowView">
                            <div wire:loading wire:target="toogleShowView"
                                class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
                            </div>
                            <span>Annuler</span>
                        </button>


                        <button role="button" type="submit" wire:loading.attr="disabled" wire:target="add"
                            class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-2 px-3  h-[40px] flex  items-center">
                            <div wire:loading wire:target="add"
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
