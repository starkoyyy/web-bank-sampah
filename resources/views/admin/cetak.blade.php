<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Cetak Laporan Bank Sampah</title>
    <style>
        body { font-family: 'Times New Roman', Times, serif; color: #000; font-size: 12pt; padding: 20px; }
        .header { text-align: center; border-bottom: 3px solid #000; padding-bottom: 10px; margin-bottom: 20px; }
        .header h2, .header h3, .header p { margin: 0; padding: 2px; }
        .header h2 { font-size: 16pt; text-transform: uppercase; }
        .header h3 { font-size: 18pt; font-weight: bold; text-transform: uppercase; }
        .header p { font-size: 11pt; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #000; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; text-align: center; }
        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .ttd { width: 300px; float: right; margin-top: 40px; text-align: center; }
        .ttd p { margin-bottom: 70px; }
        .periode { text-align: center; font-size: 11pt; margin-top: -10px; font-weight: normal; }
    </style>
</head>
<body>

    <!-- Kop Surat Resmi -->
    <div class="header">
        <h2>Pemerintah Kabupaten Kuningan</h2>
        <h2>Kecamatan Kuningan</h2>
        <h3>Bank Sampah Desa Winduherang</h3>
        <p>Alamat: Kantor Kepala Desa Winduherang, Kab. Kuningan, Jawa Barat</p>
    </div>

    <h3 class="text-center">LAPORAN REKAPITULASI SETORAN SAMPAH</h3>
    
    <!-- Munculkan teks periode jika difilter -->
    @if($mulai && $akhir)
        <p class="periode">Periode: {{ date('d/m/Y', strtotime($mulai)) }} s.d {{ date('d/m/Y', strtotime($akhir)) }}</p>
    @else
        <p class="periode">Periode: Keseluruhan Transaksi</p>
    @endif

    <table>
        <thead>
            <tr>
                <th>No</th>
                <th>Tanggal Setor</th>
                <th>Nama Warga</th>
                <th>Kategori Sampah</th>
                <th>Berat (Kg)</th>
                <th>Total Saldo (Rp)</th>
            </tr>
        </thead>
        <tbody>
            @php $total_keseluruhan = 0; @endphp
            @forelse($data_setor as $s)
            @php $total_keseluruhan += $s->total_harga; @endphp
            <tr>
                <td class="text-center">{{ $loop->iteration }}</td>
                <td class="text-center">{{ date('d/m/Y', strtotime($s->tanggal_setor)) }}</td>
                <td>{{ $s->nama }}</td>
                <td class="text-center">{{ $s->nama_kategori }}</td>
                <td class="text-center">{{ $s->berat }}</td>
                <td class="text-right">{{ number_format($s->total_harga, 0, ',', '.') }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" class="text-center">Tidak ada data setoran.</td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <th colspan="5" class="text-right">TOTAL KESELURUHAN</th>
                <th class="text-right">Rp {{ number_format($total_keseluruhan, 0, ',', '.') }}</th>
            </tr>
        </tfoot>
    </table>

    <!-- Kolom Tanda Tangan -->
    <div class="ttd">
        <p>Winduherang, {{ date('d F Y') }}<br>Administrator Bank Sampah</p>
        <strong><u>{{ Auth::user()->nama }}</u></strong>
    </div>

    <script>
        window.onload = function() {
            window.print();
        }
    </script>
</body>
</html>