@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="bi bi-bell text-success me-2"></i>Pengajuan Transaksi</h4>
        <p class="text-muted mb-0">Kelola persetujuan setoran sampah dan penarikan uang kas oleh warga.</p>
    </div>
</div>

@if(session('success')) <div class="alert alert-success">{{ session('success') }}</div> @endif
@if(session('error')) <div class="alert alert-danger">{{ session('error') }}</div> @endif

<div class="card border-0 shadow-sm rounded-4 bg-transparent">
    <div class="card-header bg-transparent border-0 pt-4 pb-0 px-4">
        <!-- Tabs Navs -->
        <ul class="nav nav-pills custom-tabs bg-white shadow-sm p-1 rounded-pill d-inline-flex mb-3" id="adminTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active rounded-pill fw-medium px-4 py-2" id="setor-tab" data-bs-toggle="tab" data-bs-target="#setor" type="button" role="tab" aria-controls="setor" aria-selected="true">Pengajuan Setoran</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link rounded-pill fw-medium px-4 py-2" id="tarik-tab" data-bs-toggle="tab" data-bs-target="#tarik" type="button" role="tab" aria-controls="tarik" aria-selected="false">Pengajuan Penarikan</button>
            </li>
        </ul>
    </div>

    <div class="card-body p-0">
        <div class="tab-content" id="adminTabsContent">
            
            <!-- TAB SETORAN -->
            <div class="tab-pane fade show active" id="setor" role="tabpanel" aria-labelledby="setor-tab">
                <div class="table-responsive px-1 pb-3">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Warga</th>
                                <th>Kategori (Berat)</th>
                                <th>Nominal</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_setor as $s)
                            <tr>
                                <td class="text-secondary fw-medium small">{{ date('d M Y', strtotime($s->tanggal_setor)) }}</td>
                                <td class="fw-bold text-dark">{{ $s->nama }}</td>
                                <td class="text-secondary small">{{ $s->nama_kategori }} ({{ $s->berat }} Kg)</td>
                                <td class="text-success fw-bold">+ Rp {{ number_format($s->total_harga, 0, ',', '.') }}</td>
                                <td>
                                    @if($s->status === 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-1 fw-bold">Menunggu</span>
                                    @elseif($s->status === 'disetujui')
                                        <span class="badge bg-success px-3 py-1 fw-bold">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-1 fw-bold">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if($s->status === 'pending')
                                    <div class="d-flex gap-2">
                                        <form action="/admin/pengajuan/setor/{{ $s->id }}/setujui" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm hover-shadow" style="font-size: 0.8rem;"><i class="bi bi-check-lg"></i> Setujui</button>
                                        </form>
                                        <form action="/admin/pengajuan/setor/{{ $s->id }}/tolak" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm hover-shadow" style="font-size: 0.8rem;"><i class="bi bi-x-lg"></i> Tolak</button>
                                        </form>
                                    </div>
                                    @else
                                        <span class="text-muted small fw-medium"><i class="bi bi-check2-all text-success"></i> Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5 bg-white rounded-4 shadow-sm">
                                    <i class="bi bi-check-circle fs-1 d-block mb-3 text-success opacity-50"></i>
                                    <h6 class="fw-medium text-dark mb-1">Semua setoran sudah diproses</h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <!-- TAB PENARIKAN -->
            <div class="tab-pane fade" id="tarik" role="tabpanel" aria-labelledby="tarik-tab">
                <div class="table-responsive px-1 pb-3">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th>Tanggal</th>
                                <th>Nama Warga</th>
                                <th>Metode & Tujuan</th>
                                <th>Nominal Ditarik</th>
                                <th>Status</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($data_tarik as $t)
                            <tr>
                                <td class="text-secondary fw-medium small">{{ date('d M Y', strtotime($t->tanggal_tarik)) }}</td>
                                <td class="fw-bold text-dark">{{ $t->nama }}</td>
                                <td>
                                    <span class="badge bg-secondary px-2 py-1 mb-1">{{ $t->metode_penarikan }}</span>
                                    @if($t->detail_tujuan)
                                        <div class="small fw-medium text-dark">{{ $t->detail_tujuan }}</div>
                                    @endif
                                </td>
                                <td class="text-danger fw-bold">- Rp {{ number_format($t->jumlah_tarik, 0, ',', '.') }}</td>
                                <td>
                                    @if($t->status === 'pending')
                                        <span class="badge bg-warning text-dark px-3 py-1 fw-bold">Menunggu</span>
                                    @elseif($t->status === 'disetujui')
                                        <span class="badge bg-success px-3 py-1 fw-bold">Disetujui</span>
                                    @else
                                        <span class="badge bg-danger px-3 py-1 fw-bold">Ditolak</span>
                                    @endif
                                </td>
                                <td>
                                    @if($t->status === 'pending')
                                    <div class="d-flex gap-2">
                                        <form action="/admin/pengajuan/{{ $t->id }}/setuju" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-success rounded-pill px-3 shadow-sm hover-shadow" style="font-size: 0.8rem;"><i class="bi bi-check-lg"></i> Setujui</button>
                                        </form>
                                        <form action="/admin/pengajuan/{{ $t->id }}/tolak" method="POST" class="m-0">
                                            @csrf
                                            <button type="submit" class="btn btn-sm btn-danger rounded-pill px-3 shadow-sm hover-shadow" style="font-size: 0.8rem;"><i class="bi bi-x-lg"></i> Tolak</button>
                                        </form>
                                    </div>
                                    @else
                                        <span class="text-muted small fw-medium"><i class="bi bi-check2-all text-success"></i> Selesai</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-5 bg-white rounded-4 shadow-sm">
                                    <i class="bi bi-check-circle fs-1 d-block mb-3 text-success opacity-50"></i>
                                    <h6 class="fw-medium text-dark mb-1">Semua penarikan sudah diproses</h6>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .custom-tabs .nav-link.active { 
        background-color: var(--bs-success) !important; 
        color: white !important; 
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
    }
    .custom-tabs .nav-link { color: #64748b; font-weight: 600; }
</style>
@endsection