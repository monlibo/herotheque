<div>

    <div class="w-full bg-white rounded-md p-4 flex flex-col space-y-3 text-[14px]">
        <div
            class="text-[14px] py-2 border-b-[1px] border-black flex flex-col md:flex-row space-y-2 justify-between items-center w-full ">


            <div class="text-[16px] font-semibold text-left w-full">Offre stage No {{ $internship->id }}</div>

        </div>

        @if ($internship)
            <div class="w-full flex flex-col space-y-3">
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Titre :
                    </div>
                    <div>
                        {{ $internship->offer->title }}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Description :
                    </div>
                    <div>
                        {!! $internship->offer->description !!}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Localisation :
                    </div>
                    <div>
                        {{ $internship->offer->department_address }}, {{ $internship->offer->city_address }}
                    </div>
                </div>


                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Nombre de poste offert :
                    </div>
                    <div>
                        {{ $internship->offer->number_position_offered }}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Type de stage :
                    </div>
                    <div class="uppercase">
                        {{ $internship->type }}
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Domaines :
                    </div>
                    <div>
                        @php
                            $fields = $internship->offer->fields;
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
                            $skills = $internship->offer->skills;
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
                            $levels = $internship->offer->education_levels;
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
                            $trainings = $internship->trainings;
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
                            $languages = $internship->offer->languages;
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
                            $qualities = $internship->offer->qualities;
                        @endphp
                        @foreach ($qualities as $quality)
                            {{ $quality }} ,
                        @endforeach
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Début du stage :
                    </div>
                    <div>
                        {{ $internship->date_start }}
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Fin du stage :
                    </div>
                    <div>
                        {{ $internship->date_end }}
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Validité :
                    </div>
                    <div>
                        Du
                        {{ $internship->offer->publication_date }}
                        au
                        {{ $internship->offer->disability_date }}
                    </div>
                </div>

            </div>
        @else
            <div class="w-full">
                Désolé, aucun stage ne correspond
            </div>
        @endif

        <div
            class="w-full md:w-auto flex space-x-3 justify-end border-t-[1px] border-black py-3 text-[12px] font-semibold">


            <a href="{{ route('internship-dashboard-edit', [$internship->id]) }}">
                <button class="py-2 w-full px-4 rounded-md font-semibold bg-green-700 text-gray-100">
                    MODIFIER
                </button>
            </a>
        </div>

    </div>
</div>
