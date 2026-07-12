@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Tambah Kategori Baru</h5>
                <form action="/admin/kategori" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Sampah</label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Misal: Kardus Bekas" required>
                    </div>
                    <div class="mb-4">
    <label class="form-label fw-medium text-dark">Berat Sampah (Kg)</label>
                        <div class="input-group">
                            <input type="number" name="berat" class="form-control" placeholder="Contoh: 2.5" min="0.1" step="0.1" required>
                            <span class="input-group-text bg-light">Kg</span>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success w-100 rounded-pill py-2">Simpan Kategori</button>
                    <a href="/admin/kategori" class="btn btn-light w-100 rounded-pill py-2 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection