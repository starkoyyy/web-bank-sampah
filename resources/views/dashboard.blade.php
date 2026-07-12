@extends('layouts.app')

@section('content')


<div class="row g-4 mb-5 justify-content-center mt-2">
    <!-- Kolom Kiri: Profil & Saldo -->
    <div class="col-lg-6 col-md-8">
        <div class="card border-0 shadow-sm rounded-4 h-100 overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #fdfbf7 100%); border: 1px solid rgba(6, 78, 59, 0.08) !important;">
            <!-- Header Background / Accent -->
            <div class="position-relative py-4 text-center" style="background: linear-gradient(135deg, rgba(6, 78, 59, 0.08) 0%, rgba(6, 78, 59, 0.02) 100%);">
                <div class="position-absolute top-0 end-0 p-3">
                    <span class="badge rounded-pill px-3 py-2 shadow-sm text-dark" style="background-color: #f59e0b;"><i class="bi bi-person-check-fill me-1"></i> Warga Aktif</span>
                </div>
                <div class="d-inline-block bg-white rounded-circle p-2 shadow-sm mt-3 mb-2" style="box-shadow: 0 4px 15px rgba(6, 78, 59, 0.1) !important;">
                    <div class="rounded-circle d-flex align-items-center justify-content-center shadow-inner text-white" style="width: 84px; height: 84px; background: linear-gradient(135deg, var(--accent-green) 0%, var(--bs-success) 100%);">
                        <span class="fs-1 fw-bold">{{ strtoupper(substr(Auth::user()->nama, 0, 1)) }}</span>
                    </div>
                </div>
                <h4 class="fw-bold mb-1 mt-2 text-dark" style="letter-spacing: -0.5px;">{{ Auth::user()->nama }}</h4>
                <p class="text-muted small mb-0 fw-medium"><i class="bi bi-geo-alt-fill text-danger me-1"></i> {{ $nasabah->alamat }}</p>
            </div>
            
            <div class="card-body p-4 text-center d-flex flex-column justify-content-center">
                <!-- Premium Balance Card -->
                <div class="p-4 rounded-4 mb-4 position-relative overflow-hidden shadow-sm" style="background: linear-gradient(135deg, var(--bs-success) 0%, #4d7c0f 100%); border: 1px solid rgba(255,255,255,0.1);">
                    <!-- Decorative element -->
                    <div class="position-absolute top-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 100% 0%, rgba(255,255,255,0.2) 0%, transparent 50%); z-index: 0;"></div>
                    <div class="position-absolute bottom-0 start-0 w-100 h-100" style="background: radial-gradient(circle at 0% 100%, rgba(0,0,0,0.1) 0%, transparent 50%); z-index: 0;"></div>
                    
                    <h6 class="text-white text-opacity-75 fw-medium mb-2 position-relative" style="font-size: 0.85rem; letter-spacing: 1px; text-transform: uppercase; z-index: 1;">Total Saldo Anda</h6>
                    <h1 class="display-5 fw-bold text-white mb-0 position-relative" style="letter-spacing: -1.5px; z-index: 1; text-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                        Rp {{ number_format($nasabah->total_saldo, 0, ',', '.') }}
                    </h1>
                </div>
                
                <div class="d-grid gap-3 mt-auto">
                    <a href="/setor" class="btn btn-success rounded-pill py-3 fw-bold shadow-sm d-flex align-items-center justify-content-center gap-2 transition-all" style="font-size: 1.05rem;">
                        <i class="bi bi-plus-circle-fill fs-5"></i> Setor Sampah
                    </a>
                    <a href="/tarik" class="btn btn-outline-success rounded-pill py-3 fw-bold d-flex align-items-center justify-content-center gap-2 transition-all hover-outline" style="font-size: 1.05rem;">
                        <i class="bi bi-wallet2 fs-5"></i> Tarik Saldo
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .hover-bg-light:hover { background-color: #f8fafc !important; }
    .transition-all { transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); }
    .shadow-inner { box-shadow: inset 0 2px 4px rgba(0,0,0,0.15); }
    .custom-tabs .nav-link.active { 
        background-color: var(--bs-success) !important; 
        color: white !important; 
        box-shadow: 0 4px 10px rgba(16, 185, 129, 0.25);
    }
    .custom-tabs .nav-link { color: #64748b; font-weight: 600; }
</style>
@endsection