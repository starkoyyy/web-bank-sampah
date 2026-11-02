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
        // 1. Validasi input ketat
        $request->validate([
            'nama' => 'required|string|max:100',
            'username' => 'required|string|alpha_dash|min:3|max:50|unique:users,username',
            'password' => 'required|string|min:6|max:100',
            'alamat' => 'required|string|max:500',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan'
        ], [
            'nama.required' => 'Nama lengkap wajib diisi.',
            'username.required' => 'Username wajib diisi.',
            'username.alpha_dash' => 'Username hanya boleh berisi huruf, angka, tanda strip (-) dan garis bawah (_).',
            'username.unique' => 'Username sudah terdaftar, silakan gunakan username lain.',
            'password.required' => 'Password wajib diisi.',
            'password.min' => 'Password minimal terdiri dari 6 karakter.',
            'alamat.required' => 'Alamat wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
        ]);

        \Illuminate\Support\Facades\DB::beginTransaction();
        try {
            // 2. Simpan ke tabel users
            $user = new User();
            $user->username = strtolower(trim($request->username));
            $user->password = Hash::make($request->password);
            $user->role = 'nasabah';
            $user->nama = strip_tags(trim($request->nama)); 
            $user->save();

            // 3. Simpan ke tabel nasabah
            $nasabah = new Nasabah();
            $nasabah->user_id = $user->id;
            $nasabah->alamat = strip_tags(trim($request->alamat)); 
            $nasabah->jenis_kelamin = $request->jenis_kelamin;
            $nasabah->total_saldo = 0;
            $nasabah->save();

            \Illuminate\Support\Facades\DB::commit();
            return redirect('/login')->with('success', 'Akun berhasil dibuat! Silakan login.');
        } catch (\Exception $e) {
            \Illuminate\Support\Facades\DB::rollBack();
            return back()->with('error', 'Terjadi kendala sistem saat membuat akun. Silakan coba kembali.');
        }
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