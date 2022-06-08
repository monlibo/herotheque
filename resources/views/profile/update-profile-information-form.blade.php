<x-jet-form-section submit="updateProfileInformation">
    <x-slot name="title">
        {{ __('Informations personnelles') }}
    </x-slot>

    <x-slot name="description">
        {{ __('Mettez à jour vos informations personnelles et votre adresse email.') }}
    </x-slot>

    <x-slot name="form">
        <!-- Profile Photo -->
        @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
            <div x-data="{ photoName: null, photoPreview: null }" class="col-span-6 sm:col-span-4">
                <!-- Profile Photo File Input -->
                <input type="file" class="hidden" wire:model="photo" x-ref="photo" x-on:change="
                                    photoName = $refs.photo.files[0].name;
                                    const reader = new FileReader();
                                    reader.onload = (e) => {
                                        photoPreview = e.target.result;
                                    };
                                    reader.readAsDataURL($refs.photo.files[0]);
                            " />

                <x-jet-label for="photo" value="{{ __('Photo') }}" />

                <!-- Current Profile Photo -->
                <div class="mt-2" x-show="! photoPreview">
                    <img src="{{ $this->user->profile_photo_url }}" alt="{{ $this->user->name }}"
                        class="rounded-full h-20 w-20 object-cover">
                </div>

                <!-- New Profile Photo Preview -->
                <div class="mt-2" x-show="photoPreview" style="display: none;">
                    <span class="block rounded-full w-20 h-20 bg-cover bg-no-repeat bg-center"
                        x-bind:style="'background-image: url(\'' + photoPreview + '\');'">
                    </span>
                </div>

                <x-jet-secondary-button class="mt-2 mr-2" type="button" x-on:click.prevent="$refs.photo.click()">
                    {{ __('Select A New Photo') }}
                </x-jet-secondary-button>

                @if ($this->user->profile_photo_path)
                    <x-jet-secondary-button type="button" class="mt-2" wire:click="deleteProfilePhoto">
                        {{ __('Remove Photo') }}
                    </x-jet-secondary-button>
                @endif

                <x-jet-input-error for="photo" class="mt-2" />
            </div>
        @endif

        <!-- Prénom -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="firstname" value="{{ __('Prénom') }}" />
            <x-jet-input id="firstname" type="text" class="mt-1 block w-full" wire:model.defer="state.firstname"
                autocomplete="firstname" />
            <x-jet-input-error for="firstname" class="mt-2" />
        </div>

        <!-- Nom -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="lastname" value="{{ __('Nom') }}" />
            <x-jet-input id="lastname" type="text" class="mt-1 block w-full" wire:model.defer="state.lastname"
                autocomplete="lastname" />
            <x-jet-input-error for="lastname" class="mt-2" />
        </div>

        <!-- Surnom -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="nickname" value="{{ __('Pseudo') }}" />
            <x-jet-input id="nickname" type="text" class="mt-1 block w-full" wire:model.defer="state.nickname"
                autocomplete="nickname" />
            <x-jet-input-error for="firstname" class="mt-2" />
        </div>

        <!-- Date de naissance -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="birthdate" value="{{ __('Date de naissance') }}" />
            <x-jet-input id="birthdate" type="date" class="mt-1 block w-full" wire:model.defer="state.birthdate"
                autocomplete="birthdate" />
            <x-jet-input-error for="birthdate" class="mt-2" />
        </div>

        <div class="col-span-6 sm:col-span-4 flex flex-col">
            <x-jet-label value="{{ __('Sexe') }}" />
            <div class="flex flex-wrap space-x-4">
                <!-- Sexe:M -->
                <div class="col-span-6 sm:col-span-4 space-x-4 items-center">
                    <input type="radio" value="M" name="sex" id="M" wire:model.defer="state.sex">
                    <label for="M">Masculin</label>
                </div>

                <!-- Sexe:F -->
                <div class="col-span-6 sm:col-span-4 flex space-x-4 items-center">
                    <input type="radio" value="F" name="sex" id="F" wire:model.defer="state.sex">
                    <label for="F">Féminin</label>
                </div>

                <!-- Sexe:O -->
                <div class="col-span-6 sm:col-span-4 space-x-4 items-center">
                    <input type="radio" value="O" name="sex" id="O" wire:model.defer="state.sex">
                    <label for="O">Autre</label>
                </div>
            </div>

        </div>


        <!-- Email -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="email" value="{{ __('Email') }}" />
            <x-jet-input id="email" type="email" class="mt-1 block w-full" wire:model.defer="state.email" />
            <x-jet-input-error for="email" class="mt-2" />
        </div>

        <!-- Numéro de téléphone -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="phone_number" value="{{ __('Numéro de téléphone') }}" />
            <x-jet-input id="phone_number" type="tel" class="mt-1 block w-full" wire:model.defer="state.phone_number" />
            <x-jet-input-error for="phone_number" class="mt-2" />
        </div>


        <!-- Adresse de quartier -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="neighborhood_address" value="{{ __('Quartier') }}" />
            <x-jet-input id="neighborhood_address" type="text" class="mt-1 block w-full"
                wire:model.defer="state.neighborhood_address" />
            <x-jet-input-error for="neighborhood_address" class="mt-2" />
        </div>

        <!-- Adresse de ville -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="city_address" value="{{ __('Ville') }}" />
            <x-jet-input id="city_address" type="text" class="mt-1 block w-full"
                wire:model.defer="state.city_address" />
            <x-jet-input-error for="city_address" class="mt-2" />
        </div>

        <!-- Addresse de Département -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="department_address" value="{{ __('Département') }}" />
            <x-jet-input id="department_address" type="text" class="mt-1 block w-full"
                wire:model.defer="state.department_address" />
            <x-jet-input-error for="department_address" class="mt-2" />
        </div>

        <!-- Addresse de Pays -->
        <div class="col-span-6 sm:col-span-4">
            <x-jet-label for="country_address" value="{{ __('Pays') }}" />
            <x-jet-input id="country_address" type="text" class="mt-1 block w-full"
                wire:model.defer="state.country_address" />
            <x-jet-input-error for="country_address" class="mt-2" />
        </div>
    </x-slot>

    <x-slot name="actions">
        <x-jet-action-message class="mr-3" on="saved">
            {{ __('Mise à jour.') }}
        </x-jet-action-message>

        <x-jet-button wire:loading.attr="disabled" wire:target="photo">
            {{ __('Mettre à jour') }}
        </x-jet-button>
    </x-slot>
</x-jet-form-section>
