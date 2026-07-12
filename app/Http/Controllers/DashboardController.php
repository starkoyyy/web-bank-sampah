<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Nasabah;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin');
        }

        $nasabah = Nasabah::where('user_id', Auth::id())->first();
        return view('dashboard', compact('nasabah'));
    }

    public function riwayat(Request $request)
    {
        if (Auth::user()->role === 'admin') {
            return redirect('/admin');
        }
        $nasabah = Nasabah::where('user_id', Auth::id())->first();
        
        $filter = $request->query('filter', 'semua');
        
        $query_setor = DB::table('transaksi_setor')
            ->join('kategori', 'transaksi_setor.kategori_id', '=', 'kategori.id')
            ->where('transaksi_setor.nasabah_id', $nasabah->id)
            ->select('transaksi_setor.*', 'kategori.nama_kategori');
            
        $query_tarik = DB::table('transaksi_tarik')
            ->where('nasabah_id', $nasabah->id);

        if ($filter == 'minggu') {
            // Data minggu ini (Senin - Minggu)
            $start = \Carbon\Carbon::now()->startOfWeek();
            $end = \Carbon\Carbon::now()->endOfWeek();
            $query_setor->whereBetween('tanggal_setor', [$start, $end]);
            $query_tarik->whereBetween('tanggal_tarik', [$start, $end]);
        } elseif ($filter == 'bulan') {
            // Data bulan ini
            $query_setor->whereMonth('tanggal_setor', \Carbon\Carbon::now()->month)
                        ->whereYear('tanggal_setor', \Carbon\Carbon::now()->year);
            $query_tarik->whereMonth('tanggal_tarik', \Carbon\Carbon::now()->month)
                        ->whereYear('tanggal_tarik', \Carbon\Carbon::now()->year);
        }

        $riwayat_setor = $query_setor->orderBy('transaksi_setor.id', 'desc')->get();
        $riwayat_tarik = $query_tarik->orderBy('id', 'desc')->get();

        return view('riwayat', compact('riwayat_setor', 'riwayat_tarik', 'filter'));
    }
}
