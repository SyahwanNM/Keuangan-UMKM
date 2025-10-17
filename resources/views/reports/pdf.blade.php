<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Keuangan UMKM</title>
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
            width: 33.33%;
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
        
        .category-grid {
            display: table;
            width: 100%;
            margin-bottom: 15px;
            border-collapse: collapse;
        }
        
        .category-section {
            display: table-cell;
            width: 50%;
            background: #f9f9f9;
            padding: 10px;
            border: 1px solid #000;
            vertical-align: top;
        }
        
        .category-section h4 {
            margin: 0 0 8px 0;
            font-size: 10px;
            color: #000;
            font-weight: bold;
            text-transform: uppercase;
        }
        
        .category-item {
            display: table;
            width: 100%;
            padding: 3px 0;
            border-bottom: 1px solid #000;
        }
        
        .category-item:last-child {
            border-bottom: none;
        }
        
        .category-name {
            display: table-cell;
            color: #000;
            font-size: 9px;
            width: 60%;
        }
        
        .category-amount {
            display: table-cell;
            font-weight: bold;
            font-size: 9px;
            text-align: right;
            color: #000;
        }
        
        .transactions-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 15px;
            table-layout: fixed;
        }
        
        .transactions-table th,
        .transactions-table td {
            padding: 8px 12px;
            text-align: left;
            border-bottom: 1px solid #E5E7EB;
            border-right: 1px solid #E5E7EB;
            word-wrap: break-word;
        }
        
        .transactions-table th:last-child,
        .transactions-table td:last-child {
            border-right: none;
        }
        
        .transactions-table th {
            background: #f0f0f0;
            font-weight: bold;
            color: #000;
            font-size: 9px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        
        .transactions-table td {
            font-size: 9px;
            color: #000;
        }
        
        .transactions-table .type-income {
            color: #000;
            font-weight: bold;
        }
        
        .transactions-table .type-expense {
            color: #000;
            font-weight: bold;
        }
        
        .amount {
            text-align: right;
            font-weight: bold;
        }
        
        .footer {
            margin-top: 30px;
            padding-top: 15px;
            border-top: 1px solid #000;
            text-align: center;
            color: #000;
            font-size: 9px;
        }
        
        .no-data {
            text-align: center;
            color: #9CA3AF;
            font-style: italic;
            padding: 20px;
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
        <h1>LAPORAN KEUANGAN</h1>
        <h2>Periode {{ $periodName }} - {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }} s/d {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</h2>
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
        <p><strong>Jenis Laporan:</strong> {{ $periodName }}</p>
        <p><strong>Tanggal Mulai:</strong> {{ \Carbon\Carbon::parse($startDate)->format('d M Y') }}</p>
        <p><strong>Tanggal Akhir:</strong> {{ \Carbon\Carbon::parse($endDate)->format('d M Y') }}</p>
        <p><strong>Tanggal Cetak:</strong> {{ \Carbon\Carbon::now()->format('d M Y H:i') }}</p>
    </div>

    <!-- Summary Cards -->
    <div class="summary-cards">
        <div class="summary-card income">
            <h4>Total Pemasukan</h4>
            <p class="amount">Rp {{ number_format($totalIncome, 0, ',', '.') }}</p>
        </div>
        <div class="summary-card expense">
            <h4>Total Pengeluaran</h4>
            <p class="amount">Rp {{ number_format($totalExpense, 0, ',', '.') }}</p>
        </div>
        <div class="summary-card profit">
            <h4>Laba Bersih</h4>
            <p class="amount">Rp {{ number_format($netProfit, 0, ',', '.') }}</p>
        </div>
    </div>

    <!-- Category Breakdown -->
    @if($incomeByCategory->count() > 0 || $expenseByCategory->count() > 0)
    <div class="section">
        <h3>Rincian per Kategori</h3>
        <div class="category-grid">
            @if($incomeByCategory->count() > 0)
            <div class="category-section">
                <h4>Pemasukan per Kategori</h4>
                @foreach($incomeByCategory as $category => $amount)
                <div class="category-item">
                    <span class="category-name">{{ $category }}</span>
                    <span class="category-amount" style="color: #10B981;">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
            @endif

            @if($expenseByCategory->count() > 0)
            <div class="category-section">
                <h4>Pengeluaran per Kategori</h4>
                @foreach($expenseByCategory as $category => $amount)
                <div class="category-item">
                    <span class="category-name">{{ $category }}</span>
                    <span class="category-amount" style="color: #EF4444;">Rp {{ number_format($amount, 0, ',', '.') }}</span>
                </div>
                @endforeach
            </div>
            @endif
        </div>
    </div>
    @endif

    <!-- Transactions Table -->
    <div class="section">
        <h3>Detail Transaksi</h3>
        @if($transactions->count() > 0)
        <table class="transactions-table">
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Tipe</th>
                    <th>Kategori</th>
                    <th>Deskripsi</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody>
                @foreach($transactions as $transaction)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($transaction->date)->format('d M Y') }}</td>
                    <td class="type-{{ $transaction->type }}">
                        {{ $transaction->type == 'income' ? 'Pemasukan' : 'Pengeluaran' }}
                    </td>
                    <td>{{ $transaction->category }}</td>
                    <td>{{ $transaction->description }}</td>
                    <td class="amount type-{{ $transaction->type }}">
                        Rp {{ number_format($transaction->amount, 0, ',', '.') }}
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <div class="no-data">
            Tidak ada transaksi pada periode ini.
        </div>
        @endif
    </div>

    <!-- Analysis & Insights -->
    <div class="section">
        <h3>Analisis & Insight</h3>
        <div style="background-color: #f8f9fa; padding: 15px; border-left: 4px solid #3b82f6;">
            @php
                $roi = $totalCapital > 0 ? (($netProfit) / $totalCapital) * 100 : 0;
                $expenseRatio = $totalIncome > 0 ? ($totalExpense / $totalIncome) * 100 : 0;
            @endphp
            
            <p><strong>Return on Investment (ROI):</strong> {{ number_format($roi, 2) }}%</p>
            <p><strong>Rasio Pengeluaran terhadap Pemasukan:</strong> {{ number_format($expenseRatio, 2) }}%</p>
            
            @if($roi > 20)
                <p><strong>Status:</strong> Sangat baik! Bisnis memberikan return yang tinggi.</p>
            @elseif($roi > 10)
                <p><strong>Status:</strong> Baik! Bisnis memberikan return yang positif.</p>
            @elseif($roi > 0)
                <p><strong>Status:</strong> Cukup baik, bisnis masih menguntungkan.</p>
            @else
                <p><strong>Status:</strong> Perlu evaluasi strategi bisnis untuk meningkatkan profitabilitas.</p>
            @endif
            
            @if($expenseRatio > 80)
                <p><strong>Rekomendasi:</strong> Pengeluaran terlalu tinggi, perlu optimasi biaya operasional.</p>
            @elseif($expenseRatio > 60)
                <p><strong>Rekomendasi:</strong> Pengeluaran cukup tinggi, monitor dan kontrol biaya dengan ketat.</p>
            @else
                <p><strong>Rekomendasi:</strong> Rasio pengeluaran dalam batas wajar, pertahankan efisiensi.</p>
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
    <div class="disclaimer" style="margin-top: 30px; padding: 10px; border: 1px solid #000; background: #f9f9f9;">
        <h4 style="margin: 0 0 8px 0; font-size: 10px; font-weight: bold; text-transform: uppercase;">Disclaimer</h4>
        <p style="margin: 0; font-size: 8px; line-height: 1.2;">
            Laporan keuangan ini dibuat berdasarkan data transaksi yang tercatat dalam sistem. 
            Akurasi laporan bergantung pada kelengkapan dan ketepatan data yang dimasukkan. 
            Laporan ini hanya untuk keperluan internal dan tidak dimaksudkan sebagai laporan audit.
        </p>
    </div>

    <!-- Footer -->
    <div class="footer">
        <p><strong>Laporan ini dibuat secara otomatis oleh Sistem Manajemen Keuangan UMKM</strong></p>
        <p>Dicetak pada {{ \Carbon\Carbon::now()->format('d M Y H:i') }} | Halaman 1 dari 1</p>
    </div>
</body>
</html>


