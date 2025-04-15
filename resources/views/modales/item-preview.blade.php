<div id="prendaModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden z-50">
  <div class="bg-white p-6 rounded-lg w-1/3">
      <!-- header -->
      <div class="flex justify-between items-center">
          <h2 class="text-xl">Detalles de la Prenda</h2>
          <button onclick="closeModal('prendaModal')" class="text-gray-500 hover:text-gray-700">X</button>
      </div>
      
      <!-- body -->
      <div id="modalContent" class="mt-4 p-2 overflow-y-auto max-h-[70vh]">
        
        <form id="updateForm" enctype="multipart/form-data" class="flex flex-col h-full gap-5 p-4">
            @csrf
            @method('PUT')
            
            <!-- campo oculto d id -->
            <input type="hidden" name="id" id="id">

            <!-- img -->
            <div class="flex-1 flex relative w-full items-center justify-center">
                <label for="imageUpload" 
                    class="w-2/3 h-2/3 flex items-center justify-center border-2 border-dashed border-gray-400 
                        rounded-md cursor-pointer overflow-hidden relative bg-gray-50">
                    <span id="uploadText" class="text-gray-600 text-center absolute">Inserta la imagen</span>
                    <img id="previewImage" src="" alt="" class="hidden w-full h-full object-cover">
                </label>
                <input id="imageUpload" type="file" name="imagen" accept="image/*" class="hidden">
            </div>                
            
            <!-- Notas -->
            <div class="flex flex-col item-center">
                <x-input-label for="notas" class="text-lg" :value="__('Notas')" />
                <x-text-input id="notas" class="block mt-1 w-full" type="text" name="notas" :value="old('notas')" required autofocus autocomplete="name" />
            </div>

            <!-- Categoria -->
            <div class="flex flex-col item-center">
                <x-input-label for="categoria_id" class="text-lg" :value="__('Categoria')" />
                <select name="categoria_id" class="categoria_id border-gray-300 py-1 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="">Cargando...</option>
                </select>   
            </div>

            <!-- Marca -->
            <div class="flex flex-col item-center">
                <x-input-label for="marca_id" class="text-lg" :value="__('Marca')" />
                <select name="marca_id" class="marca_id border-gray-300 py-1 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="">Cargando...</option>
                </select>   
            </div>

            <!-- Talla -->
            <div class="flex flex-col item-center">
                <x-input-label for="talla_id" class="text-lg" :value="__('Talla')" />
                <select name="talla_id" class="talla_id border-gray-300 py-1 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="">Cargando...</option>
                </select>   
            </div>

            <!-- Color -->
            <div class="flex flex-col item-center">
                <x-input-label for="color_id" class="text-lg" :value="__('Color')" />
                <select name="color_id" class="color_id border-gray-300 py-1 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                    <option value="">Cargando...</option>
                </select>   
            </div>

            <!-- Etiquetas -->
            <div class="flex flex-col gap-1">
                <x-input-label for="tags" :value="__('Etiquetas')" />
                <!-- x estacion -->
                <div class="ms-4 flex gap-2 relative">
                    <x-input-label for="estacion" class="text-lg flex-1" :value="__('Estacion')" />
                    <!-- Input "falso" que simula un select -->
                    <div id="dropdown-btn" class="w-40 border border-gray-300 rounded-md px-3 p-1 cursor-pointer bg-white flex justify-between items-center">
                        <span id="dropdown-text" class="text-wrap">Seleccionar</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <!-- Dropdown con checkboxes -->
                    <div id="dropdown-menu" class="absolute top-full right-0 w-40 bg-white border border-gray-300 rounded-md shadow-md hidden z-10">
                        <label class="flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                            <input type="checkbox" value="Primavera" class="checkbox-option mr-2">
                            Primavera
                        </label>
                        <label class="flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                            <input type="checkbox" value="Verano" class="checkbox-option mr-2">
                            Verano
                        </label>
                        <label class="flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                            <input type="checkbox" value="Otoño" class="checkbox-option mr-2">
                            Otoño
                        </label>
                        <label class="flex items-center p-2 hover:bg-gray-100 cursor-pointer">
                            <input type="checkbox" value="Invierno" class="checkbox-option mr-2">
                            Invierno
                        </label>
                    </div>
                    <!-- Campo oculto para enviar datos en el formulario -->
                    <input type="hidden" name="estacion" id="selected-values">
                </div>
                <!-- x ocasion -->
                <div class="ms-4 flex gap-2">
                    <x-input-label for="ocasion" class="text-lg flex-1" :value="__('Ocasion')" />
                    <x-select-input id="ocasion" name="ocasion">
                        <option value="">Seleccionar</option>
                        <option value="Casual">Casual</option>
                        <option value="Formal">Formal</option>
                        <option value="Deportiva">Deportiva</option>
                        <option value="Pijama">Pijama</option>
                        <option value="Cita">Cita</option>
                        <option value="Fiesta">Fiesta</option>
                        <option value="Uniforme">Uniforme</option>
                        <option value="Playa">Playa</option>
                    </x-select-input>
                </div>
                <!-- x mood -->
                <div class="ms-4 flex gap-2">
                    <x-input-label for="mood" class="text-lg flex-1" :value="__('Mood')" />
                    <x-select-input id="mood" name="mood">
                        <option value="">Seleccionar</option>
                        <option value="Relajado">Relajado</option>
                        <option value="Serio">Serio</option>
                        <option value="Romantico">Romantico</option>
                        <option value="Jugeton">Jugeton</option>
                        <option value="Sofisticado">Sofisticado</option>
                    </x-select-input>
                </div>
            </div>
            
            <!-- Detalles de adquisicion -->
            <div class="flex flex-col gap-1">
                <x-input-label for="tags" :value="__('Detalles de adquisicion')" />
                <!-- Precio -->
                <div class="flex items-center ms-4">
                    <x-input-label for="precio" class="flex-1 text-lg" :value="__('Precio')" />
                    <div class="w-40 flex">
                        <x-text-input id="precio" class="w-3/5 p-0 py-1 text-end rounded-r-none" type="number" step="0.01" name="precio" :value="old('precio', 0)" required />
                        <select name="moneda" id="moneda" class="w-2/5 p-1 border-gray-300 rounded-md shadow-sm rounded-l-none">
                            <option value="MXN" {{ old('moneda') == 'MXN' ? 'selected' : '' }}>MXN</option>
                            <option value="USD" {{ old('moneda') == 'USD' ? 'selected' : '' }}>USD</option>
                            <option value="EUR" {{ old('moneda') == 'EUR' ? 'selected' : '' }}>EUR</option>
                        </select>
                    </div>
                </div> 
                <!-- Fecha d adquisicion -->
                <div class="ms-4 flex">
                    <x-input-label for="fecha_adquisicion" class="text-lg flex-1" :value="__('Fecha de adquisición')" />
                    <input 
                        type="date" 
                        id="fecha_adquisicion" 
                        name="fecha_adquisicion" 
                        class="w-40 border-gray-300 py-1 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm"
                        value="{{ old('fecha_adquisicion') }}" 
                        required
                    />
                </div>
                <!-- Estado -->
                <div class="ms-4 flex gap-2">
                    <x-input-label for="estado" class="text-lg flex-1" :value="__('Estado')" />
                    <x-select-input id="estado" name="estado">
                        <option value="Nuevo">Nuevo</option>
                        <option value="Usado">Usado</option>
                        <option value="Alquilado">Alquilado</option>
                    </x-select-input>
                </div>
            </div>
            
        </form>

      </div>


      <!-- footer -->
      <div class="mt-4 flex text-right">
        <div class="flex flex-1 gap-2 items-start">
            <x-action-button id="starBtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12 17L6 20L7.5 14L3 9L9.5 8.5L12 3L14.5 8.5L21 9L16.5 14L18 20L12 17Z" stroke="black" stroke-width="1" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </x-action-button>
            <x-action-button id="deleteBtn">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M18 6V18C18 19.1046 17.1046 20 16 20H8C6.89543 20 6 19.1046 6 18V6M18 6H15M18 6H20M6 6H4M6 6H9M15 6V5C15 3.89543 14.1046 3 13 3H11C9.89543 3 9 3.89543 9 5V6M15 6H9" stroke="black" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </x-action-button>
        </div>
            <x-action-button id="saveBtn">Guardar cambios</x-action-button>
      </div>
  </div>
</div>