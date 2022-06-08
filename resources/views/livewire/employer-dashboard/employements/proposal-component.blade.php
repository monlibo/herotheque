<div x-data="{ openShow: @entangle('openShow'), openApplicantProfile: @entangle('openApplicantProfile'), openRejectConfirm: @entangle('openRejectConfirm'), selection: @entangle('selection').defer }" @close-modal.window="openRejectConfirm = false;" class="w-full">



    <div class="w-full bg-white py-4 rounded-t-md flex flex-col space-y-2  px-4 mt-2  mx-auto">
        @if (session()->has('message'))
            <div x-data="{ shown: false, timeout: null }" x-init="() => {
                clearTimeout(timeout);
                shown = true;
                timeout = setTimeout(() => { shown = false }, 2000);
            }" x-show.transition.out.opacity.duration.1500ms="shown"
                x-transition:leave.opacity.duration.1500ms
                class="text-[14px] font-semibold text-left px-4 py-2 rounded-md bg-green-100 text-green-600">
                {{ session('message') }}
            </div>
        @endif



        <div class="text-[14px] py-2 flex flex-col space-y-2 justify-between items-center w-full">
            <div class="text-[14px] font-semibold text-left w-full">Candidatures à l'offre d'emploi</div>
            <div class="text-[14px] font-semibold text-left w-full text-gray-500 ">Recherche d'un(e) {{ $employement->offer->title }}
            </div>
        </div>

    </div>

    <div class="bg-white dark:bg-gray-800 dark:text-gray-200 md:rounded-b-md  mx-auto relative">
        <div>
            <!-- le tableau de la liste des postulat pour un emploi donné -->
            <div class="overflow-hidden md:rounded-b-lg shadow-xs">

                <div class="overflow-x-auto">

                    <div class="flex flex-col h-full py-2">
                        <div x-cloak x-show="selection.length > 0" class="text-[11px] w-full px-4 mb-4 flex items-start space-x-2">
                            <button x-on:click="$wire.selection = selection"
                                class="border-[1px]  bg-green-600 text-gray-100 shadow dark:text-gray-200 px-2 py-1 rounded-md">
                                PROGRAMMER UN ENTRETIEN
                            </button>
                        </div>

                        @if (count($proposals) > 0)
                            @foreach ($proposals as $proposal)
                                <!-- Un emploi: Début -->
                                <div
                                    class="w-full flex flex-col lg:flex-row lg:space-y-0 lg:items-center lg:justify-between  space-y-3 px-4">
                                    <div class="flex px-4">
                                        <div class="w-[30px] md:w-[50px]">
                                            <input type="checkbox" x-model="selection" value="{{ $proposal->id }}"
                                                class="rounded-md">
                                        </div>
                                        <div class="w-[30px] mr-4 h-full flex items-center">
                                            <div
                                                class="min-w-[30px] h-[30px]  rounded-full overflow-hidden bg-indigo-400">
                                                @if ($proposal->user->profile_photo_path)
                                                    <img src="{{ Storage::url($proposal->user->profile_photo_path) }}"
                                                        class="h-full" alt="">
                                                @endif
                                            </div>
                                        </div>
                                        <div class="flex flex-1 justify-between flex-col md:flex-row space-y-2">
                                            <div class="flex flex-col text-[14px]">
                                                <a href="">
                                                    <div class="text-[15px] font-semibold">
                                                        {{ $proposal->user->lastname }}
                                                        {{ $proposal->user->firstname }}
                                                    </div>
                                                    <div class="text-gray-400 text-[14px]">
                                                        {{ $proposal->user->profile->short_bio }}</div>
                                                </a>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="justify-between flex items-center">
                                        @if ($proposal->jobInterview)
                                            <div class="text-[16px] text-orange-400 flex items-start space-x-2 mr-4">
                                                <i class="bi-calendar-check-fill"></i>
                                            </div>
                                        @endif
                                        <div class="text-[13px] flex items-start space-x-2 mr-4">
                                            <a href="" class="flex items-center h-full">
                                                @if ($proposal->state == 'loading')
                                                    <div class="bg-yellow-200 py-1 px-2 rounded-md">En cours de
                                                        validation
                                                    </div>
                                                @elseif($proposal->state == 'accepted')
                                                    <div class="bg-green-200 py-1 px-2 rounded-md"> Proposition
                                                        acceptée
                                                    </div>
                                                @endif

                                            </a>
                                        </div>

                                        <div class="text-[11px] flex items-start space-x-2">
                                            <button wire:click="show({{ $proposal->id }})"
                                                class="border-[1px]  bg-blue-600 text-gray-100 shadow dark:text-gray-200 px-2 py-1 rounded-md">
                                                VOIR LA PROPOSITION
                                            </button>
                                        </div>
                                    </div>
                                </div>
                                <!-- Un emploi: Fin -->
                            @endforeach
                        @else
                            <div class="w-full px-4">Vous n'avez encore aucune proposition pour cette offre d'emploi
                            </div>
                        @endif
                    </div>


                </div>
            </div>


        </div>
    </div>

    <div x-cloak x-show="selection.length > 0"
        class="text-[12px] text-red-600 flex items-start space-x-2 mr-4 bg-white py-2 px-4">
        Les entretiens d'embauche ne seront pas programmés pour les candidatures qui ne sont pas encore
        acceptées et celles qui ont déjà un entretien d'embauche
    </div>

    @if ($openShow)
        <div>
            <div
                class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
                <div
                    class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">

                    <div class="w-full py-2 px-4 flex justify-between items-center">
                        <span>Proposition de {{ $proposalShow->user->firstname }} </span>
                        <span wire:click="resetProposalShow"
                            class="text-[12px] cursor-pointer text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
                            <div wire:loading wire:target="toogleShowView"
                                class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full"
                                type="button"></div>
                            Fermer
                        </span>
                    </div>

                    <div class="w-full flex flex-col px-4 font-bold">
                        Motivation
                    </div>
                    <div class="px-4">
                        {!! $proposalShow->motivation !!}
                    </div>

                    <div x-cloak @click="openApplicantProfile = !openApplicantProfile"
                        class="w-full flex justify-between px-4 font-bold mt-6">
                        <span>Profil de candidat</span>
                        @if ($openApplicantProfile)
                            <span><i class="bi-caret-down-fill"></i></span>
                        @else
                            <span><i class="bi-caret-right-fill"></i></span>
                        @endif

                    </div>
                    <!-- Profil du candidat -->
                    <div x-show="openApplicantProfile" class="px-4">
                        <div class="flex flex-col justify-center h-auto m-auto">
                            <div class="flex flex-row justify-center py-2">
                                <div class="h-full flex flex-col space-y-5 w-full items-center ">
                                    @if ($proposalShow->user->profile_photo_path)
                                        <div class="w-[100px] max-h-[100px] rounded-full bg-[gray]  overflow-hidden">
                                            <img src="{{ Storage::url($proposalShow->user->profile_photo_path) }}"
                                                class="h-full" alt="">
                                        </div>
                                    @endif
                                    <div class="flex flex-col space-y-4 w-full items-center px-4">
                                        <div class="text-[20px]">{{ $proposalShow->user->firstname }}
                                            {{ $proposalShow->user->lastname }}</div>
                                        <div class="w-full text-center">{{ $proposalShow->user->profile->short_bio }}
                                        </div>
                                    </div>

                                    <div class="flex flex-col space-y-2 w-full items-center ">
                                        <div class="text-[16px] font-bold text-left w-full">CONTACTS</div>
                                        <ul class="text-left w-full">
                                            <li>Téléphone : +229 {{ $proposalShow->user->phone_number }}</li>
                                            <li>Whatsapp : +229 65 32 35 75</li>
                                            <li>Email : {{ $proposalShow->user->email }}</li>
                                            @if ($proposalShow->user->city_address)
                                                <li>Adresse :
                                                    {{ $proposalShow->user->city_address }},
                                                    {{ $proposalShow->user->department_address }}
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    <div class="flex flex-col space-y-2 w-full items-center ">

                                        <div class="text-[16px] font-bold text-left w-full">COMPETENCES</div>
                                        @foreach ($proposalShow->user->profile->skills as $skill)
                                            <div class="text-left w-full text-[14px] ml-10">
                                                <strong>{{ $skill['name'] }}</strong> <br>
                                                <span>{{ $skill['level'] }}</span>
                                            </div>
                                        @endforeach


                                    </div>

                                    <div class="flex flex-col space-y-2 w-full items-center ">

                                        <div class="text-[16px] font-bold text-left w-full">LANGUES</div>
                                        @foreach ($proposalShow->user->profile->languages as $language)
                                            <div class="text-left w-full text-[14px] ml-10">
                                                <strong>{{ $language['name'] }}</strong> <br>
                                                <span>{{ $language['level'] }}</span>
                                            </div>
                                        @endforeach


                                    </div>



                                </div>
                            </div>

                            <div class="flex flex-row justify-center py-2">
                                <div class="flex flex-col  space-y-5 w-full   ">
                                    @if ($proposalShow->user->profile->bio && $proposalShow->user->profile->bio !== '<p><br></p>')
                                        <div class="flex flex-col space-y-2 w-full items-center ">
                                            <div
                                                class="text-[16px] font-bold text-left w-full h-[40px] flex flex-row items-center">
                                                Biographie</div>
                                            <div class="w-full bio-container">
                                                {!! $proposalShow->user->profile->bio !!}
                                            </div>
                                        </div>
                                    @endif

                                    <div class="flex flex-col space-y-2 w-full items-center ">
                                        <div
                                            class="text-[16px] font-bold text-left w-full h-[40px] flex flex-row items-center">
                                            FORMATIONS</div>
                                        <ul class="flex flex-col text-left w-full space-y-4 pl-4">
                                            @foreach ($proposalShow->user->profile->trainings as $training)
                                                <li><strong>{{ $training->name }}</strong> <br>
                                                    {{ $training->institut }} , {{ $training->city }},
                                                    {{ $training->country }}
                                                    <br>
                                                    de <span>{{ $training->date_start }}</span> à
                                                    <span>{{ $training->date_end }}</span>
                                                    <span>{{ $training->description }}</span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>



                                    <div class="flex flex-col space-y-2 w-full items-center ">
                                        <div
                                            class="text-[16px] font-bold text-left w-full   h-[40px] flex flex-row items-center">
                                            EXPERIENCES PROFESSIONNELLES</div>
                                        <ul class="flex flex-col text-left w-full  space-y-4 pl-4">
                                            @foreach ($proposalShow->user->profile->proExperiences as $experience)
                                                <li><strong>{{ $experience->position_occuped }}</strong> <br>
                                                    {{ $experience->company }} , {{ $experience->city }},
                                                    {{ $experience->country }} <br>
                                                    de <span>{{ $experience->date_start }}</span> à
                                                    <span>{{ $experience->date_end }}</span>
                                                    <span>{{ $experience->description }}</span>
                                                </li>
                                            @endforeach

                                        </ul>
                                    </div>









                                </div>
                            </div>

                        </div>
                        <div class="w-full text-center  text-black text-[12px] font-bold mt-10 ">
                            Généré le {{ now() }} par <span class="text-blue-500"> Emploitheque.com </span>
                        </div>
                    </div>

                    @csrf
                    @if ($proposalShow->state !== 'accepted')
                        <!-- Les boutons pour la submission du formulaire -->
                        <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                            <div class="h-16 flex w-full  justify-between px-4">
                                <button wire:click="rejectConfirmation({{ $proposal }})" role="button"
                                    wire:loading.attr="disabled" wire:target="store"
                                    class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-1 px-3  h-[40px] flex  items-center">

                                    Invalider la candidature
                                </button>

                                <button wire:click="accept({{ $proposalShow }})" role="button" type="submit"
                                    wire:loading.attr="disabled" wire:target="store"
                                    class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-1 px-3  h-[40px] flex  items-center">

                                    Sélectionner ce candidat
                                </button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
    @endif

    <!-- Start: Confirmation -->
    <div x-cloak x-show="openRejectConfirm">
        <div
            class="bg-[#07141fd4]  flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
            <div
                class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">
                <div class="w-full py-2 px-4 flex flex-col  items-start">
                    <p class="text-[16px] font-semibold">Etes-vous sûr de vouloir rejeter cette candidature ?</p>
                    <p>Une fois supprimée, elle disparaitra de la liste des candidatures à cette offre.</p>
                </div>
                <div class="w-full py-2 px-4 flex flex-col  items-start">
                    <p class="flex space-x-4 justify-end w-full">
                        <button @click="openRejectConfirm = false"
                            class="border-[1px] rounded-md text-blue-500 py-1 px-4">Annuler</button>
                        <button wire:click="reject({{ $proposalShow }})"
                            class="bg-blue-500 text-white rounded-md py-1 px-4">Confirmer</button>
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- End: Confirmation -->


    @if (count($selection) > 0)
        <div>
            <div
                class="bg-[#07141fd4] flex   md:p-8 w-full  justify-center items-start  h-screen fixed top-0 left-0 z-50 overflow-x-hidden overflow-y-auto">
                <div
                    class="bg-white dark:bg-gray-800 dark:text-gray-200 shadow-2xl rounded-md w-full lg:w-1/2 flex flex-col p-4 space-y-4 ">

                    <div class="w-full py-2 px-4 flex justify-between items-center">
                        <span>Programmer un entretien</span>
                        <span wire:click="resetInterview"
                            class="text-[12px] cursor-pointer text-blue-500 hover:border-[1px] rounded-md px-2 hover:border-blue-500">
                            <div wire:loading wire:target="toogleShowView"
                                class="animate-spin mr-2 w-5 h-5 border-[3px] border-transparent border-t-[3px] border-t-blue-500  rounded-full"
                                type="button"></div>
                            Fermer
                        </span>
                    </div>

                    <form wire:submit.prevent="schedule" method="POST"
                        class="w-full flex flex-col space-y-4 items-center">
                        @csrf

                        <div class="input-container">
                            <label class="label" for="birthdate">
                                Date
                            </label>
                            <input class="input" wire:model.debounce.500ms="date" type="date" name="date">
                            @error('date')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="input-container">
                            <label class="label" for="birthdate">
                                Heure
                            </label>
                            <input class="input" wire:model.debounce.500ms="time" type="time" name="time">
                            @error('time')
                                <p class="text-[12px] text-red-500">{{ $message }}</p>
                            @enderror
                        </div>


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
                        }" class="input-container" wire:ignore>

                            <label class="label" for="description">
                                Donnez quelques détails qui vous semblent importants pour le/les candidat(s)
                            </label>
                            <div id="description"></div>

                        </div>
                        @error('descriptionLength')
                            <p class="text-[12px] text-red-500 text-left w-full pl-6">{{ $message }}</p>
                        @enderror

                        <!-- Les boutons pour la submission du formulaire -->
                        <div class="h-24 w-full !mt-6 text-[14px] flex justify-end">
                            <div class="h-16 flex w-full  justify-between px-4">
                                <button role="button" type="submit" wire:loading.attr="disabled" wire:target="schedule"
                                    class="bg-blue-600 disabled:bg-gray-500 disabled:text-gray-300 rounded-md shadow-lg text-white mx-4 py-1 px-3  h-[40px] flex  items-center">
                                    Programmer l'entretien
                                </button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    @endif
</div>
