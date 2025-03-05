<div id="seeoutfitModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white p-6 rounded-lg w-1/3">
      <!-- header -->
      <div class="flex justify-between items-center">
          <h2 class="text-xl">Detalles del outfit</h2>
          <button onclick="closeModal('seeoutfitModal')" class="text-gray-500 hover:text-gray-700">X</button>
      </div>
      
      <!-- body -->
      <div id="modalContent" class="mt-4 py-2 overflow-y-auto max-h-[70vh]">
        
        <div class="flex flex-col h-full gap-6 py-4">

            <!-- items -->
            <div id="prendas-container" class="flex-1 flex flex-wrap gap-2 justify-center">
              <!-- dinamic imgs 4 prendas -->
            </div>                
            
            <!-- Stats -->
            <div class="flex flex-col gap-1">
              <!-- name -->
              <div id="name" class="text-2xl font-pixelify uppercase mt-2 flex-1 bg-slate-400 text-white p-2"></div>
              <x-input-label for="tags" :value="__('Stats')" />
              <!-- last fecha d uso -->
              <div class="ms-4 flex">
                  <x-input-label for="fecha_adquisicion" class="text-lg flex-1" :value="__('Ultima vez usado')" />
                  <input 
                      type="date" 
                      id="fecha_adquisicion" 
                      name="fecha_adquisicion" 
                      class="w-40 border-gray-300 py-1 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                      value="{{ old('fecha_adquisicion') }}" 
                      required
                  />
              </div>
              <!-- dias en el closet -->
              <div class="ms-4 flex gap-2">
                  <x-input-label for="diasUso" class="text-lg flex-1" :value="__('Dias en el closet')" />
                  <x-text-input id="diasUso" class="w-40 p-0 py-1 text-end rounded-r-none" type="number" name="diasUso" :value="old('diasUso', 0)" required />
              </div>
          </div>
            
        </div>

      </div>

      <!-- footer -->
      <div class="mt-4 flex text-right">
        <div class="flex flex-1 gap-2 items-start">
            <x-action-button id="starBtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 17L6 20L7.5 14L3 9L9.5 8.5L12 3L14.5 8.5L21 9L16.5 14L18 20L12 17Z" stroke="black" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </x-action-button>
            <x-action-button id="deleteOutfitBtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6V18C18 19.1046 17.1046 20 16 20H8C6.89543 20 6 19.1046 6 18V6M18 6H15M18 6H20M6 6H4M6 6H9M15 6V5C15 3.89543 14.1046 3 13 3H11C9.89543 3 9 3.89543 9 5V6M15 6H9" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </x-action-button>
        </div>
            <x-action-button id="editOutfitBtn">Abrir canva</x-action-button>
      </div>
  </div>
</div>