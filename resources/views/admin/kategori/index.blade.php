@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-between align-items-center mt-4 mb-4">
    <h4 class="fw-bold"><i class="bi bi-tags-fill text-success me-2"></i>Kelola Kategori & Harga</h4>
    <a href="/admin/kategori/tambah" class="btn btn-success rounded-pill px-4"><i class="bi bi-plus-lg"></i> Tambah Kategori</a>
</div>

@if(session('success'))
    <div class="alert alert-success rounded-3">{{ session('success') }}</div>
@endif

<div class="card border-0 shadow-sm rounded-4 bg-transparent">
    <div class="card-body p-0">
        <div class="table-responsive px-1 pb-3">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th width="10%">No</th>
                        <th width="30%">Nama Kategori Sampah</th>
                        <th width="20%">Total Terkumpul</th>
                        <th width="20%">Harga per Kg</th>
                        <th width="20%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($kategori as $item)
                    <tr>
                        <td class="text-muted fw-medium">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-dark">
                            <i class="bi bi-tag-fill text-success opacity-75 me-2"></i>{{ $item->nama_kategori }}
                        </td>
                        <td>
                            <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">
                                <i class="bi bi-box-seam text-success me-1"></i> 
                                {{ number_format($item->total_terkumpul, 0, ',', '.') }} Kg
                            </span>
                        </td>
                        <td>
                            <span class="text-success fw-bold">
                                Rp {{ number_format($item->harga_per_kg, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="text-end">
                            <div class="d-flex justify-content-end gap-2">
                                <a href="/admin/kategori/{{ $item->id }}/edit" class="btn btn-sm btn-light border shadow-sm rounded-circle text-primary hover-shadow d-flex align-items-center justify-content-center" title="Edit" style="width: 32px; height: 32px;"><i class="bi bi-pencil" style="font-size: 0.8rem;"></i></a>
                                <button type="button" class="btn btn-sm btn-light border shadow-sm rounded-circle text-danger hover-shadow d-flex align-items-center justify-content-center" title="Hapus" style="width: 32px; height: 32px;" onclick="confirmDeleteKategori({{ $item->id }})">
                                    <i class="bi bi-trash" style="font-size: 0.8rem;"></i>
                                </button>
                                <form id="delete-form-{{ $item->id }}" action="/admin/kategori/{{ $item->id }}" method="POST" class="d-none">
                                    @csrf
                                    @method('DELETE')
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="text-center text-muted py-5 bg-white rounded-4 shadow-sm">
                            <i class="bi bi-tags fs-1 d-block mb-3 text-secondary opacity-50"></i>
                            <h6 class="fw-medium text-dark mb-1">Belum ada kategori</h6>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
    function confirmDeleteKategori(id) {
        Swal.fire({
            title: 'Hapus Kategori?',
            text: "Kategori ini akan dihapus permanen jika belum ada riwayat setoran.",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#ef4444',
            cancelButtonColor: '#f1f5f9',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            customClass: {
                popup: 'premium-swal-popup',
                title: 'premium-swal-title',
                htmlContainer: 'premium-swal-content',
                confirmButton: 'premium-swal-confirm',
                cancelButton: 'premium-swal-cancel'
            }
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }
</script>
@endsection