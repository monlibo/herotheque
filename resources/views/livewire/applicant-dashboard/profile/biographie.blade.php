<div x-data="{ openEditForm: @entangle('openEditForm') }" @close-modal.window="openEditForm = false;">

    <div class="bg-white dark:bg-gray-800 dark:text-gray-300  border-[2px] border-gray-200 dark:border-gray-400   w-full rounded-md px-6 py-4 mt-6 flex flex-col space-y-8">
        <div class="text-gray-500 flex items-center justify-between">
            <span class="dark:text-gray-200">Votre biographie</span>
            <button @click="openEditForm = !openEditForm"
                class="text-[12px] text-gray-600 border-[1px] border-gray-500 rounded-full px-3 py-1 hover:bg-blue-600 hover:text-gray-100 hover:border-none">
                Editer</button>
        </div>

        <div class="w-full flex flex-col space-y-4 bio-container">
            @if ($profile->bio && $profile->bio !== "<p><br></p>")
                {!!  $profile->bio   !!}
            @else
                Votre biographie est vide
            @endif

        </div>
    </div>

    <!-- Start: Formulaire d'ajout -->
    <div x-cloak x-show="openEditForm">
        <div
            class="bg-[#07141fd4]  flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4 flex justify-between items-center">
                    <span>Modifier votre biographie</span>
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

                    <div x-data="{ bio: @entangle('bio') }" x-init=" editor = new Quill('#biographie', {
                         theme: 'snow'
                     });

                     editor.on('text-change', function() {
                         bio = editor.root.innerHTML;
                     });

                     if ($('.ql-toolbar').length == 2) {
                         $('.ql-toolbar:first').remove();
                     }" class="input-container" wire:ignore>

                        <div id="biographie">
                            {!! $profile->bio !!}
                        </div>

                    </div>


                    <!-- Les boutons pour la submission du formulaire -->
                    <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                        <div class="h-16 flex w-full  justify-between px-4">
                            <button role="button" type="submit" wire:loading.attr="disabled" wire:target="store"
                                class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-1 px-3  h-[40px] flex  items-center">
                                <div wire:loading wire:target="store"
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                                    type="button"></div>
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- End: Formlaire d'ajout -->

</div>
