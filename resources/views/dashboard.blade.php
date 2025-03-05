<x-app-layout>

    <div class="py-10">
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex gap-7 mb-10">
            <button onclick="openSidebar()" class="text-center flex flex-col items-center transition-transform duration-200 hover:scale-110">
                <img src="/img/ness.png" alt="" class="w-12 h-12">
                <div class="mt-2">Subir prendas</div>
            </button>
            <a href="/outfits" class="text-center flex flex-col items-center">
                <img src="/img/phone.png" alt="" class="w-12 h-12">
                <div class="mt-2">Buscar niauianos</div>
            </a>
            <a href="/outfits" class="text-center flex flex-col items-center">
                <img src="/img/ness.png" alt="" class="w-12 h-12">
                <div class="mt-2">Ver mis stats</div>
            </a>
        </div>
        <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex gap-2">
            <!-- recomendaciones -->
            <div class="w-full flex bg-[#9471B7] dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-xl text-gray-100">
                    <div class="">
                        No sabes que ponerte hoy?
                    </div>
                    <span class="font-pixelify text-2xl">PRUEBA UNA DE NUESTRAS RECOMENDACIONES!</span>
                </div>
            </div>
            <!-- clima -->
            <div class="w-full flex font-michroma bg-gradient-to-l from-[#e2f1f1] to-[#afc9e3] dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 me-4 text-white dark:text-gray-100">
                    <div> Ciudad Victoria, Tamaulipas </div>
                    <div class=" text-6xl"> 27° </div>
                    <div class="pt-2"> Despejado </div>
                    <div class=""> 31°/ 14° </div>
                </div>
                <div class="p-6 flex flex-1 flex-col gap-2">
                    <div class="bg-white flex w-full p-2 px-4">
                        Manana <span class="flex-1 w-full text-right text-gray-400">5° / 31°</span>
                    </div>
                    <div class="bg-white flex w-full p-2 px-4">
                        Jueves <span class="flex-1 w-full text-right text-gray-400">5° / 31°</span>
                    </div>
                    <div class="bg-white flex w-full p-2 px-4">
                        Viernes <span class="flex-1 w-full text-right text-gray-400">5° / 31°</span>
                    </div>
                </div>
            </div>
        </div>

        @include('modales.item-add')

    </div>
</x-app-layout>
