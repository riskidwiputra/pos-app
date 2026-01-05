<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Daftar Role
            </h1>
            <p class="text-sm text-gray-500 mt-1">Kelola permission untuk setiap role</p>
        </div>

        <!-- Success Message -->
        @if(session()->has('message'))
        <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
            <div class="bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200/50 rounded-xl px-6 py-4 flex items-center gap-4">
                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center">
                    <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <p class="text-sm text-emerald-800">{{ session('message') }}</p>
            </div>
        </div>
        @endif

        <!-- Search & Filter -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-10">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari role..." 
                       class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm"/>
            </div>
            <div class="md:col-span-2">
                <select wire:model.live="perPage" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm cursor-pointer">
                    <option value="10">10 per halaman</option>
                    <option value="25">25 per halaman</option>
                    <option value="50">50 per halaman</option>
                </select>
            </div>
        </div>

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">No</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Nama Role</span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Judul Role</span>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Jml. Module</span>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Jml. Permission</span>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600">Action</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($roles as $index => $role)
                            <tr class="group hover:bg-gradient-to-r hover:from-blue-50 hover:via-indigo-50 hover:to-blue-50 transition-all duration-300">
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 text-sm font-bold text-indigo-700 group-hover:from-indigo-500 group-hover:to-blue-500 group-hover:text-white transition-all duration-300">
                                        {{ $roles->firstItem() + $index }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <p class="font-semibold text-gray-900">{{ $role->name }}</p>
                                </td>
                                <td class="px-6 py-4">
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-700">
                                        {{ $role->slug }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-purple-100 text-purple-700 font-bold text-sm">
                                        {{ $role->permissions->unique('module')->count() }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-indigo-100 text-indigo-700 font-bold text-sm">
                                        {{ $role->permissions_count }}
                                    </span>
                                </td>
                                <td class="px-6 py-4">
                                    <div class="flex items-center justify-center">
                                        <button wire:click="openEditModal({{ $role->id }})" 
                                                class="inline-flex items-center gap-1 px-4 py-2 rounded-lg bg-gradient-to-r from-green-500 to-emerald-600 text-white font-medium text-xs shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <p class="text-gray-500">Tidak ada data role</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Pagination -->
        <div class="mt-6">
            {{ $roles->links() }}
        </div>

        <!-- Edit Permission Modal (Gambar 5) -->
        @if($showEditModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl w-full max-w-5xl max-h-[90vh] overflow-hidden flex flex-col">
                
                <!-- Modal Header -->
                <div class="border-b px-6 py-4 flex items-center justify-between bg-gradient-to-r from-blue-50 to-indigo-50">
                    <div>
                        <h3 class="text-xl font-bold text-gray-900">Edit Role Permission</h3>
                        <p class="text-sm text-gray-600 mt-1">
                            Role: <span class="font-semibold">{{ $roles->find($selectedRoleId)->name ?? '' }}</span>
                        </p>
                    </div>
                    <button wire:click="closeEditModal" class="text-gray-400 hover:text-gray-600 transition">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>

                <!-- Assign All Checkbox -->
                <div class="px-6 py-4 bg-gray-50 border-b">
                    <label class="flex items-center gap-3 cursor-pointer">
                        <input type="checkbox" wire:click="toggleAssignAll" {{ $assignAll ? 'checked' : '' }} 
                               class="w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                        <span class="text-sm font-medium text-gray-700">
                            Assign/Unassign semua permission ke role {{ $roles->find($selectedRoleId)->name ?? '' }}
                        </span>
                    </label>
                </div>

                <!-- Permissions List (Scrollable) -->
                <div class="flex-1 overflow-y-auto p-6">
                    <div class="space-y-6">
                        @foreach($groupedPermissions as $module => $permissions)
                            <div class="border border-gray-200 rounded-xl overflow-hidden">
                                <!-- Module Header -->
                                <div class="bg-gradient-to-r from-slate-100 to-blue-100 px-4 py-3 border-b border-gray-200">
                                    <h4 class="font-bold text-gray-800 flex items-center gap-2">
                                        <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7v10a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-6l-2-2H5a2 2 0 00-2 2z"></path>
                                        </svg>
                                        {{ $module }}
                                        <span class="ml-auto text-xs font-normal text-gray-600">
                                            {{ $permissions->count() }} permissions
                                        </span>
                                    </h4>
                                </div>

                                <!-- Permissions in Module -->
                                <div class="divide-y divide-gray-100">
                                    @foreach($permissions as $permission)
                                        <label class="flex items-start gap-3 p-4 hover:bg-blue-50 transition cursor-pointer group">
                                            <input type="checkbox" wire:model="selectedPermissions" value="{{ $permission->id }}" 
                                                   class="mt-1 w-5 h-5 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500">
                                            <div class="flex-1">
                                                <div class="flex items-center gap-2">
                                                    <span class="font-medium text-gray-900 group-hover:text-indigo-600 transition">
                                                        {{ $permission->name }}
                                                    </span>
                                                    <span class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium {{ $permission->type === 'menu' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700' }}">
                                                        {{ ucfirst($permission->type) }}
                                                    </span>
                                                </div>
                                                <p class="text-xs text-gray-500 mt-1">
                                                    {{ $permission->description ?? 'Tidak ada deskripsi' }}
                                                </p>
                                                @if($permission->url)
                                                    <p class="text-xs text-gray-400 mt-1 font-mono">
                                                        {{ $permission->url }}
                                                    </p>
                                                @endif
                                            </div>
                                        </label>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="border-t px-6 py-4 bg-gray-50 flex gap-3">
                    <button type="button" wire:click="closeEditModal" 
                            class="flex-1 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-medium rounded-lg transition">
                        Batal
                    </button>
                    <button wire:click="savePermissions" 
                            class="flex-1 px-4 py-2 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-medium rounded-lg transition shadow-lg">
                        Simpan Perubahan
                    </button>
                </div>

            </div>
        </div>
        @endif

    </div>
</div>