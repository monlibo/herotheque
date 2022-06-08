<div>
    <div class="mt-4">
        <div class="flex flex-col lg:flex-row">
            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <a href="{{ route('employement') }}">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white dark:bg-gray-800">
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-blue-600">
                                {{ count(Auth::user()->offers->where('offerable_type', 'App\Models\Employement')) }}
                            </h4>
                            <div class="text-gray-500 dark:text-gray-300">Emplois</div>
                        </div>
                    </div>
                </a>

            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <a href="{{ route('internship') }}">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white dark:bg-gray-800">
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-blue-600">
                                {{ count(Auth::user()->offers->where('offerable_type', 'App\Models\InternShip')) }}
                            </h4>
                            <div class="text-gray-500 dark:text-gray-300">Stages</div>
                        </div>
                    </div>
                </a>
            </div>

            <div class="w-full mt-6 px-6 sm:w-1/2 xl:w-1/3 xl:mt-0">
                <a href="{{ route('job') }}">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white dark:bg-gray-800">
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-blue-600">
                                {{ count(Auth::user()->offers->where('offerable_type', 'App\Models\Job')) }}
                            </h4>
                            <div class="text-gray-500 dark:text-gray-300">Jobs</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>


</div>
