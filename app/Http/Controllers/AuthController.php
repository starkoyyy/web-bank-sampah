<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Nasabah;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registerStore(Request $request)
    {
        // 1. Validasi input agar lebih aman
        $request->validate([
            'nama' => 'required|string|max:255',
            'username' => 'required|string|unique:users',
            'password' => 'required|min:6',
            'alamat' => 'required|string',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan'
        ]);

        // 2. Simpan ke tabel users
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->role = 'nasabah';
        
        // SUDAH DIPERBAIKI: Menangkap $request->nama
        $user->nama = $request->nama; 
        $user->save();

        // 3. Simpan ke tabel nasabah
        $nasabah = new Nasabah();
        $nasabah->user_id = $user->id;
        
        // SUDAH DIPERBAIKI: Menangkap $request->alamat sebagai satu kesatuan teks
        $nasabah->alamat = $request->alamat; 
        $nasabah->jenis_kelamin = $request->jenis_kelamin;
        $nasabah->total_saldo = 0;
        $nasabah->save();

        return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function loginProses(Request $request)
    {
        if (Auth::attempt(['username' => $request->username, 'password' => $request->password])) {
            $request->session()->regenerate();
            
            if (Auth::user()->role === 'admin') {
                return redirect('/admin')->with('success', 'Login berhasil! Selamat datang Admin.');
            }
            
            return redirect('/')->with('success', 'Login berhasil! Selamat datang.');
        }
        return back()->with('error', 'Username atau password salah!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}