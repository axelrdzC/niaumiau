<x-app-layout>

    <div class="py-12">

        <div class="max-w-7xl flex gap-10 mb-10 mx-auto sm:px-6 lg:px-8 space-y-6">
            <!-- img -->
            <div class="flex relative items-center justify-center">
                @if ($user->img == null)
                    <x-item-preview class="w-60 h-60" onclick="openModal('profilepicModal')">
                        <span class="text-gray-600 text-center">Agrega una foto</span>
                    </x-item-preview>
                @else
                    <x-item-preview class="p-0 w-60 h-60" onclick="openModal('profilepicModal')">
                        <img src="{{ asset('storage/' . Auth::user()->img) }}" class="h-full w-full object-cover">
                    </x-item-preview>
                @endif
            </div>  
            <!-- username y correo -->
            <div class="flex-1 flex-col">
                <div class="text-4xl font-pixelify"> {{ $user->username }} </div>
                <div class="text-xl"> {{ $user->email }} </div>
            </div>
        </div>

        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white dark:bg-gray-800 shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
    
    @include('modales.change-profile-pic')

</x-app-layout>
