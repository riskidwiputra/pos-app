<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8">
            <div class="flex items-center justify-between mb-6">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Setting Kategori Order Jasa
                    </h1>
                    <p class="text-sm text-gray-500 mt-1">Pilih kategori dan sub kategori yang tersedia untuk order jasa</p>
                </div>
                <a 
                    href="{{ route('order-jasa.index') }}"
                    class="inline-flex items-center gap-2 px-4 py-2 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    Kembali
                </a>
            </div>

            {{-- Flash Message --}}
            @if(session()->has('success'))
                <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
                    <div class="rounded-xl bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"></path>
                                </svg>
                            </div>
                            <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                        </div>
                    </div>
                </div>
            @endif

            @if(session()->has('error'))
                <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
                    <div class="rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 p-4">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center">
                                <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                </svg>
                            </div>
                            <p class="text-red-800 font-medium">{{ session('error') }}</p>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        

        {{-- Main Content --}}
        <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
            <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                <div class="flex items-center justify-between">
                    <h2 class="text-lg font-semibold text-gray-900">Daftar Kategori</h2>
                    
                </div>
            </div>

            <div class="p-6">
                <div class="space-y-3">
                   <div class="group">
                        <label class="block text-sm font-semibold text-gray-800 mb-2">
                            Kategori <span class="text-red-500 font-bold">*</span>
                        </label>
                        <select 
                            wire:model.live="category_id"
                            class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 transition-all duration-200 hover:border-gray-300 cursor-pointer @error('category_id') border-red-500 focus:border-red-500 focus:ring-red-200 @enderror"
                        >
                            <option value="">Pilih Kategori</option>
                            @foreach($this->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                            @endforeach
                        </select>
                        @error('category_id') 
                            <div class="mt-2 flex items-center gap-2 text-red-600 text-sm">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                </div>
            </div>

            {{-- Footer Actions --}}
            <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-t border-gray-200 flex items-center justify-between">
                
                <button 
                    wire:click="update"
                    class="px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-bold rounded-xl shadow-lg hover:shadow-xl transition-all transform hover:scale-105">
                    <span class="flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                        Simpan Pengaturan
                    </span>
                </button>
            </div>
        </div>

    </div>
</div>