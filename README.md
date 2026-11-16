# Bank Sampah Desa Winduherang (v2)

Sistem Informasi Pengelolaan Bank Sampah Berbasis Web

---

## 1. Deskripsi Aplikasi

Bank Sampah Desa Winduherang merupakan sistem informasi berbasis web yang dikembangkan untuk mendigitalkan dan mengotomatisasi operasional pencatatan tabungan sampah warga. Sistem ini memfasilitasi interaksi antara nasabah (warga desa) dan pengurus (administrator) secara transparan, akuntabel, dan terstruktur.

Aplikasi ini mengimplementasikan prinsip-prinsip rekayasa perangkat lunak berbasis keamanan (*Secure Software Development Lifecycle*), mencakup autentikasi berlapis, kontrol akses berbasis peran (RBAC), sanitasi input, pencegahan injeksi data, perlindungan sesi perbankan, serta penerapan header keamanan sesuai standar OWASP.

---

## 2. Fitur Utama

- **Autentikasi dan Otorisasi (RBAC):** Pemisahan hak akses antara Administrator dan Nasabah dengan perlindungan middleware pada level rute HTTP.
- **Pengelolaan Data (CRUD):** Manajemen data nasabah, manajemen katalog jenis sampah beserta tarif harga per kilogram, dan manajemen mutasi transaksi.
- **Kalkulasi Saldo Otomatis:** Perhitungan nominal setoran sampah secara otomatis di sisi backend berdasarkan bobot fisik timbangan dan tarif kategori aktif.
- **Verifikasi Satu Pintu (Approval Gate):** Seluruh pengajuan setoran fisik dan penarikan kas wajib diverifikasi dan disetujui oleh pengurus sebelum saldo dimutasi.
- **Pencairan Saldo Fleksibel:** Pengajuan penarikan saldo melalui metode tunai, transfer bank, dan dompet digital (E-Wallet) dengan perlindungan *pessimistic locking* terhadap *race condition*.
- **Laporan dan Rekapitulasi Kas:** Laporan keuangan dengan filter rentang waktu dinamis serta fitur cetak dokumen resmi kas desa dalam format siap cetak/PDF.
- **Dashboard Statistik:** Visualisasi analitik komposisi volume sampah masuk dan tren transaksi per bulan menggunakan Chart.js.

---

## 3. Teknologi yang Digunakan

| Komponen | Teknologi | Keterangan |
| :--- | :--- | :--- |
| Backend Framework | Laravel 12.x | Arsitektur Model-View-Controller (MVC) berbasis PHP 8.2+ |
| Database Engine | MySQL 8.0 | Sistem basis data relasional dengan integritas foreign key |
| Frontend Interface | Blade, Bootstrap 5.3 | Mesin templat responsif dan antarmuka pengguna |
| Visualisasi Data | Chart.js | Grafik statistik analitik sampah pada dashboard |
| Containerization | Docker Engine, Docker Compose | Orkestrasi kontainer aplikasi dan basis data |
| Web Server / Proxy | Nginx Reverse Proxy | Terminasi SSL/TLS HTTPS dan reverse proxy ke port internal |
| Keamanan HTTP | OWASP Security Headers | Middleware kustom (CSP, HSTS, X-Frame-Options, dll.) |

---

## 4. URL Aplikasi Aktif

Aplikasi telah dipublikasikan dan aktif secara daring pada domain publik:
- **URL Aplikasi Utama:** https://bank-sampah.akucintacysec.online
- **URL Halaman Login:** https://bank-sampah.akucintacysec.online/login
- **Protokol:** HTTPS (Enkripsi SSL/TLS Let's Encrypt aktif)

---

## 5. Cara Instalasi dan Menjalankan Aplikasi

### Opsi A: Menjalankan Menggunakan Docker Compose (Direkomendasikan)

1. Kloning repositori:
   ```bash
   git clone https://github.com/starkoyyy/web-bank-sampah.git
   cd web-bank-sampah
   ```

2. Siapkan file konfigurasi environment:
   ```bash
   cp .env.example .env
   ```
   Sesuaikan parameter `APP_KEY`, `DB_PASSWORD`, dan `DB_ROOT_PASSWORD` pada file `.env`.

3. Bangun dan jalankan kontainer Docker:
   ```bash
   docker compose up -d --build
   ```

4. Jalankan migrasi basis data dan seeder akun default:
   ```bash
   docker compose exec app php artisan migrate --force --seed
   ```

5. Bersihkan cache aplikasi:
   ```bash
   docker compose exec app php artisan optimize:clear
   ```

6. Akses aplikasi melalui browser pada `http://localhost:8000` (atau port yang ditentukan).

---

### Opsi B: Menjalankan di Lingkungan Lokal (XAMPP / PHP Native)

1. Pastikan PHP versi 8.2 atau lebih tinggi dan MySQL telah terinstal dan berjalan.
2. Pasang dependensi PHP via Composer:
   ```bash
   composer install
   ```
3. Salin file `.env` dan buat encryption key:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```
4. Buat basis data MySQL dengan nama `db_bank_sampah` di phpMyAdmin atau terminal MySQL.
5. Jalankan migrasi dan seeder:
   ```bash
   php artisan migrate --seed
   ```
6. Jalankan server pengembangan:
   ```bash
   php artisan serve
   ```
7. Buka browser pada alamat `http://127.0.0.1:8000`.

---

## 6. Konfigurasi Environment Variable

Aplikasi tidak menyimpan kredensial atau rahasia apa pun secara hardcode pada repositori. Seluruh konfigurasi diatur melalui variabel lingkungan (`.env`):

| Variabel | Deskripsi | Nilai Contoh |
| :--- | :--- | :--- |
| `APP_NAME` | Nama aplikasi | `Bank Sampah Desa Winduherang` |
| `APP_ENV` | Lingkungan aplikasi | `production` / `local` |
| `APP_DEBUG` | Mode debugging | `false` (wajib false di produksi) |
| `APP_KEY` | Kunci enkripsi AES-256-CBC | Dihasilkan via `php artisan key:generate` |
| `APP_URL` | URL basis aplikasi | `https://bank-sampah.akucintacysec.online` |
| `DB_CONNECTION` | Driver koneksi database | `mysql` |
| `DB_HOST` | Host database server | `db` (pada Docker) / `127.0.0.1` (lokal) |
| `DB_PORT` | Port layanan database | `3306` |
| `DB_DATABASE` | Nama basis data | `db_bank_sampah` |
| `DB_USERNAME` | Username pengguna database | `root` / pengguna terdaftar |
| `DB_PASSWORD` | Kata sandi database | Password acak terisolasi |
| `DB_ROOT_PASSWORD` | Kata sandi root MySQL kontainer | Password acak terisolasi |
| `SESSION_DRIVER` | Driver penyimpanan sesi | `file` |
| `SESSION_SECURE_COOKIE` | Penegakan atribut Secure pada cookie | `true` |

---

## 7. Ringkasan Penggunaan AI Agent

Sesuai dengan ketentuan akademik mata kuliah Cyber Security, pengembangan dan pengerasan keamanan sistem ini dibantu oleh asisten AI dengan pengawasan dan verifikasi penuh oleh pengembang:

- **Alat AI yang Digunakan:** Google Antigravity Agentic Assistant (berbasis Gemini 3.8).
- **Cakupan Bantuan:**
  1. Perancangan dan penyusunan arsitektur middleware keamanan HTTP (`SecurityHeaders.php`) mengacu pada rekomendasi OWASP.
  2. Audit keamanan statis kode program terhadap kerentanan SQL Injection, Cross-Site Scripting (XSS), dan Insecure Direct Object References (IDOR).
  3. Konfigurasi isolasi lingkungan kontainer Docker (`Dockerfile`, `docker-compose.yml`, dan `.dockerignore`) dengan prinsip zero hardcoded credentials.
  4. Penyusunan skenario pengujian mandiri (*self-testing*) keamanan.
- **Metode Verifikasi Mahasiswa:** Seluruh kode yang dihasilkan melalui asistensi AI ditinjau ulang secara manual baris demi baris, diuji pada lingkungan lokal dan produksi, serta divalidasi perilakunya melalui pengujian fungsional dan pengujian keamanan berbasis terminal.

---

## 8. Ringkasan Hasil Self-Testing Keamanan

| No | Kategori Pengujian | Target Uji | Metode & Skenario | Hasil |
| :---: | :--- | :--- | :--- | :---: |
| 1 | SQL Injection (SQLi) | Form Login dan Filter Data | Injeksi kutip tunggal dan boolean logic (`' OR 1=1 --`) | **Lolos** |
| 2 | Cross-Site Scripting (XSS) | Input Registrasi dan Kategori | Injeksi tag skrip `<script>alert(1)</script>` | **Lolos** |
| 3 | Broken Access Control | Rute `/admin/*` dan Endpoint Mutasi | Percobaan bypass otorisasi role dan manipulasi IDOR | **Lolos** |
| 4 | Brute Force Protection | Endpoint POST `/login` | Pengiriman request berulang (>5 kali per menit) | **Lolos (HTTP 429)** |
| 5 | Security Headers & HTTPS | Respons HTTP dan Cookie | Pengecekan HSTS, CSP, X-Frame-Options, dan Secure Cookie | **Lolos** |
