<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kategori;
use App\Models\Nasabah;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransaksiController extends Controller 
{
    public function create()
    {
        $kategori = DB::table('kategori')->orderBy('nama_kategori', 'asc')->get();
        return view('transaksi.setor', compact('kategori')); 
    }

    public function store(Request $request)
    {
        // ==========================================
        // LAPIS PENGAMAN: Minimal 1 Kg
        // ==========================================
        if ($request->berat < 1) {
            return back()->with('error', 'Gagal! Berat sampah minimal adalah 1 Kg.');
        }

        $nasabah = Nasabah::where('user_id', Auth::id())->first();

        if (!$nasabah) {
            return back()->with('error', 'Data Anda belum lengkap sebagai nasabah.');
        }

        $kategori = DB::table('kategori')->where('id', $request->kategori_id)->first();
        $total_harga = $request->berat * $kategori->harga_per_kg;

        DB::table('transaksi_setor')->insert([
            'nasabah_id' => $nasabah->id,
            'kategori_id' => $request->kategori_id,
            'berat' => $request->berat,
            'total_harga' => $total_harga,
            'tanggal_setor' => date('Y-m-d'),
            'status' => 'pending'
        ]);

        return redirect('/')->with('success', 'Pengajuan setoran berhasil! Menunggu konfirmasi admin.');
    }
}