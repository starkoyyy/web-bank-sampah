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

        if (!$nasabah) {
            return back()->with('error', 'Data profil nasabah tidak ditemukan.');
        }

        // Validasi input
        $request->validate([
            'jumlah_tarik' => 'required|numeric|min:1000|max:100000000',
            'metode_penarikan' => 'required|in:Tunai,Transfer,E-Wallet',
            'detail_tujuan' => 'nullable|string|max:150'
        ]);

        if (in_array($request->metode_penarikan, ['Transfer', 'E-Wallet']) && empty($request->detail_tujuan)) {
            return back()->with('error', 'Detail tujuan (rekening/nomor e-wallet) wajib diisi untuk metode Transfer atau E-Wallet.');
        }

        // Hitung total penarikan yang masih berstatus 'pending'
        $pending_tarik = DB::table('transaksi_tarik')
            ->where('nasabah_id', $nasabah->id)
            ->where('status', 'pending')
            ->sum('jumlah_tarik');

        $saldo_tersedia = $nasabah->total_saldo - $pending_tarik;

        // Validasi ketersediaan saldo
        if ($saldo_tersedia < $request->jumlah_tarik) {
            if ($pending_tarik > 0) {
                return back()->with('error', 'Saldo efektif tidak mencukupi. Terdapat pengajuan penarikan lain sebesar Rp ' . number_format($pending_tarik, 0, ',', '.') . ' yang masih menunggu persetujuan Admin.');
            }
            return back()->with('error', 'Saldo Anda tidak mencukupi untuk melakukan penarikan ini.');
        }

        // Masukkan data ke database dengan status 'pending'
        DB::table('transaksi_tarik')->insert([
            'nasabah_id' => $nasabah->id,
            'tanggal_tarik' => date('Y-m-d'),
            'jumlah_tarik' => $request->jumlah_tarik,
            'metode_penarikan' => $request->metode_penarikan,
            'detail_tujuan' => $request->metode_penarikan === 'Tunai' ? null : strip_tags($request->detail_tujuan),
            'status' => 'pending'
        ]);

        return redirect('/')->with('success', 'Pengajuan tarik saldo berhasil dikirim. Menunggu persetujuan Admin.');
    }
}