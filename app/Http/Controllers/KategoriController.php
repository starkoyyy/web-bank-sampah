<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use Illuminate\Support\Facades\Auth;

class KategoriController extends Controller
{
    // Tampilkan daftar kategori
    public function index()
    {
        $kategori = Kategori::all();
        
        // Hitung total terkumpul untuk setiap kategori
        foreach ($kategori as $item) {
            $item->total_terkumpul = \Illuminate\Support\Facades\DB::table('transaksi_setor')
                ->where('kategori_id', $item->id)
                ->where('status', 'disetujui')
                ->sum('berat');
        }
        
        return view('admin.kategori.index', compact('kategori'));
    }

    // Tampilkan form tambah
    public function create()
    {
        return view('admin.kategori.create');
    }

    // Simpan data kategori baru
    public function store(Request $request)
    {
        Kategori::create([
            'nama_kategori' => $request->nama_kategori,
            'harga_per_kg' => $request->harga_per_kg
        ]);
        return redirect('/admin/kategori')->with('success', 'Kategori baru berhasil ditambahkan!');
    }

    // Tampilkan form edit
    public function edit($id)
    {
        $kategori = Kategori::find($id);
        return view('admin.kategori.edit', compact('kategori'));
    }

    // Simpan perubahan harga/nama
    public function update(Request $request, $id)
    {
        $kategori = Kategori::find($id);
        $kategori->update([
            'nama_kategori' => $request->nama_kategori,
            'harga_per_kg' => $request->harga_per_kg
        ]);
        return redirect('/admin/kategori')->with('success', 'Data kategori berhasil diperbarui!');
    }

    // Hapus kategori (dengan validasi)
    public function destroy($id)
    {
        // Cek apakah kategori ini sudah dipakai di transaksi setor
        $adaTransaksi = \Illuminate\Support\Facades\DB::table('transaksi_setor')
            ->where('kategori_id', $id)
            ->exists();

        if ($adaTransaksi) {
            return back()->with('error', 'Peringatan: Kategori ini tidak dapat dihapus karena sudah memiliki riwayat setoran sampah dari nasabah.');
        }

        // Jika aman, hapus
        $kategori = Kategori::find($id);
        if ($kategori) {
            $kategori->delete();
            return redirect('/admin/kategori')->with('success', 'Kategori berhasil dihapus permanen!');
        }

        return back()->with('error', 'Data kategori tidak ditemukan.');
    }
}