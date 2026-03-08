<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 "> 
    <div class="container mx-auto px-8 sm:px-6 lg:px-8 py-8">
        
        <!-- Header with Back Button -->
        <div class="mb-8">
            <a href="{{ route('product.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar Produk
            </a>

            <div class="flex items-center gap-4">
                <div class="w-16 h-16 rounded-2xl bg-gradient-to-br from-blue-500 to-indigo-600 flex items-center justify-center shadow-lg">
                    <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                    </svg>
                </div>
                <div>
                    <h1 class="text-3xl font-bold text-gray-900">Upload Produk Massal</h1>
                    <p class="text-sm text-gray-500 mt-1">Import banyak produk sekaligus menggunakan file Excel</p>
                </div>
            </div>
        </div>

        <!-- Success Message -->
        @if($importFinished)
        <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
            <div class="group relative overflow-hidden rounded-xl backdrop-blur-md bg-gradient-to-r from-emerald-50 via-green-50 to-emerald-50 border border-emerald-200/50 shadow-lg">
                <div class="relative px-6 py-4 flex items-start gap-4">
                    <div class="flex-shrink-0 relative">
                        <div class="absolute inset-0 bg-emerald-400 rounded-full blur-md opacity-30 animate-pulse"></div>
                        <div class="relative w-10 h-10 rounded-full bg-gradient-to-br from-emerald-500 to-green-600 flex items-center justify-center shadow-lg">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                        </div>
                    </div>
                    <div class="flex-1 pt-1">
                        <h3 class="text-sm font-bold text-emerald-900 mb-1">Import Berhasil!</h3>
                        <p class="text-sm text-emerald-800/80">Berhasil mengimpor {{ $importedCount }} produk ke dalam sistem</p>
                    </div>
                    <button wire:click="resetImport" class="flex-shrink-0 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-200/50 rounded-lg p-2 transition-all duration-200">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <!-- Instructions Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 mb-6">
            <div class="bg-gradient-to-r from-blue-500 to-indigo-600 px-6 py-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    Cara Menggunakan
                </h2>
            </div>
            <div class="p-6">
                <div class="space-y-4">
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold flex items-center justify-center">1</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 mb-1">Download Template Excel</h3>
                            <p class="text-sm text-gray-600">Klik tombol "Download Template" untuk mendapatkan file Excel dengan format yang sudah sesuai</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold flex items-center justify-center">2</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 mb-1">Isi Data Produk</h3>
                            <p class="text-sm text-gray-600">Isi data produk pada file Excel sesuai dengan kolom yang tersedia. Pastikan kategori, sub kategori, dan unit sudah terdaftar di sistem</p>
                        </div>
                    </div>
                    
                    <div class="flex gap-4">
                        <div class="flex-shrink-0 w-8 h-8 rounded-full bg-blue-100 text-blue-600 font-bold flex items-center justify-center">3</div>
                        <div class="flex-1">
                            <h3 class="font-semibold text-gray-900 mb-1">Upload File</h3>
                            <p class="text-sm text-gray-600">Upload file Excel yang sudah diisi dan klik "Import Produk"</p>
                        </div>
                    </div>
                </div>

                <div class="mt-6 pt-6 border-t border-gray-200">
                    <button 
                        wire:click="downloadTemplate"
                        class="w-full sm:w-auto inline-flex items-center justify-center gap-2 px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                        </svg>
                        Download Template Excel
                    </button>
                </div>
            </div>
        </div>

        <!-- Upload Form Card -->
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="bg-gradient-to-r from-slate-50 via-blue-50 to-slate-50 px-6 py-4 border-b border-gray-200">
                <h2 class="text-xl font-bold text-gray-900">Upload File Excel</h2>
            </div>
            
            <form wire:submit.prevent="import" class="p-6 space-y-6">
                
                <!-- File Upload -->
                <div class="group">
                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                        Pilih File Excel <span class="text-red-500 font-bold">*</span>
                    </label>
                    <div class="relative">
                        <input 
                            type="file" 
                            wire:model="file" 
                            accept=".xlsx,.xls"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100 @error('file') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                    </div>
                    
                    @if($file)
                        <div class="mt-3 p-3 bg-blue-50 rounded-lg border border-blue-200">
                            <div class="flex items-center gap-3">
                                <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path>
                                </svg>
                                <div class="flex-1">
                                    <p class="text-sm font-semibold text-blue-900">{{ $file->getClientOriginalName() }}</p>
                                    <p class="text-xs text-blue-600">{{ number_format($file->getSize() / 1024, 2) }} KB</p>
                                </div>
                                <button 
                                    type="button"
                                    wire:click="$set('file', null)"
                                    class="text-red-500 hover:text-red-700 hover:bg-red-100 rounded-lg p-2 transition-all"
                                >
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                    @endif

                    @error('file') 
                        <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            {{ $message }}
                        </div>
                    @enderror
                    
                    <p class="mt-2 text-xs text-gray-500">Format: .xlsx atau .xls | Maksimal 5MB</p>
                </div>

                <!-- Errors Display -->
                @if(!empty($importErrors) && count($importErrors) > 0)
                <div class="bg-red-50 border-l-4 border-red-500 rounded-lg p-4">
                    <div class="flex items-start gap-3">
                        <svg class="w-6 h-6 text-red-600 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div class="flex-1">
                            <h3 class="font-semibold text-red-900 mb-2">Terdapat Error pada Import ({{ count($importErrors) }} error)</h3>
                            
                            <div class="space-y-1 max-h-60 overflow-y-auto">
                                @foreach($importErrors as $error)
                                <p class="text-sm text-red-700">• {{ $error }}</p>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Loading Indicator -->
                @if($importing)
                <div class="bg-blue-50 border-l-4 border-blue-500 rounded-lg p-4">
                    <div class="flex items-center gap-3">
                        <svg class="animate-spin w-6 h-6 text-blue-600" fill="none" viewBox="0 0 24 24">
                            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
                            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
                        </svg>
                        <div>
                            <p class="font-semibold text-blue-900">Sedang mengimpor data...</p>
                            <p class="text-sm text-blue-700">Mohon tunggu, jangan tutup halaman ini</p>
                        </div>
                    </div>
                </div>
                @endif

                <!-- Button Section -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <a 
                        href="{{ route('product.index') }}"
                        class="flex-1 px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-lg transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-2"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        Batal
                    </a>
                    <button 
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="import"
                        class="flex-1 px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 flex items-center justify-center gap-2 disabled:opacity-50 disabled:cursor-not-allowed"
                    >
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16a4 4 0 01-.88-7.903A5 5 0 1115.9 6L16 6a5 5 0 011 9.9M15 13l-3-3m0 0l-3 3m3-3v12"></path>
                        </svg>
                        <span wire:loading.remove wire:target="import">Import Produk</span>
                        <span wire:loading wire:target="import">Mengimpor...</span>
                    </button>
                </div>
            </form>
        </div>

    </div>
</div>

<script>
    document.addEventListener('livewire:init', () => {
        Livewire.on('import-finished', () => {
            setTimeout(() => {
                window.location.href = '{{ route("product.index") }}';
            }, 2000);
        });
    });
</script>