@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="bi bi-file-earmark-text text-success me-2"></i>Laporan Setoran</h4>
        <p class="text-muted mb-0">Rekapitulasi aktivitas setoran sampah berdasarkan tanggal.</p>
    </div>
    <div>
        <!-- Tombol Cetak (Otomatis membawa tanggal yang sedang difilter) -->
        <a href="/admin/laporan/cetak?mulai={{ $mulai }}&akhir={{ $akhir }}" target="_blank" class="btn btn-success rounded-pill px-4 shadow-sm">
            <i class="bi bi-printer-fill me-2"></i> Cetak Laporan
        </a>
    </div>
</div>

<!-- Form Filter Tanggal -->
<div class="card border-0 shadow-sm rounded-4 mb-4 bg-white">
    <div class="card-body p-4">
        <form action="/admin/laporan" method="GET" class="row g-3 align-items-end">
            <div class="col-md-4">
                <label class="form-label text-muted fw-medium">Dari Tanggal</label>
                <input type="date" name="mulai" class="form-control" value="{{ $mulai }}" required>
            </div>
            <div class="col-md-4">
                <label class="form-label text-muted fw-medium">Sampai Tanggal</label>
                <input type="date" name="akhir" class="form-control" value="{{ $akhir }}" required>
            </div>
            <div class="col-md-4">
                <button type="submit" class="btn btn-dark px-4 me-2"><i class="bi bi-search"></i> Tampilkan</button>
                <a href="/admin/laporan" class="btn btn-light border"><i class="bi bi-arrow-counterclockwise"></i> Reset</a>
            </div>
        </form>
    </div>
</div>

<!-- Tabel Laporan -->
<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="table-light">
                    <tr>
                        <th>No</th>
                        <th>Tanggal Setor</th>
                        <th>Nama Warga</th>
                        <th>Kategori</th>
                        <th>Berat (Kg)</th>
                        <th>Total Harga</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_setor as $s)
                    <tr>
                        <td class="text-muted">{{ $loop->iteration }}</td>
                        <td class="text-dark">{{ date('d M Y', strtotime($s->tanggal_setor)) }}</td>
                        <td class="fw-bold text-dark">{{ $s->nama }}</td>
                        <td><span class="badge bg-secondary">{{ $s->nama_kategori }}</span></td>
                        <td>{{ $s->berat }} Kg</td>
                        <td class="text-success fw-bold">Rp {{ number_format($s->total_harga, 0, ',', '.') }}</td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-5">
                            <i class="bi bi-inbox fs-1 d-block mb-2"></i>
                            Tidak ada data setoran pada rentang tanggal tersebut.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection