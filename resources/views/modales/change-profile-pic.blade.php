<div id="profilepicModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden z-50">
  <section class="bg-white p-6 flex flex-col items-center rounded-md shadow-md border">
    <header class="w-full justify-center">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Suba una nueva imagen como foto de perfil') }}
        </h2>
  
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Extensiones soportadas: jpg, jpeg, png, gif") }}
        </p>
    </header>
  
    <form method="post" action="{{ route('profile.update') }}" enctype="multipart/form-data" class="mt-6 flex flex-col items-center gap-6 w-full">
        @csrf
        @method('patch')
  
        <!-- img -->
        <div class="flex relative items-center justify-center">
          <label for="imageUpload" 
              class="w-80 h-80 flex items-center justify-center border-2 border-dashed border-gray-400 
                  rounded-md cursor-pointer overflow-hidden relative bg-gray-50">
              <span id="uploadText" class="text-gray-600 text-center absolute">Inserta la imagen</span>
              <img id="previewImageNw" src="" alt="" class="hidden w-full h-full object-cover">
          </label>
          <input id="imageUpload" type="file" name="img" accept="image/*" class="hidden">
        </div>  
  
        
        <div class="flex items-center gap-4">
            <x-primary-button class="w-60 justify-center">{{ __('Guardar') }}</x-primary-button>
            <x-secondary-button class="w-60 justify-center" onclick="closeModal('profilepicModal')">{{ __('Cancelar') }}</x-secondary-button>
        </div>
    </form>
  </section>
</div>
