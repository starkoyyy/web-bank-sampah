@extends('layouts.app')
@section('content')
<div class="row justify-content-center mt-5">
    <div class="col-md-5">
        <div class="card border-0 shadow-sm rounded-4">
            <div class="card-body p-4">
                <h5 class="fw-bold mb-4">Edit Kategori & Harga</h5>
                <form action="/admin/kategori/{{ $kategori->id }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Nama Sampah</label>
                        <input type="text" name="nama_kategori" class="form-control" value="{{ $kategori->nama_kategori }}" required>
                    </div>
                    <div class="mb-4">
                        <label class="form-label">Harga per Kg (Rp)</label>
                        <input type="number" name="harga_per_kg" class="form-control" value="{{ $kategori->harga_per_kg }}" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100 rounded-pill py-2">Update Data</button>
                    <a href="/admin/kategori" class="btn btn-light w-100 rounded-pill py-2 mt-2">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection