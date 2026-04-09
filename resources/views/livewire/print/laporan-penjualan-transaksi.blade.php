<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Penjualan</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Arial', sans-serif;
            font-size: 9px;
            color: #333;
            line-height: 1.4;
        }
        
        .container {
            padding: 15px;
        }
        
        /* Header */
        .header {
            text-align: center;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 3px solid #4F46E5;
        }
        
        .company-name {
            font-size: 20px;
            font-weight: bold;
            color: #4F46E5;
            margin-bottom: 3px;
            text-transform: uppercase;
        }
        
        .company-info {
            font-size: 8px;
            color: #666;
        }
        
        .report-title {
            font-size: 16px;
            font-weight: bold;
            color: #333;
            margin-top: 8px;
        }
        
        /* Filter Info */
        .filter-section {
            background: #f8f9fa;
            padding: 10px;
            border-radius: 5px;
            border-left: 3px solid #4F46E5;
        }
        
        .filter-row {
            display: table;
            width: 100%;
            margin-bottom: 3px;
        }
        
        .filter-label {
            display: table-cell;
            width: 120px;
            font-weight: bold;
            color: #666;
            font-size: 8px;
        }
        
        .filter-value {
            display: table-cell;
            color: #333;
            font-size: 8px;
        }
        
        /* Statistics */
        .statistics {
            display: table;
            width: 100%;
            margin-bottom: 15px;
        }
        
        .stat-box {
            display: table-cell;
            width: 25%;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 10px;
            text-align: center;
            border-radius: 5px;
            color: white;
        }
        
        .stat-box:nth-child(2) {
            background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%);
        }
        
        .stat-box:nth-child(4) {
            background: linear-gradient(135deg, #4facfe 0%, #00f2fe 100%);
        }
        
        .stat-box:nth-child(6) {
            background: linear-gradient(135deg, #43e97b 0%, #38f9d7 100%);
        }
        
        .stat-label {
            font-size: 8px;
            opacity: 0.9;
            text-transform: uppercase;
            margin-bottom: 4px;
        }
        
        .stat-value {
            font-size: 12px;
            font-weight: bold;
        }
        
        /* Table */
        .data-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 12px;
        }
        
        .data-table thead {
            background: #4F46E5;
            color: white;
        }
        
        .data-table th {
            padding: 6px 4px;
            text-align: left;
            font-size: 8px;
            text-transform: uppercase;
            font-weight: 600;
        }
        
        .data-table td {
            padding: 6px 4px;
            border-bottom: 1px solid #e5e7eb;
            font-size: 8px;
        }
        
        .data-table tbody tr:nth-child(even) {
            background: #f9fafb;
        }
        
        .text-right {
            text-align: right;
        }
        
        .text-center {
            text-align: center;
        }
        
        .font-bold {
            font-weight: bold;
        }
        
        /* Status Badge */
        .status-badge {
            display: inline-block;
            padding: 2px 6px;
            border-radius: 8px;
            font-size: 7px;
            font-weight: 600;
        }
        
        .status-lunas {
            background: #d1fae5;
            color: #065f46;
        }
        
        .status-batal {
            background: #fee2e2;
            color: #991b1b;
        }
        
        /* Summary */
        .summary-section {
            margin-top: 12px;
            padding: 10px;
            background: #f8f9fa;
            border-radius: 5px;
        }
        
        .summary-row {
            display: table;
            width: 100%;
            margin-bottom: 5px;
        }
        
        .summary-label {
            display: table-cell;
            text-align: right;
            padding-right: 15px;
            font-size: 9px;
            color: #666;
            width: 70%;
        }
        
        .summary-value {
            display: table-cell;
            text-align: right;
            font-weight: bold;
            font-size: 9px;
        }
        
        .total-row {
            border-top: 2px solid #4F46E5;
            padding-top: 6px;
            margin-top: 6px;
        }
        
        .total-row .summary-label {
            font-size: 11px;
            font-weight: bold;
            color: #333;
        }
        
        .total-row .summary-value {
            font-size: 13px;
            color: #4F46E5;
        }
        
        /* Footer */
        .footer {
            margin-top: 20px;
            padding-top: 10px;
            border-top: 2px solid #e5e7eb;
            text-align: center;
            font-size: 7px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Header -->
        <div class="header">
            @php
                    $path = public_path('img/logo/Logos.jpeg');
                    $type = pathinfo($path, PATHINFO_EXTENSION);
                    $data = file_get_contents($path);
                    $image = 'data:image/' . $type . ';base64,' . base64_encode($data);
                @endphp
                <img src="{{ $image }}" width="800">
            <div class="report-title">LAPORAN PENJUALAN PER TRANSAKSI</div>
            
        </div>

        <!-- Filter Info -->
        <div class="filter-section">
            <div class="filter-row">
                <div class="filter-label">Periode:</div>
                <div class="filter-value">{{ $filters['tanggal_mulai'] }} - {{ $filters['tanggal_selesai'] }}</div>
            </div>
            <div class="filter-row">
                <div class="filter-label">Status:</div>
                <div class="filter-value">{{ $filters['status'] }}</div>
            </div>
            <div class="filter-row">
                <div class="filter-label">Pencarian:</div>
                <div class="filter-value">{{ $filters['pencarian'] }}</div>
            </div>
            <div class="filter-row">
                <div class="filter-label">Tanggal Cetak:</div>
                <div class="filter-value">{{ now()->format('d F Y H:i:s') }}</div>
            </div>
        </div>

        <!-- Statistics -->
       
        <!-- Data Table -->
        <table class="data-table">
            <thead>
                <tr>
                    <th style="width: 3%;">NO</th>
                    <th style="width: 10%;">TANGGAL</th>
                    <th style="width: 15%;">NO INVOICE</th>
                    <th style="width: 15%;">PELANGGAN</th>
                    <th style="width: 7%;" class="text-center">TOTAL ITEM</th>
                    <th style="width: 15%;" class="text-right">TOTAL HARGA</th>
                    <th style="width: 15%;" class="text-right">KEUNTUNGAN</th>
                    <th style="width: 10%;" class="text-center">PEMBAYARAN</th>
                    <th style="width: 10%;" class="text-center">STATUS</th>
                </tr>
            </thead>
            <tbody>
                @foreach($sales as $index => $penjualan)
                <tr>
                    <td class="text-center">{{ $index + 1 }}</td>
                    <td>
                        <div class="font-bold">{{ $penjualan->transaction_date->format('d M Y') }}</div>
                        <div style="font-size: 7px; color: #666;">{{ $penjualan->transaction_date->format('H:i') }}</div>
                    </td>
                    <td class="font-bold">{{ $penjualan->invoice_number }}</td>
                    <td>{{ $penjualan->customer->fullname ?? 'Umum' }}</td>
                    <td class="text-center">{{ $penjualan->items->sum('quantity') }} item</td>
                    <td class="text-right font-bold">Rp {{ number_format($penjualan->total, 0, ',', '.') }}</td>
                    <td class="text-right font-bold" style="color: #059669;">
                        Rp {{ number_format($component->hitungKeuntungan($penjualan), 0, ',', '.') }}
                    </td>
                    <td class="text-center">{{ strtoupper($penjualan->payment_method) }}</td>
                    <td class="text-center">
                        <span class="status-badge {{ $penjualan->status === 'Lunas' ? 'status-lunas' : 'status-batal' }}">
                            {{ $penjualan->status }}
                        </span>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Summary -->
        <div class="summary-section">
            <div class="summary-row">
                <div class="summary-label">Total Transaksi:</div>
                <div class="summary-value">{{ number_format($ringkasan['total_transaksi']) }} transaksi</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Total Item Terjual:</div>
                <div class="summary-value">{{ number_format($ringkasan['total_item_terjual']) }} item</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Total Pendapatan:</div>
                <div class="summary-value">Rp {{ number_format($ringkasan['total_pendapatan'], 0, ',', '.') }}</div>
            </div>
            <div class="summary-row">
                <div class="summary-label">Total Keuntungan:</div>
                <div class="summary-value" style="color: #059669;">Rp {{ number_format($ringkasan['total_keuntungan'], 0, ',', '.') }}</div>
            </div>
            <div class="summary-row total-row">
                <div class="summary-label">GRAND TOTAL:</div>
                <div class="summary-value">Rp {{ number_format($ringkasan['total_pendapatan'], 0, ',', '.') }}</div>
            </div>
        </div>

            <!-- Footer -->
            <div class="footer">
                Laporan ini dicetak pada {{ now()->format('d F Y H:i:s') }}.
            </div>
    </div>
</body>
</html>