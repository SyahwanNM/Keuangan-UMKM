<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Pajak Tahunan {{ $year }}</title>
    <style>
        body {
            font-family: 'DejaVu Sans', sans-serif;
            font-size: 12px;
            line-height: 1.4;
            color: #333;
            margin: 0;
            padding: 20px;
        }
        .header {
            text-align: center;
            margin-bottom: 30px;
            border-bottom: 2px solid #333;
            padding-bottom: 20px;
        }
        .header h1 {
            font-size: 24px;
            margin: 0;
            color: #2c3e50;
        }
        .header h2 {
            font-size: 18px;
            margin: 5px 0;
            color: #7f8c8d;
        }
        .business-info {
            background: #f8f9fa;
            padding: 15px;
            border-radius: 5px;
            margin-bottom: 20px;
        }
        .summary-grid {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .summary-item {
            display: table-cell;
            width: 25%;
            text-align: center;
            padding: 15px;
            border: 1px solid #ddd;
            background: #f8f9fa;
        }
        .summary-item h3 {
            margin: 0 0 10px 0;
            font-size: 14px;
            color: #666;
        }
        .summary-item .amount {
            font-size: 16px;
            font-weight: bold;
            color: #2c3e50;
        }
        .monthly-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .monthly-table th,
        .monthly-table td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        .monthly-table th {
            background: #f8f9fa;
            font-weight: bold;
            text-align: center;
        }
        .monthly-table tr:nth-child(even) {
            background: #f9f9f9;
        }
        .tax-details {
            margin-top: 20px;
        }
        .tax-details h3 {
            color: #2c3e50;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 10px;
            color: #666;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }
        .text-right {
            text-align: right;
        }
        .text-center {
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="header">
        <h1>LAPORAN PAJAK TAHUNAN</h1>
        <h2>Tahun {{ $year }}</h2>
        <p>Dibuat pada: {{ date('d F Y H:i') }}</p>
    </div>

    <div class="business-info">
        <h3>Informasi Usaha</h3>
        <p><strong>Nama Usaha:</strong> {{ $annualReport['user']->business_name ?? 'Belum diisi' }}</p>
        <p><strong>Jenis Usaha:</strong> {{ $annualReport['user']->business_type ?? 'Belum diisi' }}</p>
        <p><strong>Alamat:</strong> {{ $annualReport['user']->business_address ?? 'Belum diisi' }}</p>
        <p><strong>No. HP:</strong> {{ $annualReport['user']->phone_number ?? 'Belum diisi' }}</p>
    </div>

    <div class="summary-grid">
        <div class="summary-item">
            <h3>Total Pemasukan</h3>
            <div class="amount">Rp {{ number_format($annualReport['total_annual_income'], 0, ',', '.') }}</div>
        </div>
        <div class="summary-item">
            <h3>Total Pengeluaran</h3>
            <div class="amount">Rp {{ number_format($annualReport['total_annual_expense'], 0, ',', '.') }}</div>
        </div>
        <div class="summary-item">
            <h3>Laba Bersih</h3>
            <div class="amount">Rp {{ number_format($annualReport['total_annual_net_income'], 0, ',', '.') }}</div>
        </div>
        <div class="summary-item">
            <h3>Total Pajak</h3>
            <div class="amount">Rp {{ number_format($annualReport['total_annual_tax'], 0, ',', '.') }}</div>
        </div>
    </div>

    <h3>Ringkasan Tahunan</h3>
    <div class="business-info">
        <p><strong>Bulan dengan Pajak:</strong> {{ $annualReport['summary']['months_with_tax'] }} bulan</p>
        <p><strong>Bulan tanpa Pajak:</strong> {{ $annualReport['summary']['months_without_tax'] }} bulan</p>
        <p><strong>Rata-rata Pajak Bulanan:</strong> Rp {{ number_format($annualReport['summary']['average_monthly_tax'], 0, ',', '.') }}</p>
        <p><strong>Pajak Tertinggi:</strong> Rp {{ number_format($annualReport['summary']['highest_month_tax'], 0, ',', '.') }}</p>
        <p><strong>Pajak Terendah:</strong> Rp {{ number_format($annualReport['summary']['lowest_month_tax'], 0, ',', '.') }}</p>
    </div>

    <h3>Detail Pajak Per Bulan</h3>
    <table class="monthly-table">
        <thead>
            <tr>
                <th>Bulan</th>
                <th class="text-right">Pemasukan</th>
                <th class="text-right">Pengeluaran</th>
                <th class="text-right">Laba Bersih</th>
                <th class="text-right">Pajak Dihitung</th>
            </tr>
        </thead>
        <tbody>
            @foreach($annualReport['monthly_reports'] as $monthly)
            <tr>
                <td>{{ $monthly['month_name_id'] }} {{ $year }}</td>
                <td class="text-right">Rp {{ number_format($monthly['income'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($monthly['expense'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($monthly['net_income'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($monthly['calculated_tax'], 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
        <tfoot>
            <tr style="background: #e8f4fd; font-weight: bold;">
                <td>TOTAL</td>
                <td class="text-right">Rp {{ number_format($annualReport['total_annual_income'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($annualReport['total_annual_expense'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($annualReport['total_annual_net_income'], 0, ',', '.') }}</td>
                <td class="text-right">Rp {{ number_format($annualReport['total_annual_tax'], 0, ',', '.') }}</td>
            </tr>
        </tfoot>
    </table>

    @if($annualReport['annual_tax_calculation']['taxes'])
    <div class="tax-details">
        <h3>Detail Jenis Pajak Tahunan</h3>
        <table class="monthly-table">
            <thead>
                <tr>
                    <th>Jenis Pajak</th>
                    <th class="text-right">Tarif</th>
                    <th class="text-right">Dasar Pengenaan</th>
                    <th class="text-right">Jumlah Pajak</th>
                </tr>
            </thead>
            <tbody>
                @foreach($annualReport['annual_tax_calculation']['taxes'] as $tax)
                <tr>
                    <td>{{ $tax['name'] }}</td>
                    <td class="text-right">{{ $tax['rate'] }}%</td>
                    <td class="text-right">Rp {{ number_format($tax['taxable_amount'], 0, ',', '.') }}</td>
                    <td class="text-right">Rp {{ number_format($tax['amount'], 0, ',', '.') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif

    <div class="footer">
        <p>Laporan ini dibuat otomatis oleh sistem Keuangan UMKM</p>
        <p>Untuk pertanyaan atau klarifikasi, silakan hubungi administrator sistem</p>
        <p>Dicetak pada: {{ date('d F Y H:i:s') }}</p>
    </div>
</body>
</html>
