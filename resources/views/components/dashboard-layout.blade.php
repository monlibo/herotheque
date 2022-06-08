<!DOCTYPE html>
<html :class="{ 'dark': dark }" x-data="data()" lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="theme-color" content="#141318" />
    <title>Windmill Dashboard</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('css/quill.snow.css') }}">
    <link rel="stylesheet" href="{{ asset('font-icon/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    {{-- <link rel="stylesheet" href="{{ asset('css/') }}"> --}}


    <!-- BEGIN: CSS Assets-->

    <!-- END: CSS Assets-->
    @livewireStyles
    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap"> --}}

    <script defer src="{{ asset('js/quill.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/init-alpine.js') }}" defer></script>
    <script defer src="{{ asset('js/Chart.min.js') }}"></script>
    {{-- <script defer src="{{ asset('js/charts-pie.js') }}"></script> --}}


</head>

<body class="font-sans antialiased transition-all  bg-gray-100   pt-[60px] pb-16 lg:pl-64 lg:pt-24 dark:bg-gray-900"
    style="/* background-image: url({{ asset('storage/img/32.jpg') }}); background-size:cover;  */">


    <div class="flex min-h-screen  dark:bg-gray-900" :class="{ 'overflow-hidden': isSideMenuOpen }">
        <!-- Desktop sidebar -->
        @role('employer')
            <x-employer-desktop-sidebar />
        @endrole

        @role('applicant')
            <x-applicant-desktop-sidebar />
        @endrole


        <!-- Mobile sidebar -->
        <!-- Backdrop -->
        <div x-show="isSideMenuOpen" x-transition:enter="transition ease-in-out duration-150"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in-out duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            class="fixed inset-0 z-10 flex items-end bg-black bg-opacity-50 sm:items-center sm:justify-center">
        </div>

        <!-- Mobile sidebar real -->
        @role('employer')
            <x-employer-mobile-sidebar />
        @endrole

        @role('applicant')
            <x-applicant-mobile-sidebar />
        @endrole

        <div class="flex relative flex-col flex-1 w-full rounded-lg">
            <x-dashboard-header />

            <main class="w-full">
                <div class="container md:px-6 mx-auto ">
                    {{ $slot }}
                </div>
            </main>
        </div>
    </div>



    @livewireScripts
    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/select2.full.min.js') }}"></script>
    @stack('scripts')

</body>

</html>
