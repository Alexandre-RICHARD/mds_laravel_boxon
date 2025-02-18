<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.navigation', [
                'links' => [
                    ['route' => 'dashboard', 'text' => 'Dashboard'],
                    ['route' => 'boxes.getAll', 'text' => 'Boxes'],
                    ['route' => 'tenants.getAll', 'text' => 'Locataires'],
                    ['route' => 'contracts.getAll', 'text' => 'Contrats'],
                    ['route' => 'contractModels.getAll', 'text' => 'Modèles de contrats'],
                    ['route' => 'bills.getAll', 'text' => 'Factures'],
                ]
            ])

            <!-- Page Heading -->
            @isset($header)
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endisset

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>
    </body>
</html>
