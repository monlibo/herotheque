<aside
    class="fixed py-4 left-0 top-[62px] z-30 shadow-sm border-r-2 border-gray-300 dark:border-gray-600   h-screen hidden w-64 overflow-y-auto overflow-x-hidden  dark:bg-gray-800 lg:block flex-shrink-0">
    <div class=" text-gray-700 dark:text-gray-400 flex flex-col space-y-4 pl-8">

        <ul class="flex flex-col  space-y-1">
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
                class="relative px-2 py-2 @if (Route::currentRouteName() !== 'applicant.application') text-gray-500 @else text-blue-600 font-bold bg-gray-200 dark:bg-[#ffffff2c] rounded-l-md @endif ">
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
                class="relative px-2 py-2
                @if (Route::currentRouteName() !== 'applicant.proposal') text-gray-500 @else text-blue-600 font-bold bg-gray-200 dark:bg-[#ffffff2c] rounded-l-md @endif ">
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
