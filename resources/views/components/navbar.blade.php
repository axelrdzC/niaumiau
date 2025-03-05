<!-- navbar para la pagina de welcome -->
<div class="bg-[#EBEBEB] shadow-sm border-gray-300 py-2">
    <nav class="w-full gap-10 h-8 font-kosugi flex flex-1 justify-center">
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Inicio') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Sobre nosotros') }}
        </x-nav-link>
        <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
            {{ __('Caracteristicas') }}
        </x-nav-link>
    </nav>
</div>