<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">

        {{-- ── Header ─────────────────────────────────────────────────────────── --}}
        <div class="mb-8">
            <a href="{{ route('order-jasa.index') }}"
               class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke halaman Order
            </a>

            <div class="flex items-start justify-between gap-4">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Edit Order Jasa
                    </h1>
                    <div class="flex items-center gap-3 mt-1">
                        <p class="text-sm text-gray-500">Perbarui data pesanan jasa percetakan</p>
                        <span class="px-2.5 py-0.5 bg-blue-100 text-blue-700 text-xs font-bold rounded-full font-mono">
                            {{ $order->order_code }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        {{-- ── Flash ───────────────────────────────────────────────────────────── --}}
        @if(session()->has('error'))
            <div class="mb-6 rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 p-4">
                <div class="flex items-center gap-3">
                    <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center shrink-0">
                        <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                        </svg>
                    </div>
                    <p class="text-red-800 font-medium">{{ session('error') }}</p>
                </div>
            </div>
        @endif

        <form wire:submit.prevent="save">
            <div class="space-y-6">

                {{-- ════════════════════════════════════════════════════════════════
                     SEKSI 1 — INFORMASI CUSTOMER
                ════════════════════════════════════════════════════════════════ --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Customer</h2>
                    </div>

                    <div class="p-6 space-y-4">

                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Nama Customer <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="customer_name"
                                   placeholder="Nama lengkap customer..."
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                          @error('customer_name') border-red-500 @enderror"/>
                            @error('customer_name')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    No. Telepon <span class="text-red-500">*</span>
                                </label>
                                <input type="text" wire:model="customer_phone"
                                       placeholder="08xxxxxxxxxx"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                              @error('customer_phone') border-red-500 @enderror"/>
                                @error('customer_phone')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Email <span class="text-gray-400 text-xs">(Opsional)</span>
                                </label>
                                <input type="email" wire:model="customer_email"
                                       placeholder="email@example.com"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                              @error('customer_email') border-red-500 @enderror"/>
                                @error('customer_email')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════════
                     SEKSI 2 — DETAIL ORDER
                ════════════════════════════════════════════════════════════════ --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Detail Order Jasa</h2>
                    </div>

                    <div class="p-6 space-y-4">

                        {{-- Kategori --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Kategori Jasa <span class="text-red-500">*</span>
                            </label>
                            <select wire:model.live="category_id"
                                    class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 cursor-pointer
                                           @error('category_id') border-red-500 @enderror">
                                <option value="">Pilih Kategori</option>
                                @foreach($this->kategori as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_jasa }}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                           
                        </div>

                        {{-- Judul --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Judul / Nama Pesanan <span class="text-red-500">*</span>
                            </label>
                            <input type="text" wire:model="order_title"
                                   placeholder="Contoh: Cetak Spanduk Event HUT RI..."
                                   class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                          @error('order_title') border-red-500 @enderror"/>
                            @error('order_title')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Deskripsi --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Deskripsi Detail <span class="text-red-500">*</span>
                            </label>
                            <textarea wire:model="order_description" rows="4"
                                      placeholder="Jelaskan detail pesanan: ukuran, bahan, warna, finishing, dll..."
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none
                                             @error('order_description') border-red-500 @enderror"></textarea>
                            @error('order_description')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        {{-- Jumlah & Satuan --}}
                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Jumlah <span class="text-red-500">*</span>
                                </label>
                                <input type="number" wire:model="quantity" min="1"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                              @error('quantity') border-red-500 @enderror"/>
                                @error('quantity')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Satuan <span class="text-red-500">*</span>
                                </label>
                                <select wire:model="unit"
                                        class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 cursor-pointer">
                                    <option value="pcs">Pcs</option>
                                    <option value="lembar">Lembar</option>
                                    <option value="meter">Meter</option>
                                    <option value="set">Set</option>
                                    <option value="box">Box</option>
                                    <option value="rim">Rim</option>
                                    <option value="roll">Roll</option>
                                    <option value="unit">Unit</option>
                                </select>
                            </div>
                        </div>

                        {{-- Tanggal --}}
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Tanggal Order <span class="text-red-500">*</span>
                                </label>
                                <input type="date" wire:model="order_date"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                              @error('order_date') border-red-500 @enderror"/>
                                @error('order_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Estimasi Selesai <span class="text-red-500">*</span>
                                </label>
                                <input type="date" wire:model="estimated_completion_date"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                              @error('estimated_completion_date') border-red-500 @enderror"/>
                                @error('estimated_completion_date')
                                    <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        {{-- File Desain --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Upload File Desain <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>

                            {{-- File existing --}}
                            @if($existing_design_file && !$hapus_design_file)
                                <div class="mb-3 flex items-center justify-between p-3 bg-blue-50 border border-blue-200 rounded-xl">
                                    <div class="flex items-center gap-2">
                                        <svg class="w-4 h-4 text-blue-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M15.172 7l-6.586 6.586a2 2 0 102.828 2.828l6.414-6.586a4 4 0 00-5.656-5.656l-6.415 6.585a6 6 0 108.486 8.486L20.5 13"/>
                                        </svg>
                                        <span class="text-sm text-blue-700 font-medium truncate max-w-xs">{{ basename($existing_design_file) }}</span>
                                    </div>
                                    <div class="flex items-center gap-3 shrink-0">
                                        <a href="{{ Storage::url($existing_design_file) }}" target="_blank"
                                           class="text-xs text-blue-600 hover:underline font-semibold">Lihat</a>
                                        <label class="flex items-center gap-1.5 cursor-pointer">
                                            <input type="checkbox" wire:model.live="hapus_design_file" class="w-3.5 h-3.5 rounded accent-red-500"/>
                                            <span class="text-xs text-red-500 font-semibold">Hapus</span>
                                        </label>
                                    </div>
                                </div>
                            @endif

                            @if(!$existing_design_file || $hapus_design_file)
                                <input type="file" wire:model="design_file"
                                       accept=".pdf,.jpg,.jpeg,.png,.zip,.rar,.ai,.psd,.cdr"
                                       class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500
                                              @error('design_file') border-red-500 @enderror"/>
                                <p class="mt-1 text-xs text-gray-500">Format: PDF, JPG, PNG, ZIP, RAR, AI, PSD, CDR (Max: 10MB)</p>
                            @endif

                            @error('design_file')
                                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                            @enderror

                            @if($design_file)
                                <div class="mt-2 flex items-center gap-2 p-3 bg-green-50 border border-green-200 rounded-xl">
                                    <svg class="w-4 h-4 text-green-500 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <p class="text-sm text-green-700 font-medium">{{ $design_file->getClientOriginalName() }}</p>
                                </div>
                            @endif
                        </div>

                        {{-- Catatan --}}
                        <div>
                            <label class="block text-sm font-semibold text-gray-800 mb-2">
                                Catatan Tambahan <span class="text-gray-400 text-xs">(Opsional)</span>
                            </label>
                            <textarea wire:model="notes" rows="3"
                                      placeholder="Catatan atau permintaan khusus dari customer..."
                                      class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200 resize-none"></textarea>
                        </div>

                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════════
                     SEKSI 3 — PEMBAYARAN
                ════════════════════════════════════════════════════════════════ --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Pembayaran</h2>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Total Harga <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                    <input type="number" wire:model="total_price" min="0" step="1000"
                                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                                  @error('total_price') border-red-500 @enderror"/>
                                </div>
                                @error('total_price') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Uang Muka (DP) <span class="text-gray-400 text-xs">(Opsional)</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                    <input type="number" wire:model="down_payment" min="0" step="1000"
                                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200"/>
                                </div>
                            </div>

                            <div>
                                <label class="block text-sm font-semibold text-gray-800 mb-2">
                                    Jumlah Dibayar <span class="text-red-500">*</span>
                                </label>
                                <div class="relative">
                                    <span class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-500 font-semibold">Rp</span>
                                    <input type="number" wire:model="payment" min="0" step="1000"
                                           class="w-full pl-12 pr-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-indigo-500 focus:ring-2 focus:ring-indigo-200
                                                  @error('payment') border-red-500 @enderror"/>
                                </div>
                                @error('payment') <p class="mt-1 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>

                        </div>

                        {{-- Indikator live sisa tagihan --}}
                        @if($total_price > 0)
                            @php $sisa = $total_price - $payment; $lunas = $payment >= $total_price; @endphp
                            <div class="mt-4 flex flex-wrap items-center gap-3 p-3 rounded-xl border
                                        {{ $lunas ? 'bg-green-50 border-green-200' : 'bg-amber-50 border-amber-200' }}">
                                <div class="flex items-center gap-2">
                                    <div class="w-2 h-2 rounded-full {{ $lunas ? 'bg-green-500' : 'bg-amber-500' }}"></div>
                                    <span class="text-sm font-bold {{ $lunas ? 'text-green-700' : 'text-amber-700' }}">
                                        {{ $lunas ? 'LUNAS' : 'BELUM LUNAS' }}
                                    </span>
                                </div>
                                @if(!$lunas && $sisa > 0)
                                    <span class="text-sm text-amber-600">
                                        Sisa: <span class="font-bold">Rp {{ number_format($sisa, 0, ',', '.') }}</span>
                                    </span>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>

                {{-- ════════════════════════════════════════════════════════════════
                     SEKSI 4 — STATUS
                ════════════════════════════════════════════════════════════════ --}}
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Status Order</h2>
                    </div>

                    <div class="p-6">
                        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-6 gap-3">
                            @foreach([
                                ['value' => 'pending',     'label' => 'Menunggu',   'icon' => '⏳'],
                                ['value' => 'approved',    'label' => 'Disetujui',  'icon' => '✅'],
                                ['value' => 'in_progress', 'label' => 'Diproses',   'icon' => '⚙️'],
                                ['value' => 'completed',   'label' => 'Selesai',    'icon' => '🎉'],
                                ['value' => 'rejected',    'label' => 'Ditolak',    'icon' => '❌'],
                                ['value' => 'cancelled',   'label' => 'Dibatalkan', 'icon' => '🚫'],
                            ] as $opt)
                                <label class="cursor-pointer">
                                    <input type="radio" wire:model="status" value="{{ $opt['value'] }}" class="sr-only peer"/>
                                    <div class="flex flex-col items-center gap-1 p-3 rounded-xl border-2 border-gray-200 text-center
                                                transition-all peer-checked:border-indigo-500 peer-checked:bg-indigo-50 hover:border-indigo-300">
                                        <span class="text-xl">{{ $opt['icon'] }}</span>
                                        <span class="text-xs font-bold text-gray-700">{{ $opt['label'] }}</span>
                                    </div>
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>

                {{-- ── Tombol Aksi ─────────────────────────────────────────────── --}}
                <div class="space-y-2 pb-8">
                    <button type="submit"
                            class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600
                                   hover:from-blue-600 hover:to-indigo-700
                                   text-white font-semibold rounded-xl shadow-lg hover:shadow-xl
                                   transition-all duration-200 transform hover:scale-[1.01]">
                        <span class="flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Simpan Perubahan
                        </span>
                    </button>
                    <a href="{{ route('order-jasa.index') }}"
                       class="block w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-xl transition-all text-center">
                        Batal
                    </a>
                </div>

            </div>
        </form>
    </div>
</div>