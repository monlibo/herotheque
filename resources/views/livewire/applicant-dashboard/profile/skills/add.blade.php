<div>
    <div
        class="bg-[#000000d3] flex  p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
        <div class="bg-white shadow-2xl rounded-md w-1/2 flex flex-col p-4 space-y-4 ">
            <div wire:click="" class="w-full py-2 px-4 flex justify-between items-center">
                <span>Ajouter une compétence</span>
                <span wire:click="hideAddForm"
                    class="text-[12px] text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
                    <div wire:loading wire:target="hideAddForm"
                        class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full"
                        type="button"></div>
                    Fermer
                </span>
            </div>
            <div class="flex flex-col w-full space-y-4 items-center">
                <div class="flex flex-col  space-y-3 w-full bg-gray-50 p-2 rounded-b-md">
                    <form wire:submit.prevent="add" method="POST">
                        @csrf
                        <div class="flex justify-between w-full space-x-3">
                            <div class="input-container !w-[70%]">
                                <label class="label" for="">
                                    Nom
                                </label>

                                <div>
                                    <select wire:model="newSkill" class="input" name="skill" id="newSkill">
                                        <option value="{{ $newSkill }}">{{ $newSkill }}</option>
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

                                <select wire:model="newLevel" class="input" name="skill" id="newLevel">
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
                        <div class="w-full  text-[14px] flex justify-end">
                            <div class="flex w-full  justify-end py-4">


                                <button role="none" type="button"
                                    class="border-blue-600 border-[1px] rounded-md text-blue-600 py-1 mx-4 px-3   flex items-center "
                                    wire:click="hideAddForm">
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
        </div>
    </div>


    <script>
        $(function() {


            window.livewire.on('selectUpdated', () => {
                // $('#newSkill').select2({
                //     tags: true
                // });

                $('body').on('select2:select', '#newSkill', function() {
                    let data = $(this).val();
                    @this.set('newSkill', data);
                });
            });


            $('#newSkill').select2({
                tags: true
            });


            $('body').on('select2:select', '#newSkill', function() {
                let data = $(this).val();
                @this.set('newSkill', data);
            });

        });
    </script>
</div>
