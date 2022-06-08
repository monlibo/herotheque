<div x-data="{
    openProposalForm: @entangle('openProposalForm')
}">
    <div class="flex flex-col space-y-2 lg:space-y-6 mt-6 w-full items-center ">
        <div class="flex flex-col bg-white shadow-md shadow-violet-50 w-full lg:px-6">
            <div class="flex flex-col lg:flex-row  justify-center w-full lg:space-x-6 px-6 py-6  ">
                <div class="max-w-[160px] max-h-40 rounded-full overflow-hidden">
                    @if($company->logo)
                        <img src="{{ Storage::url($company->logo) }}" class="h-full" alt="">
                    @endif
                </div>
                <div class="flex flex-col space-y-1 py-3 flex-1 h-40">
                    <div class="w-full font-bold text-2xl">
                        {{ $company->name }}
                    </div>
                    <div class="w-full text-[16px] text-gray-500">
                        @if (count($company->field) > 0)
                            @foreach ($company->field as $field)
                                {{ $field }}
                            @endforeach
                        @endif
                    </div>
                    <div class="w-full text-[16px] text-blue-500">
                        <span><i class="bi-geo-alt-fill"></i></span>
                        {{ $company->city_address }}, {{ $company->department_address }}
                    </div>
                    <div class="w-2/3 text-[14px]">
                        {{ substr($company->description, 0, 160) }} ...
                    </div>
                </div>
                <div class="lg:w-44 lg:h-40 flex justify-center items-center">
                    <button wire:click="openCandidateForm"
                        class="bg-gray-700 text-white text-[14px] px-4 py-2  ">Envoyer
                        une candidature
                        spontanée</button>
                </div>
            </div>
            <div
                class="w-[90%] px-4 lg:px-4 flex text-[14px] space-x-4 overflow-y-hidden overflow-x-auto whitespace-nowrap">

                <div wire:click="setTyp('')"
                    class="cursor-pointer px-4 py-1 bg-white   @if ($type == '') font-bold border-b-gray-700 border-b-2  text-gray-700 @endif  text-gray-500 flex items-center">
                    Tous</div>
                <div wire:click="setTyp('employement')"
                    class="cursor-pointer px-4 py-1 bg-white  @if ($type == 'employement') font-bold border-b-gray-700 border-b-2  text-gray-700 @endif  text-gray-500 flex">
                    Emplois</div>
                <div wire:click="setTyp('internship')"
                    class="cursor-pointer px-4 py-1 bg-white    @if ($type == 'internship') font-bold border-b-gray-700 border-b-2  text-gray-700 @endif  text-gray-500 flex">
                    Stages</div>

            </div>
        </div>




        <div class="relative w-full lg:px-6">

            @if (count($offers) > 0)
                <div class="py-4  px-4 lg:px-0">

                    <div class="mb-6 mt-3  grid grid-cols-1 md:grid-cols-3 gap-4 w-full">

                        @foreach ($offers as $offer)
                            <div
                                class="bg-white shadow-md shadow-violet-50 h-auto py-4 px-2 lg:px-4 w-full   flex flex-col space-y-3 items-end">
                                <!-- Contient les informations concernants l'offre -->
                                <a href="@if ($offer->offerable_type == 'App\Models\Employement') {{ route('employement.show', $offer->offerable->id) }}
                                                @elseif($offer->offerable_type == 'App\Models\Job') {{ route('job.show', $offer->offerable->id) }}
                                                @elseif($offer->offerable_type == 'App\Models\InternShip') {{ route('internship.show', $offer->offerable->id) }} @endif"
                                    class="w-full">
                                    <div class="flex flex-col space-y-0 items-end  flex-1 h-full w-full">
                                        <!-- Le titre de l'offre -->

                                        <div class="w-full h-auto flex items-center text-[16px] font-semibold !mb-2">
                                            Recherche d'un(e) {{ $offer->title }}
                                        </div>
                                        <!-- Un partie de la descrption de l'offre -->
                                        <div class="w-full h-auto items-center text-[14px] text-gray-500">
                                            {!! $offer->description !!}
                                        </div>


                                        <!-- Informations sur le prix -->
                                        <div
                                            class="w-full h-[auto] flex flex-col space-y-2 lg:space-y-0 lg:flex-row lg:space-x-4 justify-start items-start text-[14px] !mb-2">
                                            <!-- Le prix -->

                                            <div class=" text-gray-600 py-1 rounded-md font-semibold">
                                                <span><i class="bi-geo-alt-fill"></i></span>
                                                {{ $offer->city_address }},
                                                {{ $offer->department_address }}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                                <!-- Les informations concernant l'auteur de l'offre -->
                                <div class="w-full h-full flex justify-start items-center space-x-[10px] ">
                                    <!-- Son logo -->

                                    <!-- Son nom et la date -->
                                    <div class="w-full h-auto flex flex-col items-start text-[12px] flex-1">


                                        <!-- L'heure à laquelle ça a été publié -->
                                        <span class="text-gray-500">
                                            <strong>
                                                @if (now()->diffInHours($offer->publication_date) > 24)
                                                    il y a
                                                    {{ now()->diffInDays($offer->publication_date) }}
                                                    jour(s)
                                                @else
                                                    il y a
                                                    {{ now()->diffInHours($offer->publication_date) }}
                                                    heure(s)
                                                @endif
                                            </strong>
                                        </span>
                                    </div>

                                    <div class="h-full flex justify-center items-center space-x-2 text-[13px]">
                                        <!-- Le bouton pour ajouter aux favoris -->
                                        @if ($offer->isMarked())
                                            <button wire:click="bookMark({{ $offer }})"
                                                class="bg-gray-200 w-[28px] h-[28px] text-[16px] text-red-500 rounded-md hover:bg-red-100 transition-all ease-linear hover:shadow-sm hover:shadow-red-300">
                                                <i class="bi-bookmark-fill"></i>
                                            </button>
                                        @else
                                            <button wire:click="bookMark({{ $offer }})"
                                                class="bg-gray-200 w-[28px] h-[28px] text-[16px] text-gray-500 rounded-md hover:bg-red-100 transition-all ease-linear hover:shadow-sm hover:shadow-red-300">
                                                <i class="bi-bookmark-fill"></i>
                                            </button>
                                        @endif
                                    </div>
                                </div>

                                <!-- La liste des tags -->
                                <div class="w-full h-full flex justify-start items-center space-x-[10px] text-[12px] ">
                                    <div>
                                        <ul class="text-blue-500 ">
                                            @foreach ($offer->skills as $skill)
                                                <li
                                                    class="bg-gray-100 px-2 cursor-default rounded-md inline-block mr-2 mb-2 hover:border-[1px] hover:border-blue-500 hover:bg-blue-500 hover:text-white transition-all">
                                                    #{{ $skill }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                    </div>
                </div>
            @else
                <div class="flex flex-col items-center space-y-4 py-3">
                    <div class="md:w-[300px] md:h-[300px] ">
                        <img src="{{ Storage::url('illustrations/search-error.jpg') }}" alt=""
                            class="h-full">
                    </div>
                    <div class="text-center font-semibold">Nous sommes désolés !</div>
                    <div class="text-center">Aucun résultat ne correspond à votre recherche: <br>

                    </div>
                </div>
            @endif

            <div wire:loading wire:target="setTyp,skill,field,level,experience,q,geo"
                class="w-full h-full bg-white dark:bg-gray-800  text-center rounded-md absolute top-0 left-0 flex justify-center items-center">
                <div class="flex justify-center items-center h-full">
                    <div
                        class="animate-spin mr-2 w-10 h-10 border-[3px] border-transparent border-t-[3px] border-t-blue-600   rounded-full">
                    </div>
                </div>

            </div>
        </div>

        <div class="w-[90%]">
            {{ $offers->links() }}
        </div>
    </div>

    <div x-cloak x-show="openProposalForm">
        <div
            class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div
                class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full flex justify-between">
                    <span>Envoyer une candidature spontanée</span>
                    <span wire:click="hideCandidateForm" class="text-blue-500 text-[13px] cursor-pointer">Fermer</span>
                </div>
                <form wire:submit.prevent="applicate" method="post" class="flex flex-col w-full space-y-4 items-center">
                    @csrf

                    <div class="input-container"">
                        <label class="     label w-full" for="position">
                        Entrez votre motivation
                        </label>
                    </div>

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

                    <div class="input-container ">
                        <label class="label" for="position">
                            Poste visé
                        </label>
                        <input wire:model.debounce.1000ms="position" id="position" name="position"
                            class="input" type="text">
                        @error('position')
                            <p class="text-[12px] text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

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

    <div x-data="{ shown: false, timeout: null }" x-init="@this.on('flash', () => {
        clearTimeout(timeout);
        shown = true;
        timeout = setTimeout(() => { shown = false }, 3000);
    });" x-show.transition.out.opacity.duration.1500ms="shown"
        x-transition:leave.opacity.duration.1500ms style="display: none;"
        class="text-center flex w-full justify-center fixed bottom-5 z-20 px-4 text-[14px] py-2 rounded-md  text-gray-100">

        <div class="text-center px-4 text-[14px] py-2 rounded-md bg-[#0000009f] text-white">
            {{ session('message') }}
        </div>

    </div>
</div>
