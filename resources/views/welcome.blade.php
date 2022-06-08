<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" x-data="data()">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{ env('APP_NAME') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('font-icon/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">


    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}


    <script defer src="{{ asset('js/quill.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/init-alpine.js') }}" defer></script>

</head>

<body class="leading-normal tracking-normal bg-cover">

    <x-header></x-header>

    <main class="w-full lg:h-[500px] flex items-center bg-white bg-cover py-4">
        <div class="px-4 lg:px-16  w-full flex flex-col justify-center items-center h-full ">
            <p class="md:text-[40px]  text-gray-100 text-[28px] py-4 px-4 font-bold mb-4">

                <span class="bg-gray-700 px-4">Découvrez une </span><br>
                <span class="bg-gray-700 px-4 lg:-ml-8">multitude </span> <br>
                <span class="bg-orange-600 px-4">d'opportunités</span>
            </p>
            <p class="text-[16px] text-black">Vous pouvez rechercher des offres d'emplois, des stages et des jobs.
            </p>
            <div class="mt-4 md:px-10 lg:w-[900px] w-full flex justify-center">
                <form method="GET" action="{{ route('search') }}"
                    class="w-full flex flex-col space-y-4 lg:space-y-0 lg:flex-row justify-center">
                    @method('get')
                    @csrf
                    <div class="lg:w-[400px] w-full relative">
                        <label for="search" class="absolute text-[16px] text-gray-800 left-2 top-[13px]"><i
                                class="bi-lightning-charge-fill"></i></label>
                        <input type="text" id="search" name="q"
                            class="w-full h-[45px] text-[14px]  lg:rounded-none lg:rounded-l-lg pl-10 text-gray-800"
                            placeholder="Rechercher un emploi, un stage, une entreprise, ....">
                    </div>
                    <div class="lg:w-[400px] relative">
                        <label for="geo" class="absolute text-[16px] text-gray-800 left-2 top-[13px]"><i
                                class="bi-geo-alt-fill"></i></label>
                        <input type="text" name="geo" id="geo" placeholder="Entrez la localisation"
                            class="w-full lg:rounded-none h-[45px] pl-10 text-gray-800 text-[14px]">
                    </div>
                    <div class="relative w-full lg:w-[100px]">
                        <button
                            class="bg-gray-700 border-gray-700 flex items-center justify-center border-2 h-[45px] text-[16px] text-white py-2  lg:rounded-none lg:rounded-r-md font-semibold text-2xl w-full">
                            <i class="bi-search hidden md:block"></i>
                            <span class="md:hidden text-[14px]">Rechercher</span>
                        </button>
                    </div>
                </form>
            </div>
            <div class="w-full md:px-10 lg:w-[900px] mt-6 flex flex-col space-y-2">
                <p class="text-[16px]">Suggestions de recherche : </p>
                <div class="w-full text-[14px]">
                    <div class="px-3 bg-gray-200 rounded-full mr-2 mb-4 inline-block py-1"><a href="{{ route('search',['q'=>"Assistant social"]) }}">Assistant social</a></div>
                    <div class="px-3 bg-gray-200 rounded-full mr-2 mb-4 inline-block py-1"><a href="{{ route('search',['q'=>"Ingénieur électrique"]) }}">Ingénieur électrique</a></div>
                    <div class="px-3 bg-gray-200 rounded-full mr-2 mb-4 inline-block py-1"><a href="{{ route('search',['q'=>"Génie civile"]) }}">Génie civile</a></div>
                    <div class="px-3 bg-gray-200 rounded-full mr-2 mb-4 inline-block py-1"><a href="{{ route('search',['q'=>"Blanchisseur"]) }}">Blanchisseur</a></div>
                    <div class="px-3 bg-gray-200 rounded-full mr-2 mb-4 inline-block py-1"><a href="{{ route('search',['q'=>"Développeur full-stack"]) }}">Développeur full-stack</a></div>
                </div>
            </div>
        </div>
    </main>


    <section class="text-gray-600 bg-gray-100 body-font">
        <div class="container px-5 py-10 mx-auto">
            <div
                class="bg-white rounded-lg flex flex-col lg:flex-row  items-center lg:w-4/5 mx-auto border-b p-6 mb-10 border-gray-200">
                <div
                    class="md:max-h-[350px] md:max-w-[350px] w-full lg:mr-10 flex items-center  justify-center rounded-full  text-indigo-500 flex-shrink-0">
                    <img src="{{ Storage::url('illustrations/i1.jpg') }}" class="w-full" alt="">
                </div>
                <div class="flex-grow sm:text-left text-left mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg lg:text-xl title-font font-bold mb-2 ">Trouvez l'emploi qu'il vous
                        faut</h2>
                    <p class="leading-relaxed text-base">
                        <span class="text-violet-600 font-semibold"> Recherchez
                        </span> parmis nos multitudes d'offres.
                        <span class="text-violet-600 font-semibold">Trouvez</span> celles qui conviennent le mieux à
                        votre profil et
                        <span class="text-violet-600 font-semibold">Postulez-y.</span>
                    </p>
                </div>
            </div>

            <div
                class="bg-white rounded-lg flex items-center lg:w-4/5 mx-auto border-b p-6 mb-10 border-gray-200 sm:flex-row flex-col">
                <div
                    class="w-full lg:hidden lg:mr-10 inline-flex items-center justify-center rounded-full  text-indigo-500 flex-shrink-0">
                    <img src="{{ Storage::url('illustrations/i2.jpg') }}" class="w-full" alt="">
                </div>
                <div class="flex-grow sm:text-left mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg lg:text-xl title-font font-bold mb-2">Trouvrez le ou les candidats
                        idéaux</h2>
                    <p class="leading-relaxed text-base"> <span class="font-semibold text-violet-600">Publiez</span> vos
                        offres d'emplois, de stages et des jobs. <span class="font-semibold text-violet-600">
                            Sélectionnez</span> ensuite les candidats qui vous conviennent le mieux et <span
                            class="font-semibold text-violet-600">programmez</span> un entretien.</p>

                </div>
                <div
                    class="md:max-h-[350px] md:max-w-[350px] hidden sm:mr-10 md:inline-flex items-center justify-center rounded-full  text-indigo-500 flex-shrink-0">
                    <img src="{{ Storage::url('illustrations/i2.jpg') }}" alt="">
                </div>

            </div>

            <div
                class="bg-white rounded-lg flex items-center lg:w-4/5 mx-auto border-b p-6 mb-10 border-gray-200 sm:flex-row flex-col">
                <div
                    class="md:max-h-[350px] md:max-w-[350px] w-full lg:mr-10 flex items-center bg-red-500 justify-center rounded-full  text-indigo-500 flex-shrink-0">
                    <img src="{{ Storage::url('illustrations/i3.jpg') }}" class="w-full" alt="">
                </div>
                <div class="flex-grow sm:text-left  mt-6 sm:mt-0">
                    <h2 class="text-gray-900 text-lg lg:text-xl title-font font-bold mb-2">Décidez de votre prochaine
                        carrière</h2>
                    <p class="leading-relaxed text-base"> Explorez les <span
                            class="font-semibold text-violet-600">entreprises inscrites </span> sur le site web. Envoyez une
                        <span class="font-semibold text-violet-600"> candidature spontanée </span> et voyez ci celles-ci
                        s'y intéressent.
                    </p>

                </div>
            </div>
        </div>
    </section>

    <section class="text-gray-600 body-font bg-white">
        <div class="container px-5  mx-auto">

            <div class="flex flex-wrap -m-4 text-center justify-center">
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">

                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ $countOffer }}</h2>
                        <p class="leading-relaxed">Offres publiées</p>
                    </div>
                </div>
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">

                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ $countUser }}</h2>
                        <p class="leading-relaxed">Demandeurs d'emplois</p>
                    </div>
                </div>
                <div class="p-4 md:w-1/4 sm:w-1/2 w-full">
                    <div class="border-2 border-gray-200 px-4 py-6 rounded-lg">

                        <h2 class="title-font font-medium text-3xl text-gray-900">{{ $countCompany }}</h2>
                        <p class="leading-relaxed">Entreprises</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- <section class="text-gray-600 body-font">
        <div class="container px-5 py-24 mx-auto">
            <h1 class="text-3xl font-medium title-font text-gray-900 mb-12 text-center">Témoignages</h1>
            <div class="flex flex-wrap -m-4">
                <div class="p-4 md:w-1/2 w-full">
                    <div class="h-full bg-gray-100 p-8 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                            <path
                                d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                            </path>
                        </svg>
                        <p class="leading-relaxed mb-6">Synth chartreuse iPhone lomo cray raw denim brunch everyday
                            carry neutra before they sold out fixie 90's microdosing. Tacos pinterest fanny pack venmo,
                            post-ironic heirloom try-hard pabst authentic iceland.</p>
                        <a class="inline-flex items-center">
                            <img alt="testimonial" src="https://dummyimage.com/106x106"
                                class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                            <span class="flex-grow flex flex-col pl-4">
                                <span class="title-font font-medium text-gray-900">Holden Caulfield</span>
                                <span class="text-gray-500 text-sm">UI DEVELOPER</span>
                            </span>
                        </a>
                    </div>
                </div>
                <div class="p-4 md:w-1/2 w-full">
                    <div class="h-full bg-gray-100 p-8 rounded">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            class="block w-5 h-5 text-gray-400 mb-4" viewBox="0 0 975.036 975.036">
                            <path
                                d="M925.036 57.197h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.399 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l36 76c11.6 24.399 40.3 35.1 65.1 24.399 66.2-28.6 122.101-64.8 167.7-108.8 55.601-53.7 93.7-114.3 114.3-181.9 20.601-67.6 30.9-159.8 30.9-276.8v-239c0-27.599-22.401-50-50-50zM106.036 913.497c65.4-28.5 121-64.699 166.9-108.6 56.1-53.7 94.4-114.1 115-181.2 20.6-67.1 30.899-159.6 30.899-277.5v-239c0-27.6-22.399-50-50-50h-304c-27.6 0-50 22.4-50 50v304c0 27.601 22.4 50 50 50h145.5c-1.9 79.601-20.4 143.3-55.4 191.2-27.6 37.8-69.4 69.1-125.3 93.8-25.7 11.3-36.8 41.7-24.8 67.101l35.9 75.8c11.601 24.399 40.501 35.2 65.301 24.399z">
                            </path>
                        </svg>
                        <p class="leading-relaxed mb-6">Synth chartreuse iPhone lomo cray raw denim brunch everyday
                            carry neutra before they sold out fixie 90's microdosing. Tacos pinterest fanny pack venmo,
                            post-ironic heirloom try-hard pabst authentic iceland.</p>
                        <a class="inline-flex items-center">
                            <img alt="testimonial" src="https://dummyimage.com/107x107"
                                class="w-12 h-12 rounded-full flex-shrink-0 object-cover object-center">
                            <span class="flex-grow flex flex-col pl-4">
                                <span class="title-font font-medium text-gray-900">Alper Kamu</span>
                                <span class="text-gray-500 text-sm">DESIGNER</span>
                            </span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    <x-footer></x-footer>

</body>

</html>
