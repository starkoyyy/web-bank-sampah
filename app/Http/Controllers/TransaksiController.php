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
        // Validasi input yang ketat
        $request->validate([
            'kategori_id' => 'required|integer|exists:kategori,id',
            'berat' => 'required|numeric|min:0.1|max:10000',
        ], [
            'kategori_id.required' => 'Pilih kategori sampah terlebih dahulu.',
            'kategori_id.exists' => 'Kategori sampah tidak valid atau tidak ditemukan.',
            'berat.required' => 'Berat sampah wajib diisi.',
            'berat.numeric' => 'Berat sampah harus berupa angka yang valid.',
            'berat.min' => 'Berat sampah minimal adalah 0.1 Kg.',
            'berat.max' => 'Berat sampah melebihi batas wajar (maksimal 10.000 Kg).',
        ]);

        $nasabah = Nasabah::where('user_id', Auth::id())->first();

        if (!$nasabah) {
            return back()->with('error', 'Profil data Anda sebagai nasabah tidak ditemukan.');
        }

        $kategori = DB::table('kategori')->where('id', $request->kategori_id)->first();
        if (!$kategori) {
            return back()->with('error', 'Kategori sampah tidak ditemukan.');
        }

        $total_harga = round($request->berat * $kategori->harga_per_kg, 2);

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