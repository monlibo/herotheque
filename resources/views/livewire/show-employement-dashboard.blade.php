<div>

    <div class="w-full bg-white rounded-md p-4 flex flex-col space-y-3 text-[14px]">
        <div
            class="text-[14px] py-2 border-b-[1px] border-black flex flex-col md:flex-row space-y-2 justify-between items-center w-full ">


            <div class="text-[16px] font-semibold text-left w-full">Offre d'emploi No {{ $employement->id }}</div>

        </div>

        @if ($employement)
            <div class="w-full flex flex-col space-y-3">
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Titre :
                    </div>
                    <div>
                        {{ $employement->offer->title }}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Description :
                    </div>
                    <div>
                        {!! $employement->offer->description !!}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Localisation :
                    </div>
                    <div>
                        {{ $employement->offer->department_address }}, {{ $employement->offer->city_address }}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Poste proposé :
                    </div>
                    <div>
                        {{ $employement->offered_position }}
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Nombre de poste offert :
                    </div>
                    <div>
                        {{ $employement->offer->number_position_offered }}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Type de contrat :
                    </div>
                    <div class="uppercase">
                        {{ $employement->type_of_contract }}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Salaire :
                    </div>
                    <div>
                        {{ $employement->min_salary }} - {{ $employement->max_salary }} FCFA /
                        {{ $employement->payment_frequency }}
                        pour {{ $employement->working_hours_per_week }} heure(s) par semaine
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Domaines :
                    </div>
                    <div>
                        @php
                            $fields = $employement->offer->fields;
                        @endphp
                        @foreach ($fields as $field)
                            {{ $field }} ,
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Compétences :
                    </div>
                    <div>
                        @php
                            $skills = $employement->offer->skills;
                        @endphp
                        @foreach ($skills as $skill)
                            {{ $skill }} ,
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Niveau d'étude :
                    </div>
                    <div>
                        @php
                            $levels = $employement->offer->education_levels;
                        @endphp
                        @foreach ($levels as $level)
                            {{ $level }} ,
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Formations :
                    </div>
                    <div>
                        @php
                            $trainings = $employement->trainings;
                        @endphp
                        @foreach ($trainings as $training)
                            {{ $training }} ,
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Langues :
                    </div>
                    <div>
                        @php
                            $languages = $employement->offer->languages;
                        @endphp
                        @foreach ($languages as $language)
                            {{ $language }} ,
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Qualités :
                    </div>
                    <div>
                        @php
                            $qualities = $employement->offer->qualities;
                        @endphp
                        @foreach ($qualities as $quality)
                            {{ $quality }} ,
                        @endforeach
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Validité :
                    </div>
                    <div>
                        Du
                        {{ $employement->offer->publication_date }}
                        au
                        {{ $employement->offer->disability_date }}
                    </div>
                </div>

            </div>
        @else
            <div class="w-full">
                <div class="flex flex-col items-center space-y-4 bg-white py-3">
                    <div class="md:w-[300px] md:h-[300px]">
                        <img src="{{ Storage::url('illustrations/search-error.jpg') }}" alt="">
                    </div>
                    <div class="text-center font-semibold">Nous sommes désolés !</div>
                    <div class="text-center">Aucun résultat ne correspond à votre recherche</div>
                </div>
            </div>
        @endif

        <div
            class="w-full md:w-auto flex space-x-3 justify-end border-t-[1px] border-black py-3 text-[12px] font-semibold">
            <a href="{{ route('employement-edit', [$employement->id]) }}">
                <button class="py-2 w-full px-4 rounded-md font-semibold bg-green-700 text-gray-100">
                    MODIFIER
                </button>
            </a>
        </div>

    </div>
</div>
