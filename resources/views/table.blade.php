<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <link rel="stylesheet" href="{{ asset('font-icon/bootstrap-icons.css') }}">
    @livewireStyles
</head>

<body class="font-[Nunito]">


    <table class="w-full flex flex-row flex-no-wrap sm:bg-white rounded-lg overflow-hidden sm:shadow-lg my-5">
        <thead class="text-white">
            <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="p-3 text-left">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Nom</font>
                    </font>
                </th>
                <th class="p-3 text-left">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">E-mail</font>
                    </font>
                </th>
                <th class="p-3 text-left" width="110px">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Actions</font>
                    </font>
                </th>
            </tr>
            <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="p-3 text-left">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Nom</font>
                    </font>
                </th>
                <th class="p-3 text-left">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">E-mail</font>
                    </font>
                </th>
                <th class="p-3 text-left" width="110px">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Actions</font>
                    </font>
                </th>
            </tr>
            <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="p-3 text-left">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Nom</font>
                    </font>
                </th>
                <th class="p-3 text-left">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">E-mail</font>
                    </font>
                </th>
                <th class="p-3 text-left" width="110px">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Actions</font>
                    </font>
                </th>
            </tr>
            <tr class="bg-teal-400 flex flex-col flex-no wrap sm:table-row rounded-l-lg sm:rounded-none mb-2 sm:mb-0">
                <th class="p-3 text-left">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Nom</font>
                    </font>
                </th>
                <th class="p-3 text-left">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">E-mail</font>
                    </font>
                </th>
                <th class="p-3 text-left" width="110px">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Actions</font>
                    </font>
                </th>
            </tr>
        </thead>
        <tbody class="flex-1 sm:flex-none">
            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Jean Covv</font>
                    </font>
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">contato@johncovv.com</font>
                    </font>
                </td>
                <td
                    class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Supprimer</font>
                    </font>
                </td>
            </tr>
            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Michael Jackson</font>
                    </font>
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">m_jackson@mail.com</font>
                    </font>
                </td>
                <td
                    class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Supprimer</font>
                    </font>
                </td>
            </tr>
            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Julia</font>
                    </font>
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">julia@mail.com</font>
                    </font>
                </td>
                <td
                    class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Supprimer</font>
                    </font>
                </td>
            </tr>
            <tr class="flex flex-col flex-no wrap sm:table-row mb-2 sm:mb-0">
                <td class="border-grey-light border hover:bg-gray-100 p-3">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Martin Madrazo</font>
                    </font>
                </td>
                <td class="border-grey-light border hover:bg-gray-100 p-3 truncate">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">martin.madrazo@mail.com</font>
                    </font>
                </td>
                <td
                    class="border-grey-light border hover:bg-gray-100 p-3 text-red-400 hover:text-red-600 hover:font-medium cursor-pointer">
                    <font style="vertical-align: inherit;">
                        <font style="vertical-align: inherit;">Supprimer</font>
                    </font>
                </td>
            </tr>
        </tbody>
    </table>


    @livewireScripts
</body>

</html>
