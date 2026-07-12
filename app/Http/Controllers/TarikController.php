<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Nasabah;

class TarikController extends Controller
{
    public function create()
    {
        $nasabah = Nasabah::where('user_id', Auth::id())->first();
        return view('tarik.create', compact('nasabah')); // Pastikan nama view ini sesuai dengan milik Anda
    }

    public function store(Request $request)
    {
        $nasabah = Nasabah::where('user_id', Auth::id())->first();

        // Validasi input
        $request->validate([
            'jumlah_tarik' => 'required|numeric|min:1000',
            'metode_penarikan' => 'required|in:Tunai,Transfer,E-Wallet',
            'detail_tujuan' => 'nullable|string'
        ]);

        // Validasi: Cek apakah saldo mencukupi
        if ($nasabah->total_saldo < $request->jumlah_tarik) {
            return back()->with('error', 'Saldo tidak mencukupi untuk melakukan penarikan.');
        }

        // Masukkan data ke database dengan status 'pending', SALDO BELUM DIPOTONG
        DB::table('transaksi_tarik')->insert([
            'nasabah_id' => $nasabah->id,
            'tanggal_tarik' => date('Y-m-d'),
            'jumlah_tarik' => $request->jumlah_tarik,
            'metode_penarikan' => $request->metode_penarikan,
            'detail_tujuan' => $request->metode_penarikan === 'Tunai' ? null : $request->detail_tujuan,
            'status' => 'pending'
        ]);

        return redirect('/')->with('success', 'Pengajuan tarik saldo berhasil dikirim. Menunggu persetujuan Admin.');
    }
}