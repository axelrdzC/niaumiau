<x-app-layout>

  <div class="py-10">

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 mb-5 flex gap-4">
      <!-- header o sea buscador y filtros -->
      <input type="text" class="w-[500px] rounded-md border border-gray-300" placeholder="Buscar...">
      <x-action-button>
        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M12 17L6 20L7.5 14L3 9L9.5 8.5L12 3L14.5 8.5L21 9L16.5 14L18 20L12 17Z" stroke="black" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
        Favoritos
      </x-action-button>
      <x-action-button>
        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
          <path d="M4 5L10 5M10 5C10 6.10457 10.8954 7 12 7C13.1046 7 14 6.10457 14 5M10 5C10 3.89543 10.8954 3 12 3C13.1046 3 14 3.89543 14 5M14 5L20 5M4 12H16M16 12C16 13.1046 16.8954 14 18 14C19.1046 14 20 13.1046 20 12C20 10.8954 19.1046 10 18 10C16.8954 10 16 10.8954 16 12ZM8 19H20M8 19C8 17.8954 7.10457 17 6 17C4.89543 17 4 17.8954 4 19C4 20.1046 4.89543 21 6 21C7.10457 21 8 20.1046 8 19Z" stroke="black" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>          
        Mas Filtros
      </x-action-button>
      <div class="flex flex-1 items-center text-white h-full justify-end">
        <x-action-button2 onclick="openSidebar()" class=" focus:ring-rose-400 px-4">
          Agregar prenda
        </x-action-button2>
      </div>
    </div>

    <div class="max-w-8xl mx-auto sm:px-6 lg:px-8 flex flex-col gap-7">
      <!-- preview de las prendas -->
      <div class="container flex gap-2">
        @foreach ($prendas as $prenda)
          <x-item-preview onclick="openModal('prendaModal', '/prenda/{{$prenda->id}}', null, loadPrendaData)">
            <img src="{{ asset('storage/' . $prenda->imagen) }}" alt="{{ $prenda->nombre }}" class="w-32 h-32 object-cover mt-2">
          </x-item-preview>
        @endforeach
      </div>
    </div>

    @include('modales.item-preview')
    @include('modales.item-add')

  </div>

</x-app-layout>
