<div>
    <div
        class="bg-[#07141fd4] flex text-black   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
            <div class="w-full py-2 px-4 flex justify-between items-center">
                <span>Modifier une compétence</span>
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

                <div class="flex justify-between w-full space-x-3">
                    <div class="input-container !w-[70%]">
                        <label class="label" for="">
                            Nom
                        </label>

                        <div>
                            <select wire:model="skills.{{ $skill_id }}.name" class="input"
                                name="skills.{{ $skill_id }}.name" id="skill">
                                <option value="{{ $skills[$skill_id]['name'] }}">{{ $skills[$skill_id]['name'] }}
                                </option>
                            </select>
                        </div>

                        @error('newSkill')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="input-container !w-[30%] ">
                        <label class="label" for="department_address">
                            Niveau
                        </label>

                        <select wire:model="skills.{{ $skill_id }}.level" class="input" name="skill">
                            <option value="debutant">Débutant</option>
                            <option value="inter">Intermédiaire</option>
                            <option value="avance">Avancée</option>
                        </select>

                        @error('newLevel')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
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


    <script>
        $(function() {

            document.addEventListener('livewire:load', function() {
                window.livewire.on('selectUpdated', () => {
                    $('#skill').select2({
                        tags: true
                    });
                });
            });



            $('#skill').select2({
                tags: true
            });

            // $(this).select2({
            //     tags: true
            // });

            // alert($(this).val());

            $('body').on('select2:select', '#skill', function() {
                let data = $(this).val();
                @this.set($(this).attr('name'), data);
            })




        });
    </script>
</div>
