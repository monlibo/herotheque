<header class="z-20 h-[60px]  flex bg-gray-800 dark:bg-gray-800 dark:text-gray-200   fixed top-0 left-0 lg:px-16 w-full">
    <div class="container w-full flex space-x-4 items-center justify-between h-full px-2 mx-auto text-white ">
        <!-- Mobile hamburger -->
        <button class="p-1  -ml-1 rounded-md md:hidden focus:outline-none focus:shadow-outline-purple"
            @click="toggleSideMenu" aria-label="Menu">
            <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                <path fill-rule="evenodd"
                    d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                    clip-rule="evenodd"></path>
            </svg>
        </button>
        <!-- Search input -->

        <div class="font-bold flex flex-1 text-[14px]  lg:text-xl text-indigo-600">
            <img src="{{ Storage::url('illustrations/logo.svg') }}" class="min-w-[90px] max-w-[90px] lg:min-w-[150px] lg:max-w-[150px] " alt="">
        </div>
        <div class="hidden lg:block lg:!mr-10 text-[14px]">
            <a href="{{ route('search') }}">
                Explorer
            </a>
        </div>

        <ul class="flex items-center flex-shrink-0 lg:space-x-6 space-x-4">
            {{-- <li class="hidden lg:block w-[400px]">
                <div class="flex justify-start">
                    <div class="relative w-full max-w-xl mr-6 text-white focus-within:text-purple-500">
                        <label for="search" class="absolute right-0 inset-y-0 flex items-center pr-2">
                            <span class="text-[12px]"><i class="bi-search"></i></span>
                        </label>
                        <input
                            class="w-full pl-2 pr-8 h-[30px] text-[12px] bg-[rgba(255, 255, 255, 0.2)] text-white placeholder:text-white placeholder-[#85929c] bg-[#ffffff2c] border-0 rounded-full dark:placeholder-gray-500 dark:focus:shadow-outline-gray dark:focus:placeholder-gray-600 dark:bg-gray-700 dark:text-gray-200 focus:placeholder-gray-500 focus:bg-white focus:border-purple-300 focus:outline-none focus:shadow-outline-purple form-input"
                            type="text" placeholder="Search..." id="search" aria-label="Search" />
                    </div>
                </div>
            </li> --}}



            <!-- Theme toggler -->
            <li class="flex">
                <button class="rounded-md text-gray-200 focus:outline-none focus:shadow-outline-purple"
                    @click="toggleTheme" aria-label="Toggle color mode">
                    <template x-if="!dark">
                        <span class="text-[16px] md:text-[14px]"><i class="bi-moon-stars"></i></span>
                    </template>
                    <template x-if="dark">
                        <span class="text-[16px] md:text-[14px]"><i class="bi-sun"></i></span>
                    </template>
                </button>
            </li>

            @role('employer')
                <!-- Add menu for employer -->
                <li class="relative">
                    <button
                        class="relative text-gray-200 align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                        @click="toggleAddMenu" @keydown.escape="closeAddMenu" aria-label="Notifications"
                        aria-haspopup="true">
                        <span class="text-[30px] md:text-[24px]"><i class="bi-plus"></i></span>

                    </button>
                    <div x-cloak x-show="isAddMenuOpen">
                        <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                            x-transition:leave-end="opacity-0" @click.away="closeAddMenu" @keydown.escape="closeAddMenu"
                            class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:text-gray-300 dark:border-gray-700 dark:bg-gray-700">
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="{{ route('employement-create') }}">
                                    <span>Nouvel emploi</span>
                                </a>
                            </li>
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="{{ route('internship-create') }}">
                                    <span>Nouveau Stage</span>
                                </a>
                            </li>
                            <li class="flex">
                                <a class="inline-flex items-center justify-between w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="{{ route('job-create') }}">
                                    <span>Nouveau job</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>
            @endrole

            <!-- Notifications menu -->
            <li class="relative">
                <a href="{{ route('dashboard.notification') }}">
                    <button
                        class="relative text-gray-200 align-middle rounded-md focus:outline-none focus:shadow-outline-purple"
                        @click="toggleNotificationsMenu" @keydown.escape="closeNotificationsMenu"
                        aria-label="Notifications" aria-haspopup="true">
                        <span class="text-[14px]"><i class="bi-bell"></i></span>
                        <!-- Notification badge -->
                        <span aria-hidden="true"
                            class="absolute top-0 right-0 inline-block w-auto px-1  transform translate-x-1 -translate-y-1 bg-red-600 rounded-full dark:border-gray-800 text-[8px] ">
                            {{ count(Auth::user()->unreadNotifications) }}
                        </span>
                    </button>
                </a>
            </li>



            <!-- Profile menu -->
            <li class="relative">
                <button
                    class="align-middle flex space-x-3 items-center rounded-full focus:shadow-outline-purple focus:outline-none"
                    @click="toggleProfileMenu" @keydown.escape="closeProfileMenu" aria-label="Account"
                    aria-haspopup="true">

                    @if (Laravel\Jetstream\Jetstream::managesProfilePhotos())
                        <img class="h-8 w-8 rounded-full object-cover" src="{{ Storage::url(Auth::user()->profile_photo_path) }}"
                            alt="" />
                    @endif
                    <span class="text-[13px] hidden md:block">{{ Auth::user()->nickname }}</span>
                </button>
                <div x-cloak x-show="isProfileMenuOpen">
                    <ul x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
                        x-transition:leave-end="opacity-0" @click.away="closeProfileMenu"
                        @keydown.escape="closeProfileMenu"
                        class="absolute right-0 w-56 p-2 mt-2 space-y-2 text-gray-600 bg-white border border-gray-100 rounded-md shadow-md dark:border-gray-700 dark:text-gray-300 dark:bg-gray-700"
                        aria-label="submenu">

                        <li class="flex">
                            <a class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                href="{{ route('profile.show') }}">

                                <span>Paramètres</span>
                            </a>
                        </li>
                        <li class="flex">
                            <form class="w-full" method="POST" action="{{ route('logout') }}" x-data>
                                @csrf
                                <a @click.prevent="$root.submit();"
                                    class="inline-flex items-center w-full px-2 py-1 text-sm font-semibold transition-colors duration-150 rounded-md hover:bg-gray-100 hover:text-gray-800 dark:hover:bg-gray-800 dark:hover:text-gray-200"
                                    href="{{ route('logout') }}">

                                    <span>Déconnexion</span>
                                </a>
                            </form>
                        </li>
                    </ul>
                </div>
            </li>

        </ul>
    </div>
</header>
