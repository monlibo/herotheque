<div class="w-full">
    <div
        class="w-full bg-white dark:bg-gray-800 dark:text-gray-200   rounded-md flex flex-col space-y-4 md:flex-row md:space-x-4 p-4 px-6 pt-8">
        <div class="max-w-[100px] max-h-[100px]  rounded-full overflow-hidden flex bg-blue-100">
            @if ($user->profile_photo_path)
                <img src="{{ Storage::url($user->profile_photo_path) }}">
            @endif

        </div>
        <div class="flex flex-1 flex-col space-y-3">
            <div class="w-full flex justify-between">
                <div class="flex flex-col">
                    <span class="font-semibold">{{ $user->lastname }} {{ $user->firstname }}
                    </span>
                    <span class="text-[14px]"> <i class="bi-geo-alt"></i>
                        @if ($user->city_address)
                            {{ $user->city_address }} , {{ $user->department_address }}
                        @else
                            <span>Indéfini</span>
                        @endif

                    </span>
                </div>
                <div class="flex flex-col">
                    <button wire:click="toogleEditView" wire:loading.attr="disabled" wire:target="toogleEditView"
                        class="py-1 px-4 text-[14px] bg-blue-500 text-white rounded-full flex items-center">
                        <div wire:loading wire:target="toogleEditView"
                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                            type="button"></div>
                        Editer
                    </button>
                </div>
            </div>
            <div class="w-full flex flex-col space-y-3 justify-between text-[14px]">

                <div class="flex flex-col space-y-1   text-gray-500 dark:text-gray-400">
                    <div class="flex flex-col lg:flex-row lg:space-x-4">
                        <span><i class="bi-briefcase"></i> {{ $profile->short_bio }}</span>
                        <span><i class="bi-clock-history"></i> Niveau {{ $profile->experience_years }}</span>
                    </div>
                    <div class="flex flex-col lg:flex-row lg:space-x-4">
                        <span><i class="bi-envelope-open"></i> {{ $user->email }}</span>
                        <span><i class="bi-phone"></i> +229 {{ $user->phone_number }}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Start: EditForm -->
    @if ($isEditFormOpen)
        <div
            class="bg-[#07141fd4] flex  md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4 flex justify-between items-center">
                    <span>Modifier les informations personnelles</span>
                    <span wire:click="toogleEditView"
                        class="text-[12px] text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
                        <div wire:loading wire:target="toogleEditView"
                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                            type="button"></div>
                        Fermer
                    </span>
                </div>
                <form wire:submit.prevent="update" method="post" class="flex flex-col w-full space-y-4 items-center">
                    @csrf
                    <div class="col-span-6 !mb-6 sm:col-span-4 flex w-full md:w-[90%] justify-start items-end">
                        <div
                            class="max-w-[100px] max-h-[100px]  rounded-full overflow-hidden flex bg-blue-100">
                            @if (!$temporaryPhoto)
                                <img src="{{ $photo }}" class="w-full">
                            @else
                                <img src="{{ $temporaryPhoto }}">
                            @endif
                        </div>

                        <div class="flex flex-1 flex-col space-y-3 md:flex-row md:space-y-0">
                            <label for="newLogo"
                                class="text-[14px] dark:bg-blue-600 dark:text-gray-200   text-gray-600 mx-4 py-1 px-3  rounded-md flex  items-center border-[1px] border-gray-600">
                                Choisir
                            </label>
                            <button role="none" type="button" for="" wire:click="deletePhoto"
                                class="text-[14px] dark:bg-blue-600 dark:text-gray-200  text-gray-600 mx-4 py-1 px-3   rounded-md flex  items-center border-[1px] border-gray-600">
                                Supprimer
                            </button>
                        </div>



                        <input wire:model.defer="newPhoto" class="!hidden" id="newLogo" name="newLogo"
                            type="file">
                        @error('newPhoto')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div
                        class="flex flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%]">
                        <div class="input-container ">
                            <label class="label" for="firstname">
                                Prénom(s)
                            </label>
                            <input wire:model.debounce.500ms="user.firstname" id="firstname" name="firstname"
                                class="input" type="text">
                            @error('user.firstname')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-container ">
                            <label class="label" for="lastname">
                                Nom
                            </label>
                            <input wire:model.debounce.500ms="user.lastname" id="lastname" name="lastname"
                                class="input" type="text">
                            @error('user.lastname')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Date de naissance
                        </label>
                        <input wire:model.debounce.500ms="user.birthdate" id="birthdate" name="birthdate"
                            class="input" type="date">
                        @error('user.birthdate')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div
                        class="flex flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%] !mb-6">
                        <div class="input-container ">
                            <label class="label" for="birthdate">
                                Ville
                            </label>
                            <select wire:model.debounce.500ms="city_address" class="input" name="" id="city1">
                                <option value="">Sélectionnez une ville</option>
                                @foreach ($cities as $city)
                                    <option
                                        value="{{ $city->name }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                            @error('city_address')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-container ">
                            <label class="label" for="birthdate">
                                Département
                            </label>
                            <select wire:model.debounce.500ms="department_address" class="input" name=""
                                id="department1">
                                <option value="">Sélectionnez un département</option>
                                @foreach ($departments as $department)
                                    <option
                                        value="{{ $department->name }}">{{ $department->name }}</option>
                                @endforeach

                            </select>
                            @error('department_address')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <div
                        class="flex  flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%] !mb-6">
                        <div class="input-container ">
                            <label class="label" for="birthdate">
                                Email
                            </label>
                            <input wire:model.debounce.500ms="user.email" id="birthdate" name="birthdate"
                                class="input" type="email">
                            @error('user.email')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                        <div class="input-container ">
                            <label class="label" for="birthdate">
                                Téléphone
                            </label>
                            <input wire:model.debounce.500ms="user.phone_number" id="birthdate" name="birthdate"
                                class="input" type="tel">
                            @error('user.phone_number')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="input-container ">
                        <label class="label" for="birthdate">
                            Niveau d'expérience
                        </label>
                        <select wire:model.debounce.500ms="profile.experience_years" class="input">
                            <option value="">Sélectionnez un niveau d'expérience</option>
                            <option value="débutant">Débutant (1-5 ans)</option>
                            <option value="intermédiaire">Intermédiaire (5-10 ans)</option>
                            <option value="expérimenté">Expérimenté (>10 ans)</option>
                        </select>
                        @error('profile.experience_years')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container  ">
                        <label class="label" for="short_bio">
                            Métier
                        </label>
                        <textarea wire:model.debounce.500ms="profile.short_bio" name="short_bio" class="input" id="short_bio" cols="30"
                            rows="1"></textarea>
                        @error('profile.short_bio')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <div
                        class="flex  flex-col  space-y-3 lg:space-y-0 lg:flex-row  lg:space-x-4 w-full items-start md:w-[90%] !mb-6">
                        <div class="input-container  ">
                            <label class="label" for="short_bio">
                                Niveau d'étude
                            </label>
                            <select wire:model.debounce.500ms="profile.education_level" class="input"
                                name="level_of_education_required" id="level_of_education_required">
                                <option value="">Sélectionnez un niveau d'étude</option>
                                @foreach ($levels as $level)
                                    @php
                                        $i = 0;
                                    @endphp

                                    <option @if ($i == 0) selected @endif
                                        value="{{ $level['libelle'] }}">{{ $level['libelle'] }}</option>
                                    @php
                                        $i++;
                                    @endphp
                                @endforeach

                            </select>
                            @error('profile.education_level')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-container  ">
                            <label class="label" for="driver_licence">
                                Permis de conduire
                            </label>
                            <select wire:model.debounce.500ms="profile.driver_licence" class="input"
                                name="driver_licence" id="driver_licence">
                                <option selected value="">Aucun</option>
                                <option value="A">Type A</option>
                                <option value="B">Type B</option>
                                <option value="C">Type C</option>
                                <option value="D">Type D</option>
                            </select>
                            @error('profile.driver_licence')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>


                    <!-- Les boutons pour la submission du formulaire -->
                    <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                        <div class="h-16 flex w-full  justify-between">

                            <button role="none" type="button"
                                class="border-blue-600 border-[1px] rounded-md text-blue-600 py-2 mx-4 px-3  h-[40px] flex items-center "
                                wire:click="toggleShow">
                                <div wire:loading wire:target=""
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
                                </div>
                                <span>Annuler</span>
                            </button>


                            <button role="button" type="submit" wire:loading.attr="disabled" wire:target="newPhoto"
                                class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-2 px-3  h-[40px] flex  items-center"
                                wire:click="update">
                                <div wire:loading wire:target="update"
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                                    type="button"></div>
                                Mettre à jour
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @endif
    <!-- End: EditForm -->
</div>

@push('scripts')
    <script>
        $(function() {
            $('#department1').select2({
                placeholder: 'Sélectionner un département'
            });
            $('#city1').select2({
                placeholder: 'Sélectionner une ville'
            });

            $('body').on('select2:select', '#department1', function() {
                let data = $(this).val();
                @this.set('department_address', data);
            });


            $('body').on('select2:select', '#city1', function() {

                let data = $(this).val();

                @this.set('city_address', data);
            });

            Livewire.on('selectUpdated', () => {
                $('#department1').select2();
                $('#city1').select2();
            });
        });
    </script>
@endpush
