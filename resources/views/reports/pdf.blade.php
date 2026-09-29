<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan - Stockify WMS</title>
    <style>
        body { font-family: sans-serif; color: #333; line-height: 1.5; padding: 20px; }
        h2 { text-align: center; margin-bottom: 5px; }
        p.subtitle { text-align: center; color: #666; margin-top: 0; margin-bottom: 20px; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px 12px; font-size: 14px; text-align: left; }
        th { background-color: #f4f4f4; }
        .summary { margin-bottom: 20px; font-size: 14px; }
        
        /* Gaya untuk Tombol Kembali */
        .btn-back {
            display: inline-block;
            background-color: #4f46e5;
            color: white;
            padding: 8px 16px;
            text-decoration: none;
            border-radius: 5px;
            font-size: 14px;
            margin-bottom: 20px;
        }
        .btn-back:hover {
            background-color: #4338ca;
        }

        /* Trik agar tombol kembali TIDAK IKUT TERCETAK di kertas/PDF */
        @media print {
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">

    <!-- Tombol Kembali ke Dashboard -->
    <div class="no-print">
        <a href="{{ route('dashboard') }}" class="btn-back">&larr; Kembali ke Dashboard</a>
    </div>

    <h2>Laporan Resmi Stockify WMS</h2>
    <p class="subtitle">Sistem Manajemen Gudang Terpusat</p>

    <div class="summary">
        <p><strong>Total Produk:</strong> {{ $totalProducts }}</p>
        <p><strong>Total Stok Keseluruhan:</strong> {{ $totalStock }}</p>
    </div>

    <h3>Riwayat Transaksi Stok</h3>
    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal</th>
                <th>Nama Produk</th>
                <th>Tipe</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @forelse($transactions as $index => $trx)
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ $trx->created_at }}</td>
                <td>{{ $trx->product->name ?? 'Produk Dihapus' }}</td>
                <td>{{ ucfirst($trx->type) }}</td>
                <td>{{ $trx->quantity }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data transaksi.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

</body>
</html>