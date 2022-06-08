<div>
    <div class="mt-4">
        <div class="flex flex-col lg:flex-row w-full items-center">
            <div class="w-full mt-6 px-6  lg:w-1/3 lg:mt-0">
                <a href="{{ route('applicant.application') }}">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white dark:bg-gray-800">
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-blue-600">
                                {{ $applicationCount }}
                            </h4>
                            <div class="text-gray-500 dark:text-gray-300">Candidatures spontanées</div>
                        </div>
                    </div>
                </a>

            </div>



            <div class="w-full mt-6 px-6  lg:w-1/3 lg:mt-0">
                <a href="{{ route('applicant.proposal') }}">
                    <div class="flex items-center px-5 py-6 shadow-sm rounded-md bg-white dark:bg-gray-800">
                        <div class="mx-5">
                            <h4 class="text-2xl font-semibold text-blue-600">
                                {{ $proposalCount }}
                            </h4>
                            <div class="text-gray-500 dark:text-gray-300">Candidatures</div>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
