<div align="center">

# ♻️ Bank Sampah Desa Winduherang (v2)

**Sistem Informasi Pengelolaan Bank Sampah Berbasis Web**

---

[![Laravel](https://img.shields.io/badge/Laravel-12.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white)](https://laravel.com)
[![PHP](https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white)](https://php.net)
[![Bootstrap](https://img.shields.io/badge/Bootstrap-5.3-7952B3?style=for-the-badge&logo=bootstrap&logoColor=white)](https://getbootstrap.com)
[![SQLite](https://img.shields.io/badge/SQLite-003B57?style=for-the-badge&logo=sqlite&logoColor=white)](https://sqlite.org)

</div>

---

## 📌 Ringkasan Aplikasi

**Bank Sampah Desa Winduherang** adalah platform berbasis web yang dirancang untuk mendigitalkan dan mempermudah operasional bank sampah desa. Aplikasi ini memfasilitasi interaksi antara warga (nasabah) dan pengurus (admin) dalam pengelolaan sampah daur ulang secara transparan dan efisien.

### Fitur Utama:
* **Pengelolaan Akun & Saldo:** Pendaftaran nasabah dan pencatatan saldo tabungan hasil setoran sampah secara real-time.
* **Transaksi Setor Sampah:** Pengajuan setoran dengan kalkulasi nominal otomatis berdasarkan berat (Kg) dan tarif kategori sampah.
* **Penarikan Saldo Fleksibel:** Nasabah dapat mengajukan penarikan dana melalui Tunai, Transfer Bank, atau E-Wallet (Gopay/OVO/Dana) yang diverifikasi oleh admin.
* **Manajemen Kategori Sampah:** Admin dapat mengatur jenis sampah serta memperbarui harga per kilogram sesuai kebutuhan.
* **Verifikasi Transaksi:** Sistem persetujuan (*approval*) satu pintu oleh admin untuk memvalidasi setoran fisik dan pengeluaran kas.
* **Laporan & Rekapitulasi:** Rekam jejak seluruh mutasi transaksi serta fitur cetak laporan kas resmi desa yang siap cetak / simpan ke PDF.

---

## 🛠️ Teknologi yang Digunakan

Aplikasi ini dikembangkan menggunakan teknologi berikut:

| Komponen | Teknologi | Keterangan |
| :--- | :--- | :--- |
| **Backend Framework** | [Laravel 12](https://laravel.com/) | Framework utama berbasis PHP dengan arsitektur MVC |
| **Bahasa Pemrograman** | [PHP 8.2+](https://www.php.net/) | Pemrosesan logika bisnis dan transaksi |
| **Basis Data** | [SQLite](https://www.sqlite.org/) | Database relasional penyimpanan data aplikasi |
| **Frontend UI** | [Blade](https://laravel.com/docs/blade) & [Bootstrap 5](https://getbootstrap.com/) | Template mesin dan kerangka antarmuka pengguna responsif |
| **Ikon Antarmuka** | [Bootstrap Icons](https://icons.getbootstrap.com/) | Ikonografi modern untuk navigasi visual |
| **Notifikasi Interaktif** | [SweetAlert2](https://sweetalert2.github.io/) | Dialog konfirmasi dan notifikasi toast animasi |
| **Visualisasi Data** | [Chart.js](https://www.chartjs.org/) | Diagram grafik statistik sampah pada dashboard admin |
| **Build Tool** | [Vite](https://vitejs.dev/) | Tool pengelola dan kompilasi aset frontend |
