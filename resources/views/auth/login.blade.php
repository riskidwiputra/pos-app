<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST"  id="formAuthentication" class="mb-3" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email / Username')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <div class="d-flex justify-content-between">
             <x-input-label for="password" :value="__('Password')" />
                <!-- @if (Route::has('password.request')) 
                    <a class=" text-sm   rounded-md  focus:ring-2 focus:ring-offset-2 " href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                 @endif -->
                  </div>
            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

       

        <div class=" mt-4">
           

            <x-primary-button class=" btn btn-primary d-grid w-100">
                {{ __('Log in') }}
            </x-primary-button>

            <!-- <p class="text-center mt-2">
                <a href="{{ route('register') }}" class=" d-grid w-100">
                  <span>Create an account</span>
                </a>
              </p> -->
        </div>
    </form>
</x-guest-layout>
