@extends('layouts.app')

@section('content')
<!-- Tambahan CSS Khusus Halaman Login -->
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
    .login-card {
        background: #ffffff !important; 
        border: none !important; 
        border-radius: 24px !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.5) !important; 
    }

    /* Mengubah semua teks menjadi gelap untuk kontras maksimal */
    .login-card h4, .login-card label, .login-card p, .login-card span {
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

    /* Modifikasi kotak isian standar putih */
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
    
    /* Tombol Solid Premium */
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
</style>

<div class="row justify-content-center align-items-center" style="min-height: 70vh;">
    <div class="col-md-5 col-lg-4">
        


        <div class="card border-0 rounded-4 login-card p-2">
            <div class="card-body p-4 p-md-5">
                <div class="text-center mb-4">
                    <i class="bi bi-recycle glass-icon" style="font-size: 3.5rem;"></i>
                    <h4 class="fw-bold mt-2">Bank Sampah</h4>
                    <p class="small" style="opacity: 0.8;">Silakan masuk ke akun Anda</p>
                </div>

                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label small fw-medium">Username</label>
                        <input type="text" name="username" class="form-control form-control-lg fs-6 glass-input" placeholder="Masukkan username" required autofocus>
                    </div>
                    
                    <div class="mb-4">
                        <label class="form-label small fw-medium">Password</label>
                        <input type="password" name="password" class="form-control form-control-lg fs-6 glass-input" placeholder="Masukkan password" required>
                    </div>
                    
                    <button type="submit" class="btn w-100 py-2 mb-3 fw-bold rounded-3 glass-btn text-white">Masuk</button>
                    
                    <div class="text-center mt-4">
                        <span class="small" style="opacity: 0.8;">Belum punya akun?</span><br>
                        <a href="/register" class="glass-link text-decoration-none fw-bold small">Daftar Akun Baru di sini</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Scripts if needed
    });
</script>
@endpush
@endsection