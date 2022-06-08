<div x-data="{
    openProposalForm: @entangle('openProposalForm')
}">
    <div class="w-full flex items-center rounded-md p-4 flex-col space-y-3 text-[16px]">


        @if ($internship)
            <div class="max-w-2xl bg-white shadow-md rounded-md  p-6 flex flex-col space-y-3">



                <div>
                    La structure <strong>{{ $internship->offer->user->company->name }}</strong> recherche pour
                    le
                    poste de <strong>stagiaire</strong> ,
                    <strong>
                        {{ $internship->offer->number_position_offered }}
                        {{ $internship->offer->title }}</strong> de niveau
                    <strong>{{ $internship->offer->experience }}</strong>
                </div>

                <div class="w-full flex flex-col ">
                    <div class=" font-bold underline">
                        La description
                    </div>
                    <div>
                        {!! $internship->offer->description !!}
                    </div>
                </div>

                <div class="w-full flex flex-col">
                    <div>
                        <span class="font-bold">Les domaines suivants sont concernés: </span>

                        @php
                            $fields = $internship->offer->fields;
                        @endphp
                        @foreach ($fields as $field)
                            {{ $field }} ,
                        @endforeach
                    </div>
                </div>

                <div class="w-full flex flex-col ">
                    <div class=" font-bold underline">
                        Le contrat
                    </div>
                    <div>
                        Ce stage est un stage <strong>{{ $internship->type }} </strong> et
                        <strong>
                            @if ($internship->paid)
                                réménuré
                            @else
                                non rénuméré
                            @endif
                        </strong>
                        pour
                        <strong>{{ $internship->working_hours_per_week }} heure(s) </strong> par semaine
                    </div>
                </div>

                <div class="w-full flex flex-col ">
                    <div class=" font-bold underline">
                        Le lieu
                    </div>
                    <div>
                        {{ $internship->offer->city_address }} ,
                        {{ $internship->offer->department_address }}
                    </div>
                </div>


                <div class="font-bold underline">
                    Informations importantes
                </div>

                <div class="flex flex-col">
                    <ul class="disc list-outside list-disc pl-8 flex flex-col  space-y-2">
                        <li>

                            Vous êtes issus d'un(e)
                            @php
                                $levels = $internship->offer->education_levels;
                                $i = 1;
                            @endphp
                            @foreach ($levels as $level)
                                <span class="font-bold">{{ $level }} </span>
                                @if ($i < count($levels))
                                    /
                                @endif

                                @php
                                    $i++;
                                @endphp
                            @endforeach

                            en

                            @php
                                $trainings = $internship->trainings;
                                $i = 1;
                            @endphp
                            @foreach ($trainings as $training)
                                <span class="font-bold"> {{ $training }}</span>

                                @if ($i < count($trainings))
                                    /
                                @endif

                                @php
                                    $i++;
                                @endphp
                            @endforeach

                        </li>

                        <li>
                            Vous maîtrisez les outils/compétences tels que :
                            @php
                                $skills = $internship->offer->skills;
                                $i = 1;
                            @endphp
                            @foreach ($skills as $skill)
                                <span class="font-bold">{{ $skill }}</span>
                                @if ($i < count($skills))
                                    ,
                                @endif

                                @php
                                    $i++;
                                @endphp
                            @endforeach


                        </li>

                        <li>
                            Ces langues vous sont familières :
                            @php
                                $languages = $internship->offer->languages;
                                $i = 1;
                            @endphp
                            @foreach ($languages as $language)
                                <span class="font-bold"> {{ $language }} </span>
                                @if ($i < count($languages))
                                    ,
                                @endif

                                @php
                                    $i++;
                                @endphp
                            @endforeach
                        </li>

                        <li>

                            Les qualités telles que :
                            @php
                                $qualities = $internship->offer->qualities;
                                $i = 1;
                            @endphp
                            @foreach ($qualities as $quality)
                                <span class="lowercase font-bold"> {{ $quality }} </span>
                                @if ($i < count($qualities))
                                    ,
                                @endif

                                @php
                                    $i++;
                                @endphp
                            @endforeach
                            seront très apréciées

                        </li>
                    </ul>

                </div>

                <div class="w-full flex flex-col  ">
                    <div class=" font-bold underline">
                        Validité
                    </div>
                    <div>
                        Du
                        {{ $internship->offer->publication_date }}
                        au
                        {{ $internship->offer->disability_date }}
                    </div>
                </div>

                <div class="w-full flex flex-col  !mt-8">
                    <div class=" font-bold underline !mb-4">
                        A propos de l'entreprise
                    </div>
                    <!-- Les informations concernant l'auteur de l'offre -->
                    <div class="w-full h-full flex justify-start items-center space-x-[10px] ">
                        <!-- Son logo -->
                        <div class="min-w-[50px] max-w-[50px] h-[50px]  rounded-full overflow-hidden bg-indigo-400">

                            @if ($internship->offer->user->company->logo)
                                <img src="{{ Storage::url($internship->offer->user->company->logo) }}"
                                    class="h-full" alt="">
                            @endif

                        </div>
                        <!-- Son nom et la date -->
                        <div class="w-full h-auto flex flex-col items-start flex-1">
                            <!-- Son nom et le lien qui le renvoie à sa page -->
                            <a href="{{ route('company.show', ['company' => $internship->offer->user->company]) }}"
                                class="text-blue-500">
                                <span class="font-bold">{{ $internship->offer->user->company->name }}</span>
                            </a>
                        </div>

                        <div class="h-full flex justify-center items-center space-x-2">
                            <!-- Le bouton pour ajouter aux favoris -->
                            @if ($internship->offer->isMarked())
                                <button wire:click="bookMark({{ $internship->offer }})"
                                    class="bg-gray-200 w-[28px] h-[28px] text-[16px] text-red-500 rounded-md hover:bg-red-100 transition-all ease-linear hover:shadow-sm hover:shadow-red-300">
                                    <i class="bi-bookmark-fill"></i>
                                </button>
                            @else
                                <button wire:click="bookMark({{ $internship->offer }})"
                                    class="bg-gray-200 w-[28px] h-[28px] text-[16px] text-gray-500 rounded-md hover:bg-red-100 transition-all ease-linear hover:shadow-sm hover:shadow-red-300">
                                    <i class="bi-bookmark-fill"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                    <div>
                        {{ $internship->offer->user->company->description }}
                    </div>
                </div>

                <div class="w-full py-4 flex justify-end">
                    <button wire:click="showPostulateForm"
                        class="bg-blue-500 shadow text-gray-100 py-1 px-4 rounded-md">Postuler</button>
                </div>

            </div>
        @else
            <div class="w-full">
                Désolé, aucun emploi ne correspond
            </div>
        @endif


        <div x-data="{ shown: false, timeout: null }" x-init="@this.on('flash', () => {
            clearTimeout(timeout);
            shown = true;
            timeout = setTimeout(() => { shown = false }, 6000);
        });" x-show.transition.out.opacity.duration.1500ms="shown"
            x-transition:leave.opacity.duration.1500ms style="display: none;"
            class="text-center px-4 text-[14px] py-2 rounded-md bg-gray-500 text-gray-100">

            {{ session('message') }}

        </div>
    </div>

    <div x-cloak x-show="openProposalForm">
        <div
            class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div
                class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-fill">
                    Postuler à l'offre d'emploi
                </div>
                <form wire:submit.prevent="postulate" method="post" class="flex flex-col w-full space-y-4 items-center">
                    @csrf

                    <div x-data="{ motivation: @entangle('motivation'), motivationLength: @entangle('motivationLength') }" x-init="let toolbar = [
                        ['bold'],
                        [{
                            'indent': '-1'
                        }, {
                            'indent': '+1'
                        }]
                    ];
                    editor = new Quill('#motivation', {
                        modules: {
                            toolbar: toolbar
                        },
                        theme: 'snow'
                    });

                    editor.on('text-change', function() {
                        motivation = editor.root.innerHTML;
                        motivationLength = editor.getLength();
                    });

                    if ($('.ql-toolbar').length == 2) {
                        $('.ql-toolbar:first').remove();
                    }" class="input-container" wire:ignore>

                        <div id="motivation">

                        </div>

                    </div>
                    @error('motivationLength')
                        <p class="text-[12px] text-red-500 text-left w-full pl-6">{{ $message }}</p>
                    @enderror

                    <!-- Les boutons pour la submission du formulaire -->
                    <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                        <div class="h-16 flex w-full  justify-end px-4">
                            <button role="button" type="submit" wire:loading.attr="disabled" wire:target="store"
                                class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-1 px-3  h-[40px] flex  items-center">
                                <div wire:loading wire:target="store"
                                    class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-white  rounded-full"
                                    type="button"></div>
                                Envoyer la candidature
                            </button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>
