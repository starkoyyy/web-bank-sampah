@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        
        <!-- Pesan Error Jika Saldo Kurang -->
        @if(session('error'))
            <div class="alert alert-danger rounded-3 shadow-sm">
                <i class="bi bi-exclamation-triangle-fill me-2"></i> {{ session('error') }}
            </div>
        @endif

        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-5">
                <div class="text-center mb-4">
                    <div class="text-white rounded-circle d-inline-flex align-items-center justify-content-center mb-3" style="width: 60px; height: 60px; background: linear-gradient(135deg, var(--accent-green) 0%, var(--bs-success) 100%); box-shadow: 0 10px 15px -3px rgba(6, 78, 59, 0.3);">
                        <i class="bi bi-cash-stack fs-2"></i>
                    </div>
                    <h4 class="fw-bold text-dark">Tarik Saldo Kas</h4>
                    <p class="text-muted">Total Saldo Anda: <strong class="text-success fs-5" style="color: var(--accent-green) !important;">Rp {{ number_format($nasabah->total_saldo, 0, ',', '.') }}</strong></p>
                </div>

                <form action="/tarik" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-medium text-dark">Nominal Penarikan (Rp)</label>
                        <div class="input-group">
                            <span class="input-group-text bg-light border-end-0">Rp</span>
                            <input type="number" name="jumlah_tarik" class="form-control border-start-0 ps-0" placeholder="Contoh: 50000" min="1000" max="{{ $nasabah->total_saldo }}" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-medium text-dark">Metode Penarikan</label>
                        <select name="metode_penarikan" id="metode_penarikan" class="form-select" required onchange="toggleDetail()">
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer Bank</option>
                            <option value="E-Wallet">E-Wallet (Gopay/OVO/Dana)</option>
                        </select>
                    </div>

                    <div class="mb-4 d-none" id="detail_tujuan_container">
                        <label class="form-label fw-medium text-dark">Detail Tujuan (No. Rek / No. HP E-Wallet)</label>
                        <input type="text" name="detail_tujuan" id="detail_tujuan" class="form-control" placeholder="Contoh: BCA 12345678 a.n Budi">
                        <small class="text-muted">Wajib diisi untuk Transfer dan E-Wallet</small>
                    </div>

                    <div class="form-text text-muted mb-4">
                        *Uang akan diproses oleh Admin setelah pengajuan disetujui.
                    </div>

                    <script>
                        function toggleDetail() {
                            const metode = document.getElementById('metode_penarikan').value;
                            const container = document.getElementById('detail_tujuan_container');
                            const input = document.getElementById('detail_tujuan');
                            
                            if (metode === 'Tunai') {
                                container.classList.add('d-none');
                                input.removeAttribute('required');
                                input.value = '';
                            } else {
                                container.classList.remove('d-none');
                                input.setAttribute('required', 'required');
                            }
                        }
                    </script>
                    
                    <button type="submit" class="btn btn-success w-100 rounded-pill py-2 fw-bold mb-2">Ajukan Penarikan</button>
                    <a href="/" class="btn btn-light w-100 rounded-pill py-2 fw-medium">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection