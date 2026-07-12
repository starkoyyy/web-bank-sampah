@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4 mb-5">
    <div class="col-md-8 col-lg-6">
        
        @if(session('error'))
            <div class="alert alert-danger rounded-4 shadow-sm border-0 mb-4 d-flex align-items-center" role="alert">
                <i class="bi bi-exclamation-triangle-fill me-2 fs-5"></i> 
                <div>{{ session('error') }}</div>
                <button type="button" class="btn-close ms-auto" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
            <!-- Header Accent -->
            <div class="py-5 text-center position-relative" style="background: linear-gradient(135deg, var(--bs-success) 0%, #4d7c0f 100%);">
                <!-- Decorative circles -->
                <div class="position-absolute top-0 start-0 translate-middle" style="width: 150px; height: 150px; background-color: rgba(255, 255, 255, 0.05); border-radius: 50%; z-index: 0;"></div>
                <div class="position-absolute bottom-0 end-0 translate-middle-y me-n4" style="width: 100px; height: 100px; background-color: rgba(255, 255, 255, 0.05); border-radius: 50%; z-index: 0;"></div>
                
                <div class="d-inline-block bg-white rounded-circle p-2 shadow-sm position-relative z-1 mb-3">
                    <div class="text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 70px; height: 70px; background: linear-gradient(135deg, var(--accent-green) 0%, var(--bs-success) 100%); box-shadow: inset 0 2px 4px rgba(0,0,0,0.1);">
                        <i class="bi bi-recycle fs-2"></i>
                    </div>
                </div>
                <h3 class="fw-bold text-white position-relative z-1">Form Setor Sampah</h3>
                <p class="text-white-50 small mb-0 position-relative z-1 px-4">Bantu jaga lingkungan sambil menambah saldo Anda. Silakan isi detail setoran di bawah ini.</p>
            </div>

            <div class="card-body p-4 p-md-5">
                <form action="/setor" method="POST">
                    @csrf
                    
                    <div class="mb-4 position-relative">
                        <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.9rem;">Pilih Kategori Sampah</label>
                        <div class="input-group input-group-lg shadow-sm rounded-4 overflow-hidden custom-input-group">
                            <span class="input-group-text bg-white border-light-subtle text-success border-end-0 px-3">
                                <i class="bi bi-tags"></i>
                            </span>
                            <select name="kategori_id" class="form-select border-light-subtle border-start-0 py-3 text-secondary custom-select-focus" required>
                                <option value="" disabled selected>-- Pilih Jenis Sampah --</option>
                                @foreach($kategori as $k)
                                    <option value="{{ $k->id }}">
                                        {{ $k->nama_kategori }} (Rp {{ number_format($k->harga_per_kg, 0, ',', '.') }} / Kg)
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="mb-5 position-relative">
                        <label class="form-label fw-bold text-dark mb-2" style="font-size: 0.9rem;">Berat Sampah</label>
                        <div class="input-group input-group-lg shadow-sm rounded-4 overflow-hidden custom-input-group">
                            <span class="input-group-text bg-white border-light-subtle text-success border-end-0 px-3">
                                <i class="bi bi-speedometer2"></i>
                            </span>
                            <input type="number" name="berat" class="form-control border-light-subtle border-start-0 border-end-0 py-3 custom-input-focus" placeholder="Contoh: 1.5 atau 2" min="1" step="0.1" required>
                            <span class="input-group-text bg-light border-light-subtle text-muted fw-bold px-4">Kg</span>
                        </div>
                        <div class="form-text mt-2 ms-1 text-muted" style="font-size: 0.75rem;"><i class="bi bi-info-circle me-1"></i>Minimal berat setoran adalah 1 Kg.</div>
                    </div>

                    <div class="d-flex flex-column flex-md-row gap-3">
                        <a href="/" class="btn btn-light border py-3 rounded-pill fw-medium flex-grow-1 hover-shadow transition-all text-secondary d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-arrow-left"></i> Kembali
                        </a>
                        <button type="submit" class="btn btn-success py-3 rounded-pill fw-bold flex-grow-1 shadow-sm hover-shadow transition-all d-flex align-items-center justify-content-center gap-2">
                            <i class="bi bi-check2-circle fs-5"></i> Proses Setoran
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<style>
    .custom-input-focus:focus, .custom-select-focus:focus {
        box-shadow: none !important;
        border-color: #198754 !important;
        background-color: #f8faff;
    }
    .custom-input-group:focus-within {
        border-color: #198754 !important;
        box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.25) !important;
    }
    .hover-shadow:hover {
        box-shadow: 0 6px 15px rgba(25, 135, 84, 0.15) !important;
        transform: translateY(-2px);
    }
    .btn-light.hover-shadow:hover {
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08) !important;
    }
    .transition-all {
        transition: all 0.3s ease;
    }
</style>
@endsection