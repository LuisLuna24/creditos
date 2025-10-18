<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'TESCH') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased dark:text-gray-50">
    <div class="relative flex items-center justify-center min-h-screen bg-gray-100 dark:bg-gray-900">
        <div class="absolute inset-0 z-0">
            <img class="object-cover w-full h-full"
                src="{{ asset('img/TESH.webp') }}"
                alt="Foto de la escuela">
            <div class="absolute inset-0 bg-black opacity-60"></div>
        </div>

        <div class="relative z-10 max-w-2xl mx-auto text-center text-white px-6">

            <div class="flex justify-center mb-6">
                <img src="{{ asset('img/tesch-logo-dark.webp') }}" alt="logo tesch" class=" h-32">
            </div>

            <h1 class="text-4xl font-extrabold tracking-tight md:text-5xl">
                Registro de Actividades Extra Curriculares
            </h1>

            <div class="mt-8 flex flex-wrap justify-center gap-4">
                @auth
                    @php
                        switch (Auth::user()->type_user_id) {
                            case 1:
                                $panel = 'admin.panel';
                                break;
                            case 2:
                                $panel = 'docentes.panel';
                                break;
                            case 3:
                                $panel = 'alumnos.panel';
                                break;
                        }
                    @endphp
                    <a href="{{ route($panel) }}"
                        class="inline-block rounded-lg bg-indigo-600 px-8 py-3 text-sm font-semibold text-white shadow-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        Ir al Panel
                    </a>
                @else
                    <a href="{{ route('login') }}"
                        class="inline-block rounded-lg bg-indigo-600 px-8 py-3 text-sm font-semibold text-white shadow-lg hover:bg-indigo-500 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 focus:ring-offset-gray-900">
                        Iniciar Sesión
                    </a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="inline-block rounded-lg bg-white px-8 py-3 text-sm font-semibold text-gray-800 shadow-lg hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-400 focus:ring-offset-2 focus:ring-offset-gray-900">
                            Registrarse
                        </a>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
</body>

</html>
