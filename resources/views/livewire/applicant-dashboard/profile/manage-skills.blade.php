<div>
    <!-- Start: Skills -->
    <div class="flex flex-col space-y-2 w-full items-center px-4">

        <div class="text-[16px] flex items-center justify-between font-bold text-left w-full text-gray-600 ">
            <span>COMPETENCES</span>
            <div class="flex space-x-4">
                <button wire:click="toggleAddForm" class="text-black text-[25px]">
                    <i class="bi-plus"></i>
                </button>
                <button wire:click="toggleEditForm" class="text-black">
                    <i class="bi-pencil"></i>
                </button>
            </div>
        </div>

        <div class="flex flex-col space-y-3 w-full px-4">
            @if(count($skills1) > 0)
                @foreach ($skills1 as $skill)
                    <div class="flex flex-col w-full space-y-2 text-[14px] text-gray-500">
                        <div>{{ $skill['name'] }}</div>
                        <div class="flex space-x-3">
                            @for ($i = 0; $i < $skill['level']; $i++)
                                <span class="w-[12px] h-[12px] rounded-full bg-orange-500"></span>
                            @endfor


                            @if($skill['level'] < 10 && is_int(intval($skill['level'])))
                                @for ($i = 0; $i < 10 - intval($skill['level']); $i++)
                                    <span class="w-[12px] h-[12px] rounded-full border-[1px] border-orange-500"></span>
                                @endfor
                            @endif

                        </div>
                    </div>
                @endforeach
            @else
                <div>Aucune compétence </div>
            @endif
        </div>

    </div>
    <!-- End: Skills -->




    @if ($isEditFormOpen)
        <div
            class="bg-[#000000d3] flex  p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white shadow-2xl rounded-md w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full flex items-center justify-between py-2 px-4">
                    <span>Compétences</span>
                    <button wire:click="toggleEditForm">
                        <span class="text-[12px] text-red-500">Fermer</span>
                    </button>
                </div>
                <div class="flex flex-col w-full space-y-4 items-center">


                    @if ($skills)
                        @php
                            $i = 0;
                        @endphp
                        @foreach ($skills as $skill)
                            <div class="flex flex-col w-full">
                                @if ($editId !== $i)
                                    <div wire:key="skill{{ $i }}" wire:click="startEdit({{ $i }})"
                                        class="bg-gray-50 rounded-t-md w-full py-2 px-4 flex justify-between  @if ($editId === $i) border-b-2 border-gray-400 @endif ">
                                        <span>{{ $skill['name'] }}</span>
                                        <span>{{ $skill['level'] }}</span>
                                    </div>
                                @else
                                    <div class="flex flex-col  space-y-3 w-full bg-gray-50 p-2 rounded-b-md">
                                        <form wire:submit.prevent="update({{ $i }})" method="POST">
                                            @csrf
                                            <div class="flex justify-between w-full space-x-3">
                                                <div class="input-container !w-[70%]">
                                                    <label class="label" for="skill{{ $i }}">
                                                        Nom
                                                    </label>

                                                    <div>
                                                        <select wire:key='skills.{{ $i }}.name'
                                                            wire:model="skills.{{ $i }}.name"
                                                            class="input editable "
                                                            name="skills.{{ $i }}.name"
                                                            id="skill{{ $i }}">
                                                            <option selected value="{{ $skill['name'] }}">{{ $skill['name'] }}
                                                            </option>
                                                        </select>
                                                    </div>

                                                    @error('skills.' . $i . '.name')
                                                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="input-container !w-[30%] ">
                                                    <label class="label" for="department_address">
                                                        Niveau
                                                    </label>

                                                    <input wire:key='skills.{{ $i }}.name'
                                                        wire:model="skills.{{ $i }}.level" max="10"
                                                        class="input" type="number"
                                                        name="skills.{{ $i }}.level"
                                                        id="skills.{{ $i }}.level">

                                                    @error('skills.' . $i . '.level')
                                                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <!-- Les boutons pour la submission du formulaire -->
                                            <div class="w-full  text-[14px] flex justify-end">
                                                <div class="flex w-full  justify-end py-4">

                                                    <button role="none" type="button"
                                                        class="border-red-600 border-[1px] rounded-md text-red-600 py-1 mx-4 px-3   flex items-center "
                                                        wire:click="supprimerSkill({{ $i }})">
                                                        <div wire:loading wire:target=""
                                                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
                                                        </div>
                                                        <span>Supprimer la compétence</span>
                                                    </button>

                                                    <button role="none" type="button"
                                                        class="border-blue-600 border-[1px] rounded-md text-blue-600 py-1 mx-4 px-3   flex items-center "
                                                        wire:click="resetEdit">

                                                        <span>Annuler</span>
                                                    </button>


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
                                @endif
                            </div>


                            @php
                                $i++;
                            @endphp
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    @elseif ($isAddFormOpen)
        <div
            class="bg-[#000000d3] flex  p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white shadow-2xl rounded-md w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4">Compétences</div>
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
                                        <select wire:model="newSkill" class="input" name="skill" id="skill">
                                            <option value="{{ $newSkill }}">{{ $newSkill }}</option>
                                        </select>
                                    </div>

                                    @error('skill')
                                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="input-container !w-[30%] ">
                                    <label class="label" for="department_address">
                                        Niveau
                                    </label>

                                    <input wire:model="newLevel" max="10" class="input" type="number" name=""
                                        id="level">

                                    @error('level')
                                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>


                            <!-- Les boutons pour la submission du formulaire -->
                            <div class="w-full  text-[14px] flex justify-end">
                                <div class="flex w-full  justify-end py-4">


                                    <button
                                        class="border-blue-600 border-[1px] rounded-md text-blue-600 py-1 mx-4 px-3   flex items-center "
                                        wire:click="toggleAddForm">
                                        <div wire:loading wire:target=""
                                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
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
    @endif
</div>

@push('scripts')
    <script>
        $(function() {


            $('#skill').select2({
                tags: true
            });


            $('body').on('select2:select', '#skill', function() {
                let data = $(this).val();
                @this.set('newSkill', data);
            });


            Livewire.on('selectUpdated', () => {
                watchSelect();

                $('#skill').select2({
                    tags: true
                });


                $('body').on('select2:select', '#skill', function() {
                    let data = $(this).val();
                    @this.set('newSkill', data);
                });
            });

            watchSelect();

            function watchSelect() {
                let select = $('.editable');

                $.each(select, function(indexInArray, valueOfElement) {
                    // alert('#'+$(this).attr('id'));

                    $('#' + $(this).attr('id')).select2({
                        tags: true
                    });

                    // $(this).select2({
                    //     tags: true
                    // });

                    // alert($(this).val());

                    $('body').on('select2:select', '#' + $(this).attr('id'), function() {
                        let data = $(this).val();
                        @this.set($(this).attr('name'), data);
                    })
                });
            }
        });
    </script>
@endpush
