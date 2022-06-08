<div>
    <!-- Start: Contact -->
    <div class="flex flex-col space-y-2 w-full items-center px-4">
        <div class="text-[16px] flex justify-between font-bold text-left w-full text-gray-600">
            <span>CONTACT</span>
            <button wire:click="toggleShow" id="buttonToggleEdit" class="text-black">
                <i class="bi-pencil"></i>
            </button>
        </div>
        <ul class="text-left flex flex-col pl-4 space-y-2 w-full text-gray-500 text-[14px]">
            <li class="flex space-x-3 items-center w-full">
                <span class="text-[16px] text-center"><i class="bi-telephone"></i></span>
                <span>{{ $phone_number }}</span>
            </li>
            <li class="flex w-full">
                <a class="flex space-x-3 items-center" href="https://whatsapp.me/+229{{ $whatsapp }}">
                    <span class="text-[16px] text-center"><i class="bi-whatsapp"></i></span>
                    <span>{{ $whatsapp }}</span>
                </a>
            </li>
            <li class="flex w-full">
                <a class="flex space-x-3 items-center" href="mailto:{{ $email }}">
                    <span class="text-[16px] text-center"><i class="bi-envelope-paper"></i></span>
                    <span>libertliboo@gmail.com</span>
                </a>
            </li>
            <li class="flex w-full space-x-3 items-center">
                <span class="text-[16px] text-center"><i class="bi-geo-alt"></i></span>
                <span>{{ $city_name }} , {{ $department_name }} </span>
            </li>
        </ul>
    </div>
    <!-- End: Contact -->


    @if ($isEditFormOpen)
        <div
            class="bg-[#000000d3] flex  p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div class="bg-white shadow-2xl rounded-md w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4">Modifier les liens sociaux</div>
                <div class="flex flex-col w-full space-y-4 items-center">

                    <div class="input-container ">
                        <label class="label" for="email">
                            Email
                        </label>
                        <input wire:model="email" id="email" name="email" class="input" type="email">
                        @error('email')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="phone_number">
                            Téléphone
                        </label>
                        <input wire:model="phone_number" id="phone_number" name="phone_number" class="input"
                            type="tel">
                        @error('phone_number')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="whatsapp">
                            Whatsapp
                        </label>
                        <input wire:model="whatsapp" id="whatsapp" name="whatsapp" class="input" type="url">
                        @error('whatsapp')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="department_address">
                            Adresse Département
                        </label>

                        <div>
                            <select wire:model="department_address" class="input" name="department_address"
                                id="department_address">

                                @foreach ($departments as $department)
                                    @if ($department['id'] == $department_address)
                                        <option selected value="{{ $department['id'] }}">
                                            {{ $department['name'] }}</option>
                                    @else
                                        <option value="{{ $department['id'] }}">{{ $department['name'] }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>

                        @error('department_address')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="input-container ">
                        <label class="label" for="city_address">
                            Adresse Ville
                        </label>
                        <div>
                            <select wire:model="city_address" class="input" name="city_address"
                                id="city_address">
                                @foreach ($cities as $city)
                                    @if ($city['id'] === $city_address)
                                        <option selected value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                    @endif
                                    <option value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                @endforeach
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

            Livewire.on('selectUpdated', () => {
                $('#department_address').select2();
                $('#city_address').select2();
            });
        });
    </script>
@endpush
