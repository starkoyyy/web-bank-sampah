@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-lg-10 col-xl-9">
        
        <div class="card border-0 shadow-sm rounded-4 overflow-hidden h-100">
            <div class="card-header bg-white border-0 pt-4 pb-0 px-4">
                <div class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <h5 class="fw-bold mb-0 text-dark d-flex align-items-center gap-2">
                        <div class="bg-success p-2 rounded-3 d-flex align-items-center justify-content-center">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M12 6V12L16 14" stroke="white" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        Riwayat Transaksi
                    </h5>
                    
                    <!-- Tabs Navs -->
                    <ul class="nav nav-pills custom-tabs bg-white shadow-sm p-1 rounded-pill mb-3" id="transactionTabs" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active rounded-pill fw-medium px-4 py-2" id="setor-tab" data-bs-toggle="tab" data-bs-target="#setor" type="button" role="tab" aria-controls="setor" aria-selected="true">Setoran</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link rounded-pill fw-medium px-4 py-2" id="tarik-tab" data-bs-toggle="tab" data-bs-target="#tarik" type="button" role="tab" aria-controls="tarik" aria-selected="false">Penarikan</button>
                        </li>
                    </ul>
                </div>
                
                <!-- Filter Section -->
                <div class="mb-3 d-flex justify-content-end align-items-center">
                    <span class="text-muted small fw-medium me-2"><i class="bi bi-funnel"></i> Filter:</span>
                    <div class="btn-group bg-white shadow-sm rounded-pill p-1" role="group">
                        <a href="?filter=semua" class="btn btn-sm rounded-pill {{ $filter == 'semua' ? 'btn-success fw-bold' : 'btn-light text-secondary fw-medium' }} px-3">Semua</a>
                        <a href="?filter=minggu" class="btn btn-sm rounded-pill {{ $filter == 'minggu' ? 'btn-success fw-bold' : 'btn-light text-secondary fw-medium' }} px-3">Minggu Ini</a>
                        <a href="?filter=bulan" class="btn btn-sm rounded-pill {{ $filter == 'bulan' ? 'btn-success fw-bold' : 'btn-light text-secondary fw-medium' }} px-3">Bulan Ini</a>
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
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Kategori</th>
                                            <th class="text-center">Status</th>
                                            <th class="text-end">Pendapatan</th>
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
                                                {{ $rs->nama_kategori }} <span class="fw-normal text-muted small ms-1">({{ $rs->berat }} Kg)</span>
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
                                            <td class="text-success fw-bold text-end">+ Rp {{ number_format($rs->total_harga, 0, ',', '.') }}</td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center text-center h-100 py-5 bg-white rounded-4 shadow-sm m-3">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-4" style="filter: drop-shadow(0 4px 6px rgba(16, 185, 129, 0.2));">
                                    <rect x="15" y="20" width="70" height="65" rx="12" fill="#d1fae5"/>
                                    <rect x="25" y="35" width="50" height="8" rx="4" fill="#34d399"/>
                                    <rect x="25" y="53" width="35" height="8" rx="4" fill="#34d399"/>
                                    <rect x="25" y="71" width="20" height="8" rx="4" fill="#a7f3d0"/>
                                    <circle cx="70" cy="70" r="16" fill="#10b981"/>
                                    <path d="M65 70L68 73L76 65" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                                <h6 class="fw-bold text-dark">Belum ada riwayat</h6>
                                <p class="text-muted small mb-4">Anda belum pernah melakukan setoran sampah.</p>
                                <a href="/setor" class="btn btn-sm btn-success rounded-pill px-4 shadow-sm">Setor Sekarang</a>
                            </div>
                        @endif
                    </div>
                    
                    <!-- TAB PENARIKAN -->
                    <div class="tab-pane fade" id="tarik" role="tabpanel" aria-labelledby="tarik-tab">
                        @if(isset($riwayat_tarik) && $riwayat_tarik->count() > 0)
                            <div class="table-responsive px-1 pb-3">
                                <table class="table table-custom align-middle mb-0">
                                    <thead>
                                        <tr>
                                            <th>Tanggal</th>
                                            <th>Metode & Tujuan</th>
                                            <th>Nominal Tarik</th>
                                            <th class="text-center">Status</th>
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
                                                <span class="badge bg-secondary px-2 py-1 me-2">{{ $rt->metode_penarikan }}</span>
                                                @if($rt->detail_tujuan)
                                                    <span class="small text-muted">{{ $rt->detail_tujuan }}</span>
                                                @endif
                                            </td>
                                            <td class="text-danger fw-bold">
                                                - Rp {{ number_format($rt->jumlah_tarik, 0, ',', '.') }}
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
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="d-flex flex-column align-items-center justify-content-center text-center py-5 bg-white rounded-4 shadow-sm m-3">
                                <svg width="100" height="100" viewBox="0 0 100 100" fill="none" xmlns="http://www.w3.org/2000/svg" class="mb-4" style="filter: drop-shadow(0 4px 6px rgba(16, 185, 129, 0.2));">
                                    <rect x="10" y="30" width="80" height="50" rx="10" fill="#d1fae5"/>
                                    <path d="M10 40C10 34.4772 14.4772 30 20 30H80C85.5228 30 90 34.4772 90 40V45H10V40Z" fill="#34d399"/>
                                    <circle cx="75" cy="55" r="10" fill="#10b981"/>
                                    <circle cx="75" cy="55" r="4" fill="#ffffff"/>
                                    <rect x="25" y="60" width="25" height="6" rx="3" fill="#a7f3d0"/>
                                    <rect x="25" y="50" width="10" height="6" rx="3" fill="#a7f3d0"/>
                                </svg>
                                <h6 class="fw-bold text-dark">Belum ada riwayat penarikan</h6>
                                <p class="text-muted small mb-4">Anda belum pernah melakukan penarikan saldo.</p>
                                <a href="/tarik" class="btn btn-sm btn-success rounded-pill px-4 shadow-sm">Tarik Saldo</a>
                            </div>
                        @endif
                    </div>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-bg-light:hover { background-color: #f8fafc !important; }
    .custom-tabs .nav-link.active { 
        background-color: var(--bs-success) !important; 
        color: white !important; 
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
    }
    .custom-tabs .nav-link { color: #64748b; font-weight: 600; }
</style>
@endsection
