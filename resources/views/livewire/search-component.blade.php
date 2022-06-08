<div x-data="{ openFilter: false }">
    <div class="min-h-[200px] flex flex-row mb-6 ">


        <div class="flex flex-col w-full ">

            <!-- La barre de recherche -->
            <div class="w-full py-6 px-4 bg-gray-700">
                <form method="GET" action="{{ route('search') }}"
                    class="w-full flex flex-col space-y-4 lg:space-y-0 lg:flex-row lg:justify-center justify-start">
                    @method('get')
                    @csrf
                    <div class="lg:w-1/3 relative">
                        <label for="search" class="absolute text-[16px] text-gray-600 left-2 top-[7px]"><i
                                class="bi-lightning-charge-fill"></i></label>
                        <input wire:model.debounce.1000ms="q" type="text" id="search" name="q"
                            class="w-full h-[40px] text-[14px] pl-10 text-gray-600"
                            placeholder="Rechercher un emploi, un stage, une entreprise, ....">
                    </div>
                    <div class="lg:w-1/3 relative">
                        <label for="geo" class="absolute text-[16px] text-gray-600 left-2 top-[7px]"><i
                                class="bi-geo-alt-fill"></i></label>
                        <input wire:model.debounce.1000ms="geo" type="text" name="geo" id="geo"
                            placeholder="Entrez la localisation"
                            class="w-full h-[40px] pl-10 text-gray-600 text-[14px]">
                    </div>
                    {{-- <div class="relative w-full lg:w-[50px]">
                        <button
                            class="border-2 h-[40px] text-[14px] text-gray-600 py-2 px-4 lg:rounded-none lg:rounded-r-md bg-gray-200 rounded-lg font-semibold text-2xl w-full flex items-center">
                            <i class="bi-search"></i>
                        </button>
                    </div> --}}
                </form>
            </div>
            <!-- Fin de la barre de recherche -->

            <div class="w-full flex">
                <!-- Le filtrage -->

                <div x-cloak @click.away="openFilter = false" x-show="openFilter"
                    class="lg:w-[300px] z-20 fixed w-full bg-white px-4 flex flex-col h-full space-y-4 text-[14px] border-2">
                    <div class="flex justify-between">
                        <div class="py-2 bg-white font-bold rounded-md text-gray-700 flex">
                            <span class="mr-2 "><i class="bi-funnel-fill"></i></span>
                            Filtrer par:
                        </div>
                        <div @click="openFilter = false"
                            class="py-2 bg-white font-bold rounded-md text-gray-700 flex text-[20px]">
                            <span class="mr-2"><i class="bi-arrow-bar-left"></i></span>
                        </div>
                    </div>

                    <div class="w-full text-[14px] font-semibold">
                        <label for="" class="font-bold">Domaine</label>
                        <select name="field" wire:model.debounce.500ms="field" id=""
                            class="w-full h-[40px] text-[14px] py-0 border-2 border-gray-300 rounded-md text-gray-700">
                            <option value="">Tous les domaines</option>

                            @for ($i = 0; $i < count($fields); $i++)
                                <option value="{{ $fields[$i] }}">{{ $fields[$i] }}</option>
                            @endfor
                        </select>
                    </div>

                    <div class="w-full text-[14px] font-semibold">
                        <label for="" class="font-bold">Compétences</label>
                        <select name="field" wire:model.debounce.500ms="skill"
                            class="w-full h-[40px] text-[14px] py-0 border-2 border-gray-300 rounded-md text-gray-700">
                            <option value="">Toutes les compétences</option>
                            @for ($i = 0; $i < count($skills); $i++)
                                <option value="{{ $skills[$i] }}">{{ $skills[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                    <div class="w-full text-[14px] font-semibold">
                        <label for="" class="font-bold">Expérience</label>
                        <select name="field" id="" wire:model.debounce.500ms="experience"
                            class="w-full h-[40px] text-[14px] py-0 border-2 border-gray-300 rounded-md text-gray-700">
                            <option value="">Tous les niveaux</option>
                            <option value="débutant">Débutant</option>
                            <option value="intermédiaire">Intermédiaire</option>
                            <option value="expérimenté">Expérimenté</option>
                        </select>
                    </div>
                    <div class="w-full text-[14px] font-semibold">
                        <label for="" class="font-bold">Niveau d'étude</label>
                        <select name="field" wire:model.debounce.500ms="level"
                            class="w-full h-[40px] text-[14px] py-0 border-2 border-gray-300 rounded-md text-gray-700">
                            <option value="">Tous les niveaux</option>

                            @for ($i = 0; $i < count($levels); $i++)
                                <option value="{{ $levels[$i] }}">{{ $levels[$i] }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
                <!-- Fin du filtrage -->


                <div class="w-full">
                    <div
                        class="w-full px-4 py-6 lg:px-4 flex mb-4 text-[14px] space-x-4 overflow-y-hidden overflow-x-auto whitespace-nowrap">


                        <div @click="openFilter = true" class="px-4 py-2 bg-white font-bold shadow  text-gray-500 flex">
                            <span class="mr-2"><i class="bi-funnel-fill"></i></span>
                            Filtrer
                        </div>


                        <div wire:click="setTyp('')"
                            class="px-4 py-2 bg-white shadow cursor-pointer  @if ($type == '') font-bold border-violet-500 text-gray-100 bg-gray-700 @endif  text-gray-500 flex items-center">
                            Tous</div>
                        <div wire:click="setTyp('emploi')"
                            class="px-4 py-2 bg-white shadow cursor-pointer @if ($type == 'emploi') font-bold border-violet-500 text-gray-100 bg-gray-700 @endif  text-gray-500 flex">
                            Emplois</div>
                        <div wire:click="setTyp('internship')"
                            class="px-4 py-2 bg-white shadow cursor-pointer   @if ($type == 'internship') font-bold border-violet-500 text-gray-100 bg-gray-700 @endif  text-gray-500 flex">
                            Stages</div>
                        <div wire:click="setTyp('job')"
                            class="px-4 py-2 bg-white shadow cursor-pointer  @if ($type == 'job') font-bold border-violet-500 text-gray-100 bg-gray-700 @endif  text-gray-500 flex">
                            Jobs</div>

                    </div>


                    <div class="relative">

                        @if (count($offers) > 0)
                            <div class="bg-white py-4  px-4 lg:px-0">
                                <div class="lg:px-4 text-[14px]"> <span class="text-[16px] font-bold text-violet-500">
                                        {{ count($offers) }} </span> résultat(s)</div>
                                <div
                                    class="mb-6 mt-3 lg:px-4  grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 w-full">

                                    @foreach ($offers as $offer)
                                        <div
                                            class="bg-white shadow-md shadow-gray-200 h-auto py-4 px-2 lg:px-4 w-full   flex flex-col space-y-3 items-end">
                                            <!-- Contient les informations concernants l'offre -->
                                            <a href="@if ($offer->offerable_type == 'App\Models\Employement') {{ route('employement.show', $offer->offerable->id) }}
                                                @elseif($offer->offerable_type == 'App\Models\Job') {{ route('job.show', $offer->offerable->id) }}
                                                @elseif($offer->offerable_type == 'App\Models\InternShip') {{ route('internship.show', $offer->offerable->id) }} @endif"
                                                class="w-full">
                                                <div class="flex flex-col space-y-0 items-end  flex-1 h-full w-full">
                                                    <!-- Le titre de l'offre -->

                                                    <div
                                                        class="w-full h-auto flex items-center text-[16px] font-semibold !mb-2">
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
                                                <div
                                                    class="max-w-[30px] min-w-[30px] h-[30px]  rounded-full overflow-hidden bg-indigo-400">
                                                    @if ($offer->offerable_type == 'App\Models\Employement' || $offer->offerable_type == 'App\Models\InternShip')
                                                        @if ($offer->user->company->logo)
                                                            <img src="{{ Storage::url($offer->user->company->logo) }}"
                                                                class="h-full" alt="">
                                                        @endif
                                                    @elseif($offer->offerable_type == 'App\Models\Job')
                                                        @if ($offer->user->profile_photo_path)
                                                            <img src="{{ Storage::url($offer->user->profile_photo_path) }}"
                                                                class="h-full" alt="">
                                                        @endif
                                                    @endif
                                                </div>
                                                <!-- Son nom et la date -->
                                                <div class="w-full h-auto flex flex-col items-start text-[12px] flex-1">
                                                    @if ($offer->offerable_type == 'App\Models\Employement' || $offer->offerable_type == 'App\Models\InternShip')
                                                        <!-- Son nom et le lien qui le renvoie à sa page -->
                                                        <a href="" class="text-blue-500">
                                                            <span
                                                                class="font-bold">{{ $offer->user->company->name }}</span>

                                                        </a>
                                                    @elseif($offer->offerable_type == 'App\Models\Job')
                                                        <!-- Son nom et le lien qui le renvoie à sa page -->
                                                        <a href="" class="text-blue-500">
                                                            @if ($offer->offerable_type == 'App\Models\Employement' || $offer->offerable_type == 'App\Models\InternShip')
                                                                <span
                                                                    class="font-bold">{{ $offer->user->company->name }}</span>
                                                            @elseif($offer->offerable_type == 'App\Models\Job')
                                                                <span
                                                                    class="font-bold">{{ $offer->user->firstname }}</span>
                                                            @endif
                                                        </a>
                                                    @endif

                                                    <!-- L'heure à laquelle ça a été publié -->
                                                    <span class="text-gray-500"> a publié
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

                                                <div
                                                    class="h-full flex justify-center items-center space-x-2 text-[13px]">
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
                                            <div
                                                class="w-full h-full flex justify-start items-center space-x-[10px] text-[12px] ">
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
                            <div class="flex flex-col items-center space-y-4 bg-white py-3">
                                <div class="md:w-[300px] md:h-[300px]">
                                    <img src="{{ Storage::url('illustrations/search-error.jpg') }}" alt="">
                                </div>
                                <div class="text-center font-semibold">Nous sommes désolés !</div>
                                <div class="text-center">Aucun résultat ne correspond à votre recherche: <br>
                                    @if ($q)
                                        <span class="font-bold text-blue-600 text-lg">{{ $q }}</span>
                                    @endif
                                    @if ($geo)
                                        et
                                        <span class="font-bold text-blue-600 text-lg">{{ $geo }}</span>
                                    @endif
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

                    <div class="px-4">

                        {{ $offers->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
