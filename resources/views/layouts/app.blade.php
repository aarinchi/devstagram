<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    @stack('styles') <!-- Sirve para cuando necesitemos un hoja de estilos de manera ocasional -->
    <title>DevStagram - @yield('titulo')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js']) <!-- Importamos el archivo con los modulos de tailwind -->
    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    @livewireStyles <!-- Estilos de livewire -->
</head>

<!-- ESTO APLICA DE PLANTILLA PARA TODAS LAS PAGINAS  -->

<body class="bg-gray-100">

    <header class="p-5 border-b bg-white shadow">

        <div class="container mx-auto flex justify-between items-center">

            <a href="{{ route('home') }}" class="text-3xl font-black">DevStagram</a>

            <!-- Vamos a cambiar la navegacion si esta auth o no -->

            @auth <!-- Si existe un usuario autenticado entonces -->
            <nav class="flex gap-2 items-center">

                <!-- Seccion subir Imagen de Perfil -->
                <a href="{{ route('posts.create') }}" class="flex items-center gap-2 bg-white border p-2 text-gray-600 rounded text-sm uppercase font-bold cursor-pointer">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-camera" viewBox="0 0 16 16">
                        <path d="M15 12a1 1 0 0 1-1 1H2a1 1 0 0 1-1-1V6a1 1 0 0 1 1-1h1.172a3 3 0 0 0 2.12-.879l.83-.828A1 1 0 0 1 6.827 3h2.344a1 1 0 0 1 .707.293l.828.828A3 3 0 0 0 12.828 5H14a1 1 0 0 1 1 1zM2 4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6a2 2 0 0 0-2-2h-1.172a2 2 0 0 1-1.414-.586l-.828-.828A2 2 0 0 0 9.172 2H6.828a2 2 0 0 0-1.414.586l-.828.828A2 2 0 0 1 3.172 4z" />
                        <path d="M8 11a2.5 2.5 0 1 1 0-5 2.5 2.5 0 0 1 0 5m0 1a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7M3 6.5a.5.5 0 1 1-1 0 .5.5 0 0 1 1 0" />
                    </svg>


                    Crear
                </a>


                <a class="font-bold text-gray-600 text-sm" href="{{ route('posts.index', auth()->user()->username) }}">
                    Hola:
                    <span class="font-normal">
                        {{ auth()->user()->username }}
                    </span>
                </a>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf <!-- Prevenimos ataques de inyeccion por request -->
                    <button type="submit" class="font-bold uppercase text-gray-600 text-sm" href="{{route('logout')}}">Cerrar Sesion</button>
                </form>
            </nav>
            @endauth


            @guest <!-- Si NO existe un usuario autenticado entonces -->
            <nav class="flex gap-2 items-center">
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{ route('login') }}">Login</a>
                <a class="font-bold uppercase text-gray-600 text-sm" href="{{route('register')}}">Crear Cuenta</a>
            </nav>
            @endguest

        </div>
    </header>

    <main class="container mx-auto mt-10">


        <h2 class="font-black text-center text-3xl mb-10">@yield('titulo')</h2>

        @yield('contenido')

    </main>

    <footer class="mt-10 text-center p-5 text-gray-500 font-bold uppercase">
        DevStagram - Todos los derechos reservados
        {{ now()->year }} <!-- Este es un helper que nos da Laravel apra las fechas -->
    </footer>

    @livewireScripts

</body>
</hmtl>