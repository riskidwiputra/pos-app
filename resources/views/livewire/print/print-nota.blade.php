<div>
    <style>
        @media print {
            @page {
                width: 80mm;
                margin: 0;
            }
            
            body {
                margin: 0;
                padding: 0;
            }
            
            .no-print {
                display: none !important;
            }
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Courier New', Courier, monospace;
            font-size: 12px;
            line-height: 1.4;
            color: #000;
            background: #fff;
            width: 80mm;
            margin: 0 auto;
            padding: 10px;
        }
        
        .nota-container {
            width: 100%;
        }
        
        /* Header */
        .header {
            text-align: center;
            border-bottom: 1px dashed #000;
            padding-bottom: 8px;
            margin-bottom: 8px;
        }
        
        .store-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 2px;
            text-transform: uppercase;
        }
        
        .store-info {
            font-size: 10px;
            line-height: 1.3;
        }
        
        /* Info Section */
        .info-section {
            font-size: 11px;
            margin-bottom: 8px;
            border-bottom: 1px dashed #000;
            padding-bottom: 8px;
        }
        
        .info-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 2px;
        }
        
        .info-label {
            font-weight: normal;
        }
        
        .info-value {
            font-weight: bold;
            text-align: right;
        }
        
        /* Items */
        .items-section {
            margin-bottom: 8px;
        }
        
        .item {
            margin-bottom: 6px;
            font-size: 11px;
        }
        
        .item-name {
            font-weight: bold;
            margin-bottom: 2px;
        }
        
        .item-details {
            display: flex;
            justify-content: space-between;
            font-size: 10px;
        }
        
        .item-qty-price {
            flex: 1;
        }
        
        .item-subtotal {
            text-align: right;
            font-weight: bold;
        }
        
        /* Summary */
        .summary-section {
            border-top: 1px dashed #000;
            padding-top: 8px;
            margin-bottom: 8px;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 4px;
            font-size: 11px;
        }
        
        .summary-label {
            font-weight: normal;
        }
        
        .summary-value {
            font-weight: bold;
            text-align: right;
        }
        
        .total-row {
            border-top: 1px solid #000;
            border-bottom: 1px solid #000;
            padding: 6px 0;
            margin: 6px 0;
            font-size: 13px;
            font-weight: bold;
        }
        
        /* Payment */
        .payment-section {
            border-top: 1px dashed #000;
            padding-top: 8px;
            margin-bottom: 8px;
            font-size: 11px;
        }
        
        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 3px;
        }
        
        .payment-label {
            font-weight: normal;
        }
        
        .payment-value {
            font-weight: bold;
            text-align: right;
        }
        
        .change-row {
            font-size: 12px;
            font-weight: bold;
            margin-top: 4px;
            padding-top: 4px;
            border-top: 1px dashed #000;
        }
        
        /* Footer */
        .footer {
            text-align: center;
            font-size: 10px;
            margin-top: 10px;
            border-top: 1px dashed #000;
            padding-top: 8px;
        }
        
        .thank-you {
            font-weight: bold;
            margin-bottom: 4px;
        }
        
        .footer-note {
            font-size: 9px;
            line-height: 1.3;
            margin-bottom: 3px;
        }
        
        /* Print Buttons */
        .print-buttons {
            text-align: center;
            margin: 20px 0;
            padding: 20px;
            background: #f0f0f0;
            border-radius: 8px;
        }
        
        .btn {
            display: inline-block;
            padding: 12px 24px;
            margin: 0 5px;
            font-size: 14px;
            font-weight: bold;
            text-decoration: none;
            border-radius: 6px;
            cursor: pointer;
            border: none;
            transition: all 0.3s;
        }
        
        .btn-primary {
            background: #4F46E5;
            color: white;
        }
        
        .btn-primary:hover {
            background: #4338CA;
        }
        
        .btn-secondary {
            background: #6B7280;
            color: white;
        }
        
        .btn-secondary:hover {
            background: #4B5563;
        }
    </style>

    <div class="nota-container">
        <!-- Header -->
        <div class="header">
            <div class="store-name">TOKO MATAHARI KISARAN</div>
            <div class="store-info">
                Jl. Merdeka No. 123, Kisaran<br>
                Telp: (0812) 3456-7890
            </div>
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <div class="info-row">
                <div class="info-label">No Invoice:</div>
                <div class="info-value">{{ $sale->invoice_number }}</div>
            </div>
            <div class="info-row">
                <div class="info-label">Tanggal:</div>
                <div class="info-value">{{ $sale->transaction_date->format('d/m/Y H:i') }}</div>
            </div>
        </div>

        <!-- Items -->
        <div class="items-section">
            @foreach($sale->items as $item)
            <div class="item">
                <div class="item-name">{{ $item->product_name }}</div>
                <div class="item-details">
                    <div class="item-qty-price">
                        {{ $item->quantity }} {{ $item->unit }} x Rp {{ number_format($item->price, 0, ',', '.') }}
                    </div>
                    <div class="item-subtotal">
                        Rp {{ number_format($item->subtotal, 0, ',', '.') }}
                    </div>
                </div>
            </div>
            @endforeach
        </div>

        <!-- Summary -->
        <div class="summary-section">
          

            <div class="summary-row total-row">
                <div class="summary-label">TOTAL:</div>
                <div class="summary-value">Rp {{ number_format($sale->total, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Payment -->
        <div class="payment-section">
            <div class="payment-row">
                <div class="payment-label">Jumlah Dibayar:</div>
                <div class="payment-value">Rp {{ number_format($sale->paid_amount, 0, ',', '.') }}</div>
            </div>
            <div class="payment-row change-row">
                <div class="payment-label">KEMBALIAN:</div>
                <div class="payment-value">Rp {{ number_format($sale->change_amount, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Footer -->
        <div class="footer">
            <div class="thank-you">Terima kasih atas kunjungan Anda</div>
            <div class="footer-note">
                Barang yang sudah dibeli tidak dapat dikembalikan
            </div>
            <div class="footer-note" style="margin-top: 8px;">
                {{ now()->format('d/m/Y H:i:s') }}
            </div>
        </div>
    </div>

    {{-- <!-- Print Buttons (hidden saat print) -->
    <div class="print-buttons no-print">
        <button onclick="window.print()" class="btn btn-primary">
            🖨️ Cetak
        </button>
        <a href="{{ route('sale.detail', $sale->id) }}" class="btn btn-secondary">
            ❌ Tutup
        </a>
    </div> --}}

    <script>
        // Auto print saat halaman dibuka (opsional)
        // window.onload = function() {
        //     window.print();
        // };
    </script>
</div>