<div class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50 py-8 px-4 sm:px-6 lg:px-8">
    <div class="max-w-5xl mx-auto">


        <div class="mb-6">
            <a href="{{ route('order-jasa.riwayat-pesanan') }}"
               class="inline-flex items-center gap-2 text-indigo-600 hover:text-indigo-700 font-semibold mb-6 group">
                <svg class="w-5 h-5 group-hover:-translate-x-1 transition-transform" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"/>
                </svg>
                Kembali ke Riwayat Pesanan
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
                        @php
                            $statusMap = [
                                'pending'     => ['label' => 'Menunggu Persetujuan', 'color' => 'yellow'],
                                'approved'    => ['label' => 'Disetujui',            'color' => 'blue'],
                                'in_progress' => ['label' => 'Sedang Diproses',      'color' => 'purple'],
                                'completed'   => ['label' => 'Selesai',              'color' => 'green'],
                                'rejected'    => ['label' => 'Ditolak',              'color' => 'red'],
                                'cancelled'   => ['label' => 'Dibatalkan',           'color' => 'gray'],
                            ];
                            $s = $statusMap[$order->status] ?? $statusMap['pending'];
                            $bayarLunas = $order->status_pembayaran === 'lunas';
                        @endphp
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold bg-{{ $s['color'] }}-100 text-{{ $s['color'] }}-700">
                            {{ $s['label'] }}
                        </span>
                        <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-bold
                                     {{ $bayarLunas ? 'bg-green-100 text-green-700' : 'bg-amber-100 text-amber-700' }}">
                            {{ $bayarLunas ? ' Lunas' : ' Belum Lunas' }}
                        </span>
                       
                    </div>
                </div>

                {{-- Tombol Aksi Header --}}
                <div class="flex flex-wrap gap-2 shrink-0">
                    <a href="{{ route('order-jasa.ubah-pesanan', $order->id) }}"
                       class="inline-flex items-center gap-1.5 px-4 py-2 bg-indigo-500 hover:bg-indigo-600
                              text-white text-sm font-semibold rounded-xl transition-all">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/>
                        </svg>
                        Ubah
                    </a>

                   
                   
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

       
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

       
            <div class="lg:col-span-2 space-y-6">

                {{-- Info Customer --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Informasi Customer
                        </h3>
                    </div>
                    <div class="p-6 grid grid-cols-1 sm:grid-cols-3 gap-4">
                        <div>
                            <p class="text-xs text-gray-400 mb-1 font-medium uppercase tracking-wide">Nama</p>
                            <p class="text-sm font-semibold text-gray-900">{{ $order->customer_name }}</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-400 mb-1 font-medium uppercase ">No. Telepon</p>
                            <a 
                               class="text-sm font-semibold text-gray-400  items-center gap-1">
                                {{ $order->customer_phone }}
                               
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

            <div class="space-y-6">

                {{-- Pembayaran --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
                    <div class="bg-gradient-to-r from-slate-50 to-gray-100 px-6 py-4 border-b border-gray-200">
                        <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
                            <svg class="w-4 h-4 text-emerald-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                      d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                            </svg>
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
                            @elseif ($order->status_pembayaran == 'belum_lunas')
                                <div class="flex items-center justify-center gap-2 p-2 bg-amber-50 border border-amber-200 rounded-xl">
                                    
                                    <span class="text-sm font-bold text-amber-700">BELUM LUNAS </span>   
                                </div>
                            @else
                                <div class="flex items-center justify-center gap-2 p-2 bg-green-50 border border-green-200 rounded-xl">
                                    <svg class="w-4 h-4 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                                    </svg>
                                    <span class="text-sm font-bold text-green-700">LUNAS ${{$order->status_pembayaran}}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Info nomor Rekening pengiriman --}}
                <div class="bg-white rounded-2xl shadow-md border border-gray-100 overflow-hidden">
    
    <div class="bg-gradient-to-r from-blue-50 to-indigo-50 px-6 py-4 border-b border-gray-200">
        <h3 class="text-base font-semibold text-gray-900 flex items-center gap-2">
            <svg class="w-4 h-4 text-blue-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M17 9V7a5 5 0 00-10 0v2M5 9h14l-1 10H6L5 9z"/>
            </svg>
            Rekening Pembayaran
        </h3>
    </div>

    <div class="p-5 space-y-4">

        <!-- BANK -->
         <div class="bg-blue-50 border border-blue-100 rounded-xl">
            <div class="flex items-center gap-3 p-4 ">

                <div class="w-12 h-12 rounded-lg bg-white flex items-center justify-center shadow-sm">
                    <img src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAAN0AAACUCAMAAAAgTdyMAAAAk1BMVEX///8AYK8AXq4AWazR2OkASacAVqsAQaT19voAXK0AVKr4+vwATqgATKcAUKns8ffl6/TG1OfY4e67y+KOps8iUqp0lMZghb/Q3OyDoMxnjsOlu9qetteUqtF9nMqKqNBDb7W0xN9Ufryuu9krY7A4dbgwbLRVeLkAOaFngb2AksV4jMKntNY6X69GabMANJ9wfLtJhgSwAAALKElEQVR4nO1b6bqiOhbFRJCAmBA4TAICItSpM1S//9N1QMEkDHL71te3q7+s+mMhxKw97x2OpikoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgoKCgo3GFjbNr2P72L3wrbJLSMwwbq+hvDUdfhLclcgv98mmZU+lXz/f7zcvaiiHSgrpfGH23dJFeX/NP7+zuIsve68hmJqZow9T7Dpv1Zmv/Avn4D7LRwbuWaAZrEza2vgP4XN/WbQPJDnU70YtuToOKGDihXXNA2Z7ElONmPn/PkfSyt+XrJO0qrdeVr1IvDKsw9WVf48l0v88t/HWag1+GZLhu1Tei+zPIkCfOSlpZxFhzcjmfX/JFsJGd++PIlnDWOBSG0nCbDk+/qJfOk9W4WCB5hMBHg4xkWyXaOc7KM7ud2NUKnW8rxiwwwu2SwkR2d7Ba3BhpWsVo5VpphtrBSDOfZMQCrvsw84SUFtOBz/6D7CGF7Hu8IjXmBhRvZxT9lS2v4FSGSHyh3sj7viBo0u5PHfk4Tem4BIZpTDYSF91hTX1it2kYOQ0+6kojiMmQx4bacW8iOTyvkmF4M8bF9qy9LA+l1bzNLAkPtNnZlITl81EjirCPpEb+YW2g/qwYOMOR0TjJn2Y47WcCO3Xnpnq3sbnJMyeQVoexnkT5nmoG1Tm4Hdk8ricJ1Re+czvVw+zfZmbqkGTuX/diYxKc6nS5EnRfkdrvT53CzV68qjkm06lT3OR9SenabEt75S7qAk4nuEllVqfwQw+3FfjsxxQ8nOK94XA8AO9XR5TCFik3sWjmSzbALZXamPkl57mvV7YyHmNLDqztR2MkhOy7fUMzHbYnLmxwy7EA2B/gxkROUTdOuXmijZxf0W7oub3r8yc5DKVwOU6DY0rK4+uSSP2EXT+7JP6QLJRB3AvQOjlhoWH5fSb6KrZ21dGsmK2FqG7vsNiVcSxutp0WUJxkGDi1Bd8Cge9d1y0Sgd7pqCzkfIIangH50W49+GfNVWP9As6VbmdaYLLS/yOYdGyQy9oq25TdtDEUun15Qw7wAV7JGkIHqokOzexRlp95YvLJM+dQrMAWN7FEzMFu+UCGud2VdAa75jSKWVim7LvTm5u06IczXTMehLCk5Q4ABM0xfij7o1OSpS1iXhLuZB2TSQDWZeRrUAtUZg5qAfnMKzsLd0TndfNN1uEVPnu23lnPahdkzuNjBpJL2+G0fhv2lTycDKJpmRaNOeSUQL3R21lBDE76ERiFfpG9i5zajRuzQ6O0CGQ3xRnrA8fB33zEAaHCV6+ek9BaqU2P4lisNjp29VWK6sW6y+5jXw9iVeHw9g7yY+wVQy9XxDMrbGB3C0R/QiXqPYAxgSeG4Ic4D3UrON5y+n25Xcte6+OVJ5OZ6UDLsG98Ep+UlxZxwtpIXca2GErrk4jQz/Ot9YSMlxdMJARr7LvcmRWTKy9nKMAOhKRweBlbVqTMU2FnrbUzJe7LuCSUiAOfVZ3t8Jg92plADGyEJu32hEAtJxwgGYUSySaX8fahKwiQJ6+No4FZfpnhCsoEv6g3EBTcAWYfF/QRAM6WujCx/OIhU0llX2gnuQK5C/EZjHKY3KSKHwvMIdngGFN3vxeLzq8n9nowzH4BOmchuh5YGBDw7/8HOFXMcQiYzIiOxkZik4RCpyE2MWbhYqcSgdRcFEWKKMSnOBdjfvJ4NKrGDc4MMaQV/kIDEbndMmfJ0ItWxwBg8nkhjNG9hYNRvZKAhxEDOiWfh85KwYpttVnCSaXk4YRcP7ORmA0GtgY0tcX5aJpbYTVpeHkZ1v/lTiPCTZCCA8LUP6Eqjv85u1J0pd9YHGus+lWY2xhCEZHbTxkJ8DnQuZgopEb2vdmipkD477dvZX2Sn+YPfaSUUlWdl3g8vFSmz7PcUrcCOvmiAUFdaYME+4Oq8lfC5DvQNl8Quf80ui0cBptDgWxNU0V/7SrAOg+vqSCGw8/hWDCBW8gMkiKvLCESwhPV5qxAwUds7rshuw7h2zHckJdFHW1tjzwFqatFi/J9h1e1HhMcpsRQzeY8CdZwxXPKWz75wr4l2vqo7IogG5hrGJhbY9SX5C1zDBzvvUJWEuNdg9xjEgTpqogc76NTB1SWkrA5DzBTznTCtAMWwRb4yOZ61vchubZp8EWI1CvOA4SYa9uvjtrHOTE8Qth9ZZDIKDrqzq9yeHXIqj5hu9tFCeBr6BLFWIXzP9FQKb4rMT1zRMovlmGlL40BkMIiBYTrsmWLoEbpMyTwFgjqgLDucwMgOWKwLpnkN+qG4MfipWGcKWjk9SxAujMDQFtndx17ziFcj8GZ2wwnJUAcAYBwa105ZVKjdkLFDMLPd5mA8OmNrYOe984tfeI/QnybDxRpY2VJ+uY8s53f1cvLC2L0erOChN78+YxTSE1rWqI4YO4SuNDg8NXAc5q2Z0N/xoR7txsu8shg7LGXP01zK6qS9cpb0/JlF2XD4eKRzoVaxKhrDOkrcAuYRPwcZaxU74YtYk9+2Ne6Z8GsyyxQnGl0gntAjcfnqLGnYSrthbOQPkSs93ZcEzNWAlZOiZ1fT2Oqv3L+zhoRn3vj63hMaseFXy0KqFE3pcImtJ5oXjuuaSFl7kd16IffY2HH4dK67poX5W80iiOOmX4zdd77XIequ9C3N1xgHCOTXFnYNg6TD7SjOAB3mAufJyQg8JXvcH5l3wVo3jldmRuC113Uhd8NQDL+N0sNZEMSpx4TnJkZA3hi7LxpYiWdr2E3jILg8Be21fLYRZ8bQ6OO3uEXUzR+j3WTfwNCtKojjoNFZou0Vkr84HRoW3DA20oq5Htf2kdlZ5puJ/NmSIOHrIPo6ft+DLZ6vtaFhWfejbOgzs9hEbttQTLsUc1fNL9K4lafjr/mK4MS73eIRIifp+17O60P2PmhJzgmfr04IX/CHgcugsyeNmqmZNvunzZMTHwpfs3sEUvt99VYYTFSHQpPcgYl0sLiFnWZsGL/IyPlhFm5fBnBriMzRmvKAxRxbaqWOz9ghdq9cN7aGy/v40aRr7xFxn794ucmnKjPkxrmilq4c83VTUGkxVHMbENjtrE3sKBzEY6d5bttzhsqYnbk5u6fzVNMXhgmOCZfV8oVXNBh0Fq4DcTGdoyCxO21iZ1dDdUVCXJn775BqEXdi0KXX+qz51TNG/eRbs+k5uwjkxLzzmrmzoOpedVLOgNyjErvj5JxmFt5w0Of+9Dwty86p3ZB/UReEUddEVBecUFc75/mg1eiLT+WrQwcAUSFH7gzNK/tIJ9OdIx8TZN19altAmoeOz37ma2Fy25vfOCTl5ZM9H+VxZuYUa2kz3KZlFa8Md4kcQKyhD2faHPddzvUdrMDUXGnACHgxyn63jZ2WPSZANEv22lcUENLiBKeVv2fUE/9d872ckR1OL4hQY2qfv/RZOOAWfLqzYQqfQ+skCQV1R+XFQVjiIEwX7PwH/+WPDcPofrvB23vPzyS26ZOE0C8vsS+XzhJx7v3S3Koy8cN87fRbfC+O7BdAyfJsALt+c3BYhYIAQEzHzqHJ2N2utITY5JC1L1eAA6d+vKrIikoWBpNIy+8aOgdMpuO7njR5M86/5/1hG3uX5LYzDHQLL972t0n/o986t3p1pSuvDtuExuAt3FLd/S8i8t/r1i+jhde+g+b75/lPfq/djDy/qouPn1npPt7Yj9wyzbtX9j8+3T/wjW8JNib7c3DbOf1fW3R/bgFuSerSGYX+0WA8/x/+hERBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUFBQUHh/wb/BmWtxjdbvPWKAAAAAElFTkSuQmCC" class="h-6">
                </div>

                <div class="flex-1">
                    <p class="text-sm font-bold text-gray-900">Bank BCA</p>
                    <p class="text-xs text-gray-500">Transfer Bank</p>
                </div>
            </div>
            <p class="text-xs flex text-gray-400 mb-1  gap-3" style="padding-left: 30px;">Nomor Rekening</p>

            <div class="flex items-center  gap-3 justify-between" style="padding:20px;">

                <p class="text-lg font-bold text-gray-900 tracking-widest">
                    1234567890
                </p>

                <button
                    onclick="navigator.clipboard.writeText('1234567890')"
                    class="px-3 py-1 text-xs font-semibold bg-indigo-500 text-white rounded-lg hover:bg-indigo-600">
                    Copy
                </button>

            </div>

        </div>


        


        <!-- ATAS NAMA -->
        <div class="bg-gray-50 border border-gray-200 rounded-xl p-4">

            <p class="text-xs text-gray-400 mb-1">Atas Nama</p>

            <p class="text-sm font-semibold text-gray-900">
                Toko Matahari
            </p>

        </div>


        <!-- INFO -->
        <div class="bg-yellow-50 border border-yellow-200 rounded-xl p-3 text-xs text-yellow-800 leading-relaxed">
            Silakan transfer sesuai jumlah tagihan. Setelah melakukan pembayaran,
            kirim bukti transfer agar pesanan dapat segera diproses.  No Wa : <span class="text text-green-400 mb-1 font-medium uppercase"> 082283821173</span>
        </div>

    </div>

</div>
               

            </div>
        </div>

    </div>{{-- end max-w --}}


    

</div>