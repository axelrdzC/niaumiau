<div id="outfitModal" class="fixed inset-0 bg-gray-500 bg-opacity-50 flex items-center justify-center hidden z-50">
  <section class="bg-white p-8 flex flex-col items-center rounded-md shadow-md border">
    <header class="w-full justify-center">
        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
            {{ __('Agregue un nombre para identificar su outfit!') }}
        </h2>
  
        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
            {{ __("Puede no agregar nada igual") }}
        </p>
    </header>
  
    <form id="outfit-form" method="POST" action="@stack('action')" class="mt-6 flex flex-col items-center gap-4 w-full">
        @csrf
        @stack('metodoreal')
  
        <!-- Nombre -->
        <div class="flex flex-col w-full item-center">
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name', $outfit->name ?? '')" 
                                    placeholder="{{ $outfit->name ?? 'Ingrese un nombre para su outfit' }}" 
                                    required autofocus autocomplete="name" />
        </div> 
  
        <div class="flex items-center gap-4">
            <x-primary-button class="w-60 justify-center" onclick="guardarOutfit()">{{ __('Guardar conjunto') }}</x-primary-button>
            <x-secondary-button class="w-60 justify-center" onclick="closeModal('outfitModal')">{{ __('Cancelar') }}</x-secondary-button>
        </div>
    </form>
  </section>
</div>
