<div>
    <div id="some-id" class="flex flex-col items-center">
        @if (!$viewEdit)
            @if (!empty($session_message))
                <div class="flex items-center space-x-4 mb-4  px-4 h-10 bg-red-300 w-full text-[14px]">
                    <span class="text-red-500"> <i class="bi-info-square "></i> </span>
                    <span>{{ $session_message }}</span>
                </div>
            @endif
            <div
                class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-sm rounded-md text-gray-500  py-4 px-4 w-full min-h-[200px] flex flex-col lg:flex-row space-y-4 mb-8 ">
                <div class="h-full flex flex-col lg:items-center space-y-4">
                    <div
                        class="w-[120px] h-[120px] lg:h-[150px] lg:min-w-[150px] rounded-full overflow-hidden bg-yellow-300">
                        @if ($logo)
                            <img src="{{ $logo }}" class="h-full w-auto">
                        @endif
                    </div>
                    <div>
                        <button wire:click="toggleView"
                            class="bg-blue-600 text-[14px] rounded-md shadow-lg text-white mx-4 py-1 px-4 flex  items-center">
                            <div wire:loading wire:target="toggleView"
                                class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
                            </div>
                            Editer
                        </button>
                    </div>
                </div>

                <div class="w-full min-h-[150px] px-2 md:px-4 flex flex-col space-y-2 text-[14px]">
                    <div class="w-full text-[18px] text-black dark:bg-gray-800 dark:text-gray-200 font-semibold">

                        @if (!empty($name))
                            {{ $name }}
                        @else
                            Non défini
                        @endif
                    </div>

                    <div class="w-full">
                        <span> <i class="bi-geo-alt"></i> </span>
                        <span>
                            @if (!empty($city_address) || !empty($department_address))
                                {{ $city_address }} , {{ $department_address }}
                            @else
                                Non défini
                            @endif
                        </span>
                    </div>
                    <div class="w-full">
                        <span> <i class="bi-phone"></i> </span>
                        <span>
                            @if (!empty($phone))
                                {{ $phone }}
                            @else
                                Non défini
                            @endif
                        </span>
                    </div>
                    <div class="w-full">
                        <span> <i class="bi-envelope"></i> </span>
                        <span>
                            @if (!empty($email))
                                <a href="mailto:{{ $email }}">{{ $email }}</a>
                            @else
                                Non défini
                            @endif
                        </span>
                    </div>
                    <div>
                        <span><i class="bi-globe2"></i></span>
                        <span>
                            @if (!empty($url))
                                <a href="http://{{ $url }}">{{ $url }}</a>
                            @else
                                Non défini
                            @endif
                        </span>
                    </div>
                    <div>
                        <span> <i class="bi-key"></i> </span>
                        <span>
                            @if (!empty($ifu))
                                {{ $ifu }}
                            @else
                                Non défini
                            @endif
                        </span>
                    </div>
                    <div class="w-[70%]">
                        <p>
                            @if (!empty($description))
                                {{ $description }}
                            @endif
                        </p>
                    </div>
                    <div class="w-full">
                        @if (!empty($field))
                            @foreach ($field as $field)
                                {{ $field }} |
                            @endforeach
                        @else
                            Aucun domaine
                        @endif
                    </div>
                </div>
            </div>
        @else
            <div
                class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
                <div class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                    <div id="update-company-info-form-container"
                        class="relative text-gray-500 py-4 w-full flex flex-col   space-y-4 mb-8 ">
                        <div class="form-container !px-0 !bg-transparent">
                            <form wire:submit.prevent='updateCompanyInformation' action="" enctype="multipart/form-data"
                                class="form !space-y-3">

                                <div class="flex flex-col space-y-3 w-full">
                                    <div class="flex flex-col w-full space-y-4 items-center rounded-md py-4">

                                        <div
                                            class="col-span-6 sm:col-span-4 flex w-full md:w-[90%] justify-start items-end">


                                            <div
                                                class="w-[100px] h-[100px] lg:h-[100px] lg:min-w-[100px] rounded-full bg-blue-200 overflow-hidden flex">
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

                                            <input wire:model.debounce.500ms="newLogo" class="!hidden" id="newLogo"
                                                name="newLogo" type="file">
                                            @error('newLogo')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <!-- Type de contrat -->
                                        <div class="input-container ">
                                            <label class="label" for="name">
                                                Nom de l'entreprise <span class="text-red-500">*</span>
                                            </label>
                                            <input wire:model.debounce.500ms="name" class="input" id="name" name="name"
                                                type="text">
                                            @error('name')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-container ">
                                            <label class="label" for="description">
                                                Description de l'entreprise
                                            </label>
                                            <textarea wire:model.debounce.500ms="description" name="description" class="input" id="description" cols="30"
                                                rows="5"></textarea>
                                            @error('description')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-container ">
                                            <label class="label" for="user_position_held">
                                                Poste occupé <span class="text-red-500">*</span>
                                            </label>

                                            <input wire:model.debounce.500ms="user_position_held" class="input"
                                                id="user_position_held" name="user_position_held" type="text">

                                            @error('user_position_held')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex flex-col w-full space-y-4 items-center  rounded-md py-4">


                                        <div class="input-container ">
                                            <label class="label" for="department_address">
                                                Département<span class="text-red-500">*</span>
                                            </label>
                                            <div>
                                                <select name="department_address" class="input"
                                                    wire:model.debounce.500ms="department_address" id="department_address">
                                                    <option value="">Sélectionnez un département</option>
                                                    @foreach ($departments as $department)
                                                        <option value="{{ $department->name }}">
                                                            {{ $department->name }}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('department_address')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror

                                        </div>

                                        <div class="input-container ">
                                            <label class="label" for="city_address">
                                                Ville <span class="text-red-500">*</span>
                                            </label>
                                            <div>
                                                <select name="city_address" class="input" id="city_address"
                                                    wire:model.debounce.500ms="city_address">
                                                    <option value="">Sélectionnez une ville</option>
                                                    @foreach ($cities as $city)
                                                        <option value="{{ $city->name }}">
                                                            {{ $city->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            @error('city_address')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex flex-col w-full space-y-4 items-center  rounded-md py-4">


                                        <div class="input-container ">
                                            <label class="label" for="phone">
                                                Téléphone <span class="text-red-500">*</span>
                                            </label>
                                            <input wire:model.debounce.500ms="phone" name="phone" id="phone" class="input"
                                                type="tel">
                                            @error('phone')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-container ">
                                            <label class="label" for="email">
                                                Email <span class="text-red-500">*</span>
                                            </label>
                                            <input wire:model.debounce.500ms="email" name="email" class="input" id="email"
                                                type="email">
                                            @error('email')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex flex-col w-full space-y-4 items-center rounded-md py-4">
                                        <div class="input-container ">
                                            <label class="label" for="url">
                                                Site web
                                            </label>
                                            <input wire:model.debounce.500ms="url" id="url" name="url" class="input"
                                                type="url">
                                            @error('url')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>

                                        <div class="input-container ">
                                            <label class="label" for="facebook">
                                                Facebook
                                            </label>
                                            <input wire:model.debounce.500ms="facebook" id="facebook" name="facebook"
                                                class="input" type="url">
                                            @error('facebook')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>


                                        <div class="input-container ">
                                            <label class="label" for="ifu">
                                                Ifu <span class="text-red-500">*</span>
                                            </label>
                                            <input wire:model.debounce.500ms="ifu" id="ifu" name="ifu" class="input" min="0"
                                                type="number">
                                            @error('ifu')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="flex flex-col w-full space-y-4 items-center rounded-md py-4">

                                        <!-- Compétences -->
                                        <div id="skiller-container" class="col-span-6 sm:col-span-4 w-full lg:w-[90%]">
                                            <label class="label" for="url">
                                                Domaines / Branches d'activité
                                            </label>
                                            <div wire:ignore>
                                                <select id="field" multiple wire:model.debounce.500ms="field"
                                                    class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50  shadow-sm mt-1 block w-full text-[14px]">
                                                    @foreach ($field as $field)
                                                        <option value="{{ $field }}">{{ $field }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                            @error('field')
                                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                                            @enderror

                                        </div>
                                    </div>
                                </div>


                                <div class="w-full text-[14px] flex justify-end px-4">
                                    <div class="flex w-full justify-between">

                                        <button wire:click="toggleView"
                                            class="text-blue-600 border-blue-600 border-2 rounded-md py-1 mx-4 px-3 flex items-center"
                                            role="none" type="button">
                                            <div wire:loading wire:target="toggleView"
                                                class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-600  rounded-full">
                                            </div>
                                            <span>Annuler</span>
                                        </button>


                                        <button type="submit" wire:loading.attr="disabled"
                                            class="bg-blue-600 rounded-md shadow-lg disabled:bg-gray-600 text-white mx-4 py-1 px-3 flex  items-center">
                                            <div wire:loading wire:target="updateCompanyInformation"
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
            </div>
        @endif
    </div>
</div>


@push('scripts')
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



            $('#field').select2({
                tags: true
            });
            $('body').on('select2:select', '#field', function(e) {
                let data = $(this).val();
                @this.set('field', data);
            });

            $('body').on('select2:unselect', '#field', function(e) {
                let data = $(this).val();
                @this.set('field', data);
            });


            Livewire.on('selectUpdated', () => {
                $('#department_address').select2();
                $('#city_address').select2();
                $('#field').select2({
                    tags: true
                });
            });



        });
    </script>
@endpush
