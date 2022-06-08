<div class="flex w-full">
    <div class="flex w-full lg:space-x-6">

        <div class="flex w-full lg:w-[calc(100%-300px)] flex-col">
            <!-- Début: Affichage du CV sans formulaire -->
            @livewire('applicant-dashboard.profile.personnal-informations', ['profile' => $profile])

            <div class="w-full  flex flex-col relative text-[14px]">
                <ul
                    class="hideScroll flex bg-white dark:bg-gray-800 dark:text-gray-200 rounded-b-md w-full overflow-x-auto overflow-y-hidden h-[50px] sticky top-[60px]    z-10 space-x-6 border-b-[2px] border-gray-200 dark:border-gray-600  text-gray-400 ">
                    <li wire:click="goToTab('biographie')"
                        class=" cursor-pointer @if ($openedTab == 'bio') text-blue-600 dark:text-blue-500 @endif font-semibold relative py-3 px-4">
                        Biographie
                        @if ($openedTab == 'biographie')
                            <span class="h-[3px] rounded-full bg-blue-600  w-full absolute -bottom-[1px] left-0"></span>
                        @endif
                    </li>
                    <li wire:click="goToTab('experience')"
                        class=" cursor-pointer @if ($openedTab == 'experience') text-blue-600 dark:text-blue-500 @endif font-semibold relative py-3 px-4">
                        Expériences
                        @if ($openedTab == 'experience')
                            <span class="h-[3px] rounded-full bg-blue-600 w-full absolute -bottom-[1px] left-0"></span>
                        @endif
                    </li>
                    <li wire:click="goToTab('skill')"
                        class="cursor-pointer relative font-semibold h-full  py-3 px-4 @if ($openedTab == 'skill') text-blue-600 dark:text-blue-500 @endif">
                        Compétences
                        @if ($openedTab == 'skill')
                            <span class="h-[3px] rounded-full bg-blue-600 w-full absolute -bottom-[1px] left-0"></span>
                        @endif
                    </li>
                    <li wire:click="goToTab('training')"
                        class="cursor-pointer relative h-full font-semibold  py-3 px-4 @if ($openedTab == 'training') text-blue-600 dark:text-blue-500 @endif">
                        Formations
                        @if ($openedTab == 'training')
                            <span class="h-[3px] rounded-full bg-blue-600 w-full absolute -bottom-[1px] left-0"></span>
                        @endif
                    </li>

                    <li wire:click="goToTab('language')"
                        class="cursor-pointer relative h-full font-semibold  py-3 px-4  @if ($openedTab == 'language') text-blue-600 dark:text-blue-500 @endif">
                        Langues
                        @if ($openedTab == 'language')
                            <span class="h-[3px] rounded-full bg-blue-600 w-full absolute -bottom-[1px] left-0"></span>
                        @endif
                    </li>

                    <li wire:click="goToTab('link')"
                        class="cursor-pointer relative h-full font-semibold  py-3 px-4 @if ($openedTab == 'quality') text-blue-600 dark:text-blue-500 @endif">
                        Liens
                        @if ($openedTab == 'link')
                            <span class="h-[3px] rounded-full bg-blue-600 w-full absolute -bottom-[1px] left-0"></span>
                        @endif
                    </li>
                </ul>

                @if ($openedTab == 'experience')
                    @livewire('applicant-dashboard.profile.professional-experience', ['profile' => $profile], key('profile-experience-' . $profile->id))
                @elseif($openedTab == 'skill')
                    @livewire('applicant-dashboard.profile.skill', ['profile' => $profile], key('profile-skill-' . $profile->id))
                @elseif($openedTab == 'training')
                    @livewire('applicant-dashboard.profile.training', ['profile' => $profile], key('profile-training-' . $profile->id))
                @elseif($openedTab == 'language')
                    @livewire('applicant-dashboard.profile.language', ['profile' => $profile], key('profile-language-' . $profile->id))
                @elseif($openedTab == 'link')
                    @livewire('applicant-dashboard.profile.link', ['profile' => $profile], key('profile-links-' . $profile->id))
                @elseif ($openedTab == 'biographie')
                    @livewire('applicant-dashboard.profile.biographie', ['profile' => $profile], key('profile-biographie-' . $profile->id))
                @endif

                <div wire:loading wire:target='goToTab'
                    class="w-full h-full bg-white dark:bg-gray-800  text-center rounded-md absolute top-[70px] left-0 flex justify-center pt-[100px]">
                    <div class="flex justify-center">
                        <div
                            class="animate-spin mr-2 w-20 h-20 border-[3px] border-transparent border-t-[3px] border-t-blue-600   rounded-full">
                        </div>
                    </div>

                </div>

            </div>
            <!-- Fin: Affichage du CV sans formulaire -->
        </div>

        <div
            class="bg-white pb-4  dark:bg-gray-800 dark:text-gray-200 rounded-md overflow-hidden w-[300px] hidden lg:flex lg:flex-col lg:items-center py-6 space-y-4">
            <div class="w-[200px] h-[200px]">
                <img src="{{ Storage::url('illustrations/368.jpg') }}" class="w-full" alt="">
            </div>
            <div class="px-4 text-[14px]">
                Remplissez complètement votre profil pour avoir plus de chance d'être sélectionné par les recruteurs.
            </div>
            <div wire:ignore class="min-w-0  bg-white rounded-lg shadow-xs dark:bg-gray-800">
                <canvas id="pie"></canvas>
            </div>

            <div class="px-4 mt-8 text-[14px]">
                Profil rempli à {{ $percent }} %
            </div>
        </div>
    </div>
</div>
@push('scripts')
    <script>
        $(function() {
            const pieConfig = {
                type: 'doughnut',
                data: {
                    datasets: [{
                        data: [@this.get('percent'), 100 - @this.get('percent')],
                        /**
                         * These colors come from Tailwind CSS palette
                         * https://tailwindcss.com/docs/customizing-colors/#default-color-palette
                         */
                        backgroundColor: ['#0694a2'],
                        label: 'Dataset 1',
                    }, ],
                    labels: ['Votre profil', 'Reste'],
                },
                options: {
                    responsive: true,
                    cutoutPercentage: 85,
                    /**
                     * Default legends are ugly and impossible to style.
                     * See examples in charts.html to add your own legends
                     *  */
                    legend: {
                        display: false,
                    },
                },
            }

            // change this to the id of your chart element in HMTL
            const pieCtx = document.getElementById('pie')
            window.myPie = new Chart(pieCtx, pieConfig)
        });
    </script>
@endpush
