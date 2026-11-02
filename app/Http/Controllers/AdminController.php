<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nasabah;
use App\Models\TransaksiSetor;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function index()
    {
        $total_nasabah = DB::table('nasabah')
            ->join('users', 'nasabah.user_id', '=', 'users.id')
            ->where('users.role', '!=', 'admin')
            ->count();
        $total_sampah = TransaksiSetor::sum('berat');
        $total_kas = Nasabah::sum('total_saldo');
        
        $statistik_kategori = DB::table('transaksi_setor')
            ->join('kategori', 'transaksi_setor.kategori_id', '=', 'kategori.id')
            ->select('kategori.nama_kategori', DB::raw('SUM(transaksi_setor.berat) as total_berat'))
            ->groupBy('kategori.nama_kategori')
            ->get();

        $label_kategori = $statistik_kategori->pluck('nama_kategori');
        $data_kategori = $statistik_kategori->pluck('total_berat');

        return view('admin.dashboard', compact('total_nasabah', 'total_sampah', 'total_kas', 'label_kategori', 'data_kategori'));
    }

    public function nasabah()
    {
        $data_nasabah = DB::table('nasabah')
            ->join('users', 'nasabah.user_id', '=', 'users.id')
            ->select('nasabah.*', 'users.nama')
            ->where('users.role', '!=', 'admin') 
            ->orderBy('users.nama', 'asc')
            ->get();

        return view('admin.nasabah', compact('data_nasabah'));
    }

    public function createNasabah()
    {
        return view('admin.nasabah_create');
    }

    public function storeNasabah(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users',
            'password' => 'required|string|min:6',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        DB::beginTransaction();
        try {
            $user = User::create([
                'nama' => $request->nama,
                'username' => $request->username,
                'password' => Hash::make($request->password),
                'role' => 'nasabah'
            ]);

            Nasabah::create([
                'user_id' => $user->id,
                'alamat' => $request->alamat,
                'jenis_kelamin' => $request->jenis_kelamin,
                'total_saldo' => 0
            ]);

            DB::commit();
            return redirect('/admin/nasabah')->with('success', 'Nasabah berhasil ditambahkan.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function editNasabah($id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $user = User::findOrFail($nasabah->user_id);
        return view('admin.nasabah_edit', compact('nasabah', 'user'));
    }

    public function updateNasabah(Request $request, $id)
    {
        $nasabah = Nasabah::findOrFail($id);
        $user = User::findOrFail($nasabah->user_id);

        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'password' => 'nullable|string|min:6',
            'alamat' => 'nullable|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
        ]);

        DB::beginTransaction();
        try {
            $user->nama = $request->nama;
            $user->username = $request->username;
            if ($request->filled('password')) {
                $user->password = Hash::make($request->password);
            }
            $user->save();

            $nasabah->alamat = $request->alamat;
            $nasabah->jenis_kelamin = $request->jenis_kelamin;
            $nasabah->save();

            DB::commit();
            return redirect('/admin/nasabah')->with('success', 'Data nasabah berhasil diperbarui.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function destroyNasabah($id)
    {
        DB::beginTransaction();
        try {
            $nasabah = Nasabah::findOrFail($id);
            
            // Validasi: Jangan hapus jika saldo masih ada
            if ($nasabah->total_saldo > 0) {
                return back()->with('error', 'Peringatan: Nasabah tidak dapat dihapus karena masih memiliki saldo sebesar Rp ' . number_format($nasabah->total_saldo, 0, ',', '.'));
            }

            $user = User::findOrFail($nasabah->user_id);
            
            // Hapus transaksi terkait karena tidak ada on delete cascade
            DB::table('transaksi_setor')->where('nasabah_id', $nasabah->id)->delete();
            DB::table('transaksi_tarik')->where('nasabah_id', $nasabah->id)->delete();
            
            $nasabah->delete();
            $user->delete();

            DB::commit();
            return redirect('/admin/nasabah')->with('success', 'Nasabah berhasil dihapus.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menghapus nasabah: ' . $e->getMessage());
        }
    }

    public function pengajuan()
    {
        $data_tarik = DB::table('transaksi_tarik')
            ->join('nasabah', 'transaksi_tarik.nasabah_id', '=', 'nasabah.id')
            ->join('users', 'nasabah.user_id', '=', 'users.id')
            ->select('transaksi_tarik.*', 'users.nama')
            ->orderBy('transaksi_tarik.id', 'desc')
            ->get();

        $data_setor = DB::table('transaksi_setor')
            ->join('nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
            ->join('users', 'nasabah.user_id', '=', 'users.id')
            ->join('kategori', 'transaksi_setor.kategori_id', '=', 'kategori.id')
            ->select('transaksi_setor.*', 'users.nama', 'kategori.nama_kategori')
            ->orderBy('transaksi_setor.id', 'desc')
            ->get();

        return view('admin.pengajuan', compact('data_tarik', 'data_setor'));
    }

    public function setujuiTarik($id)
    {
        DB::beginTransaction();
        try {
            $tarik = DB::table('transaksi_tarik')->where('id', $id)->lockForUpdate()->first();
            if (!$tarik || $tarik->status !== 'pending') {
                DB::rollBack();
                return back()->with('error', 'Pengajuan penarikan tidak ditemukan atau sudah diproses.');
            }

            $nasabah = DB::table('nasabah')->where('id', $tarik->nasabah_id)->lockForUpdate()->first();
            if (!$nasabah) {
                DB::rollBack();
                return back()->with('error', 'Data nasabah tidak ditemukan.');
            }

            if ($nasabah->total_saldo < $tarik->jumlah_tarik) {
                DB::rollBack();
                return back()->with('error', 'Gagal menyetujui! Saldo nasabah saat ini (Rp ' . number_format($nasabah->total_saldo, 0, ',', '.') . ') tidak mencukupi untuk ditarik.');
            }

            DB::table('nasabah')->where('id', $nasabah->id)->decrement('total_saldo', $tarik->jumlah_tarik);
            DB::table('transaksi_tarik')->where('id', $id)->update(['status' => 'disetujui']);

            DB::commit();
            return back()->with('success', 'Pengajuan berhasil disetujui. Saldo warga telah dipotong.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem saat memproses transaksi.');
        }
    }

    public function tolakTarik($id)
    {
        $updated = DB::table('transaksi_tarik')
            ->where('id', $id)
            ->where('status', 'pending')
            ->update(['status' => 'ditolak']);

        if (!$updated) {
            return back()->with('error', 'Pengajuan tidak ditemukan atau sudah diproses sebelumnya.');
        }
        return back()->with('error', 'Pengajuan penarikan ditolak.');
    }

    public function setujuiSetor($id)
    {
        DB::beginTransaction();
        try {
            $setor = DB::table('transaksi_setor')->where('id', $id)->lockForUpdate()->first();
            if (!$setor || $setor->status !== 'pending') {
                DB::rollBack();
                return back()->with('error', 'Setoran tidak ditemukan atau sudah diproses.');
            }

            $nasabah = DB::table('nasabah')->where('id', $setor->nasabah_id)->lockForUpdate()->first();
            if (!$nasabah) {
                DB::rollBack();
                return back()->with('error', 'Data nasabah tidak ditemukan.');
            }

            DB::table('nasabah')->where('id', $nasabah->id)->increment('total_saldo', $setor->total_harga);
            DB::table('transaksi_setor')->where('id', $id)->update(['status' => 'disetujui']);

            DB::commit();
            return back()->with('success', 'Setoran berhasil disetujui. Saldo nasabah telah bertambah.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Terjadi kesalahan sistem saat menyetujui setoran.');
        }
    }

    public function tolakSetor($id)
    {
        $updated = DB::table('transaksi_setor')
            ->where('id', $id)
            ->where('status', 'pending')
            ->update(['status' => 'ditolak']);

        if (!$updated) {
            return back()->with('error', 'Setoran tidak ditemukan atau sudah diproses sebelumnya.');
        }
        return back()->with('error', 'Setoran telah ditolak.');
    }

   // --- FUNGSI BARU UNTUK LAPORAN (DENGAN FILTER) ---
    public function laporan(Request $request)
    {
        // Tangkap inputan tanggal dari form (jika ada)
        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');

        // Siapkan query dasar
        $query = DB::table('transaksi_setor')
            ->join('nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
            ->join('users', 'nasabah.user_id', '=', 'users.id')
            ->join('kategori', 'transaksi_setor.kategori_id', '=', 'kategori.id')
            ->select('transaksi_setor.*', 'users.nama', 'kategori.nama_kategori')
            ->orderBy('transaksi_setor.tanggal_setor', 'desc');

        // Jika Admin mengisi filter tanggal, saring datanya
        if ($mulai && $akhir) {
            $query->whereBetween('transaksi_setor.tanggal_setor', [$mulai, $akhir]);
        }

        $data_setor = $query->get();

        return view('admin.laporan', compact('data_setor', 'mulai', 'akhir'));
    }

    public function cetakLaporan(Request $request)
    {
        $mulai = $request->input('mulai');
        $akhir = $request->input('akhir');

        $query = DB::table('transaksi_setor')
            ->join('nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
            ->join('users', 'nasabah.user_id', '=', 'users.id')
            ->join('kategori', 'transaksi_setor.kategori_id', '=', 'kategori.id')
            ->select('transaksi_setor.*', 'users.nama', 'kategori.nama_kategori')
            ->orderBy('transaksi_setor.tanggal_setor', 'desc');

        if ($mulai && $akhir) {
            $query->whereBetween('transaksi_setor.tanggal_setor', [$mulai, $akhir]);
        }

        $data_setor = $query->get();

        return view('admin.cetak', compact('data_setor', 'mulai', 'akhir'));
    }

    // --- FUNGSI UNTUK RIWAYAT ADMIN (DENGAN FILTER MANUAL ATAU CEPAT) ---
    public function riwayat(Request $request)
    {
        $filter = $request->query('filter', 'semua');
        $mulai = $request->query('mulai');
        $akhir = $request->query('akhir');
        
        $query_setor = DB::table('transaksi_setor')
            ->join('nasabah', 'transaksi_setor.nasabah_id', '=', 'nasabah.id')
            ->join('users', 'nasabah.user_id', '=', 'users.id')
            ->join('kategori', 'transaksi_setor.kategori_id', '=', 'kategori.id')
            ->select('transaksi_setor.*', 'users.nama', 'kategori.nama_kategori');
            
        $query_tarik = DB::table('transaksi_tarik')
            ->join('nasabah', 'transaksi_tarik.nasabah_id', '=', 'nasabah.id')
            ->join('users', 'nasabah.user_id', '=', 'users.id')
            ->select('transaksi_tarik.*', 'users.nama');

        // Jika form manual dikirim (mulai dan akhir terisi)
        if ($mulai && $akhir) {
            $query_setor->whereBetween('tanggal_setor', [$mulai, $akhir]);
            $query_tarik->whereBetween('tanggal_tarik', [$mulai, $akhir]);
            $filter = 'manual'; // Override filter status for UI
        } else {
            // Filter cepat (Hari, Bulan, Tahun)
            if ($filter == 'hari') {
                $query_setor->whereDate('tanggal_setor', \Carbon\Carbon::today());
                $query_tarik->whereDate('tanggal_tarik', \Carbon\Carbon::today());
            } elseif ($filter == 'bulan') {
                $query_setor->whereMonth('tanggal_setor', \Carbon\Carbon::now()->month)
                            ->whereYear('tanggal_setor', \Carbon\Carbon::now()->year);
                $query_tarik->whereMonth('tanggal_tarik', \Carbon\Carbon::now()->month)
                            ->whereYear('tanggal_tarik', \Carbon\Carbon::now()->year);
            } elseif ($filter == 'tahun') {
                $query_setor->whereYear('tanggal_setor', \Carbon\Carbon::now()->year);
                $query_tarik->whereYear('tanggal_tarik', \Carbon\Carbon::now()->year);
            }
        }

        $riwayat_setor = $query_setor->orderBy('transaksi_setor.id', 'desc')->get();
        $riwayat_tarik = $query_tarik->orderBy('transaksi_tarik.id', 'desc')->get();

        return view('admin.riwayat', compact('riwayat_setor', 'riwayat_tarik', 'filter', 'mulai', 'akhir'));
    }
}