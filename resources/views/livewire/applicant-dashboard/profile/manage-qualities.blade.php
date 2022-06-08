<div>
    <!-- Start: Qualities -->
    <div class="flex flex-col space-y-2 w-full items-center px-4">
        <div class="text-[16px] flex justify-between items-center font-bold text-left w-full text-gray-600">
            <span>QUALITES DOMINANTES</span>
            <div class="flex space-x-4">
                <button class="text-black text-[25px]">
                    <i class="bi-plus"></i>
                </button>
                <button class="text-black">
                    <i class="bi-pencil"></i>
                </button>
            </div>
        </div>
        <ul class="text-left text-[14px] w-full pl-4 text-gray-500 " style="list-style:circle;">
            <li>Travail en équipe</li>
            <li>Ponctuel et Dynamique</li>
            <li>Facilité d'adaptation</li>
            <li>Goût du travail bien fait</li>
            <li>Innovateur</li>
        </ul>
    </div>
    <!-- End: Qualities -->

    @if ($isEditFormOpen)
        <div
            class="bg-[#000000d3] flex  p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white shadow-2xl rounded-md w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4">Modifier les qualités dominantes</div>
                <div class="flex flex-col w-full space-y-4 items-center">


                    <div class="input-container ">
                        <label class="label" for="city_address">
                            Adresse Ville
                        </label>
                        <div>
                            <select wire:model="city_address" class="input" name="city_address"
                                id="city_address">
                                <option value="ll">Mibert</option>
                            </select>
                        </div>

                        @error('city_address')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Les boutons pour la submission du formulaire -->
                    <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                        <div class="h-16 flex w-full  justify-between px-4">

                            <button
                                class="border-blue-600 border-[1px] rounded-md text-blue-600 py-2 mx-4 px-3  h-[40px] flex items-center "
                                wire:click="toggleShow">
                                <div wire:loading wire:target=""
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
                                </div>
                                <span>Annuler</span>
                            </button>


                            <button
                                class="bg-blue-600 rounded-md shadow-lg text-white mx-4 py-2 px-3  h-[40px] flex  items-center"
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

</div>
{{-- @push('scripts')
    <script>
        $(function() {
            $('#department_address').select2();
            $('#city_address').select2();

            $('body').on('select2:select', '#department_address', function() {
                let data = $(this).val();
                @this.set('department_address', data);
            });


            $('body').on('select2:select', '#city_address', function() {
                let data = $(this).val();
                @this.set('city_address', data);
            });

            Livewire.on('selectUpdated', () => {
                $('#department_address').select2();
                $('#city_address').select2();
            });



        });
    </script>
@endpush --}}
