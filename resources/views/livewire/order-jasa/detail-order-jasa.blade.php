<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">

        {{-- ── Header ─────────────────────────────────────────────────────────── --}}
        <div class="mb-6">
            <a href="{{ route('order-jasa.index') }}"
               class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Daftar Pesanan Jasa
            </a>

            <div class="flex flex-col sm:flex-row sm:items-start sm:justify-between gap-4">
                <div>
                    <div class="flex flex-wrap items-center gap-3 mb-2">
                        <h1 class="text-2xl font-bold text-gray-900">{{ $order->order_title }}</h1>
                        <span class="px-2.5 py-0.5 bg-blue-100 text-blue-700 text-xs font-bold rounded-full font-mono">
                            {{ $order->order_code }}
                        </span>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        {{-- Status badge --}}
                       
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold  bg-gray-100  ">
                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                     {{ $order->status_pembayaran === 'lunas' ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $order->status_pembayaran === 'lunas' ? ' Lunas' : ' Belum Lunas' }}
                        </span>
                       
                    </div>
                </div>

                {{-- Tombol Aksi Header --}}
                <div class="flex flex-wrap gap-2 shrink-0">
                    

                    @if($order->canBeApproved())
                        <button wire:click="$set('showApproveModal', true)"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-green-500 hover:bg-green-600
                                       text-white text-sm font-semibold rounded-xl transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                            </svg>
                            Setujui
                        </button>
                    @endif

                    @if($order->canBeRejected())
                        <button wire:click="$set('showRejectModal', true)"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-red-500 hover:bg-red-600
                                       text-white text-sm font-semibold rounded-xl transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Tolak
                        </button>
                    @endif

                    @if(in_array($order->status, ['approved', 'in_progress']))
                        <button wire:click="$set('showProgressModal', true)"
                                class="inline-flex items-center gap-1.5 px-4 py-2 bg-purple-500 hover:bg-purple-600
                                       text-white text-sm font-semibold rounded-xl transition-all">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                            </svg>
                            Update Progress
                        </button>
                    @endif

                   
                </div>
            </div>
        </div>

        {{-- Flash --}}
        @if(session()->has('success'))
            <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
                <div class="rounded-xl bg-gradient-to-r from-emerald-50 to-green-50 border border-emerald-200 p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-emerald-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                            </svg>
                        </div>
                        <p class="text-emerald-800 font-medium">{{ session('success') }}</p>
                    </div>
                </div>
            </div>
        @endif
        @if(session()->has('error'))
            <div class="mb-6">
                <div class="rounded-xl bg-gradient-to-r from-red-50 to-pink-50 border border-red-200 p-4">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-full bg-red-500 flex items-center justify-center">
                            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <p class="text-red-800 font-medium">{{ session('error') }}</p>
                    </div>
                </div>
            </div>
        @endif

        {{-- ── Grid Konten ─────────────────────────────────────────────────────── --}}
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- ══ KOLOM KIRI (span 2) ══════════════════════════════════════════ --}}
            <div class="lg:col-span-2 space-y-6">

                {{-- Info Customer --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                            
                            Informasi Customer
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 mb-1 font-medium uppercase tracking-wide">Nama</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1 font-medium uppercase tracking-wide">No. Telepon</p>
                            <a href="https://wa.me/{{ preg_replace('/^0/', '62', $order->customer_phone) }}" target="_blank"
                               class="text-sm font-semibold text-green-600 hover:underline inline-flex items-center gap-1">
                                {{ $order->customer_phone }}
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
                                </svg>
                            </a>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1 font-medium uppercase tracking-wide">Email</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->customer_email ?: '—' }}</p>
                        </div>
                    </div>
                </div>

                {{-- Detail Order --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                            
                            Detail Order
                        </h3>
                    </div>
                    <div class="p-6 space-y-5">

                        {{-- Kategori Jasa --}}
                        @if($order->category)
                            <div class="flex items-start gap-3 p-4 bg-indigo-50 border border-indigo-100 rounded-xl">
                                <span class="text-2xl">{{ $order->category->icon ?? '' }}</span>
                                <div>
                                    <p class="text-sm font-bold text-indigo-800">{{ $order->category->nama_jasa }}</p>
                                    <p class="text-xs text-indigo-600 mt-0.5">{{ $order->category->harga_format }}</p>
                                    @if($order->category->keterangan_bahan)
                                        <p class="text-xs text-gray-500 mt-1">Bahan: {{ $order->category->keterangan_bahan }}</p>
                                    @endif
                                </div>
                            </div>
                        @endif

                        {{-- Deskripsi --}}
                        <div>
                            <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Deskripsi Pesanan</p>
                            <p class="text-sm text-gray-700 leading-relaxed bg-gray-50 p-4 rounded-xl">{{ $order->order_description }}</p>
                        </div>

                        {{-- Quantity & Tanggal --}}
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                            <div class="bg-gray-50 rounded-xl p-3 text-center">
                                <p class="text-xs text-gray-400 mb-1">Jumlah</p>
                                <p class="text-lg font-bold text-gray-900">{{ number_format($order->quantity) }}</p>
                                <p class="text-xs text-gray-500">{{ $order->unit }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 text-center">
                                <p class="text-xs text-gray-400 mb-1">Tgl. Order</p>
                                <p class="text-sm font-bold text-gray-900">{{ $order->order_date->format('d M Y') }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 text-center">
                                <p class="text-xs text-gray-400 mb-1">Est. Selesai</p>
                                <p class="text-sm font-bold text-gray-900">{{ \Carbon\Carbon::parse($order->estimated_completion_date)->format('d M Y') }}</p>
                            </div>
                            <div class="bg-gray-50 rounded-xl p-3 text-center">
                                <p class="text-xs text-gray-400 mb-1">Selesai</p>
                                <p class="text-sm font-bold {{ $order->actual_completion_date ? 'text-green-700' : 'text-gray-400' }}">
                                    {{ $order->actual_completion_date ? \Carbon\Carbon::parse($order->actual_completion_date)->format('d M Y') : '—' }}
                                </p>
                            </div>
                        </div>

                        {{-- File Desain --}}
                        @if($order->design_file)
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">File Desain</p>
                                <a href="{{ Storage::url($order->design_file) }}" target="_blank"
                                   class="inline-flex items-center gap-2 px-4 py-2.5 bg-blue-50 hover:bg-blue-100
                                          border border-blue-200 rounded-xl text-sm text-blue-700 font-semibold transition-all">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                    </svg>
                                    {{ basename($order->design_file) }}
                                </a>
                            </div>
                        @endif

                        {{-- Catatan --}}
                        @if($order->notes)
                            <div>
                                <p class="text-xs font-bold text-gray-400 uppercase tracking-wide mb-2">Catatan</p>
                                <p class="text-sm text-gray-600 bg-amber-50 border border-amber-100 p-4 rounded-xl leading-relaxed">
                                    {{ $order->notes }}
                                </p>
                            </div>
                        @endif

                        {{-- Alasan Penolakan --}}
                        @if($order->status === 'rejected' && $order->rejection_reason)
                            <div>
                                <p class="text-xs font-bold text-red-400 uppercase tracking-wide mb-2">Alasan Penolakan</p>
                                <p class="text-sm text-red-700 bg-red-50 border border-red-100 p-4 rounded-xl leading-relaxed">
                                    {{ $order->rejection_reason }}
                                </p>
                            </div>
                        @endif

                    </div>
                </div>

            </div>

            {{-- ══ KOLOM KANAN ══════════════════════════════════════════════════ --}}
            <div class="space-y-6">

                {{-- Pembayaran --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                           
                            Pembayaran
                        </h3>
                    </div>
                    <div class="p-5 space-y-3">
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Total Harga</p>
                            <p class="text-sm font-bold text-gray-900">Rp {{ number_format($order->total_price, 0, ',', '.') }}</p>
                        </div>
                        @if($order->down_payment > 0)
                            <div class="flex justify-between items-center">
                                <p class="text-sm text-gray-500">Uang Muka (DP)</p>
                                <p class="text-sm font-semibold text-gray-700">Rp {{ number_format($order->down_payment, 0, ',', '.') }}</p>
                            </div>
                        @endif
                        <div class="flex justify-between items-center">
                            <p class="text-sm text-gray-500">Sudah Dibayar</p>
                            <p class="text-sm font-semibold text-green-700">Rp {{ number_format($order->payment, 0, ',', '.') }}</p>
                        </div>
                        <div class="border-t border-dashed border-gray-200 pt-3">
                            @php $sisa = $order->total_price - $order->payment; @endphp
                            @if($sisa > 0)
                                <div class="flex justify-between items-center">
                                    <p class="text-sm font-bold text-amber-600">Sisa Tagihan</p>
                                    <p class="text-sm font-bold text-amber-600">Rp {{ number_format($sisa, 0, ',', '.') }}</p>
                                </div>
                            @else
                                <div class="flex items-center justify-center gap-2 p-2 bg-green-50 border border-green-200 rounded-xl">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm font-bold text-green-700">LUNAS</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                

               

            </div>
        </div>

    </div>{{-- end max-w --}}


    {{-- ══════════════════════════════════════════════════════════════════════════
         MODAL: APPROVE
    ══════════════════════════════════════════════════════════════════════════ --}}
    @if($showApproveModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data @keydown.escape.window="$wire.closeApproveModal()">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-black/50 transition-opacity" wire:click="closeApproveModal"></div>
                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6 text-center">
                    <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-green-100 mb-4">
                        <svg class="h-8 w-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Setujui Order Jasa?</h3>
                    <p class="text-gray-600 mb-6">Order akan masuk ke tahap pengerjaan setelah disetujui.</p>
                    <div class="flex gap-3">
                        <button wire:click="closeApproveModal"
                                class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                            Batal
                        </button>
                        <button wire:click="approve"
                                class="flex-1 px-4 py-2.5 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-xl transition-all">
                            Ya, Setujui
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

    {{-- ══════════════════════════════════════════════════════════════════════════
         MODAL: REJECT
    ══════════════════════════════════════════════════════════════════════════ --}}
    @if($showRejectModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data @keydown.escape.window="$wire.closeRejectModal()">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-black/50 transition-opacity" wire:click="closeRejectModal"></div>
                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                    <div class="text-center mb-4">
                        <div class="mx-auto flex items-center justify-center h-16 w-16 rounded-full bg-red-100 mb-4">
                            <svg class="h-8 w-8 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                        </div>
                        <h3 class="text-xl font-bold text-gray-900 mb-2">Tolak Order Jasa?</h3>
                        <p class="text-gray-600">Berikan alasan penolakan agar customer dapat memahami keputusan ini.</p>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-semibold text-gray-700 mb-2">Alasan Penolakan <span class="text-red-500">*</span></label>
                        <textarea wire:model="rejectionReason" rows="4"
                                  placeholder="Tuliskan alasan penolakan..."
                                  class="w-full px-4 py-3 border-2 border-gray-200 rounded-xl focus:outline-none focus:border-red-500 resize-none"></textarea>
                        @error('rejectionReason')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="flex gap-3">
                        <button wire:click="closeRejectModal"
                                class="flex-1 px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                            Batal
                        </button>
                        <button wire:click="reject"
                                class="flex-1 px-4 py-2.5 bg-red-500 hover:bg-red-600 text-white font-semibold rounded-xl transition-all">
                            Tolak Order
                        </button>
                    </div>
                </div>
            </div>
        </div>
    @endif

   

    {{-- ══════════════════════════════════════════════════════════════════════════
         MODAL: UPDATE PROGRESS
    ══════════════════════════════════════════════════════════════════════════ --}}
    @if($showProgressModal)
        <div class="fixed inset-0 z-50 overflow-y-auto" x-data @keydown.escape.window="$wire.closeProgressModal()">
            <div class="flex items-center justify-center min-h-screen p-4">
                <div class="fixed inset-0 bg-black/50 transition-opacity" wire:click="closeProgressModal"></div>
                <div class="relative bg-white rounded-2xl shadow-2xl max-w-md w-full p-6">
                    <h3 class="text-lg font-bold text-gray-900 mb-2">Update Progress Order</h3>
                    <p class="text-sm text-gray-500 mb-5">Pilih status yang sesuai dengan kondisi order saat ini.</p>
                    <div class="space-y-2 mb-5">
                        @if($order->status === 'approved')
                            <button wire:click="updateStatus('in_progress')"
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-purple-50 hover:bg-purple-100 border border-purple-200
                                           rounded-xl text-sm font-semibold text-purple-700 transition-all text-left">
                                <span class="text-2xl">⚙️</span>
                                <div>
                                    <p>Mulai Proses</p>
                                    <p class="text-xs text-purple-400 font-normal">Ubah ke status Sedang Diproses</p>
                                </div>
                            </button>
                        @endif
                        @if($order->status === 'in_progress')
                            <button wire:click="updateStatus('completed')"
                                    class="w-full flex items-center gap-3 px-4 py-3 bg-green-50 hover:bg-green-100 border border-green-200
                                           rounded-xl text-sm font-semibold text-green-700 transition-all text-left">
                                <span class="text-2xl">🎉</span>
                                <div>
                                    <p>Tandai Selesai</p>
                                    <p class="text-xs text-green-400 font-normal">Order telah selesai dikerjakan</p>
                                </div>
                            </button>
                        @endif
                        <button wire:click="updateStatus('cancelled')"
                                class="w-full flex items-center gap-3 px-4 py-3 bg-gray-50 hover:bg-gray-100 border border-gray-200
                                       rounded-xl text-sm font-semibold text-gray-600 transition-all text-left">
                            <span class="text-2xl">🚫</span>
                            <div>
                                <p>Batalkan Order</p>
                                <p class="text-xs text-gray-400 font-normal">Hentikan proses order ini</p>
                            </div>
                        </button>
                    </div>
                    <button wire:click="closeProgressModal"
                            class="w-full px-4 py-2.5 bg-gray-100 hover:bg-gray-200 text-gray-700 font-semibold rounded-xl transition-all">
                        Tutup
                    </button>
                </div>
            </div>
        </div>
    @endif

</div>