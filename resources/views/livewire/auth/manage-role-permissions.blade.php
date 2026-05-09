<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-6 px-4">
    <div class="max-w-7xl mx-auto">

        {{-- Header --}}
        <div class="mb-6">
            <h1 class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Kelola Hak Akses Role
            </h1>
        </div>

        {{-- Flash Success --}}
        @if ($this->flashSuccess)
            <div class="mb-6">
                <div class="group relative overflow-hidden rounded-xl bg-gradient-to-r from-emerald-50 via-green-50 to-emerald-50 border border-emerald-200/50 shadow-lg">
                    <div class="px-6 py-4 flex items-start gap-4">
                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg flex-shrink-0">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
                        </div>
                        <div class="flex-1 pt-1">
                            <h3 class="text-sm font-bold text-emerald-900 mb-1">Berhasil!</h3>
                            <p class="text-sm text-emerald-800/80">{{ $this->flashSuccess }}</p>
                        </div>
                        <button wire:click="$set('flashSuccess', null)" class="text-emerald-600 hover:text-emerald-800 p-2 rounded-lg transition-all">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </button>
                    </div>
                </div>
            </div>
        @endif

        {{-- Flash Error --}}
        @if ($this->flashError)
            <div class="mb-6">
                <div class="flex items-center justify-between gap-4 px-6 py-4 bg-gradient-to-r from-red-50 to-pink-50 border-l-4 border-red-500 rounded-lg shadow-md">
                    <p class="text-sm font-medium text-red-800">{{ $flashError }}</p>
                    <button wire:click="$set('flashError', null)" class="text-red-600 hover:text-red-800">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </button>
                </div>
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-4 gap-6">

            {{-- Daftar Roles --}}
            <div class="lg:col-span-1">
                <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="p-5 bg-gradient-to-r from-blue-500 to-indigo-600">
                        <h2 class="text-lg font-bold text-white">Daftar Role</h2>
                    </div>
                    <div class="p-4">
                        @foreach($this->roles as $role)
                            <button
                                wire:click="selectRole({{ $role->id }})"
                                @class([
                                    'w-full text-left p-4 mb-3 rounded-xl border-2 transition-all',
                                    'bg-gradient-to-r from-blue-500 to-indigo-600 text-white border-indigo-600' => $selectedRoleId === $role->id,
                                    'bg-white hover:bg-blue-50 text-gray-900 border-gray-200' => $selectedRoleId !== $role->id,
                                ])>
                                <div class="flex items-center gap-3">
                                    <div class="flex-1">
                                        <p class="font-semibold">{{ $role->name }}</p>
                                        <p @class([
                                            'text-xs',
                                            'text-white/80' => $selectedRoleId === $role->id,
                                            'text-gray-500' => $selectedRoleId !== $role->id,
                                        ])>
                                            Level {{ $role->level }}
                                        </p>
                                    </div>
                                </div>
                            </button>
                        @endforeach
                    </div>
                </div>
            </div>

            {{-- Permissions --}}
            <div class="lg:col-span-3">
                @if($this->selectedRole)
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 overflow-hidden">
                        <div class="p-5 bg-gradient-to-r from-indigo-500 to-purple-600 text-white">
                            <div class="flex items-center justify-between">
                                <div>
                                    <h2 class="text-lg font-bold">Hak Akses: {{ $this->selectedRole->name }}</h2>
                                    <p class="text-sm opacity-90">{{ $this->selectedRole->description }}</p>
                                </div>
                            </div>
                        </div>

                        <div class="p-6 max-h-[600px] overflow-y-auto">
                            @foreach($this->permissionsGrouped as $menu)
                                <div class="mb-6 bg-gray-50 rounded-xl p-4">

                                    {{-- Menu Header --}}
                                    <div class="flex items-center justify-between mb-4 pb-3 border-b-2 border-gray-200">
                                        <div class="flex items-center gap-3">
                                            <div>
                                                <p class="font-bold text-gray-900">{{ $menu->name }}</p>
                                            </div>
                                        </div>
                                       
                                    </div>

                                    {{-- Children Permissions --}}
                                    @if($menu->children->isNotEmpty())
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-3 pl-4">
                                            @foreach($menu->children as $feature)
                                                <label class="flex items-start gap-3 p-3 rounded-lg border-2 border-gray-200 hover:border-indigo-300 hover:bg-white cursor-pointer transition-all">
                                                    <input
                                                        type="checkbox"
                                                        wire:click="togglePermission({{ $feature->id }})"
                                                        @checked(in_array($feature->id, $rolePermissions))
                                                        class="mt-0.5 w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500"
                                                    />
                                                    <div>
                                                        <p class="text-sm font-semibold text-gray-900">{{ $feature->name }}</p>
                                                        @if($feature->description)
                                                            <p class="text-xs text-gray-500">{{ $feature->description }}</p>
                                                        @endif
                                                    </div>
                                                </label>
                                            @endforeach
                                        </div>
                                    @endif

                                </div>
                            @endforeach
                        </div>

                        <div class="p-5 bg-gray-50 border-t flex justify-between items-center">
                            <div class="text-sm text-gray-600">
                                <span class="font-semibold">{{ count($rolePermissions) }}</span> permissions dipilih
                            </div>
                            <div class="flex gap-3">
                                <button
                                    wire:click="clearSelection"
                                    class="px-6 py-2 border-2 border-gray-300 hover:bg-gray-100 text-gray-700 font-semibold rounded-lg transition-all">
                                    Batal
                                </button>
                                <button
                                    wire:click="savePermissions" wire:loading.attr="disabled"
                                    class="px-6 py-2 bg-gradient-to-r from-indigo-500 to-purple-600 hover:from-indigo-600 hover:to-purple-700 text-white font-semibold rounded-lg transition-all shadow-lg">
                                    <span wire:loading.remove>
                            + Simpan Perubahan
                        </span>
                        <span wire:loading>
                            
                             <i class='bx bx-time'></i>  Memproses...
                        </span>
                                </button>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="bg-white rounded-xl shadow-lg border border-gray-200 p-12 text-center">
                        <p class="text-lg font-semibold text-gray-500">Pilih role untuk mengelola hak akses</p>
                    </div>
                @endif
            </div>

        </div>
    </div>
</div>