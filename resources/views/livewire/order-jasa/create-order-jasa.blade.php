<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">
        
        {{-- Header --}}
        <div class="mb-8">
            <a href="{{ route('order-jasa.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>

            <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                Tambah Order Jasa Baru
            </h1>
            <p class="text-sm text-gray-500 mt-1">Buat pesanan jasa percetakan baru untuk customer</p>
        </div>

        <form wire:submit.prevent="save">
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                
                {{-- Left Side - Form --}}
                <div class="lg:col-span-2 space-y-6">
                    
                    {{-- Informasi Customer --}}
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Informasi Customer</h2>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Nama Customer <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    wire:model="customer_name"
                                    placeholder="Nama lengkap customer..."
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('customer_name') border-red-500 @enderror"
                                />
                                @error('customer_name')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        No. Telepon <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="text" 
                                        wire:model="customer_phone"
                                        placeholder="08xxxxxxxxxx"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('customer_phone') border-red-500 @enderror"
                                    />
                                    @error('customer_phone')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Email <span class="text-gray-400 text-xs">(Opsional)</span>
                                    </label>
                                    <input 
                                        type="email" 
                                        wire:model="customer_email"
                                        placeholder="email@example.com"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('customer_email') border-red-500 @enderror"
                                    />
                                    @error('customer_email')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Detail Order --}}
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                        <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                            <h2 class="text-lg font-semibold text-gray-900">Detail Order Jasa</h2>
                        </div>
                        
                        <div class="p-6 space-y-4">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Kategori Jasa <span class="text-red-500">*</span>
                                    </label>
                                    <select 
                                        wire:model.live="category_id"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 cursor-pointer @error('category_id') border-red-500 @enderror"
                                    >
                                        <option value="">Pilih Kategori</option>
                                        @foreach($this->categories() as $category)
                                            <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Judul/Nama Pesanan <span class="text-red-500">*</span>
                                </label>
                                <input 
                                    type="text" 
                                    wire:model="order_title"
                                    placeholder="Contoh: Cetak Spanduk Event..."
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('order_title') border-red-500 @enderror"
                                />
                                @error('order_title')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Deskripsi Detail <span class="text-red-500">*</span>
                                </label>
                                <textarea 
                                    wire:model="order_description"
                                    rows="4"
                                    placeholder="Jelaskan detail pesanan: ukuran, bahan, warna, finishing, dll..."
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none @error('order_description') border-red-500 @enderror"
                                ></textarea>
                                @error('order_description')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Jumlah <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="number" 
                                        wire:model="quantity"
                                        min="1"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('quantity') border-red-500 @enderror"
                                    />
                                    @error('quantity')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Satuan <span class="text-red-500">*</span>
                                    </label>
                                    <select 
                                        wire:model="unit"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 cursor-pointer @error('unit') border-red-500 @enderror"
                                    >
                                        <option value="pcs">Pcs</option>
                                        <option value="lembar">Lembar</option>
                                        <option value="meter">Meter</option>
                                        <option value="set">Set</option>
                                        <option value="box">Box</option>
                                        <option value="rim">Rim</option>
                                        <option value="roll">Roll</option>
                                    </select>
                                    @error('unit')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Tanggal Order <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="date" 
                                        wire:model="order_date"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('order_date') border-red-500 @enderror"
                                    />
                                    @error('order_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Estimasi Selesai <span class="text-red-500">*</span>
                                    </label>
                                    <input 
                                        type="date" 
                                        wire:model="estimated_completion_date"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('estimated_completion_date') border-red-500 @enderror"
                                    />
                                    @error('estimated_completion_date')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Total Harga <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                        <input 
                                            type="number" 
                                            wire:model="total_price"
                                            min="0"
                                            step="1000"
                                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('total_price') border-red-500 @enderror"
                                        />
                                    </div>
                                    @error('total_price')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div>
                                    <label class="block text-sm font-semibold text-gray-800 mb-2">
                                        Jumlah Pembayaran <span class="text-red-500">*</span>
                                    </label>
                                    <div class="relative">
                                        <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                        <input 
                                            type="number" 
                                            wire:model="payment"
                                            min="0"
                                            step="1000"
                                            class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 @error('payment') border-red-500 @enderror"
                                        />
                                    </div>
                                    @error('payment')
                                        <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                    @enderror
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Upload File Desain <span class="text-gray-400 text-xs">(Opsional)</span>
                                </label>
                                <input 
                                    type="file" 
                                    wire:model="design_file"
                                    accept=".pdf,.jpg,.jpeg,.png,.zip,.rar,.ai,.psd,.cdr"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 @error('design_file') border-red-500 @enderror"
                                />
                                <p class="mt-1 text-xs text-gray-500">Format: PDF, JPG, PNG, ZIP, RAR, AI, PSD, CDR (Max: 10MB)</p>
                                @error('design_file')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                                
                                @if($design_file)
                                    <div class="mt-2 p-3 bg-blue-50 border border-blue-200 rounded-lg">
                                        <p class="text-sm text-blue-700">
                                            <span class="font-semibold">File dipilih:</span> {{ $design_file->getClientOriginalName() }}
                                        </p>
                                    </div>
                                @endif
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Catatan Tambahan <span class="text-gray-400 text-xs">(Opsional)</span>
                                </label>
                                <textarea 
                                    wire:model="notes"
                                    rows="3"
                                    placeholder="Catatan atau permintaan khusus..."
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none"
                                ></textarea>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Status Order <span class="text-red-500">*</span>
                                </label>
                                <select 
                                    wire:model="status"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 cursor-pointer"
                                >
                                    <option value="pending">Menunggu Persetujuan</option>
                                    <option value="approved">Disetujui</option>
                                    <option value="in_progress">Sedang Diproses</option>
                                    <option value="completed">Selesai</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- Right Side - Summary --}}
                <div class="lg:col-span-1">
                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 sticky top-8">
                        <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-4">
                            <h2 class="text-lg font-semibold text-white">Ringkasan Order</h2>
                        </div>

                        <div class="p-6 space-y-4">
                            <div class="border-b border-gray-200 pb-4">
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Total Harga:</span>
                                    <span class="font-bold text-gray-900">
                                        Rp {{ number_format($total_price, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex justify-between mb-2">
                                    <span class="text-gray-600">Uang Muka (DP):</span>
                                    <span class="font-bold text-green-600">
                                        Rp {{ number_format($payment, 0, ',', '.') }}
                                    </span>
                                </div>
                                <div class="flex justify-between text-lg">
                                    <span class="text-gray-600 font-semibold">Sisa Pembayaran:</span>
                                    <span class="font-bold text-red-600">
                                        Rp {{ number_format(max(0, $total_price - $payment), 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>

                            <div class="bg-blue-50 border border-blue-200 rounded-xl p-4">
                                <div class="flex gap-3">
                                    <svg class="w-5 h-5 text-blue-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                    <div class="text-sm text-blue-700">
                                        <p class="font-semibold mb-1">Informasi</p>
                                        <p>Order akan dibuat dengan kode unik dan dapat dilacak statusnya.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="space-y-3 pt-4">
                                <button 
                                    type="submit"
                                    class="w-full px-6 py-3 bg-gradient-to-r from-emerald-500 to-teal-600 hover:from-emerald-600 hover:to-teal-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105"
                                >
                                    <span class="flex items-center justify-center gap-2">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        Simpan Order Jasa
                                    </span>
                                </button>
                                
                                <a 
                                    href="{{ route('order-jasa.index') }}"
                                    class="block w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-xl transition-all duration-200 text-center"
                                >
                                    Batal
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </div>
</div>