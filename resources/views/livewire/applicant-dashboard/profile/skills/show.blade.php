<div>
    <!-- Start: Compétences -->
    <div
        class="bg-white  border-[2px] border-gray-200  text-gray-400 w-full rounded-md px-6 py-4 mt-6 flex flex-col space-y-8">
        <div class="text-gray-500 flex items-center justify-between">
            <span>{{ count($skills) }} Compétences</span>
            <button wire:click="showAddForm"
                class="text-[12px] text-gray-600 border-[1px] border-gray-500 rounded-full px-3 py-1 hover:bg-blue-600 hover:text-gray-100 hover:border-none">+
                Ajouter</button>
        </div>

        <div class="w-full flex flex-col space-y-4">
            @if (count($skills) > 0)
                @php
                    $i = 0;
                @endphp

                @foreach ($skills as $skill)
                    <div
                        class="w-full flex flex-col border-b-[2px] border-gray-200 space-y-2 relative  justify-between pb-4">
                        <div class="w-full flex space-x-4  justify-between relative">
                            <div class="flex-1 w-full flex-col flex md:flex-row justify-between md:space-x-6">
                                <div class="flex flex-1 flex-col">
                                    <span class="font-semibold text-black">{{ $skill['name'] }}</span>

                                </div>
                                <div class="flex flex-col space-y-1 h-full  text-gray-500">

                                    <span>{{ $skill['level'] }}</span>
                                </div>
                            </div>
                            <div x-data="{ open: false }" class="flex flex-col space-y-1 h-full  text-gray-800">
                                <button @click="open = true"
                                    class="hover:bg-gray-100 bg-white rounded-md text-[16px] "><i
                                        class="bi-three-dots-vertical"></i></button>
                                <div x-cloak x-show="open" @click.away="open = false"
                                    class="w-32 bg-white shadow-2xl rounded-md absolute top-[18px] right-4 md:right-0 z-20">
                                    <ul class="flex flex-col space-y-2 py-2">
                                        <li class="hover:bg-gray-100  px-4 py-1">
                                            <button wire:click="startEdit({{ $i }})"> <i
                                                    class="bi-pencil"></i> Modifer</button>
                                        </li>
                                        <li wire:click="getConfirmationToDelete({{ $i }})"
                                            class="hover:bg-gray-100 px-4 py-1">
                                            <button><i class="bi-trash"></i> Supprimer</button>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if ($editId == $i + 1)
                        @livewire('applicant-dashboard.profile.skills.edit', ['skill_id' => $i, 'skills' => $skills, 'profile' => $profile], key('skill-edit-' . $skill['name']))
                    @endif

                    @php
                        $i++;
                    @endphp
                @endforeach
            @else
                <div>Aucune compétence </div>
            @endif
        </div>
    </div>
    <!-- End: Compétences -->

    @if ($isAddFormOpen)
        @livewire('applicant-dashboard.profile.skills.add', ['profile' => $profile], key('skill-add-' . $profile->id))
    @endif
</div>


