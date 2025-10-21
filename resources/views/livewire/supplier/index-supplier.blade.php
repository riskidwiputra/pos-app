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

        <!-- Table -->
        <div class="bg-white rounded-xl shadow-xl overflow-hidden border border-gray-200 hover:shadow-2xl transition-shadow duration-300">
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr class="bg-gradient-to-r from-slate-50 to-gray-100 border-b-2 border-gray-200">
                            <th class="px-6 py-4 text-left">No</th>
                            <th class="px-6 py-4 text-left">Nama Supplier</th>
                            <th class="px-6 py-4 text-left">Alamat</th>
                            <th class="px-6 py-4 text-left">No Telepon</th>
                            <th class="px-6 py-4 text-left">Email</th>
                            <th class="px-6 py-4 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @forelse($suppliers as $index => $supplier)
                        <tr wire:key="supplier-{{ $supplier->id }}" class="hover:bg-gradient-to-r hover:from-blue-50 to-indigo-50 transition-all duration-200">
                            <td class="px-6 py-4">{{ $suppliers->firstItem() + $index }}</td>
                            <td class="px-6 py-4">{{ $supplier->nama_supplier }}</td>
                            <td class="px-6 py-4">{{ Str::limit($supplier->alamat,50) }}</td>
                            <td class="px-6 py-4">{{ $supplier->no_telepon }}</td>
                            <td class="px-6 py-4">{{ $supplier->email ?? 'Tidak ada' }}</td>
                            <td class="px-6 py-4 text-center flex justify-center gap-2">
                                <a href="{{ route('supplier.edit', $supplier->id) }}" class="px-3 py-2 bg-blue-50 text-blue-600 rounded-lg text-sm hover:bg-blue-100">Edit</a>
                                <button wire:click.prevent="confirmDelete({{ $supplier->id }})" class="px-3 py-2 bg-red-50 text-red-600 rounded-lg text-sm hover:bg-red-100">Hapus</button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-10 text-gray-500">Tidak ada data supplier</td>
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
