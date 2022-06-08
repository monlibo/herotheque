<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <title>Document</title>
    @livewireStyles
</head>

<body class="text-[14px]">
    @livewire('applicant-dashboard.cv-pdf')

    @livewireScripts
</body>

</html>
