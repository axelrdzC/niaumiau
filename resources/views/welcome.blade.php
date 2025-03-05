
<!-- PAGINA INCIAL (BIENVENIDA) -->

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Welcome!</title>

        <!-- fotns -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- styles / scripts -->
        @if (file_exists(public_path('build/manifest.json')) || file_exists(public_path('hot')))
            @vite(['resources/css/app.css', 'resources/js/app.js'])
        @endif
    </head>
    
    <body class="font-kosugi bg-cover bg-center min-h-screen" style="background-image: url('/img/backapple.jpg');">

        <div class="relative min-h-screen flex flex-col items-center justify-center selection:bg-[#93cb48] selection:text-white">
            <div class="relative min-h-screen w-full">

                <!-- navbar para la pagina de welcome -->
                <header class="w-full items-center mt gap-2">
                    @include('components.navbar')
                </header>

                <main class="mt-24 flex justify-center">
                    <div class="grid gap-6 items-center lg:grid-cols-2 lg:gap-24">
                        <!-- img d maria bottle -->
                        <div class="flex justify-center">
                            <img src="/img/maria.png" class="w-[400px]" alt="">
                        </div>
                        <!-- textos y botones -->
                        <div class="text-white font-pixelify text-3xl grid">
                            un gusto tenerte aqui :)
                            <div class="text-[#FEF15D] drop-shadow-lg text-8xl mb-5">
                                NIAU MIAU
                            </div>
                            <div class="flex gap-6 text-base"> 
                                @auth
                                    <!-- Dashboard -->
                                    <x-color-button class="border drop-shadow-lg rounded px-4 py-1 bg-[#EC798C] focus:ring-rose-400" 
                                        href="{{ url('dashboard') }}">Ir al dashboard
                                    </x-color-button>
                                @else
                                    <!-- login / reg -->
                                    <x-color-button class="bg-[#EC798C] focus:ring-rose-400" 
                                        href="{{ url('/login') }}">Iniciar sesion
                                    </x-color-button>
                                    <x-color-button class="bg-[#9471B7]  focus:ring-purple-600" 
                                        href="{{ url('/register') }}">Registrarse
                                    </x-color-button>
                                @endauth
                            </div>
                        </div>
                    </div>
                </main>

            </div>
        </div>
    
    </body>

</html>