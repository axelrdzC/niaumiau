<x-app-layout>

  <div class="py-10">
      <!-- accesos rapidos -->
      <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex gap-6">
          <!-- un preview -->
            <!-- clima -->
            <div class="w-full flex font-michroma bg-gradient-to-l from-[#e2f1f1] to-[#afc9e3] dark:bg-gray-800 overflow-hidden shadow-md sm:rounded-lg">
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
          <!-- buttons -->
          <div class="w-full flex flex-col gap-2 dark:bg-gray-800 shadow-sm sm:rounded-lg">
            <x-action-button class="flex-1 !text-xl" onclick="window.location.href='{{ route('outfits.create') }}'">Crear un outfit nuevo</x-action-button>
            <x-action-button class="flex-1 !text-xl">Mis favoritos</x-action-button>
            <x-action-button class="flex-1 !text-xl">Mas utilizados</x-action-button>
            <x-action-button class="flex-1 !text-xl">Menos utilizados</x-action-button>
          </div>
      </div>


      <!-- header o sea buscador y filtros -->
      <div class="max-w-8xl mt-16 mx-auto sm:px-6 lg:px-8 mb-5 flex gap-4">
        <!-- buscador -->
        <input type="text" class="flex-1 rounded-md border border-gray-300" placeholder="Buscar...">
        <!-- favoritos -->
        <x-action-button>
          <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M12 17L6 20L7.5 14L3 9L9.5 8.5L12 3L14.5 8.5L21 9L16.5 14L18 20L12 17Z" stroke="black" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>
          Favoritos
        </x-action-button>
        <!-- filtros -->
        <x-action-button>
          <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M4 5L10 5M10 5C10 6.10457 10.8954 7 12 7C13.1046 7 14 6.10457 14 5M10 5C10 3.89543 10.8954 3 12 3C13.1046 3 14 3.89543 14 5M14 5L20 5M4 12H16M16 12C16 13.1046 16.8954 14 18 14C19.1046 14 20 13.1046 20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12ZM8 19H20M8 19C8 17.8954 7.10457 17 6 17C4.89543 17 4 17.8954 4 19C4 20.1046 4.89543 21 6 21C7.10457 21 8 20.1046 8 19Z" stroke="black" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
          </svg>          
          Mas Filtros
        </x-action-button>
      </div>

      <!-- index d outfits -->
      <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex flex-col">
        <!-- un preview -->
        <div class="container flex gap-2">
          @foreach ($outfits as $outfit)
            <x-item-preview onclick="openModal('seeoutfitModal', '/outfits/{{$outfit->id}}', null, loadOutfitData)">
              <div class="font-semibold text-lg text-center"> {{ $outfit->name }} </div>
              <div class="flex justify-center gap-2 mt-2">
                  @foreach ($outfit->prendas as $prenda)
                      <img src="{{ asset('storage/' . $prenda->imagen) }}" 
                          alt="{{ $prenda->nombre }}" 
                          class="w-20 h-20 object-cover">
                  @endforeach
              </div>
            </x-item-preview>        
          @endforeach
        </div>
      </div>

      @include('modales.preview-outfit')

  </div>
</x-app-layout>
