<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice - {{ $sale->invoice_number }}</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 11px;
            color: #333;
            line-height: 1.4;
        }
        
        .container {
            padding: 20px;
            max-width: 210mm;
            margin: 0 auto;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 3px solid #4F46E5;
        }
        
        .company-name {
            font-size: 24px;
            font-weight: bold;
            color: #4F46E5;
            margin-bottom: 5px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .company-info {
            font-size: 10px;
            color: #666;
            margin-top: 5px;
        }
        
        .invoice-title {
            font-size: 20px;
            font-weight: bold;
            color: #333;
            margin-top: 10px;
        }
        
        /* Info Section */
        .info-section {
            display: table;
            width: 100%;
            margin-bottom: 20px;
        }
        
        .info-column {
            display: table-cell;
            width: 50%;
            padding: 10px;
            vertical-align: top;
        }
        
        .info-box {
            background: #f8f9fa;
            padding: 12px;
            border-radius: 5px;
            border-left: 3px solid #4F46E5;
        }
        
        .info-label {
            font-size: 9px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            margin-bottom: 3px;
        }
        
        .info-value {
            font-size: 11px;
            font-weight: bold;
            color: #333;
            margin-bottom: 8px;
        }
        
        /* Table */
        .items-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 15px;
        }
        
        .items-table thead {
            background: #2620a8;
            color: white;
        }
        
        .items-table th {
            padding: 10px 8px;
            text-align: left;
            font-size: 10px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: 600;
        }
        
        .items-table td {
            padding: 10px 8px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 10px;
        }
        
        .items-table tbody tr:hover {
            background: #f9fafb;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .product-name {
            font-weight: 600;
            color: #333;
        }
        
        .product-code {
            font-size: 9px;
            color: #666;
        }
        
        /* Summary */
        .summary-section {
            margin-top: 20px;
            padding: 15px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .summary-row {
            display: table;
            width: 100%;
            margin-bottom: 8px;
        }
        
        .summary-label {
            display: table-cell;
            text-align: right;
            padding-right: 20px;
            font-size: 11px;
            color: #666;
        }
        
        .summary-value {
            display: table-cell;
            text-align: right;
            font-weight: bold;
            width: 150px;
            font-size: 11px;
        }
        
        .total-row {
            border-top: 2px solid #4F46E5;
            padding-top: 10px;
            margin-top: 10px;
        }
        
        .total-row .summary-label {
            font-size: 13px;
            font-weight: bold;
            color: #333;
        }
        
        .total-row .summary-value {
            font-size: 16px;
            color: #4F46E5;
        }
        
        /* Payment Info */
        .payment-info {
            margin-top: 20px;
            padding: 15px;
            background: #ecfdf5;
            border-left: 4px solid #10b981;
            border-radius: 5px;
        }
        
        .payment-info h4 {
            font-size: 11px;
            color: #065f46;
            margin-bottom: 8px;
            text-transform: uppercase;
        }
        
        .payment-detail {
            font-size: 10px;
            color: #047857;
            margin-bottom: 4px;
        }
        
        /* Notes */
        .notes-section {
            margin-top: 20px;
            padding: 12px;
            background: #fffbeb;
            border-left: 4px solid #f59e0b;
            border-radius: 5px;
        }
        
        .notes-section h4 {
            font-size: 11px;
            color: #92400e;
            margin-bottom: 6px;
            text-transform: uppercase;
        }
        
        .notes-content {
            font-size: 10px;
            color: #78350f;
            font-style: italic;
        }
        
        /* Footer */
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
        }
        
        .footer-text {
            font-size: 9px;
            color: #666;
        }
        
        .signature-section {
            margin-top: 40px;
            display: table;
            width: 100%;
        }
        
        .signature-box {
            display: table-cell;
            width: 50%;
            text-align: center;
        }
        
        .signature-line {
            margin-top: 60px;
            border-top: 1px solid #333;
            width: 150px;
            margin-left: auto;
            margin-right: auto;
            padding-top: 5px;
            font-size: 10px;
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 4px 10px;
            border-radius: 12px;
            font-size: 9px;
            font-weight: 600;
            text-transform: uppercase;
        }
        
        .status-lunas {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-belum {
            background: #fee2e2;
            color: #991b1b;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            <div class="company-name">
                @php
                    $path = public_path('img/logo/Logos.jpeg');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <img src="{{ $image }}" width="700">
            
                
        </div>

        <!-- Info Section -->
        <div class="info-section">
            <div class="info-column">
                <div class="info-box">
                    <div class="info-label">Nomor Invoice</div>
                    <div class="info-value">{{ $sale->invoice_number }}</div>
                    
                    <div class="info-label">Tanggal Transaksi</div>
                    <div class="info-value">{{ $sale->transaction_date->format('d F Y') }}</div>
                    
                    <div class="info-label">Kasir</div>
                    <div class="info-value">{{ $sale->creator->name ?? '-' }}</div>
                </div>
            </div>
            
            <div class="info-column">
                <div class="info-box">
                    <div class="info-label">Pelanggan</div>
                    <div class="info-value">{{ $sale->customer->fullname ?? 'Umum (Walk-in Customer)' }}</div>
                    
                    <div class="info-label">Metode Pembayaran</div>
                    <div class="info-value">{{ strtoupper($sale->payment_method) }}</div>
                    
                    <div class="info-label">Status</div>
                    <div class="info-value">
                        <span class="status-badge {{ $sale->status === 'lunas' ? 'status-lunas' : 'status-belum' }}">
                            {{ $sale->status }}
                        </span>
                        
                    </div>
                </div>
            </div>
        </div>

        <!-- Items Table -->
        <table class="items-table">
            <thead>
                <tr>
                    <th style="width: 5%;">NO</th>
                    <th style="width: 40%;">NAMA PRODUK</th>
                    <th style="width: 15%;" class="text-right">HARGA</th>
                    <th style="width: 10%;" class="text-center">QTY</th>
                    
                    <th style="width: 15%;" class="text-right">SUBTOTAL</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sale->items as $index => $item)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <div class="product-name">{{ $item->product_name }}</div>
                        <div class="product-code">Kode: {{ $item->product->kode_produk ?? '-' }}</div>
                    </td>
                    <td class="text-right">Rp {{ number_format($item->price, 0, ',', '.') }}</td>
                    <td class="text-center">{{ $item->quantity }} {{ $item->unit }}</td>
                    <td class="text-right">Rp {{ number_format($item->subtotal, 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div class="summary-section">
            <div class="summary-row">
                <div class="summary-label">Subtotal:</div>
                <div class="summary-value">Rp {{ number_format($sale->total, 0, ',', '.') }}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Diskon:</div>
                <div class="summary-value">Rp {{ number_format($sale->discount ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Pajak:</div>
                <div class="summary-value">Rp {{ number_format($sale->tax ?? 0, 0, ',', '.') }}</div>
            </div>
            <div class="summary-row total-row">
                <div class="summary-label">TOTAL:</div>
                <div class="summary-value">Rp {{ number_format($sale->total, 0, ',', '.') }}</div>
            </div>
        </div>

        <!-- Payment Info -->
        <div class="payment-info">
            <h4>Informasi Pembayaran</h4>
            <div class="payment-detail"><strong>Jumlah Dibayar:</strong> Rp {{ number_format($sale->paid_amount, 0, ',', '.') }}</div>
            <div class="payment-detail"><strong>Kembalian:</strong> Rp {{ number_format($sale->change_amount, 0, ',', '.') }}</div>
            <div class="payment-detail"><strong>Metode:</strong> {{ strtoupper($sale->payment_method) }}</div>
        </div>

        <!-- Notes -->
        @if($sale->notes)
        <div class="notes-section">
            <h4>Catatan</h4>
            <div class="notes-content">{{ $sale->notes }}</div>
        </div>
        @endif

        

        <!-- Footer -->
        <div class="footer">
            <div class="footer-text">
                Terima kasih atas kepercayaan Anda.<br>
                Barang yang sudah dibeli tidak dapat dikembalikan.<br>
                <strong>Invoice ini dicetak pada: {{ now()->format('d F Y H:i:s') }}</strong>
            </div>
        </div>
    </div>
</body>
</html>