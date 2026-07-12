@extends('layouts.app')

@section('content')
<div class="row justify-content-center mt-4">
    <div class="col-md-6">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4 p-md-5">
                
                <div class="text-center mb-4">
                    <i class="bi bi-wallet2 text-success" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold mt-2">Tarik Saldo</h4>
                    <p class="text-muted">Saldo Anda saat ini: <strong class="text-dark">Rp {{ number_format($nasabah->total_saldo, 0, ',', '.') }}</strong></p>
                </div>

                <!-- Menampilkan Error Jika Saldo Kurang -->
                @if(session('error'))
                    <div class="alert alert-danger rounded-3">{{ session('error') }}</div>
                @endif

                <form action="/tarik" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label fw-bold">Nominal Penarikan</label>
                        <div class="input-group">
                            <span class="input-group-text rounded-start-3 bg-light">Rp</span>
                            <input type="number" name="jumlah_tarik" class="form-control rounded-end-3" placeholder="Contoh: 15000" min="1000" required>
                        </div>
                        <small class="text-muted">Masukkan angka saja tanpa titik (Minimal Rp 1.000)</small>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold">Metode Penarikan</label>
                        <select name="metode_penarikan" id="metode_penarikan" class="form-select rounded-3" required onchange="toggleDetail()">
                            <option value="Tunai">Tunai</option>
                            <option value="Transfer">Transfer Bank</option>
                            <option value="E-Wallet">E-Wallet (Gopay/OVO/Dana)</option>
                        </select>
                    </div>

                    <div class="mb-4 d-none" id="detail_tujuan_container">
                        <label class="form-label fw-bold">Detail Tujuan (No. Rek / No. HP E-Wallet)</label>
                        <input type="text" name="detail_tujuan" id="detail_tujuan" class="form-control rounded-3" placeholder="Contoh: BCA 12345678 a.n Budi">
                        <small class="text-muted">Wajib diisi untuk Transfer dan E-Wallet</small>
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

                    <button type="submit" class="btn btn-success w-100 py-2 rounded-3 fw-bold">
                        <i class="bi bi-check-circle me-1"></i> Tarik Uang
                    </button>
                    <a href="/" class="btn btn-outline-secondary w-100 py-2 rounded-3 fw-bold mt-2">Batal</a>
                </form>
                
            </div>
        </div>
    </div>
</div>
@endsection