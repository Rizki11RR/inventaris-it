<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Rekomendasi AHP - {{ $tanggal }}</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        .header { text-align: center; margin-bottom: 20px; border-bottom: 2px solid #000; padding-bottom: 10px; }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { border: 1px solid #000; padding: 8px; text-align: center; }
        th { background-color: #f2f2f2; }
        .text-left { text-align: left; }
        .footer { margin-top: 30px; text-align: right; }
        .signature { margin-top: 50px; margin-right: 50px; }
    </style>
</head>
<body>
    <div class="header">
        <h2>LAPORAN REKOMENDASI PERBAIKAN ASET IT</h2>
        <h3>SISTEM INVENTARIS BERBASIS METODE AHP</h3>
        <p>Tanggal Cetak: {{ $tanggal }}</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Kode Aset</th>
                <th>Nama Perangkat</th>
                <th>Kategori</th>
                <th>Skor AHP</th>
                <th>Rekomendasi</th>
            </tr>
        </thead>
        <tbody>
            @forelse($rekomendasi as $key => $item)
            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $item->asset->kode_aset ?? '-' }}</td>
                <td>{{ $item->asset->nama_perangkat ?? 'Data Terhapus' }}</td>
                {{-- Tambahkan kolom kategori di bawah ini --}}
                <td>{{ $item->asset->category->nama_kategori ?? '-' }}</td>
                {{-- Skor AHP sekarang berada di kolom yang benar --}}
                <td class="fw-bold text-primary">{{ number_format($item->total_score, 3) }}</td>
                <td>
                    @if($item->total_score >= 0.8)
                        <span class="badge bg-success">Sangat Layak</span>
                    @elseif($item->total_score >= 0.4)
                        <span class="badge bg-warning text-dark">Perbaikan</span>
                    @else
                        <span class="badge bg-danger">Ganti Baru</span>
                    @endif
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" style="text-align: center;">Tidak ada data laporan tersedia.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <div class="footer">
        <p>Dicetak oleh: {{ Auth::user()->name }}</p>
        <div class="signature">
            <p>Mengetahui,</p>
            <br><br><br>
            <p><b>( Manajer IT )</b></p>
        </div>
    </div>

    <script>
        // Otomatis membuka jendela print saat halaman dimuat
        window.print();
    </script>
</body>
</html>