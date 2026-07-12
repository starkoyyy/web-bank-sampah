@extends('layouts.app')

@section('content')
<!-- Tambahan CSS Khusus Halaman Register (Sama dengan Login) -->
<style>
    body {
        background-image: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.7)), 
                          url('https://images.unsplash.com/photo-1542601906990-b4d3fb778b09?q=80&w=2074&auto=format&fit=crop');
        background-size: cover;
        background-position: center;
        background-attachment: fixed;
    }
    
    .navbar {
        background-color: transparent !important;
        box-shadow: none !important;
        padding-top: 1.5rem !important;
    }

    .navbar .container {
        max-width: 100% !important;
        padding-left: 4vw !important;
        padding-right: 4vw !important;
    }
    
    .navbar-brand {
        color: #ffffff !important;
        text-shadow: 1px 1px 4px rgba(0,0,0,0.6);
        font-size: clamp(1.2rem, 2vw, 1.8rem) !important; 
    }

    .navbar-brand i {
        font-size: clamp(1.5rem, 2.5vw, 2.2rem) !important;
        margin-right: 5px;
    }
    
    /* =========================================
       CLEAN WHITE CARD (Kontras Tinggi)
       ========================================= */
    .glass-card {
        background: #ffffff !important; 
        border: none !important; 
        border-radius: 24px !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important; 
    }

    .glass-card h4, .glass-card label, .glass-card p, .glass-card span {
        color: #1e293b !important;
        text-shadow: none !important; 
    }
    
    .glass-icon {
        color: var(--bs-success) !important; 
        filter: none !important;
    }
    .glass-link {
        color: var(--bs-success) !important;
        font-weight: 700;
        transition: 0.3s;
    }
    .glass-link:hover {
        color: var(--accent-green) !important;
        text-decoration: underline !important;
    }

    .glass-input {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        color: #1e293b !important;
        border-radius: 12px !important;
    }
    .glass-input::placeholder {
        color: #94a3b8 !important;
    }
    .glass-input:focus {
        background: #ffffff !important;
        border: 1px solid var(--bs-success) !important;
        box-shadow: 0 0 0 4px rgba(101, 163, 13, 0.1) !important;
    }
    
    .glass-btn {
        background: var(--bs-success) !important;
        border: none !important;
        color: #ffffff !important;
        border-radius: 12px !important;
        transition: 0.3s;
    }
    .glass-btn:hover {
        background: var(--accent-green) !important;
        transform: translateY(-2px);
        box-shadow: 0 10px 15px -3px rgba(101, 163, 13, 0.3) !important;
    }
    
    /* Radio Button Clean Style */
    .glass-radio-btn {
        background: #f8fafc !important;
        border: 1px solid #e2e8f0 !important;
        color: #1e293b !important;
        border-radius: 12px !important;
        transition: all 0.3s ease;
    }
    .glass-radio-btn:hover {
        background: #f1f5f9 !important;
    }
    .btn-check:checked + .glass-radio-btn {
        background: rgba(101, 163, 13, 0.1) !important;
        border-color: var(--bs-success) !important;
        color: var(--bs-success) !important;
        font-weight: bold;
        box-shadow: none !important;
    }
</style>

<div class="row justify-content-center align-items-center" style="min-height: 70vh; margin-bottom: 50px;">
    <div class="col-md-6 col-lg-5">
        
        <!-- Pesan Error / Validasi -->
        @if($errors->any())
            <div class="alert rounded-3 shadow-sm border-0 mb-4 text-white" style="background: rgba(220, 53, 69, 0.8); backdrop-filter: blur(5px);">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="card border-0 rounded-4 glass-card p-2">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="bi bi-person-plus-fill glass-icon" style="font-size: 3rem;"></i>
                    <h4 class="fw-bold mt-2">Daftar Akun Warga</h4>
                    <p class="small" style="opacity: 0.8;">Bergabunglah dengan Bank Sampah Winduherang</p>
                </div>

                <form action="/register" method="POST">
                    @csrf
                    
                    <div class="mb-3">
                        <label class="form-label small fw-medium">Nama Lengkap</label>
                        <input type="text" name="nama" class="form-control form-control-lg fs-6 glass-input" placeholder="Masukkan nama lengkap" required autofocus>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">Alamat Lengkap</label>
                        <textarea name="alamat" class="form-control form-control-lg fs-6 glass-input" rows="2" placeholder="Masukkan alamat lengkap (Blok/RT/RW)" required></textarea>
                    </div>

                    <div class="mb-4">
                        <label for="jenis_kelamin" class="form-label small fw-medium">Jenis Kelamin</label>
                        <select class="form-select form-select-lg fs-6 glass-input" id="jenis_kelamin" name="jenis_kelamin" required>
                            <option value="" disabled selected>-- Pilih Jenis Kelamin --</option>
                            <option value="Laki-laki">Laki-laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label class="form-label small fw-medium">Username</label>
                        <input type="text" name="username" class="form-control form-control-lg fs-6 glass-input" placeholder="Buat username untuk login" required>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label small fw-medium">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg fs-6 glass-input" placeholder="Buat password" required>
                    </div>
                    
                    <button type="submit" class="btn w-100 py-2 mb-3 fw-bold rounded-3 glass-btn text-white">Daftar Sekarang</button>
                    
                    <div class="text-center mt-3">
                        <span class="small" style="opacity: 0.8;">Sudah punya akun?</span><br>
                        <a href="/login" class="glass-link text-decoration-none fw-bold small">Masuk di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection