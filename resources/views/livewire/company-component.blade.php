<div x-data="{ openFilter: false }">
    <div class="min-h-[200px] flex flex-row mb-6 ">


        <div class="flex flex-col w-full ">

            <!-- La barre de recherche -->
            <div class="w-full py-6 px-4 bg-gray-700">
                <form method="GET"
                    class="w-full flex flex-col space-y-4 lg:space-y-0 lg:flex-row lg:justify-center justify-start">
                    @method('get')
                    @csrf
                    <div class="lg:w-1/3 relative">
                        <label for="search" class="absolute text-[16px] text-gray-600 left-2 top-[7px]"><i
                                class="bi-lightning-charge-fill"></i></label>
                        <input wire:model.debounce.1000ms="search" type="text" id="search" name="q"
                            class="w-full h-[40px] text-[14px] pl-10 text-gray-600"
                            placeholder="Rechercher une entreprise, entrez un mot clé...">
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

            <div class="relative">


                @if (count($companies) > 0)
                    <div class="text-[14px] mt-4 px-6">
                        <span class="text-violet-500 text-[16px] font-bold">{{ count($companies) }}</span> entreprises
                        trouvées
                    </div>
                    <div class="w-full py-4 grid grid-cols-1 lg:grid-cols-2 gap-x-6 gap-y-4 px-6 mt-6">
                        @foreach ($companies as $company)
                            <a href="{{ route('company.show',['company'=>$company]) }}">
                                <div class="h-36 flex space-x-3 bg-white  shadow-md shadow-gray-200">
                                    <div class="w-36 h-36 bg-green-400">
                                        <img src="{{ Storage::url($company->logo) }}" class="h-full" alt="">
                                    </div>
                                    <div class="w-36 h-36 flex flex-col space-y-1 flex-1 px-4 justify-center">
                                        <div class="w-full font-bold">
                                            {{ $company->name }}
                                        </div>
                                        <div class="w-full text-[14px] text-gray-500">
                                            @if (count($company->field) > 0)
                                                @foreach ($company->field as $field)
                                                    {{ $field }}
                                                @endforeach
                                            @endif
                                        </div>
                                        <div class="w-full text-[14px] text-blue-500">
                                            <span><i class="bi-geo-alt-fill"></i></span>
                                            {{ $company->city_address }}, {{ $company->department_address }}
                                        </div>
                                        <div class="w-full text-[14px]">
                                            {{ substr($company->description, 0, 120) }} ...
                                        </div>
                                    </div>
                                </div>
                            </a>
                        @endforeach
                    </div>
                @else
                    <div class="flex flex-col w-full items-center space-y-4 bg-white py-3">
                        <div class="md:w-[300px] md:h-[300px]">
                            <img src="{{ Storage::url('illustrations/search-error.jpg') }}" alt="">
                        </div>
                        <div class="text-center font-semibold">Nous sommes désolés !</div>
                        <div class="text-center">Aucun résultat ne correspond à votre recherche: <br>
                            @if ($search)
                                <span class="font-bold text-blue-600 text-lg">{{ $search }}</span>
                            @endif
                            @if ($geo)
                                et
                                <span class="font-bold text-blue-600 text-lg">{{ $geo }}</span>
                            @endif
                        </div>
                    </div>
                @endif

                <div wire:loading wire:target="search,geo"
                    class="w-full h-full bg-white dark:bg-gray-800  text-center rounded-md absolute top-0 left-0 flex justify-center items-center">
                    <div class="flex justify-center items-center h-full">
                        <div
                            class="animate-spin mr-2 w-10 h-10 border-[3px] border-transparent border-t-[3px] border-t-blue-600   rounded-full">
                        </div>
                    </div>
                </div>
            </div>

            {{ $companies->links() }}

        </div>
    </div>
</div>
