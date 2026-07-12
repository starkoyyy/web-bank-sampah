# Bank Sampah v2

Aplikasi Bank Sampah v2 adalah sebuah platform berbasis web yang dibangun menggunakan framework Laravel. Aplikasi ini memudahkan pengelolaan bank sampah, mulai dari pendaftaran nasabah, penyetoran sampah, penarikan saldo, hingga manajemen data oleh admin.

Berikut adalah penjelasan mengenai struktur **MVC (Model, View, Controller)** pada aplikasi ini beserta relasi antar bagiannya:

---

## 1. Model (Representasi Database)
Model bertugas sebagai penghubung antara aplikasi dengan tabel-tabel di database (menggunakan Eloquent ORM Laravel).
*   **`User`**: Terhubung ke tabel `users`. Menyimpan autentikasi (username, password, nama, dan role).
*   **`Nasabah`**: Terhubung ke tabel `nasabah`. 
    *   *Relasi:* Memiliki *Foreign Key* `user_id` yang merujuk ke tabel `users`. Menyimpan profil lengkap nasabah (alamat, jenis kelamin) dan `total_saldo`.
*   **`Kategori`**: Terhubung ke tabel `kategori`. Menyimpan data jenis sampah dan harga per kilogram.
*   **`TransaksiSetor`**: Terhubung ke tabel `transaksi_setor`.
    *   *Relasi:* Terhubung dengan `Nasabah` (melalui `nasabah_id`) dan `Kategori` (melalui `kategori_id`). Menyimpan histori setoran sampah.
*   **`TransaksiTarik`**: Terhubung ke tabel `transaksi_tarik`.
    *   *Relasi:* Terhubung dengan `Nasabah` (melalui `nasabah_id`). Menyimpan histori penarikan uang.

---

## 2. View (Antarmuka Pengguna)
View adalah file `blade.php` yang mengatur tampilan aplikasi (berada di folder `resources/views`). File-file ini dipanggil oleh Controller dan seringkali disisipkan data dari Model.
*   **`admin/`**: Kumpulan tampilan khusus Admin (Dashboard statistik, manajemen nasabah, kategori, pengajuan transaksi, laporan, dan riwayat).
*   **`auth/`**: Tampilan halaman Login dan Register.
*   **`layouts/`**: *Template* atau kerangka dasar tampilan (header, footer, navigasi) yang digunakan berulang oleh halaman lain agar desain konsisten.
*   **`tarik/`**: Tampilan form pengajuan penarikan saldo untuk Nasabah.
*   **`transaksi/`**: Tampilan form pengajuan penyetoran sampah untuk Nasabah.
*   **`welcome.blade.php`**: Tampilan halaman beranda utama (dashboard) untuk Nasabah ketika baru login.

---

## 3. Controller (Logika Bisnis)
Controller (berada di `app/Http/Controllers`) berfungsi menjembatani *View* dan *Model*. Controller memproses *Request* (URL/Form), mengambil/menyimpan data melalui *Model*, lalu melempar hasilnya ke *View*.

*   **`AdminController`**
    *   **Fungsi:** Mengontrol semua alur untuk Admin (dashboard, acc/tolak transaksi, laporan).
    *   **Relasi M-V:** Mengambil data dari *Model* `User`, `Nasabah`, `TransaksiSetor`, `TransaksiTarik` dan mengirimkannya ke *View* di folder `admin/`.
*   **`AuthController`**
    *   **Fungsi:** Mengontrol alur pendaftaran, login, dan logout.
    *   **Relasi M-V:** Mengecek/membuat akun di *Model* `User` dan `Nasabah`, mengarahkan ke *View* `auth/login` atau `auth/register`, lalu mengalihkan (*redirect*) ke dashboard yang sesuai (Admin/Nasabah).
*   **`KategoriController`**
    *   **Fungsi:** Mengontrol alur CRUD kategori sampah untuk Admin.
    *   **Relasi M-V:** Memanipulasi *Model* `Kategori` dan memeriksa *Model* `TransaksiSetor` (agar kategori terpakai tidak dihapus), lalu menampilkan hasilnya ke *View* `admin/kategori/`.
*   **`TarikController`**
    *   **Fungsi:** Mengontrol form penarikan dana oleh Nasabah.
    *   **Relasi M-V:** Memeriksa ketersediaan saldo di *Model* `Nasabah`, lalu merekam pengajuan ke *Model* `TransaksiTarik`. Menampilkan form dari *View* `tarik/create`.
*   **`TransaksiController`**
    *   **Fungsi:** Mengontrol form setoran sampah oleh Nasabah.
    *   **Relasi M-V:** Mengambil referensi harga dari *Model* `Kategori`, merekam pengajuan ke *Model* `TransaksiSetor`, lalu menampilkan form dari *View* `transaksi/setor`.
