<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    @include('components.line-stars')

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="flex flex-col items-center">
            <div class="font-micro5 px-2 inline-block mx-auto rounded-md border border-black text-3xl text-center">
                NIAU MIAU ID
            </div> 
        </div>       
        
        <!-- Username -->
        <div class="mt-5 flex w-full justify-between items-center">
            <span class="text-justify me-3">El siguiente ID pertenece a</span>
            <input type="text" name="username" class="bg-transparent p-0 border-0 border-b flex-1 min-w-0" placeholder=" su username">
        </div>
        <div class="flex w-full text-justify">
            <span>y cuenta con la autorización necesaria para hacer uso de los servicios ofrecidos por NIAU MIAU COMPANY</span>
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-text-input id="password" class="bg-[#EBEBEB] block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-2">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
    
    @include('components.line-stars')

</x-guest-layout>
