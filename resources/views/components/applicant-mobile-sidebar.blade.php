<aside x-cloak
    class="fixed left-0 inset-y-0 z-20 flex-shrink-0 w-[80%] mt-16 overflow-y-auto bg-white dark:bg-gray-800 lg:hidden"
    x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
    x-transition:enter-start="opacity-0 transform -translate-x-20" x-transition:enter-end="opacity-100"
    x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
    x-transition:leave-end="opacity-0 transform -translate-x-20" @click.away="closeSideMenu"
    @keydown.escape="closeSideMenu">
    <div class="py-4 text-gray-500 dark:text-gray-400">

        <ul class="mt-6">
            <li
                class="relative px-2 py-2">


                <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('search') }}">

                    <span class="ml-4">Explorer</span>
                </a>
            </li>
            <li
                class="relative px-2 py-2
                @if (Route::currentRouteName() !== 'dashboard') text-gray-500 @else text-blue-600 font-bold bg-gray-200 dark:bg-[#ffffff2c] rounded-l-md @endif ">
                @if (Route::currentRouteName() == 'dashboard')
                    <span class="absolute inset-y-2 -left-[1px] w-1 bg-blue-600 rounded-lg rounded-tr-lg"
                        aria-hidden="true"></span>
                @endif

                <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('dashboard') }}">

                    <span class="ml-4">Tableau de bord</span>
                </a>
            </li>

            <li
                class="relative px-2 py-2 @if (Route::currentRouteName() !== 'applicant.application') text-gray-500 @else text-blue-600 font-bold bg-gray-200 dark:bg-[#ffffff2c] rounded-l-md @endif">
                @if (Route::currentRouteName() == 'applicant.application')
                    <span class="absolute inset-y-2 -left-[1px] w-1 bg-blue-600 rounded-lg rounded-tr-lg"
                        aria-hidden="true"></span>
                @endif

                <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('applicant.application') }}">

                    <span class="ml-4">Mes candidatures spontanées</span>
                </a>
            </li>

            <li
                class="relative px-2 py-2  @if (Route::currentRouteName() !== 'applicant.proposal') text-gray-500 @else text-blue-600 font-bold bg-gray-200 dark:bg-[#ffffff2c] rounded-l-md @endif">

                @if (Route::currentRouteName() == 'applicant.proposal')
                    <span class="absolute inset-y-2 -left-[1px] w-1 bg-blue-600 rounded-lg rounded-tr-lg"
                        aria-hidden="true"></span>
                @endif

                <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('applicant.proposal') }}">

                    <span class="ml-4">Mes candidatures</span>
                </a>
            </li>



            <li class="relative px-2 py-2 text-gray-500">


                <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="">

                    <span class="ml-4">Mes favoris</span>
                </a>
            </li>

            <li
                class="relative px-2 py-2
                @if (Route::currentRouteName() !== 'profile') text-gray-500 @else text-blue-600 font-bold bg-gray-200 dark:bg-[#ffffff2c] rounded-l-md @endif ">
                @if (Route::currentRouteName() == 'profile')
                    <span class="absolute inset-y-2 -left-[1px] w-1 bg-blue-600 rounded-lg rounded-tr-lg"
                        aria-hidden="true"></span>
                @endif

                <a class="inline-flex items-center w-full text-sm  transition-colors duration-150 hover:text-gray-800 dark:hover:text-gray-200 dark:text-gray-100"
                    href="{{ route('profile') }}">

                    <span class="ml-4">Mon profil</span>
                </a>
            </li>
        </ul>

    </div>
</aside>
