<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="container-xxl w-full">
        
        <!-- Header with Back Button -->
        <div class="mb-8">
            <a href="{{ route('unit.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>

            <div class="flex items-center gap-4 mb-2">
                
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Tambah Unit </h1>
                    
                </div>
            </div>
        </div>

        <!-- Main Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            
            <!-- Form Header -->
            <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-8 py-6 border-b border-gray-200">
                <div class=" items-center ">
                    
     
                        <h3 class=" font-semibold text-gray-900">Form Unit</h3>
                       
    
                </div>
            </div>

            <!-- Form Content -->
            <form wire:submit.prevent="store" class="p-8 space-y-6">
                
                <!-- Nama Supplier -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Nama unit <span class="text-red-500 font-bold">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute inset-y-0 left-0 pl-4 flex items-center pointer-events-none">
                           
                        </div>
                        <input 
                            type="text" 
                            wire:model="nama_unit" 
                            placeholder="Nama unityyh"
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('nama_unit') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                    </div>
                    @error('nama_unit') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                           
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <!-- Alamat -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Singkatan <span class="text-red-500 font-bold">*</span>
                    </label>
                    <div class="relative">
                        <div class="absolute top-4 left-0 pl-4 pointer-events-none">
                           
                        </div>
                        <input 
                            type="text" 
                            wire:model="singkatan" 
                            placeholder="Cm"
                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 @error('nama_unit') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                    </div>
                    @error('singkatan') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                           
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                

                <!-- Button Section -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('unit.index') }}"
                        class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                   <button 
                        type="submit" wire:loading.attr="disabled"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-3"
                    >
                        <span wire:loading.remove>
                            + Simpan Unit
                        </span>
                        <span wire:loading>
                            
                           <i class='bx bx-loader-alt animate-spin'></i> Memproses...
                        </span>
                    </button>
                </div>
            </form>
        </div>

       
        
    </div>
</div>