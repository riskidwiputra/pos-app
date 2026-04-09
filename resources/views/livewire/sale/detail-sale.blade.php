<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="container-xxl w-full">
        
        <!-- Header with Back Button -->
        <div class="mb-8">
            <a href="{{ route('sale.index') }}" class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali ke Daftar
            </a>

            <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4 mb-2">
                <div>
                    <h1 class="text-3xl font-bold bg-gradient-to-r from-blue-600 to-indigo-600 bg-clip-text text-transparent">
                        Detail Penjualan
                    </h1>
                    <div class="flex items-center gap-3 mt-2">
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-gradient-to-r from-blue-100 to-indigo-100 text-indigo-700 border border-indigo-200">
                            {{ $sale->invoice_number }}
                        </span>
                        @if($sale->status === 'Dibatalkan')
                            <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-red-100 text-red-700">
                                <span class="w-2 h-2 bg-red-500 rounded-full mr-2 animate-pulse"></span>
                                Dibatalkan
                            </span>
                        @endif
                    </div>
                </div>
                <div class="flex flex-wrap gap-3">
                    
                    <button  wire:loading.attr="disabled" wire:click="printInvoice" class="inline-flex items-center gap-2 px-5 py-2.5 bg-white border-2 border-gray-300 text-gray-700 font-semibold rounded-xl shadow-md hover:shadow-lg hover:border-gray-400 transition-all duration-300 transform hover:scale-105">
                      <span wire:loading.remove>
                            Cetak Invoice
                        </span>
                        <span wire:loading>
                            
                             <i class='bx bx-loader-alt animate-spin'></i> Memproses...
                        </span>
                        
                    </button>
                </div>
            </div>
        </div>

        <!-- Flash Message -->
        @if($message)
        <div class="mb-6 animate-in slide-in-from-top fade-in duration-500">
            <div class="group relative overflow-hidden rounded-xl backdrop-blur-md bg-gradient-to-r from-emerald-50 via-green-50 to-emerald-50 border border-emerald-200/50 shadow-lg hover:shadow-xl transition-all duration-300">
                <div class="absolute inset-0 rounded-xl bg-gradient-to-r from-emerald-400/20 via-green-300/20 to-emerald-400/20 opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
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
                        <p class="text-sm text-emerald-800/80 leading-relaxed">{{ $message }}</p>
                    </div>
                    <button wire:click="$set('message', '')" class="flex-shrink-0 text-emerald-600 hover:text-emerald-800 hover:bg-emerald-200/50 rounded-lg p-2 transition-all duration-200 hover:scale-110">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            
            <!-- Left Side - Details -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Info Penjualan -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h2 class="text-lg font-semibold text-gray-900">Informasi Penjualan</h2>
                    </div>
                    
                    <div class="p-6">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <!-- Invoice Number -->
                            <div class="group">
                                <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Nomor Invoice</p>
                                <div class="flex items-center gap-3">
                                   
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $sale->invoice_number }}</p>
                                        <p class="text-sm text-gray-500">{{ $sale->transaction_date->format('d M Y') }}</p>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Customer -->
                            <div class="group">
                                <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Pelanggan</p>
                                <div class="flex items-center gap-3">
                                   
                                    <div>
                                        <p class="font-bold text-gray-900">{{ $sale->customer->fullname ?? 'Umum' }}</p>
                                        <p class="text-sm text-gray-500">{{ $sale->customer ? 'Member' : 'Walk-in Customer' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Payment Method -->
                            <div class="group">
                                <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Metode Pembayaran</p>
                                <div class="flex items-center gap-3">
                                    
                                    <div>
                                        <p class="font-bold text-gray-900">{{ ucfirst($sale->payment_method) }}</p>
                                        <p class="text-sm text-gray-500">{{ $sale->transaction_date->diffForHumans() }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Status -->
                            <div class="group">
                                <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Status Transaksi</p>
                                <div class="flex items-center gap-3">
                                    
                                    <div>
                                        <p class="font-bold {{ $sale->status === 'lunas' ? 'text-emerald-700' : 'text-red-700' }}">
                                            {{ $sale->status }}
                                        </p>
                                        <p class="text-sm text-gray-500">Status pembayaran</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if($sale->notes)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Catatan</p>
                            <div class="bg-gradient-to-r from-amber-50 to-yellow-50 rounded-xl p-4 border border-amber-200">
                                <p class="text-gray-800 italic">{{ $sale->notes }}</p>
                            </div>
                        </div>
                        @endif

                        @if($sale->creator)
                        <div class="mt-6 pt-6 border-t border-gray-200">
                            <p class="text-sm font-semibold text-gray-500 mb-2 uppercase tracking-wider">Dilayani Oleh</p>
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-indigo-100 to-purple-100 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <p class="font-bold text-gray-900">{{ $sale->creator->fullname }}</p>
                                    <p class="text-sm text-gray-500">{{ $sale->creator->email }}</p>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <!-- Daftar Produk -->
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200 flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-900">Daftar Produk</h2>
                        <span class="inline-flex items-center px-3 py-1 text-sm font-semibold rounded-full bg-blue-100 text-blue-700">
                            {{ $sale->items->count() }} Item
                        </span>
                    </div>
                    
                    <div class="overflow-x-auto">
                        <table class="min-w-full">
                            <thead>
                                <tr class="bg-gradient-to-r from-gray-50 to-slate-50 border-b border-gray-200">
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">No</th>
                                    <th class="px-6 py-3 text-left text-xs font-bold text-gray-600 uppercase tracking-wider">Produk</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Harga</th>
                                    <th class="px-6 py-3 text-center text-xs font-bold text-gray-600 uppercase tracking-wider">Qty</th>
                                    <th class="px-6 py-3 text-right text-xs font-bold text-gray-600 uppercase tracking-wider">Subtotal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($sale->items as $index => $item)
                                    <tr class="group hover:bg-gradient-to-r hover:from-blue-50 hover:to-indigo-50 transition-all duration-200">
                                        <td class="px-6 py-4">
                                            <span class="inline-flex items-center justify-center w-8 h-8 rounded-lg bg-gradient-to-br from-blue-100 to-indigo-100 text-sm font-bold text-indigo-700">
                                                {{ $index + 1 }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                
                                                <div>
                                                    <p class="font-bold text-gray-900 group-hover:text-indigo-600 transition-colors">
                                                        {{ $item->product_name }}
                                                    </p>
                                                    <p class="text-xs text-gray-500">Kode: {{ $item->product->kode_produk ?? '-' }}</p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <p class="font-semibold text-gray-900">Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                                        </td>
                                        <td class="px-6 py-4 text-center">
                                            <span class="inline-flex items-center px-3 py-1.5  text-blue-700 font-bold text-sm">
                                                {{ $item->quantity }} {{ $item->unit }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            <p class="text-lg font-bold text-indigo-600">
                                                Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                                            </p>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                            <tfoot>
                                <tr class="bg-gradient-to-r from-indigo-50 to-blue-50 border-t-2 border-indigo-200">
                                    <td colspan="4" class="px-6 py-4 text-right">
                                        <span class="text-lg font-bold text-gray-900">Total Penjualan:</span>
                                    </td>
                                    <td class="px-6 py-4 text-right">
                                        <span class="text-2xl font-bold bg-gradient-to-r from-indigo-600 to-blue-600 bg-clip-text text-transparent">
                                            Rp {{ number_format($sale->total, 0, ',', '.') }}
                                        </span>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Right Side - Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white rounded-2xl shadow-xl overflow-hidden border border-gray-200 sticky top-8">
                    <div class="bg-gradient-to-r from-indigo-500 to-blue-600 px-6 py-4">
                        <h2 class="text-lg font-semibold text-white">Ringkasan Pembayaran</h2>
                    </div>

                    <div class="p-6 space-y-4">
                        <!-- Total -->
                        <div class="pb-4 border-b border-gray-200">
                            <div class="space-y-3">
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-600">Total Item:</span>
                                    <span class="font-semibold text-gray-900">{{ $sale->items->count() }}</span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-gray-600">Total:</span>
                                    <span class="text-xl font-bold text-gray-900">
                                        Rp {{ number_format($sale->total, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div class="flex justify-between items-center">
                                    <span class="text-sm font-medium text-gray-600">Jumlah Dibayar:</span>
                                    <span class="text-lg font-semibold text-green-600">
                                        Rp {{ number_format($sale->paid_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                                
                                <div class="pt-3 flex justify-between items-center">
                                    <span class="text-sm font-bold text-gray-700">Kembalian:</span>
                                    <span class="text-2xl font-bold text-blue-600">
                                        Rp {{ number_format($sale->change_amount, 0, ',', '.') }}
                                    </span>
                                </div>
                            </div>
                        </div>

                        <!-- Status Card -->
                        <div class="bg-gradient-to-r {{ $sale->status === 'lunas' ? 'from-green-50 to-emerald-50' : 'from-red-50 to-pink-50' }} rounded-xl p-4">
                            <div class="flex items-center gap-3">
                                
                                <div>
                                    <p class="text-sm font-medium text-gray-600">Status Pembayaran</p>
                                    <p class="text-lg font-bold {{ $sale->status === 'lunas' ? 'text-green-700' : 'text-red-700' }}">
                                        {{ $sale->status }}
                                    </p>
                                </div>
                            </div>
                        </div>

                        <!-- Payment Method Info -->
                        

                        <!-- Action Buttons -->
                        <div class="space-y-3 pt-4 border-t border-gray-200">
                            <button wire:click="printNota" class="w-full px-6 py-3 bg-gradient-to-r from-blue-500 to-indigo-600 hover:from-blue-600 hover:to-indigo-700 text-white font-semibold rounded-xl shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                                <span class="flex items-center justify-center gap-2">
                                    
                                    Cetak Nota
                                </span>
                            </button>
                            
                            <a href="{{ route('sale.index') }}" class="block w-full px-6 py-3 bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold rounded-xl transition-all duration-200 text-center">
                                Kembali ke Daftar
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    {{-- Modal Print Nota (Hidden) --}}
<div 
    x-data="{ 
        showPrintModal: false,
        printContent: ''
    }"
    x-on:print-nota.window="
        showPrintModal = true;
        fetch('/nota/{{ $sale->id }}')
            .then(response => response.text())
            .then(html => {
                printContent = html;
                setTimeout(() => {
                    let printFrame = document.getElementById('printFrame');
                    let doc = printFrame.contentWindow.document;
                    doc.open();
                    doc.write(printContent);
                    doc.close();
                    setTimeout(() => {
                        printFrame.contentWindow.print();
                        showPrintModal = false;
                    }, 500);
                }, 100);
            });
    "
    x-show="showPrintModal"
    style="display: none;"
    class="fixed inset-0 z-50">
    
    <iframe 
        id="printFrame" 
        style="position: absolute; width: 0; height: 0; border: none;">
    </iframe>
</div>
</div>

