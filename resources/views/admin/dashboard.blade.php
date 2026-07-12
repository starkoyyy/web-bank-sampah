@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h3 class="fw-bold text-dark mb-1">Bank Sampah Desa Winduherang</h3>
        <p class="text-muted mb-0">Dashboard ikhtisar aktivitas pengelolaan sampah dan kas hari ini.</p>
    </div>
    <div>
        <div class="btn btn-white border shadow-sm rounded-3 text-muted fw-medium py-2 px-3">
            <i class="bi bi-calendar3 me-2"></i> {{ date('d F Y') }}
        </div>
    </div>
</div>

<div class="row mb-4 g-3">
    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #fdfbf7 100%);">
            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                <i class="bi bi-people-fill" style="font-size: 5rem; color: var(--bs-primary);"></i>
            </div>
            <div class="card-body p-4 position-relative z-index-1">
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(14, 165, 233, 0.1); color: var(--bs-primary);">
                        <i class="bi bi-people fs-4"></i>
                    </div>
                    <h6 class="text-secondary fw-bold mb-0 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Warga Terdaftar</h6>
                </div>
                <div class="d-flex align-items-end">
                    <h1 class="fw-bold text-dark mb-0 me-2" style="letter-spacing: -1px;">{{ $total_nasabah }}</h1>
                    <span class="text-muted fw-medium pb-1">Orang</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #fdfbf7 100%);">
            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                <i class="bi bi-box-seam-fill" style="font-size: 5rem; color: var(--bs-info);"></i>
            </div>
            <div class="card-body p-4 position-relative z-index-1">
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(6, 182, 212, 0.1); color: var(--bs-info);">
                        <i class="bi bi-box-seam fs-4"></i>
                    </div>
                    <h6 class="text-secondary fw-bold mb-0 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Sampah Terkumpul</h6>
                </div>
                <div class="d-flex align-items-end">
                    <h1 class="fw-bold text-dark mb-0 me-2" style="letter-spacing: -1px;">{{ $total_sampah }}</h1>
                    <span class="text-muted fw-medium pb-1">Kg</span>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card border-0 shadow-sm rounded-4 h-100 position-relative overflow-hidden" style="background: linear-gradient(135deg, #ffffff 0%, #fdfbf7 100%);">
            <div class="position-absolute top-0 end-0 p-3 opacity-10">
                <i class="bi bi-wallet-fill" style="font-size: 5rem; color: var(--bs-success);"></i>
            </div>
            <div class="card-body p-4 position-relative z-index-1">
                <div class="d-flex align-items-center mb-4">
                    <div class="rounded-circle p-2 me-3" style="background-color: rgba(16, 185, 129, 0.1); color: var(--bs-success);">
                        <i class="bi bi-wallet2 fs-4"></i>
                    </div>
                    <h6 class="text-secondary fw-bold mb-0 text-uppercase" style="letter-spacing: 0.5px; font-size: 0.8rem;">Total Kas (Liabilitas)</h6>
                </div>
                <div class="d-flex align-items-center">
                    <span class="text-muted fs-5 fw-bold me-2">Rp</span>
                    <h1 class="fw-bold text-dark mb-0" style="letter-spacing: -1.5px;">{{ number_format($total_kas, 0, ',', '.') }}</h1>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 mb-4">
    <div class="card-body p-4">
        <h6 class="fw-bold mb-4"><i class="bi bi-bar-chart-line-fill text-success me-2"></i>Statistik Sampah per Kategori (Kg)</h6>
        <div style="position: relative; height:400px; width:100%">
            <canvas id="sampahChart"></canvas>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    // Konfigurasi Grafik
    const ctx = document.getElementById('sampahChart').getContext('2d');
    
    // Menerima data dari Controller
    const labels = {!! json_encode($label_kategori) !!};
    const data = {!! json_encode($data_kategori) !!};

    new Chart(ctx, {
        type: 'bar', // Bisa diubah jadi 'line' jika ingin grafik garis
        data: {
            labels: labels,
            datasets: [{
                label: 'Total Berat (Kg)',
                data: data,
                backgroundColor: '#65a30d', // Olive Green
                borderRadius: 4,
                barThickness: 50 // Ketebalan batang grafik
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true,
                    grid: { color: '#f0f0f0' }
                },
                x: {
                    grid: { display: false }
                }
            },
            plugins: {
                legend: { display: false } // Sembunyikan legenda agar bersih
            }
        }
    });
</script>
@endsection