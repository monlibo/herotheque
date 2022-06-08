<header x-data="{ navOpen: false, openProfileMenu: false }"
    class="w-full z-20 px-4 lg:px-16 md:px-10 bg-white text-gray-700 h-16 flex items-center lg:justify-between  space-x-4 lg:space-x-6 ">

    <button class="p-1 lg:mr-5 text-black -ml-1 rounded-md lg:hidden focus:outline-none focus:shadow-outline-purple"
        @click="navOpen = true" aria-label="Menu">
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
            <path fill-rule="evenodd"
                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                clip-rule="evenodd"></path>
        </svg>
    </button>
    <div class="font-bold flex flex-1 text-[14px] w-[200px] lg:text-xl text-indigo-600">
        <img src="{{ Storage::url('illustrations/logo.svg') }}" class="w-[150px]" alt="">
    </div>

    <nav class="md:ml-auto hidden md:mr-auto lg:flex flex-wrap items-center text-base justify-center text-[14px]">
        <a class="mr-5 hover:text-gray-900">Offres par domaine</a>
        <a class="mr-5 hover:text-gray-900">Offres par zone</a>
        <a href="{{ route('company.index') }}"
            class="mr-5 @if (Route::currentRouteName() == 'company.index') text-violet-500 font-bold @endif hover:text-gray-900">Découvrez
            nos entreprises</a>
    </nav>

    @guest
        <div class="flex space-x-4">
            <a href="{{ route('login') }}" class="hidden lg:flex items-center  border-violet-500 border-[1px]  text-violet-500 text-[14px] py-1 px-4">Se
                connecter</a>
            <a href="{{ route('register') }}"
                class="hidden lg:flex items-center  bg-violet-500  text-white text-[14px] py-1 px-4">S'inscrire</a>


        </div>
    @endguest

    <nav x-cloak x-show="navOpen" @click.away="navOpen = false"
        class="lg:hidden transition w-3/4 pl-6 pr-4 h-full z-30 py-4 flex flex-col space-y-3 text-[16px] fixed bg-white top-0 shadow-lg -left-4">
        <a class="hover:text-gray-900">Offres par domaine</a>
        <a class=" hover:text-gray-900">Offres par zone</a>

        <a href="{{ route('company.index') }}"
            class=" @if (Route::currentRouteName() == 'company.index') text-violet-500 @endif hover:text-gray-900">Découvrez nos
            entreprises</a>
        @guest
            <a href="{{ route('login') }}" class=" hover:text-gray-900">Se connecter</a>
            <a href="{{ route('register') }}" class=" hover:text-gray-900">S'inscrire</a>
        @endguest
    </nav>

    @auth
        <!-- Profile menu -->
        <div class="relative">
            <button
                class="align-middle flex space-x-3 items-center rounded-full focus:shadow-outline-purple focus:outline-none"
                @click="openProfileMenu = true" @click.away="openProfileMenu = false" aria-label="Account"
                aria-haspopup="true">

                @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                    <img class="h-8 w-8 rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                        alt="{{ Auth::user()->firstname }}" />
                @endif
                <span class="text-[13px] hidden md:block">{{ Auth::user()->nickname }}</span>
            </button>
            <div x-cloak x-show="openProfileMenu" class="">
                <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                    x-transition:leave-end="opacity-0" @click.away="closeProfileMenu" @keydown.escape="closeProfileMenu"
                    class="absolute z-20  right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                    aria-label="submenu">
                    <li class="flex">
                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                            href="{{ route('dashboard') }}">

                            <span>Tableau de bord</span>
                        </a>
                    </li>
                    <li class="flex">
                        <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                            href="{{ route('profile.show') }}">

                            <span>Settings</span>
                        </a>
                    </li>
                    <li class="flex">
                        <form class="w-full" method="POST" action="{{ route('logout') }}" x-data>
                            @csrf
                            <a @click.prevent="$root.submit();"
                                class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="{{ route('logout') }}">
                                <span>Log out</span>
                            </a>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    @endauth
</header>
