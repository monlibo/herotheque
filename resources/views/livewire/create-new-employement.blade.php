<div>
    <main class="">
        <div id="form-step-container" class="  ">
            <div
                class="my-0 text-[14px] px-8 flex flex-col space-y-3  font-semibold bg-white dark:bg-gray-800 dark:text-gray-200 rounded-t-md border-b-2 border-gray-700 py-8 w-full  text-gray-700 ">
                <p class="text-[16px]">AJOUTER UNE OFFRE D'EMPLOI</p>

                <p>Etape {{ $currentStep }} sur
                    {{ $maxStep }}
                </p>

            </div>

            @if ($currentStep === 1 || $currentStep === 8)
                <!-- Intitulé, description, domaine -->
                <div class="form-collection-container" id="fcc-1">
                    <div class="form-container">
                        <form action="" class="form">
                            <!-- Title de l'offre -->
                            <div class="input-container">
                                <label class="label" for="title">
                                    Recrutement d'un <span class="text-red-500">*</span>
                                </label>
                                <div class="w-full">
                                    <input wire:model="title" id="title" class="input" type="text"
                                        autocomplete="false" />
                                </div>
                                @error('title')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Description -->
                            <div class="input-container">
                                <label class="label mb-2">
                                    Description de l'offre et des tâches à accomplir <span
                                        class="text-red-500">*</span>
                                </label>
                                <div x-data="{ description: @entangle('description'), descriptionLength: @entangle('descriptionLength') }" x-init="let toolbar = [
                                    ['bold'],
                                    [{
                                        'indent': '-1'
                                    }, {
                                        'indent': '+1'
                                    }]
                                ];
                                editor = new Quill('#description', {
                                    modules: {
                                        toolbar: toolbar
                                    },
                                    theme: 'snow'
                                });

                                editor.on('text-change', function() {
                                    description = editor.root.innerHTML;
                                    descriptionLength = editor.getLength();
                                });

                                if ($('.ql-toolbar').length == 2) {
                                    $('.ql-toolbar:first').remove();
                                }" wire:ignore>

                                    <div id="description" class=" w-full text-gray-700 dark:text-gray-400">
                                        {!! $description !!}
                                    </div>

                                </div>
                                @error('description')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Domaine -->
                            <div class="input-container">
                                <label class="label" for="field">
                                    Domaine auquel appartient l'offre <span class="text-red-500">*</span>
                                </label>
                                <div>
                                    <select multiple class="input editable" id="field" wire:model="field">
                                        <option selected value="">Sélectionner un domaine</option>

                                        @foreach ($fields as $fiel)
                                            @if (!in_array($fiel, $field))
                                                <option value="{{ $fiel }}">{{ $fiel }}</option>
                                            @endif
                                        @endforeach

                                        @foreach ($field as $field)
                                            <option selected value="{{ $field }}">{{ $field }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                @error('field')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror

                            </div>

                            <!-- Poste proposé -->
                            <div class="input-container">
                                <label class="label" for="offered_position">
                                    Poste proposé <span class="text-red-500">*</span>
                                </label>

                                <div>
                                    <select class="input editable" id="offered_position" wire:model="offered_position">


                                        @foreach ($positions as $positio)
                                            @if ($offered_position !== $positio)
                                                )
                                                <option value="{{ $positio }}">{{ $fiel }}
                                                </option>
                                            @endif
                                        @endforeach

                                        @if (!empty($offered_position))
                                            <option selected value="{{ $offered_position }}">
                                                {{ $offered_position }}</option>
                                        @endif

                                    </select>
                                </div>
                                @error('offered_position')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror

                            </div>
                        </form>
                    </div>
                </div>
            @endif

            @if ($currentStep === 2 || $currentStep === 8)
                <!-- Lieu -->
                <div class="form-collection-container" id="fcc-2">

                    <div class="form-container">
                        <form action="" class="form">

                            <!-- Département  -->
                            <div class="input-container">
                                <label class="label" for="department_address">
                                    Département
                                </label>
                                <div>
                                    <select class="input" id="department_address"
                                        wire:model.debounce.500ms="department_address">
                                        <option selected value="">Selectionner un département</option>
                                        @foreach ($states as $state)
                                            <option value="{{ $state->name }}">{{ $state->name }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                @error('department_address')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Ville -->
                            <div class="input-container">
                                <label class="label" for="city_address">
                                    Ville <span class="text-red-500">*</span>
                                </label>
                                <div>
                                    <select wire:model.debounce.500ms="city_address" selected class="input"
                                        id="city_address">
                                        <option value="">Selectionner une ville</option>
                                        @foreach ($cities as $city)
                                            <option value="{{ $city->name }}">{{ $city->name }}</option>
                                        @endforeach

                                        @if (!empty($city_address))
                                            <option selected value="{{ $city_address }}">
                                                {{ $city_address }}</option>
                                        @endif
                                    </select>
                                </div>
                                @error('city_address')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </form>
                    </div>
                </div>
            @endif

            @if ($currentStep === 3 || $currentStep === 8)
                <!-- Salaire -->
                <div class="form-collection-container" id="fcc-3">

                    <div class="form-container">
                        <form action="" class="form">

                            <!-- Type de contrat -->
                            <div class="input-container">
                                <label class="label" for="type_of_contract">
                                    Type de contrat <span class="text-red-500">*</span>
                                </label>
                                <div>
                                    <select wire:model="type_of_contract" id="type_of_contract" class="input w-[15px]">
                                        <option value="">Selectionner un type de contrat</option>
                                        @foreach ($contracts as $contrat)
                                            <option @if ($contrat['code'] == $type_of_contract) selected @endif
                                                value="{{ $contrat['code'] }}">{{ $contrat['libelle'] }}</option>
                                        @endforeach
                                    </select>
                                </div>


                                @error('type_of_contract')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            {{-- <!-- Salaire Fixe ou non -->
                                <div class="input-container">
                                    <input x-model="salary_fixed" id="salary_fixed" class="!w-[15px] !h-[15px] rounded-md"
                                        name="" wire:model="fixed_salary" type="checkbox">
                                    <label class="label !inline-block" for="salary_fixed">
                                        Salaire Fixe
                                    </label>
                                </div> --}}

                            {{-- <!-- Le salaire fixe -->
                                <div class="input-container" x-show="salary_fixed">
                                    <label class="label" for="salary">
                                        Salaire <span class="text-red-500">*</span>
                                    </label>
                                    <input wire:model="salary" class="input" id="salary" name="" type="number"
                                        min="1" autocomplete="">

                                    @error('salary')
                                        <p class="text-[12px] text-red-500">{{ $message }}</p>
                                    @enderror
                                </div> --}}

                            <!-- Le salaire minimum -->
                            <div id="salary_start_div" class="input-container">
                                <label class="label" for="min_salary">
                                    Salaire minimal <span class="text-red-500">*</span>
                                </label>
                                <input wire:model="min_salary" class="input" id="min_salary" type="number"
                                    min="1" autocomplete="">

                                @error('min_salary')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Le salaire maximum -->
                            <div id="salary_end_div" class="input-container">
                                <label class="label" for="max_salary">
                                    Salaire maximal <span class="text-red-500">*</span>
                                </label>
                                <input wire:model="max_salary" class="input" id="max_salary" type="number"
                                    min="1">

                                @error('max_salary')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Fréquence de paiement -->
                            <div class="input-container">
                                <label class="label" for="payment_frequency">
                                    Fréquence de paiement <span class="text-red-500">*</span>
                                </label>
                                <div>
                                    <select wire:model="payment_frequency" class="input" id="payment_frequency"
                                        placeholder="Choisissez la fréquence de paiement" autocomplete="description">
                                        <option value="">Selectionner une fréquence de payement</option>
                                        @foreach ($frequencies as $frequency)
                                            <option @if ($frequency['code'] == $payment_frequency) selected @endif
                                                value="{{ $frequency['code'] }}">{{ $frequency['libelle'] }}
                                            </option>
                                        @endforeach
                                        <option selected value="{{ $payment_frequency }}">{{ $payment_frequency }}
                                        </option>
                                    </select>
                                </div>


                                @error('payment_frequency')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Nombre d'heures de travail par semaine -->
                            <div id="salary_end_div" class="input-container">
                                <label class="label" for="working_hours_per_week">
                                    Nombre d'heures de travail par semaine
                                </label>
                                <input wire:model="working_hours_per_week" class="input"
                                    id="working_hours_per_week" type="number" min="1">

                                @error('working_hours_per_week')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                        </form>
                    </div>
                </div>
            @endif

            @if ($currentStep === 4 || $currentStep === 8)
                <!-- Age et Situation matrimoniale -->
                <div class="form-collection-container" id="fcc-4">

                    <div class="form-container">
                        <div class="form">

                            <!-- Compétences -->

                            <!-- Niveau d'étude exigé -->
                            <div class="input-container">
                                <label class="label" for="level_of_education_required">
                                    Niveau d'étude <span class="text-red-500">*</span>
                                </label>
                                <div>
                                    <select multiple wire:model="level_of_education_required" class="input"
                                        name="level_of_education_required" id="level_of_education_required">
                                        <option value="default" selected>Facultatif</option>

                                        @foreach ($levels as $level)
                                            @if (!in_array($level['libelle'], $level_of_education_required))
                                                <option value="{{ $level['libelle'] }}">{{ $level['libelle'] }}
                                                </option>
                                            @endif
                                        @endforeach
                                        @foreach ($level_of_education_required as $level_of_education_required)
                                            <option selected value="{{ $level_of_education_required }}">
                                                {{ $level_of_education_required }}</option>
                                        @endforeach
                                    </select>
                                </div>

                                @error('level_of_education_required')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Formation exigée -->
                            <div class="input-container">
                                <label class="label" for="required_training">
                                    Formation requise <span class="text-red-500">*</span>
                                </label>
                                <div>
                                    <select wire:model="required_training" multiple name="required_training"
                                        class="input" id="required_training">
                                        @foreach ($trainings as $training)
                                            @if (!in_array($training, $required_training))
                                                <option value="{{ $training }}">{{ $training }}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($required_training as $required_training)
                                            <option selected value="{{ $required_training }}">
                                                {{ $required_training }}</option>
                                        @endforeach


                                    </select>
                                </div>
                                @error('required_training')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Expérience -->
                            <div class="input-container">
                                <label class="label" for="experience">
                                    Expérience <span class="text-red-500">*</span>
                                </label>

                                <select wire:model="experience" name="experience" class="input">
                                    <option value="">Sélectionnez un niveau d'expérience</option>
                                    <option value="débutant"> Débutant (1-5 ans) </option>
                                    <option value="intermédiaire"> Intermédiaire (5-10 ans) </option>
                                    <option value="expérimenté">Expérimenté (au moins 10 ans)</option>
                                </select>
                                @error('experience')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>


                        </div>
                    </div>
                </div>
            @endif

            @if ($currentStep === 5 || $currentStep === 8)
                <!-- Compétences -->
                <div class="form-collection-container" id="fcc-5">

                    <div class="form-container">
                        <div class="form">
                            <div class="input-container">
                                <label class="label" for="skill">
                                    Compétences
                                </label>
                                <div>
                                    <select id="skill" multiple wire:model="skill"
                                        class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50  shadow-sm mt-1 block w-full text-[14px]">

                                        @foreach ($skills as $skil)
                                            @if (!in_array($skil, $skill))
                                                <option value="{{ $skil }}">{{ $skil }}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($skill as $skill)
                                            <option selected value="{{ $skill }}">
                                                {{ $skill }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('skill')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="input-container">
                                <label class="label" for="quality">
                                    Qualités
                                </label>
                                <div>
                                    <select id="quality" multiple wire:model="quality"
                                        class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50  shadow-sm mt-1 block w-full text-[14px]">

                                        @foreach ($qualities as $qualite)
                                            @if (!in_array($qualite, $quality))
                                                <option value="{{ $qualite }}">{{ $qualite }}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($quality as $quality)
                                            <option selected value="{{ $quality }}">{{ $quality }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('quality')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror

                            </div>

                            <div class="input-container">
                                <label class="label" for="skill">
                                    Langues
                                </label>
                                <div>
                                    <select id="language" multiple wire:model="language"
                                        class=" border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50  shadow-sm mt-1 block w-full text-[14px]">
                                        @foreach ($languages as $langue)
                                            @if (!in_array($langue, $language))
                                                <option value="{{ $langue }}">{{ $langue }}</option>
                                            @endif
                                        @endforeach
                                        @foreach ($language as $language)
                                            <option value="{{ $language }}">{{ $language }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('language')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Niveau d'étude exigé -->
                            <div class="input-container">
                                <label class="label" for="driver_licence">
                                    Type de permis de conduire
                                </label>

                                <select wire:model="driver_licence" class="input" name="driver_licence"
                                    id="driver_licence">
                                    <option value="default">Facultatif</option>
                                    <option value="A">Type A</option>
                                    <option value="B">Type B</option>
                                    <option value="C">Type C</option>
                                    <option value="D">Type C</option>
                                </select>
                                @error('driver_licence')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($currentStep === 6 || $currentStep === 8)
                <div class="form-collection-container" id="fcc-7">

                    <div class="form-container">
                        <div class="form">
                            <!-- Niveau d'étude exigé -->
                            <div class="input-container">
                                <label class="label" for="date_of_publication">
                                    Date de publication de l'offre
                                </label>

                                <input type="date" wire:model="date_of_publication" name="date_of_publication"
                                    id="date_of_publication" class="input">

                                @error('date_of_publication')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Date de fin de l'offre -->
                            <div class="input-container">
                                <label class="label" for="date_of_disability">
                                    Date d'invalidité de l'offre
                                </label>

                                <input type="date" wire:model="date_of_disability" name="date_of_disability"
                                    id="date_of_disability" class="input">

                                @error('date_of_disability')
                                    <p class="text-[12px] text-red-500">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if ($currentStep === 7 || $currentStep === 8)
                <div class="form-collection-container" id="fcc-8">

                    <div class="form-container">
                        <div class="form">
                            <!-- Nombre de poste proposé -->
                            <div class="input-container">
                                <label class="label" for="number_position_offered">
                                    Nombre de poste que vous offrez
                                </label>

                                <input type="number" min="1" wire:model="number_position_offered"
                                    name="number_position_offered" id="number_position_offered" class="input">
                                @error('number_position_offered')
                                    <p class="text-red-500 text-[12px]">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Question supplémentaire -->
                            <div class="input-container">
                                <div class="flex space-x-2">
                                    <input id="immediatly_availability" class="!w-[15px] !h-[15px] rounded-md" name=""
                                        wire:model="immediatly_availability" type="checkbox">
                                    <label class="label !inline-block" for="immediatly_availability">
                                        Disponibilité immédiate
                                    </label>
                                </div>
                            </div>

                            <div class="input-container">
                                <div class="flex space-x-2">
                                    <input id="submit_letter" class="!w-[15px] !h-[15px] rounded-md" name=""
                                        wire:model="submit_letter" type="checkbox">
                                    <label class="label !inline-block" for="submit_letter">
                                        Joindre une lettre de motivation
                                    </label>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            @endif


            <!-- Les boutons pour la submission du formulaire -->
            <div class="h-24 w-full text-[14px] flex justify-end">
                <div class="h-16 flex  justify-between">
                    @if ($currentStep > 1)
                        <button class="bg-blue-600 rounded-md text-white py-2 mx-4 px-3  h-[40px] flex items-center "
                            wire:click="prevStep">
                            <div wire:loading wire:target="prevStep"
                                class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full">
                            </div>
                            <span>Précédent</span>
                        </button>
                    @endif

                    <button wire:loading.attr="disabled"
                        class="bg-blue-600 rounded-md shadow-lg text-white mx-4 py-2 px-3  h-[40px] flex  items-center"
                        wire:click="nextStep">
                        <div wire:loading wire:target="nextStep"
                            class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                            type="button"></div>
                        @if ($currentStep < 9)
                            <span>Suivant</span>
                        @elseif($currentStep === 9)
                            <span>Publier</span>
                        @endif
                    </button>
                </div>
            </div>
        </div>
    </main>
</div>

@push('scripts')
    <script>
        $(function() {



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


            $('#offered_position').select2({
                tags: true
            });
            $('body').on('select2:select', '#offered_position', function(e) {
                let data = $(this).val();
                @this.set('offered_position', data);
            });

            $('#city_address').select2();
            $('body').on('select2:select', '#city_address', function(e) {
                let data = $(this).val();
                @this.set('city_address', data);
            });
            $('body').on('select2:unselect', '#city_address', function(e) {
                let data = $(this).val();
                @this.set('city_address', data);
            });

            $('#department_address').select2();
            $('body').on('select2:select', '#department_address', function(e) {
                let data = $(this).val();
                @this.set('department_address', data);
            });
            $('body').on('select2:unselect', '#department_address', function(e) {
                let data = $(this).val();
                @this.set('department_address', data);
            });

            $('#type_of_contract').select2();
            $('body').on('select2:select', '#type_of_contract', function(e) {
                let data = $(this).val();
                @this.set('type_of_contract', data);
            });
            $('body').on('select2:unselect', '#type_of_contract', function(e) {
                let data = $(this).val();
                @this.set('type_of_contract', data);
            });


            $('#payment_frequency').select2({
                tags: true
            });
            $('body').on('select2:select', '#payment_frequency', function(e) {
                let data = $(this).val();
                @this.set('payment_frequency', data);
            });


            $('#required_training').select2({
                tags: true
            });
            $('body').on('select2:select', '#required_training', function(e) {
                let data = $(this).val();
                @this.set('required_training', data);
            });
            $('body').on('select2:unselect', '#required_training', function(e) {
                let data = $(this).val();
                @this.set('required_training', data);
            });

            $('#level_of_education_required').select2({
                tags: true
            });
            $('body').on('select2:select', '#level_of_education_required', function(e) {
                let data = $(this).val();
                @this.set('level_of_education_required', data);
            });
            $('body').on('select2:unselect', '#level_of_education_required', function(e) {
                let data = $(this).val();
                @this.set('level_of_education_required', data);
            });





            $('#skill').select2({
                tags: true
            });

            $('body').on('select2:select', '#skill', function(e) {
                let data = $(this).val();
                @this.set('skill', data);
            });

            $('body').on('select2:unselect', '#skill', function(e) {
                let data = $(this).val();
                @this.set('skill', data);
            });

            $('#language').select2({
                tags: true
            });
            $('body').on('select2:select', '#language', function(e) {
                let data = $(this).val();
                @this.set('language', data);
            });
            $('body').on('select2:unselect', '#language', function(e) {
                let data = $(this).val();
                @this.set('language', data);
            });

            $('#quality').select2({
                tags: true
            });
            $('body').on('select2:select', '#quality', function(e) {
                let data = $(this).val();
                @this.set('quality', data);
            });
            $('body').on('select2:unselect', '#quality', function(e) {
                let data = $(this).val();
                @this.set('quality', data);
            });


            Livewire.on('selectUpdated', () => {
                $('#field').select2({
                    tags: true
                });
                $('#offered_position').select2({
                    tags: true
                });
                $('#city_address').select2();
                $('#department_address').select2();
                $('#type_of_contract').select2();
                $('#payment_frequency').select2({
                    tags: true
                });
                $('#required_training').select2({
                    tags: true
                });
                $('#level_of_education_required').select2({
                    tags: true
                });
                $('#skill').select2({
                    tags: true
                });
                $('#language').select2({
                    tags: true
                });
                $('#quality').select2({
                    tags: true
                });
            });







        });
    </script>
@endpush
