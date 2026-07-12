<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bank Sampah Winduherang</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        :root {
            --bs-success-rgb: 101, 163, 13; /* Olive Green */
            --bs-success: #65a30d;
            --accent-green: #84cc16; /* Sage */
            --bg-body: #fdfaf6; /* Warm Sand */
            --bs-primary: #0ea5e9; 
            --bs-info: #06b6d4;
            --surface: #ffffff;
            --text-dark: #3f3f46; /* Softer dark zinc */
            --text-muted: #71717a; /* Zinc 500 */
        }
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-body); /* Latar belakang dasar krem hangat */
            background-image: 
                radial-gradient(at 0% 0%, rgba(101, 163, 13, 0.12) 0px, transparent 50%),
                radial-gradient(at 100% 0%, rgba(253, 186, 116, 0.1) 0px, transparent 50%),
                radial-gradient(at 100% 100%, rgba(132, 204, 22, 0.08) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(251, 191, 36, 0.08) 0px, transparent 50%);
            background-attachment: fixed;
            color: var(--text-dark);
            min-height: 100vh;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        /* Floating Glassmorphism Navbar */
        .navbar-wrapper {
            padding: 1rem 1rem 0 1rem;
        }
        .navbar-custom {
            background: rgba(253, 251, 247, 0.85) !important;
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(6, 78, 59, 0.08);
            border-radius: 1rem;
            box-shadow: 0 4px 20px -2px rgba(0, 0, 0, 0.03);
            transition: all 0.3s ease;
        }
        
        /* Nav Links */
        .nav-link-custom {
            color: #64748b !important;
            font-weight: 600;
            padding: 0.5rem 1rem !important;
            border-radius: 50rem;
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            font-size: 0.95rem;
        }
        
        .nav-link-custom:hover {
            color: var(--bs-success) !important;
            background-color: rgba(16, 185, 129, 0.1);
            transform: translateY(-2px);
        }
        
        .nav-link-custom.active {
            color: var(--bs-success) !important;
            background-color: rgba(16, 185, 129, 0.15);
            font-weight: 700;
        }
        
        .navbar-brand-custom {
            font-weight: 800;
            letter-spacing: -0.5px;
            color: var(--bs-success) !important;
        }

        .bg-success { background-color: var(--bs-success) !important; }
        .text-success { color: var(--bs-success) !important; }
        .btn-success {
            background: linear-gradient(135deg, var(--bs-success) 0%, #4d7c0f 100%) !important;
            border: none !important;
            color: white !important;
            box-shadow: 0 4px 6px -1px rgba(6, 78, 59, 0.2), 0 2px 4px -1px rgba(6, 78, 59, 0.1) !important;
        }
        .btn-success:hover {
            background: linear-gradient(135deg, #4d7c0f 0%, var(--bs-success) 100%) !important;
            box-shadow: 0 10px 15px -3px rgba(6, 78, 59, 0.3), 0 4px 6px -2px rgba(6, 78, 59, 0.15) !important;
            transform: translateY(-2px);
        }
        .btn-outline-success {
            color: var(--bs-success);
            border-color: var(--bs-success);
            background-color: transparent;
        }
        .btn-outline-success:hover {
            background-color: var(--bs-success);
            color: white;
            box-shadow: 0 4px 12px rgba(6, 78, 59, 0.2);
            transform: translateY(-2px);
        }
        
        /* Custom Logout Button */
        .btn-logout {
            width: 40px; 
            height: 40px; 
            display: flex; 
            align-items: center; 
            justify-content: center; 
            transition: all 0.25s cubic-bezier(0.4, 0, 0.2, 1);
            background-color: white;
            border: 1px solid #e2e8f0;
            color: #ef4444;
        }
        
        .btn-logout:hover {
            background-color: #ef4444;
            color: white;
            border-color: #ef4444;
            transform: scale(1.1) rotate(5deg);
            box-shadow: 0 4px 12px rgba(239, 68, 68, 0.3);
        }

        .hover-shadow { transition: all 0.25s; }
        .hover-shadow:hover {
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -4px rgba(0, 0, 0, 0.1) !important;
            transform: translateY(-2px);
        }
        
        /* Custom Tabs */
        .custom-tabs .nav-link {
            color: #64748b;
            transition: all 0.2s ease;
        }
        .custom-tabs .nav-link:hover {
            color: var(--bs-success);
        }
        .custom-tabs .nav-link.active {
            background: linear-gradient(135deg, var(--bs-success) 0%, #4d7c0f 100%) !important;
            color: white !important;
            box-shadow: 0 4px 6px -1px rgba(101, 163, 13, 0.3) !important;
        }

        /* Modern Table Styles */
        .table-custom {
            border-collapse: separate;
            border-spacing: 0 0.5rem;
        }
        .table-custom thead th {
            border-bottom: none;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            color: #64748b;
            font-weight: 700;
            padding: 1rem;
            background-color: transparent;
        }
        .table-custom tbody tr {
            background-color: #ffffff;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
            border-radius: 0.5rem;
            transition: all 0.2s ease;
        }
        .table-custom tbody tr:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.06);
            background-color: #ffffff;
        }
        .table-custom tbody td {
            border: none;
            padding: 1rem;
            vertical-align: middle;
        }
        .table-custom tbody td:first-child { border-top-left-radius: 0.5rem; border-bottom-left-radius: 0.5rem; }
        .table-custom tbody td:last-child { border-top-right-radius: 0.5rem; border-bottom-right-radius: 0.5rem; }

        @media (min-width: 992px) {
            .border-start-lg {
                border-left: 1px solid rgba(0,0,0,0.06) !important;
            }
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top py-3 mb-4 shadow-sm" id="main-navbar">
    <div class="container-fluid px-4">
        <!-- Logo -->
        <a class="navbar-brand navbar-brand-custom text-success d-flex align-items-center gap-2" href="/">
            <i class="bi bi-recycle fs-4"></i>
            <span>Bank Sampah</span>
        </a>
        
        <!-- Toggle Button for Mobile -->
        <button class="navbar-toggler border-0 shadow-none" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        
        <div class="collapse navbar-collapse" id="navbarNav">
            <!-- Gembok Pelindung: Sembunyikan semua menu jika di halaman login/register -->
            @if(!request()->is('login') && !request()->is('register'))
            <div class="ms-auto d-flex flex-column flex-lg-row align-items-lg-center mt-3 mt-lg-0 gap-3">
                @auth
                    <!-- Menu Khusus Admin -->
                    @if(Auth::user()->role === 'admin')
                        
                        <!-- Logika Hitung Pengajuan Pending -->
                        @php
                            $pending_tarik = \Illuminate\Support\Facades\DB::table('transaksi_tarik')->where('status', 'pending')->count();
                            $pending_setor = \Illuminate\Support\Facades\DB::table('transaksi_setor')->where('status', 'pending')->count();
                            $jumlah_pending = $pending_tarik + $pending_setor;
                        @endphp
                        
                        <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-1 me-lg-2">
                            <a href="/admin" class="nav-link nav-link-custom d-flex align-items-center gap-2 {{ request()->is('admin') ? 'active' : '' }}">
                                <i class="bi bi-grid"></i> Dashboard
                            </a>
                            
                            <a href="/admin/pengajuan" class="nav-link nav-link-custom d-flex align-items-center gap-2 position-relative {{ request()->is('admin/pengajuan') ? 'active' : '' }}">
                                <i class="bi bi-bell"></i> Pengajuan
                                @if($jumlah_pending > 0)
                                    <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger border border-2 border-white shadow-sm" style="font-size: 0.65rem; margin-top: 8px; margin-left: -8px;">
                                        {{ $jumlah_pending }}
                                    </span>
                                @endif
                            </a>

                            <a href="/admin/nasabah" class="nav-link nav-link-custom d-flex align-items-center gap-2 {{ request()->is('admin/nasabah') ? 'active' : '' }}">
                                <i class="bi bi-people"></i> Nasabah
                            </a>
                            
                            <a href="/admin/kategori" class="nav-link nav-link-custom d-flex align-items-center gap-2 {{ request()->is('admin/kategori*') ? 'active' : '' }}">
                                <i class="bi bi-tags"></i> Kategori
                            </a>
                            
                            <a href="/admin/laporan" class="nav-link nav-link-custom d-flex align-items-center gap-2 {{ request()->is('admin/laporan*') ? 'active' : '' }}">
                                <i class="bi bi-file-earmark-text"></i> Laporan
                            </a>
                            <a href="/admin/riwayat" class="nav-link nav-link-custom d-flex align-items-center gap-2 {{ request()->is('admin/riwayat*') ? 'active' : '' }}">
                                <i class="bi bi-clock-history"></i> Riwayat
                            </a>
                        </div>
                    @else
                        <!-- Menu Khusus Nasabah -->
                        <div class="d-flex flex-column flex-lg-row align-items-lg-center gap-1 me-lg-2">
                            <a href="/" class="nav-link nav-link-custom d-flex align-items-center gap-2 {{ request()->is('/') ? 'active' : '' }}">
                                <i class="bi bi-house"></i> Beranda
                            </a>
                            <a href="/riwayat" class="nav-link nav-link-custom d-flex align-items-center gap-2 {{ request()->is('riwayat') ? 'active' : '' }}">
                                <i class="bi bi-clock-history"></i> Riwayat Transaksi
                            </a>
                        </div>
                    @endif

                    <!-- Profil & Logout -->
                    <div class="d-flex align-items-center gap-3 ms-lg-2 ps-lg-4 border-start-lg">
                        @if(Auth::user()->role !== 'admin')
                            <!-- Notifikasi Lonceng -->
                            @php
                                $nasabah_id = \App\Models\Nasabah::where('user_id', Auth::id())->value('id');
                                $notif_gabungan = collect();
                                if($nasabah_id) {
                                    $notif_tarik = \Illuminate\Support\Facades\DB::table('transaksi_tarik')->where('nasabah_id', $nasabah_id)->orderBy('id', 'desc')->take(5)->get()->map(function($item) {
                                        $item->tipe = 'tarik';
                                        return $item;
                                    });
                                    $notif_setor = \Illuminate\Support\Facades\DB::table('transaksi_setor')->where('nasabah_id', $nasabah_id)->orderBy('id', 'desc')->take(5)->get()->map(function($item) {
                                        $item->tipe = 'setor';
                                        return $item;
                                    });
                                    $notif_gabungan = $notif_tarik->concat($notif_setor)->sortByDesc('id')->take(5);
                                }
                            @endphp
                            <div class="dropdown">
                                <button class="btn btn-light border rounded-circle shadow-sm position-relative d-flex align-items-center justify-content-center hover-shadow" type="button" data-bs-toggle="dropdown" aria-expanded="false" style="width: 40px; height: 40px; transition: all 0.2s;">
                                    <i class="bi bi-bell text-secondary"></i>
                                    @if($notif_gabungan->where('status', 'pending')->count() > 0)
                                        <span class="position-absolute top-0 start-100 translate-middle p-1 bg-danger border border-light rounded-circle" style="margin-top: 5px; margin-left: -10px;">
                                            <span class="visually-hidden">New alerts</span>
                                        </span>
                                    @endif
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end shadow border-0 rounded-4 p-2 mt-2" style="width: 300px; max-height: 400px; overflow-y: auto; z-index: 1050;">
                                    <li><h6 class="dropdown-header fw-bold text-dark fs-6 px-3">Pemberitahuan</h6></li>
                                    @forelse($notif_gabungan as $nt)
                                        <li>
                                            <a class="dropdown-item py-2 px-3 rounded-3 mb-1" href="/riwayat">
                                                <div class="d-flex align-items-start gap-2">
                                                    @if($nt->tipe === 'tarik')
                                                        @if($nt->status == 'pending')
                                                            <i class="bi bi-hourglass-split text-warning mt-1"></i>
                                                            <div>
                                                                <strong class="d-block text-dark" style="font-size: 0.85rem;">Penarikan diproses</strong>
                                                                <span class="text-muted d-block text-wrap" style="font-size: 0.75rem;">Rp {{ number_format($nt->jumlah_tarik, 0, ',', '.') }} sedang diverifikasi admin.</span>
                                                            </div>
                                                        @elseif($nt->status == 'disetujui')
                                                            <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                                            <div>
                                                                <strong class="d-block text-dark" style="font-size: 0.85rem;">Penarikan disetujui!</strong>
                                                                <span class="text-muted d-block text-wrap" style="font-size: 0.75rem;">Rp {{ number_format($nt->jumlah_tarik, 0, ',', '.') }} berhasil ditarik.</span>
                                                            </div>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger mt-1"></i>
                                                            <div>
                                                                <strong class="d-block text-dark" style="font-size: 0.85rem;">Penarikan ditolak</strong>
                                                                <span class="text-muted d-block text-wrap" style="font-size: 0.75rem;">Pengajuan Rp {{ number_format($nt->jumlah_tarik, 0, ',', '.') }} ditolak admin.</span>
                                                            </div>
                                                        @endif
                                                    @else
                                                        @if($nt->status == 'pending')
                                                            <i class="bi bi-hourglass-split text-warning mt-1"></i>
                                                            <div>
                                                                <strong class="d-block text-dark" style="font-size: 0.85rem;">Setoran diproses</strong>
                                                                <span class="text-muted d-block text-wrap" style="font-size: 0.75rem;">Setoran {{ $nt->berat }} Kg sedang diverifikasi admin.</span>
                                                            </div>
                                                        @elseif($nt->status == 'disetujui')
                                                            <i class="bi bi-check-circle-fill text-success mt-1"></i>
                                                            <div>
                                                                <strong class="d-block text-dark" style="font-size: 0.85rem;">Setoran disetujui!</strong>
                                                                <span class="text-muted d-block text-wrap" style="font-size: 0.75rem;">Saldo dari setoran {{ $nt->berat }} Kg telah ditambahkan.</span>
                                                            </div>
                                                        @else
                                                            <i class="bi bi-x-circle-fill text-danger mt-1"></i>
                                                            <div>
                                                                <strong class="d-block text-dark" style="font-size: 0.85rem;">Setoran ditolak</strong>
                                                                <span class="text-muted d-block text-wrap" style="font-size: 0.75rem;">Setoran {{ $nt->berat }} Kg ditolak admin.</span>
                                                            </div>
                                                        @endif
                                                    @endif
                                                </div>
                                            </a>
                                        </li>
                                    @empty
                                        <li><span class="dropdown-item text-center text-muted small py-3">Belum ada pemberitahuan</span></li>
                                    @endforelse
                                    <li><hr class="dropdown-divider my-1"></li>
                                    <li><a class="dropdown-item text-center text-success fw-medium small" href="/riwayat">Lihat Semua Riwayat</a></li>
                                </ul>
                            </div>
                        @endif

                        <div class="d-flex flex-column text-end d-none d-lg-flex ms-2">
                            <span class="text-muted fw-medium" style="font-size: 0.75rem;">Selamat datang,</span>
                            <strong class="text-dark" style="font-size: 0.9rem;">{{ Auth::user()->nama }}</strong>
                        </div>
                        <form id="form-logout" action="{{ route('logout') }}" method="POST" class="m-0">
                            @csrf
                            <button type="button" onclick="confirmLogout()" class="btn btn-logout rounded-circle shadow-sm" title="Logout">
                                <i class="bi bi-power"></i>
                            </button>
                        </form>
                    </div>
                @else
                    <!-- Tombol Login & Daftar -->
                    <div class="d-flex flex-column flex-lg-row gap-2">
                        <a href="/login" class="btn btn-light border rounded-pill px-4 fw-medium text-secondary hover-shadow">Masuk</a>
                        <a href="/register" class="btn btn-success rounded-pill px-4 shadow-sm fw-medium hover-shadow">Daftar</a>
                    </div>
                @endauth
            </div>
            @endif
        </div>
    </div>
</nav>

<div class="container-fluid px-4">
    @yield('content')
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style>
    /* Professional Toast Alerts */
    .colored-toast.swal2-icon-success {
        background-color: var(--surface) !important;
        border-bottom: 4px solid var(--accent-green) !important; /* Move border to bottom for center toasts */
        color: var(--text-dark) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        border-radius: 12px !important;
        padding: 0.5rem 1rem !important;
    }
    .colored-toast.swal2-icon-error {
        background-color: var(--surface) !important;
        border-bottom: 4px solid #ef4444 !important;
        color: var(--text-dark) !important;
        box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04) !important;
        border-radius: 12px !important;
        padding: 0.5rem 1rem !important;
    }
    .colored-toast .swal2-title {
        font-size: 1.1rem;
        font-weight: 700;
        margin-left: 0.5rem;
    }

    /* Premium Modal Alerts (Confirmation) - Light Theme */
    .premium-swal-popup {
        border-radius: 24px !important;
        padding: 2rem !important;
        box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.2) !important;
        background-color: var(--surface) !important;
        border: 1px solid rgba(6, 78, 59, 0.08) !important;
    }
    .premium-swal-title {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        font-weight: 800 !important;
        font-size: 1.5rem !important;
        color: var(--text-dark) !important;
        padding-top: 1rem !important;
    }
    .premium-swal-content {
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        color: var(--text-muted) !important;
        font-size: 1.05rem !important;
        margin-top: 0.5rem !important;
    }
    .premium-swal-confirm {
        border-radius: 12px !important;
        padding: 0.75rem 2rem !important;
        font-weight: 600 !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background: linear-gradient(135deg, #ef4444 0%, #dc2626 100%) !important;
        border: none !important;
        color: white !important;
        box-shadow: 0 4px 10px rgba(239, 68, 68, 0.3) !important;
        transition: all 0.2s ease !important;
    }
    .premium-swal-confirm:hover {
        transform: translateY(-2px) !important;
        box-shadow: 0 8px 15px rgba(239, 68, 68, 0.4) !important;
    }
    .premium-swal-cancel {
        border-radius: 12px !important;
        padding: 0.75rem 2rem !important;
        font-weight: 600 !important;
        font-family: 'Plus Jakarta Sans', sans-serif !important;
        background-color: #f1f5f9 !important;
        color: #475569 !important;
        border: none !important;
        transition: all 0.2s ease !important;
    }
    .premium-swal-cancel:hover {
        background-color: #e2e8f0 !important;
        color: #1e293b !important;
        transform: translateY(-2px) !important;
    }
    /* Warning Icon adjustments for light bg */
    .premium-swal-popup .swal2-icon.swal2-warning {
        border-color: rgba(245, 158, 11, 0.3) !important;
        color: #f59e0b !important;
        background-color: rgba(245, 158, 11, 0.1) !important;
    }
    .premium-swal-popup .swal2-icon.swal2-warning .swal2-icon-content {
        color: #f59e0b !important;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Konfigurasi Toast Modern
        const Toast = Swal.mixin({
            toast: true,
            position: 'top', /* Dipindah ke tengah atas */
            showConfirmButton: false,
            timer: 4000,
            timerProgressBar: true,
            customClass: {
                popup: 'colored-toast'
            },
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        });

        @if(session('success'))
            Toast.fire({
                icon: 'success',
                title: '{!! session('success') !!}'
            });
        @endif

        @if(session('error'))
            Toast.fire({
                icon: 'error',
                title: '{!! session('error') !!}'
            });
        @endif

        @if($errors->any())
            Toast.fire({
                icon: 'error',
                title: 'Gagal! Periksa kembali isian form Anda.'
            });
        @endif
    });

    function confirmLogout() {
        Swal.fire({
            title: 'Keluar Aplikasi?',
            text: "Sesi Anda akan diakhiri dan Anda harus login kembali.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Ya, Keluar',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'premium-swal-popup',
                title: 'premium-swal-title',
                htmlContainer: 'premium-swal-content',
                confirmButton: 'premium-swal-confirm',
                cancelButton: 'premium-swal-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('form-logout').submit();
            }
        });
    }
</script>

@stack('scripts')
</body>
</html>