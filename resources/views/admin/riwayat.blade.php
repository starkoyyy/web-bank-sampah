@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-lg-12">
        
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100 bg-white">
            <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                        <div class="bg-success p-2 rounded-3 d-flex align-items-center justify-content-center">
                            <i class="bi bi-clock-history text-white" style="font-size: 1.2rem;"></i>
                        </div>
                        Riwayat Transaksi Seluruh Nasabah
                    </h5>
                    
                    <!-- Tabs Navs -->
                    <ul class="nav nav-pills custom-tabs bg-light shadow-sm p-1 rounded-pill mb-3" id="transactionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill fw-medium px-4 py-2" id="setor-tab" data-bs-toggle="tab" data-bs-target="#setor" type="button" role="tab" aria-controls="setor" aria-selected="true">Setoran</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill fw-medium px-4 py-2" id="tarik-tab" data-bs-toggle="tab" data-bs-target="#tarik" type="button" role="tab" aria-controls="tarik" aria-selected="false">Penarikan</button>
                        </li>
                    </ul>
                </div>
                
                <!-- Filter Section -->
                <div class="mb-3 mt-3 d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3">
                    <form action="/admin/riwayat" method="GET" class="d-flex align-items-center gap-2">
                        <input type="date" name="mulai" class="form-control form-control-sm rounded-pill px-3" value="{{ $mulai ?? '' }}" required title="Dari Tanggal">
                        <span class="text-muted small">-</span>
                        <input type="date" name="akhir" class="form-control form-control-sm rounded-pill px-3" value="{{ $akhir ?? '' }}" required title="Sampai Tanggal">
                        <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm" title="Cari"><i class="bi bi-search"></i></button>
                        @if(isset($filter) && $filter == 'manual')
                            <a href="/admin/riwayat" class="btn btn-sm btn-light border rounded-pill px-3 text-danger shadow-sm" title="Reset"><i class="bi bi-x-lg"></i></a>
                        @endif
                    </form>
                    
                    <div class="d-flex align-items-center">
                        <span class="text-muted small fw-medium me-2"><i class="bi bi-lightning-charge text-warning"></i> Cepat:</span>
                        <div class="btn-group bg-light shadow-sm rounded-pill p-1 border" role="group">
                            <a href="?filter=semua" class="btn btn-sm rounded-pill {{ $filter == 'semua' ? 'btn-success fw-bold text-white shadow-sm' : 'btn-transparent text-secondary fw-medium' }} px-3">Semua</a>
                            <a href="?filter=hari" class="btn btn-sm rounded-pill {{ $filter == 'hari' ? 'btn-success fw-bold text-white shadow-sm' : 'btn-transparent text-secondary fw-medium' }} px-3">Hari Ini</a>
                            <a href="?filter=bulan" class="btn btn-sm rounded-pill {{ $filter == 'bulan' ? 'btn-success fw-bold text-white shadow-sm' : 'btn-transparent text-secondary fw-medium' }} px-3">Bulan Ini</a>
                            <a href="?filter=tahun" class="btn btn-sm rounded-pill {{ $filter == 'tahun' ? 'btn-success fw-bold text-white shadow-sm' : 'btn-transparent text-secondary fw-medium' }} px-3">Tahun Ini</a>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card-body p-0">
                <div class="tab-content" id="transactionTabsContent">
                    
                    <!-- TAB SETORAN -->
                    <div class="tab-pane fade show active" id="setor" role="tabpanel" aria-labelledby="setor-tab">
                        @if(isset($riwayat_setor) && $riwayat_setor->count() > 0)
                            <div class="table-responsive px-1 pb-3">
                                <table class="table table-custom align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Warga</th>
                                            <th>Kategori & Berat</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end">Total Bayar</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($riwayat_setor as $rs)
                                        <tr>
                                            <td class="text-secondary fw-medium small">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="bi bi-calendar2-week text-secondary"></i>
                                                    {{ date('d M Y', strtotime($rs->tanggal_setor)) }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-dark">
                                                {{ $rs->nama }}
                                            </td>
                                            <td class="text-dark fw-medium">
                                                <span class="badge bg-secondary me-1">{{ $rs->nama_kategori }}</span> 
                                                {{ $rs->berat }} Kg
                                            </td>
                                            <td class="text-center">
                                                @if($rs->status == 'pending')
                                                    <span class="badge bg-warning text-dark px-3 py-1 fw-bold">Menunggu</span>
                                                @elseif($rs->status == 'disetujui')
                                                    <span class="badge bg-success px-3 py-1 fw-bold">Disetujui</span>
                                                @else
                                                    <span class="badge bg-danger px-3 py-1 fw-bold">Ditolak</span>
                                                @endif
                                            </td>
                                            <td class="text-success fw-bold text-end">Rp {{ number_format($rs->total_harga, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5 bg-white rounded-4 shadow-sm m-3 border">
                                <i class="bi bi-inbox fs-1 text-secondary opacity-50 mb-3 d-block"></i>
                                <h6 class="fw-bold text-dark">Tidak ada data setoran</h6>
                                <p class="text-muted small mb-0">Belum ada riwayat setoran pada rentang waktu ini.</p>
                            </div>
                        @endif
                    </div>
                    
                    <!-- TAB PENARIKAN -->
                    <div class="tab-pane fade" id="tarik" role="tabpanel" aria-labelledby="tarik-tab">
                        @if(isset($riwayat_tarik) && $riwayat_tarik->count() > 0)
                            <div class="table-responsive px-1 pb-3">
                                <table class="table table-custom align-middle mb-0">
                                    <thead class="table-light">
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Nama Warga</th>
                                            <th>Tujuan</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end">Nominal Tarik</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($riwayat_tarik as $rt)
                                        <tr>
                                            <td class="text-secondary fw-medium small">
                                                <div class="d-flex align-items-center gap-2">
                                                    <i class="bi bi-calendar2-week text-secondary"></i>
                                                    {{ date('d M Y', strtotime($rt->tanggal_tarik)) }}
                                                </div>
                                            </td>
                                            <td class="fw-bold text-dark">
                                                {{ $rt->nama }}
                                            </td>
                                            <td class="fw-bold text-dark">
                                                <span class="badge bg-secondary px-2 py-1 me-2">{{ $rt->metode_penarikan }}</span>
                                                @if($rt->detail_tujuan)
                                                    <span class="small text-muted">{{ $rt->detail_tujuan }}</span>
                                                @endif
                                            </td>
                                            <td class="text-center">
                                                @if($rt->status == 'pending')
                                                    <span class="badge bg-warning text-dark px-3 py-1 fw-bold">Menunggu</span>
                                                @elseif($rt->status == 'disetujui')
                                                    <span class="badge bg-success px-3 py-1 fw-bold">Disetujui</span>
                                                @else
                                                    <span class="badge bg-danger px-3 py-1 fw-bold">Ditolak</span>
                                                @endif
                                            </td>
                                            <td class="text-danger fw-bold text-end">
                                                - Rp {{ number_format($rt->jumlah_tarik, 0, ',', '.') }}
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-center py-5 bg-white rounded-4 shadow-sm m-3 border">
                                <i class="bi bi-inbox fs-1 text-secondary opacity-50 mb-3 d-block"></i>
                                <h6 class="fw-bold text-dark">Tidak ada data penarikan</h6>
                                <p class="text-muted small mb-0">Belum ada riwayat penarikan pada rentang waktu ini.</p>
                            </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
        
    </div>
</div>
@endsection
