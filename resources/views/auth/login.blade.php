<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST"  id="formAuthentication" class="mb-3" action="{{ route('loginAdmin') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email / Username')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"  autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="d-flex justify-content-between">
             <x-input-label for="password" :value="__('Password')" />
                
                  </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                             autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

       

        <div class=" mt-4">
           

            <x-primary-button class="btn d-grid w-100" style="background-color: #185FA5; border-color: #185FA5; color: white;">
                {{ __('Log in') }}
            </x-primary-button>

            
        </div>
    </form>
</x-guest-layout>
