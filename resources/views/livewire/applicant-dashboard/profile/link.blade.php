<div x-data="{ openEditForm: @entangle('openEditForm') }" @close-modal.window=" openEditForm=false;">
    <!-- Start: Liens -->
    <div
        class="bg-white dark:bg-gray-800 dark:text-gray-200  border-[2px] border-gray-200 dark:border-gray-600  text-gray-400 w-full rounded-md px-6 py-4 mt-6 flex flex-col space-y-8">
        <div class="text-gray-500 flex items-center justify-between">
            <span>Liens sociaux</span>
            <button @click="openEditForm = true"
                class="text-[12px] text-gray-600 border-[1px] border-gray-500 rounded-full px-3 py-1 hover:bg-blue-600 hover:text-gray-100 hover:border-none">
                Editer
            </button>
        </div>

        <div class="w-full flex flex-col space-y-4">
            <div class="w-full flex flex-col  space-y-2 relative  justify-between pb-4">

                <div class="w-full flex space-x-4  justify-between relative">
                    <div class="flex-1 w-full flex-col flex md:flex-row justify-between md:space-x-6">
                        <div class="flex flex-1 flex-col">
                            <span class="font-semibold  dark:text-gray-200 text-black">Site web</span>
                            @if ($profile->website)
                                <span class="text-gray-400">{{ $profile->website }}</span>
                            @else
                                <span class="text-gray-400">Indéfini</span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="w-full flex space-x-4  justify-between relative">
                    <div class="flex-1 w-full flex-col flex md:flex-row justify-between md:space-x-6">
                        <div class="flex flex-1 flex-col">
                            <span class="font-semibold  dark:text-gray-200 text-black">Facebook</span>
                            @if ($profile->facebook)
                                <span class="text-gray-400">{{ $profile->facebook }}</span>
                            @else
                                <span class="text-gray-400">Indéfini</span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="w-full flex space-x-4  justify-between relative">
                    <div class="flex-1 w-full flex-col flex md:flex-row justify-between md:space-x-6">
                        <div class="flex flex-1 flex-col">
                            <span class="font-semibold  dark:text-gray-200 text-black">Instagram</span>
                            @if ($profile->instagram)
                                <span class="text-gray-400">{{ $profile->instagram }}</span>
                            @else
                                <span class="text-gray-400">Indéfini</span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="w-full flex space-x-4  justify-between relative">
                    <div class="flex-1 w-full flex-col flex md:flex-row justify-between md:space-x-6">
                        <div class="flex flex-1 flex-col">
                            <span class="font-semibold  dark:text-gray-200 text-black">Twitter</span>
                            @if($profile->twitter)
                                <span class="text-gray-400">{{ $profile->twitter }}</span>
                            @else
                                <span class="text-gray-400">Indéfini</span>
                            @endif
                        </div>

                    </div>
                </div>
                <div class="w-full flex space-x-4  justify-between relative">
                    <div class="flex-1 w-full flex-col flex md:flex-row justify-between md:space-x-6">
                        <div class="flex flex-1 flex-col">
                            <span class="font-semibold dark:text-gray-200 text-black">Github</span>
                            @if($profile->github)
                                <span class="text-gray-400">{{ $profile->github }}</span>
                            @else
                                <span class="text-gray-400">Indéfini</span>
                            @endif
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <!-- End: Liens -->

    <!-- Start: Formulaire d'édition -->
    <div x-cloak x-show="openEditForm"
        class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
        <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 items-center">
            <div wire:click="" class="w-full py-2 px-4 flex justify-between items-center">
                <span>Vos liens sociaux</span>
                <span @click="openEditForm = false;"
                    class="text-[12px] text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">

                    Fermer
                </span>
            </div>

            <form wire:submit.prevent="update" method="POST" class="flex flex-col w-full space-y-4 items-center justify-center">
                @csrf
                <div class="flex justify-between w-full space-x-3">
                    <div class="input-container">
                        <label class="label" for="website">
                            Votre site web
                        </label>

                        <input type="url" wire:model="website" class="input" id="website">

                        @error('website')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between w-full space-x-3">
                    <div class="input-container">
                        <label class="label" for="facebook">
                            Votre lien Facebook
                        </label>

                        <input type="url" wire:model="facebook" class="input" id="facebook">

                        @error('facebook')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between w-full space-x-3">
                    <div class="input-container">
                        <label class="label" for="instagram">
                            Votre lien instagram
                        </label>

                        <input type="url" wire:model="instagram" class="input" id="instagram">

                        @error('instagram')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between w-full space-x-3">
                    <div class="input-container">
                        <label class="label" for="twitter">
                            Votre lien twitter
                        </label>

                        <input type="url" wire:model="twitter" class="input">

                        @error('twitter')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="flex justify-between w-full space-x-3">
                    <div class="input-container">
                        <label class="label" for="github">
                            Votre lien github
                        </label>

                        <input type="url" wire:model="github" class="input" id="github">

                        @error('github')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                </div>


                <!-- Les boutons pour la submission du formulaire -->
                <div class="w-full  text-[14px] flex justify-end">
                    <div class="flex w-full  justify-end py-4">
                        <button type="submit"
                            class="bg-blue-600 rounded-md shadow-lg text-white mx-4 py-1 px-3   flex  items-center">
                            <div wire:loading wire:target=""
                                class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                                type="button"></div>
                            Mettre à jour
                        </button>
                    </div>
                </div>
            </form>

        </div>
    </div>
    <!-- End: Formulaire d'édition -->
</div>
