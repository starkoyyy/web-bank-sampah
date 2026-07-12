@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="bi bi-pencil-square text-success me-2"></i>Edit Data Nasabah</h4>
        <p class="text-muted mb-0">Ubah data informasi warga / nasabah.</p>
    </div>
    <div>
        <a href="{{ url('/admin/nasabah') }}" class="btn btn-light border rounded-3"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4 bg-white">
    <div class="card-body p-4">
        <form action="{{ url('/admin/nasabah/'.$nasabah->id) }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" class="form-control rounded-3 @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama', $user->nama) }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label fw-bold">Username</label>
                <input type="text" class="form-control rounded-3 @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username', $user->username) }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password (Kosongkan jika tidak ingin mengubah)</label>
                <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" id="password" name="password">
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="jenis_kelamin" class="form-label fw-bold mb-2">Jenis Kelamin</label>
                <select class="form-select rounded-3 @error('jenis_kelamin') is-invalid @enderror" id="jenis_kelamin" name="jenis_kelamin" required>
                    <option value="" disabled {{ empty($nasabah->jenis_kelamin) ? 'selected' : '' }}>-- Pilih Jenis Kelamin --</option>
                    <option value="Laki-laki" {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'Laki-laki' ? 'selected' : '' }}>Laki-laki</option>
                    <option value="Perempuan" {{ old('jenis_kelamin', $nasabah->jenis_kelamin) == 'Perempuan' ? 'selected' : '' }}>Perempuan</option>
                </select>
                @error('jenis_kelamin')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                <textarea class="form-control rounded-3 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat', $nasabah->alamat) }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success rounded-3 px-4"><i class="bi bi-save me-1"></i> Perbarui Data</button>
            </div>
        </form>
    </div>
</div>
@endsection
