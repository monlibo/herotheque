<!DOCTYPE html>
<html lang="fr" x-data="data()">

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

    <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script defer src="{{ asset('js/quill.js') }}"></script>
    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/init-alpine.js') }}" defer></script>
    @livewireStyles
</head>

<body class="leading-normal tracking-normal  bg-cover bg-[#f8fafb]">

    <x-header></x-header>

    <div>
        @livewire('internship.show-component', ['internship' => $internship], key($internship->id))
    </div>

    <x-footer></x-footer>

    @livewireScripts
</body>

</html>
