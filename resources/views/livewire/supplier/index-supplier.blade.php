<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
    <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-8">

        <!-- Header -->
        <div class="mb-8 flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
            <div>
                <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                    Supplier Management
                </h1>
                <p class="text-sm text-gray-500 mt-1">Kelola data supplier dengan mudah dan efisien</p>
            </div>
            <a href="{{ route('supplier.create') }}" class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl hover:from-blue-600 hover:to-indigo-700 transition-all duration-300 transform hover:scale-105">
                Tambah Supplier
            </a>
        </div>

        <!-- Flash Message -->
        @if($message)
        <div class="mb-6 animate-in slide-in-from-top fade-in">
            <div class="flex items-center justify-between gap-4 px-6 py-4 bg-gradient-to-r from-emerald-50 to-green-50 border-l-4 border-emerald-500 rounded-lg shadow-md backdrop-blur-sm">
                <p class="text-sm font-medium text-emerald-800">{{ $message }}</p>
                <button wire:click="$set('message','')" class="text-emerald-600 hover:text-emerald-800">✖</button>
            </div>
        </div>
        @endif
            <!-- Elegant & Professional Notification -->
@if(session()->has('message'))
    <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
        <div class="group relative overflow-hidden rounded-xl backdrop-blur-md bg-gradient-to-r from-emerald-50 via-green-50 to-emerald-50 border border-emerald-200/50 shadow-lg hover:shadow-xl transition-all duration-300">
            
            <!-- Animated gradient border -->
            <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-emerald-400/20 via-green-300/20 to-emerald-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
            
            <!-- Content Container -->
            <div class="relative px-6 py-4 flex items-start gap-4">
                
                <!-- Icon dengan animated background -->
                <div class="flex-shrink-0 relative">
                    <div class="absolute inset-0 bg-emerald-400 rounded-full blur-md opacity-30 animate-pulse"></div>
                    <div class="relative w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg">
                        <svg class="w-5 h-5 text-white animate-in zoom-in-50 duration-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                </div>

                <!-- Message Container -->
                <div class="flex-1 pt-1">
                    <h3 class="text-sm font-bold text-emerald-900 mb-1">Berhasil!</h3>
                    <p class="text-sm text-emerald-800/80 leading-relaxed">{{ session('message') }}</p>
                </div>

                <!-- Close Button -->
               <button wire:click="$set('message','')"
                    class="flex-shrink-0 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-200/50 rounded-lg p-2 transition-all duration-200 hover:scale-110"
                >
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Progress bar animation -->
            <div class="absolute bottom-0 left-0 h-1 bg-gradient-to-r from-emerald-400 to-green-500 animate-in" 
                 style="animation: slideOut 4s ease-in-out forwards;">
            </div>
        </div>
    </div>

    <style>
        @keyframes slideOut {
            0% { width: 100%; }
            100% { width: 0%; }
        }
    </style>
@endif

        <!-- Search & Per Page -->
        <div class="mb-6 grid grid-cols-1 md:grid-cols-12 gap-4">
            <div class="md:col-span-9 relative">
                <input type="text" wire:model.live.debounce.300ms="search" placeholder="Cari supplier, alamat, atau nomor telepon..." class="w-full pl-4 pr-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm"/>
            </div>
            <div class="md:col-span-3">
                <select wire:model.live="perPage" class="w-full px-4 py-3 bg-white border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 shadow-sm cursor-pointer">
                    <option value="10">10 per halaman</option>
                    <option value="25">25 per halaman</option>
                    <option value="50">50 per halaman</option>
                    <option value="100">100 per halaman</option>
                </select>
            </div>
        </div>

        <!-- Premium Professional Table Design -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600 flex items-center gap-2">
                                    
                                    No
                                </span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                    </svg>
                                    Nama Supplier
                                </span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    Alamat
                                </span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 00.948-.684l1.498-4.493a1 1 0 011.502-.684l1.498 4.493a1 1 0 00.948.684H19a2 2 0 012 2v14a2 2 0 01-2 2H5a2 2 0 01-2-2V5z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                    No Telepon
                                </span>
                            </th>
                            <th class="px-6 py-4 text-left">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600 flex items-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                    </svg>
                                    Email
                                </span>
                            </th>
                            <th class="px-6 py-4 text-center">
                                <span class="text-xs font-bold uppercase tracking-widest text-gray-600 flex items-center justify-center gap-2">
                                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 5v.01M12 12v.01M12 19v.01M12 6a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2zm0 7a1 1 0 110-2 1 1 0 010 2z"></path>
                                    </svg>
                                    Aksi
                                </span>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($suppliers as $index => $supplier)
                            <tr wire:key="supplier-{{ $supplier->id }}" 
                                class="group hover:bg-gradient-to-r hover:from-blue-50 hover:via-indigo-50 hover:to-blue-50 transition-all duration-300 border-l-4 border-transparent hover:border-indigo-500">
                                
                                <!-- No -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center">
                                        <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 text-sm font-bold text-indigo-700 group-hover:from-indigo-500 group-hover:to-blue-500 group-hover:text-white transition-all duration-300 shadow-sm">
                                            {{ $suppliers->firstItem() + $index }}
                                        </span>
                                    </div>
                                </td>

                                <!-- Nama Supplier -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-3">
                                        
                                        <div>
                                            <p class="font-semibold text-gray-900 group-hover:text-indigo-600 transition-colors duration-200">
                                                {{ $supplier->nama_supplier }}
                                            </p>
                                           
                                        </div>
                                    </div>
                                </td>

                                <!-- Alamat -->
                                <td class="px-6 py-4">
                                    <div class="flex items-start gap-2">
                                       
                                        <div class="max-w-xs">
                                            <p class="text-sm text-gray-600 leading-relaxed line-clamp-2" title="{{ $supplier->alamat }}">
                                                {{ Str::limit($supplier->alamat, 50) }}
                                            </p>
                                        </div>
                                    </div>
                                </td>

                                <!-- No Telepon -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="flex items-center gap-2">
                                        
                                        <span class="text-sm font-medium text-gray-700">{{ $supplier->no_telepon }}</span>
                                    </div>
                                </td>

                                <!-- Email -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    @if($supplier->email)
                                        <div class="flex items-center gap-2">
                                            
                                            <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-purple-100 text-purple-700">
                                                {{ $supplier->email }}
                                            </span>
                                        </div>
                                    @else
                                        <span class="inline-flex items-center px-3 py-1 text-xs font-medium rounded-full bg-gray-100 text-gray-500">
                                            <svg class="w-3 h-3 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            Tidak ada
                                        </span>
                                    @endif
                                </td>

                                <!-- Aksi -->
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class=" items-center justify-center ">
                                        <a href="{{ route('supplier.edit', $supplier->id) }}" 
                                        class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-medium text-sm shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                            </svg>
                                            Edit
                                        </a>
                                        <button wire:click.prevent="confirmDelete({{ $supplier->id }})" 
                                                class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-gradient-to-r from-red-500 to-pink-600 text-white font-medium text-sm shadow-md hover:shadow-lg transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                            Hapus
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-16 text-center">
                                    <div class="flex flex-col items-center justify-center gap-4">
                                        <!-- Icon Empty State -->
                                        <div class="relative">
                                            <div class="w-20 h-20 rounded-full bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                                                <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4"></path>
                                                </svg>
                                            </div>
                                            <!-- Decorative circles -->
                                            <div class="absolute -top-1 -right-1 w-6 h-6 rounded-full bg-blue-100 animate-ping"></div>
                                            <div class="absolute -bottom-1 -left-1 w-4 h-4 rounded-full bg-indigo-100"></div>
                                        </div>
                                        
                                        <!-- Text -->
                                        <div class="space-y-2">
                                            <p class="text-lg font-semibold text-gray-700">Tidak ada data supplier</p>
                                            <p class="text-sm text-gray-500">Mulai dengan menambahkan supplier baru untuk sistem Anda</p>
                                        </div>

                                        <!-- CTA Button -->
                                        <a href="{{ route('supplier.create') }}" 
                                        class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transform hover:scale-105 transition-all duration-200">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                                            </svg>
                                            Tambah Supplier Pertama
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>



        <!-- Pagination -->
        <div class="mt-6">
            {{ $suppliers->links() }}
        </div>

        <!-- Delete Modal -->
        @if($showDeleteModal)
        <div class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 p-4">
            <div class="bg-white rounded-2xl shadow-2xl p-6 w-full max-w-md">
                <h3 class="text-lg font-bold text-center mb-4">Hapus Supplier?</h3>
                <p class="text-center mb-6">Apakah Anda yakin ingin menghapus supplier ini? Data yang dihapus tidak dapat dikembalikan.</p>
                <div class="flex gap-3">
                    <button wire:click.prevent="closeDeleteModal" class="flex-1 px-4 py-2 bg-gray-100 rounded-lg">Batal</button>
                    <button wire:click.prevent="delete" class="flex-1 px-4 py-2 bg-red-500 text-white rounded-lg">Hapus Sekarang</button>
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
