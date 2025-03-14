<x-guest-layout>
    
    <!-- decoracion de linea d estrellitas -->
    @include('components.line-stars')

    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data" class="flex gap-5 h-full">
        @csrf

        <!-- img -->
        <div class="flex-1 flex items-stretch relative">
            <label for="imageUpload" class="w-full object-cover flex items-center justify-center border-2 border-dashed border-gray-400 rounded-md cursor-pointer overflow-hidden">
                <span id="uploadText" class="text-gray-600 text-center p-10 text-wrap">Inserta una imagen para tu perfil</span>
                <img id="previewImageNw" src="" alt="" class="hidden w-60 h-60 object-cover rounded-md">
            </label>
            <input id="imageUpload" type="file" name="img" accept="image/*" class="hidden">
        </div>
        
        <!-- datos llenables -->
        <div class="flex flex-col justify-between">

            <div class="font-micro5 mb-2 px-2 inline-block mx-auto rounded-md border border-black text-3xl text-center">
                NIAU MIAU ID
            </div> 
            
            <!-- username -->
            <div class="flex item-center gap-2">
                <x-input-label for="name" :value="__('Username:')" />
                <x-id-text-input id="name" class="block mt-1 w-full" type="text" name="username" :value="old('name')" required autofocus autocomplete="name" />
                <x-input-error :messages="$errors->get('name')" class="mt-2" />
            </div>

            <!-- email -->
            <div class="mt-2 flex align-center gap-2">
                <x-input-label for="email" :value="__('Email:')" />
                <x-id-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- password -->
            <div class="mt-2 flex align-center gap-2">
                <x-input-label for="password" :value="__('Password:')" />

                <x-id-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- confirm password -->
            <div class="mt-2 flex align-center gap-2">
                <x-input-label for="password_confirmation" :value="__('Confirm Password:')" />

                <x-id-text-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required autocomplete="new-password" />

                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>

            <!-- ya tiene cuenta? / already registrado -->
            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>
    
                <x-primary-button class="ms-4">
                    {{ __('Register') }}
                </x-primary-button>
            </div>

        </div>
        
    </form>
    
    <!-- decoracion de linea d estrellitas -->
    @include('components.line-stars')

</x-guest-layout>
