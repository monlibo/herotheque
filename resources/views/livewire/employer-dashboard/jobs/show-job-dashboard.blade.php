<div>

    <div class="w-full bg-white rounded-md p-4 flex flex-col space-y-3 text-[14px]">
        <div
            class="text-[14px] py-2 border-b-[1px] border-black flex flex-col md:flex-row space-y-2 justify-between items-center w-full ">


            <div class="text-[16px] font-semibold text-left w-full">Job No {{ $job->id }}</div>

        </div>

        @if ($job)
            <div class="w-full flex flex-col space-y-3">
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Titre :
                    </div>
                    <div>
                        {{ $job->offer->title }}

                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Description :
                    </div>
                    <div>
                        {!! $job->offer->description !!}
                    </div>
                </div>
                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Localisation :
                    </div>
                    <div>
                        {{ $job->offer->department_address }}, {{ $job->offer->city_address }}
                    </div>
                </div>


                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Nombre de poste offert :
                    </div>
                    <div>
                        {{ $job->offer->number_position_offered }}
                    </div>
                </div>


                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Domaines :
                    </div>
                    <div>
                        @php
                            $fields = $job->offer->fields;
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
                            $skills = $job->offer->skills;
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
                            $levels = $job->offer->education_levels;
                        @endphp
                        @foreach ($levels as $level)
                            {{ $level }} ,
                        @endforeach
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Langues :
                    </div>
                    <div>
                        @php
                            $languages = $job->offer->languages;
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
                            $qualities = $job->offer->qualities;
                        @endphp

                        @if ($qualities)
                            @foreach ($qualities as $quality)
                                {{ $quality }} ,
                            @endforeach
                        @endif


                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Début :
                    </div>
                    <div>
                        {{ $job->date_start }}
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Fin :
                    </div>
                    <div>
                        {{ $job->date_end }}
                    </div>
                </div>

                <div class="w-full flex flex-col md:flex-row md:space-x-4">
                    <div class="md:w-[200px] font-semibold text-[15px]">
                        Validité :
                    </div>
                    <div>
                        Du
                        {{ $job->offer->publication_date }}
                        au
                        {{ $job->offer->disability_date }}
                    </div>
                </div>

            </div>
        @else
            <div class="w-full">
                Désolé, aucun job ne correspond
            </div>
        @endif

        <div
            class="w-full md:w-auto flex space-x-3 justify-between border-t-[1px] border-black py-3 text-[12px] font-semibold">

            <a href="{{ route('job-dashboard-edit', [$job->id]) }}">
                <button class="py-2 w-full px-4 rounded-md font-semibold bg-green-700 text-gray-100">
                    MODIFIER
                </button>
            </a>
        </div>

    </div>
</div>