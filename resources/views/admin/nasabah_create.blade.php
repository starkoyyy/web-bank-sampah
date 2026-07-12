@extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="bi bi-person-plus text-success me-2"></i>Tambah Nasabah</h4>
        <p class="text-muted mb-0">Tambahkan data warga / nasabah baru.</p>
    </div>
    <div>
        <a href="{{ url('/admin/nasabah') }}" class="btn btn-outline-secondary rounded-3"><i class="bi bi-arrow-left me-1"></i> Kembali</a>
    </div>
</div>

<div class="card border-0 shadow-sm rounded-4">
    <div class="card-body p-4">
        <form action="{{ url('/admin/nasabah') }}" method="POST">
            @csrf
            
            <div class="mb-3">
                <label for="nama" class="form-label fw-bold">Nama Lengkap</label>
                <input type="text" class="form-control rounded-3 @error('nama') is-invalid @enderror" id="nama" name="nama" value="{{ old('nama') }}" required>
                @error('nama')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="username" class="form-label fw-bold">Username</label>
                <input type="text" class="form-control rounded-3 @error('username') is-invalid @enderror" id="username" name="username" value="{{ old('username') }}" required>
                @error('username')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="password" class="form-label fw-bold">Password</label>
                <input type="password" class="form-control rounded-3 @error('password') is-invalid @enderror" id="password" name="password" required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label class="form-label fw-bold mb-2">Jenis Kelamin</label>
                <div class="d-flex gap-2">
                    <div class="w-100">
                        <input type="radio" class="btn-check" name="jenis_kelamin" id="gender-male" value="Laki-laki" {{ old('jenis_kelamin') == 'Laki-laki' ? 'checked' : '' }} required>
                        <label class="btn btn-outline-success w-100 py-2 fw-medium" for="gender-male">
                            <i class="bi bi-gender-male me-1"></i> Laki-laki
                        </label>
                    </div>
                    <div class="w-100">
                        <input type="radio" class="btn-check" name="jenis_kelamin" id="gender-female" value="Perempuan" {{ old('jenis_kelamin') == 'Perempuan' ? 'checked' : '' }} required>
                        <label class="btn btn-outline-success w-100 py-2 fw-medium" for="gender-female">
                            <i class="bi bi-gender-female me-1"></i> Perempuan
                        </label>
                    </div>
                </div>
                @error('jenis_kelamin')
                    <div class="text-danger small mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-4">
                <label for="alamat" class="form-label fw-bold">Alamat Lengkap</label>
                <textarea class="form-control rounded-3 @error('alamat') is-invalid @enderror" id="alamat" name="alamat" rows="3">{{ old('alamat') }}</textarea>
                @error('alamat')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="d-flex justify-content-end">
                <button type="submit" class="btn btn-success rounded-3 px-4"><i class="bi bi-save me-1"></i> Simpan Nasabah</button>
            </div>
        </form>
    </div>
</div>
@endsection
