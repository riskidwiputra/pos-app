<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- ── FORM PROFIL ──────────────────────────────────────────── --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">Profile Saya</h2>

                    @if(session('status') === 'profile-updated')
                        <p class="mt-2 text-sm text-green-600">Profil berhasil diperbarui.</p>
                    @endif

                    <form method="post" action="{{ route('profile-admin.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('patch')

                        {{-- Nama Lengkap --}}
                        <div>
                            <x-input-label for="name" value="Nama" />
                            <x-text-input id="name" name="name" type="text"
                                class="mt-1 block w-full"
                                value="{{ old('name', $user->name ?? '') }}"
                                autocomplete="name" />
                            <x-input-error :messages="$errors->get('name')" class="mt-2" />
                        </div>

                        {{-- Username --}}
                        <div>
                            <x-input-label for="username" value="Username" />
                            <x-text-input id="username" name="username" type="text"
                                class="mt-1 block w-full"
                                value="{{ old('username', $user->username ?? '') }}"
                                autocomplete="username" />
                            <x-input-error :messages="$errors->get('username')" class="mt-2" />
                        </div>

                        {{-- Email --}}
                        <div>
                            <x-input-label for="email" value="Email" />
                            <x-text-input id="email" name="email" type="email"
                                class="mt-1 block w-full"
                                value="{{ old('email', $user->email) }}"
                                autocomplete="username" />
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- ── FORM GANTI PASSWORD ──────────────────────────────────── --}}
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    <h2 class="text-lg font-medium text-gray-900">Ganti Password</h2>

                    @if(session('status') === 'password-updated')
                        <p class="mt-2 text-sm text-green-600">Password berhasil diperbarui.</p>
                    @endif

                    <form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
                        @csrf
                        @method('put')

                        {{-- Password Saat Ini --}}
                        <div>
                            <x-input-label for="current_password" value="Password Saat Ini" />
                            <x-text-input id="current_password" name="current_password" type="password"
                                class="mt-1 block w-full"
                                autocomplete="current-password" />
                            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2" />
                        </div>

                        {{-- Password Baru --}}
                        <div>
                            <x-input-label for="password" value="Password Baru" />
                            <x-text-input id="password" name="password" type="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2" />
                        </div>

                        {{-- Konfirmasi Password --}}
                        <div>
                            <x-input-label for="password_confirmation" value="Konfirmasi Password" />
                            <x-text-input id="password_confirmation" name="password_confirmation" type="password"
                                class="mt-1 block w-full"
                                autocomplete="new-password" />
                            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2" />
                        </div>

                        <div class="flex items-center gap-4">
                            <x-primary-button>Simpan</x-primary-button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</x-app-layout>