<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pajak UMKM</title>
    <style>
        body {
            font-family: 'Times New Roman', serif;
            font-size: 11px;
            line-height: 1.3;
            color: #000;
            margin: 0;
            padding: 15mm;
            background: #fff;
        }
        
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px solid #000;
            padding-bottom: 15px;
        }
        
        .header h1 {
            color: #000;
            margin: 0;
            font-size: 18px;
            font-weight: bold;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .header h2 {
            color: #000;
            margin: 8px 0 0 0;
            font-size: 14px;
            font-weight: normal;
        }
        
        .header .company-name {
            font-size: 16px;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
        .business-info {
            background: #f9f9f9;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #000;
        }
        
        .business-info h3 {
            margin: 0 0 8px 0;
            color: #000;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .business-info p {
            margin: 3px 0;
            color: #000;
            font-size: 10px;
        }
        
        .period-info {
            background: #f0f0f0;
            padding: 12px;
            margin-bottom: 20px;
            border: 1px solid #000;
        }
        
        .period-info h3 {
            margin: 0 0 8px 0;
            color: #000;
            font-size: 12px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .period-info p {
            margin: 3px 0;
            color: #000;
            font-size: 10px;
        }
        
        .summary-cards {
            display: table;
            width: 100%;
            margin-bottom: 25px;
            border-collapse: collapse;
        }
        
        .summary-card {
            display: table-cell;
            width: 25%;
            background: #fff;
            border: 1px solid #000;
            padding: 12px;
            text-align: center;
            vertical-align: top;
        }
        
        .summary-card h4 {
            margin: 0 0 8px 0;
            font-size: 10px;
            color: #000;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            font-weight: bold;
        }
        
        .summary-card .amount {
            font-size: 14px;
            font-weight: bold;
            margin: 0;
            color: #000;
        }
        
        .section {
            margin-bottom: 20px;
        }
        
        .section h3 {
            color: #000;
            font-size: 12px;
            margin: 0 0 10px 0;
            padding-bottom: 5px;
            border-bottom: 1px solid #000;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .tax-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
        }
        
        .tax-table th,
        .tax-table td {
            padding: 8px 12px;
            text-align: left;
            border-bottom: 1px solid #000;
            border-right: 1px solid #000;
            word-wrap: break-word;
        }
        
        .tax-table th:last-child,
        .tax-table td:last-child {
            border-right: none;
        }
        
        .tax-table th {
            background: #f0f0f0;
            font-weight: bold;
            color: #000;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .tax-table td {
            font-size: 9px;
            color: #000;
        }
        
        .amount {
            text-align: right;
            font-weight: bold;
        }
        
        .status-paid {
            color: #000;
            font-weight: bold;
        }
        
        .status-unpaid {
            color: #000;
            font-weight: bold;
        }
        
        .status-overdue {
            color: #000;
            font-weight: bold;
        }
        
        .reminders {
            background: #fff3cd;
            border: 1px solid #ffeaa7;
            padding: 10px;
            margin-bottom: 20px;
        }
        
        .reminders h4 {
            margin: 0 0 8px 0;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
            color: #000;
        }
        
        .reminder-item {
            margin-bottom: 5px;
            font-size: 9px;
            color: #000;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #000;
            text-align: center;
            color: #000;
            font-size: 9px;
        }
        
        .disclaimer {
            margin-top: 30px;
            padding: 10px;
            border: 1px solid #000;
            background: #f9f9f9;
        }
        
        .disclaimer h4 {
            margin: 0 0 8px 0;
            font-size: 10px;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .disclaimer p {
            margin: 0;
            font-size: 8px;
            line-height: 1.2;
        }
        
        @page {
            margin: 1cm;
        }
    </style>
</head>
<body>
    <!-- Header -->
    <div class="header">
        <div class="company-name">{{ $user->business_name ?? 'UMKM' }}</div>
        <h1>LAPORAN PAJAK</h1>
        <h2>Periode {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</h2>
    </div>

    <!-- Business Info -->
    <div class="business-info">
        <h3>Informasi Usaha</h3>
        <p><strong>Nama Usaha:</strong> {{ $user->business_name ?? 'Belum diisi' }}</p>
        <p><strong>Jenis Usaha:</strong> {{ $user->business_type ?? 'Belum diisi' }}</p>
        <p><strong>Alamat:</strong> {{ $user->business_address ?? 'Belum diisi' }}</p>
        <p><strong>Telepon:</strong> {{ $user->phone_number ?? 'Belum diisi' }}</p>
    </div>

    <!-- Period Info -->
    <div class="period-info">
        <h3>Periode Laporan</h3>
        <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}</p>
        <p><strong>Tanggal Akhir:</strong> {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
    </div>

    <!-- Summary Cards -->
    <div class="summary-cards">
        <div class="summary-card">
            <h4>Total Pemasukan</h4>
            <p class="amount">Rp {{ number_format($taxCalculation['total_income'], 0, ',', '.') }}</p>
        </div>
        <div class="summary-card">
            <h4>Total Pengeluaran</h4>
            <p class="amount">Rp {{ number_format($taxCalculation['total_expense'], 0, ',', '.') }}</p>
        </div>
        <div class="summary-card">
            <h4>Laba Bersih</h4>
            <p class="amount">Rp {{ number_format($taxCalculation['net_income'], 0, ',', '.') }}</p>
        </div>
        <div class="summary-card">
            <h4>Total Pajak</h4>
            <p class="amount">Rp {{ number_format($taxCalculation['total_tax'], 0, ',', '.') }}</p>
        </div>
    </div>


    <!-- Tax Calculation Details -->
    <div class="section">
        <h3>Detail Kalkulasi Pajak</h3>
        <table class="tax-table">
            <thead>
                <tr>
                    <th>Jenis Pajak</th>
                    <th>Tarif</th>
                    <th>Dasar Pengenaan</th>
                    <th>Jumlah Pajak</th>
                    <th>Jatuh Tempo</th>
                </tr>
            </thead>
            <tbody>
                @foreach($taxCalculation['taxes'] as $tax)
                <tr>
                    <td>
                        <strong>{{ $tax['name'] }}</strong><br>
                        <small>{{ $tax['description'] }}</small>
                    </td>
                    <td>{{ $tax['rate'] }}%</td>
                    <td class="amount">Rp {{ number_format($tax['taxable_amount'], 0, ',', '.') }}</td>
                    <td class="amount">Rp {{ number_format($tax['amount'], 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($tax['due_date'])->format('d M Y') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


    <!-- Tax Analysis -->
    <div class="section">
        <h3>Analisis Pajak</h3>
        <div style="background-color: #f8f9fa; padding: 15px; border-left: 4px solid #000;">
            @php
                $taxRatio = $taxCalculation['total_income'] > 0 ? ($taxCalculation['total_tax'] / $taxCalculation['total_income']) * 100 : 0;
                $netIncomeAfterTax = $taxCalculation['net_income'] - $taxCalculation['total_tax'];
            @endphp
            
            <p><strong>Rasio Pajak terhadap Pemasukan:</strong> {{ number_format($taxRatio, 2) }}%</p>
            <p><strong>Laba Bersih Setelah Pajak:</strong> Rp {{ number_format($netIncomeAfterTax, 0, ',', '.') }}</p>
            
            @if($taxRatio > 10)
                <p><strong>Rekomendasi:</strong> Rasio pajak cukup tinggi, pertimbangkan untuk mengoptimalkan struktur bisnis.</p>
            @elseif($taxRatio > 5)
                <p><strong>Rekomendasi:</strong> Rasio pajak dalam batas wajar, pertahankan efisiensi operasional.</p>
            @else
                <p><strong>Rekomendasi:</strong> Rasio pajak rendah, bisnis berjalan efisien dari segi perpajakan.</p>
            @endif
        </div>
    </div>

    <!-- Signature Section -->
    <div class="signature-section" style="margin-top: 40px;">
        <div style="display: table; width: 100%;">
            <div style="display: table-cell; width: 50%; text-align: center;">
                <p style="margin: 20px 0 5px 0; font-size: 10px;">Dibuat oleh:</p>
                <div style="border-bottom: 1px solid #000; width: 200px; margin: 0 auto;"></div>
                <p style="margin: 5px 0 0 0; font-size: 9px;">{{ $user->name }}</p>
                <p style="margin: 0; font-size: 8px;">Pemilik/Pengelola</p>
            </div>
            <div style="display: table-cell; width: 50%; text-align: center;">
                <p style="margin: 20px 0 5px 0; font-size: 10px;">Tanggal:</p>
                <div style="border-bottom: 1px solid #000; width: 200px; margin: 0 auto;"></div>
                <p style="margin: 5px 0 0 0; font-size: 9px;">{{ \Carbon\Carbon::now()->format('d M Y') }}</p>
            </div>
        </div>
    </div>

    <!-- Disclaimer -->
    <div class="disclaimer">
        <h4>Disclaimer</h4>
        <p>
            Laporan pajak ini dibuat berdasarkan data transaksi yang tercatat dalam sistem dan peraturan pajak yang berlaku. 
            Akurasi laporan bergantung pada kelengkapan dan ketepatan data yang dimasukkan. 
            Laporan ini hanya untuk keperluan internal dan tidak dimaksudkan sebagai laporan audit atau konsultasi pajak resmi.
            Disarankan untuk berkonsultasi dengan konsultan pajak untuk kepastian perhitungan pajak.
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Laporan ini dibuat secara otomatis oleh Sistem Manajemen Keuangan UMKM</strong></p>
        <p>Dicetak pada {{ \Carbon\Carbon::now()->format('d M Y H:i') }} | Halaman 1 dari 1</p>
    </div>
</body>
</html>





