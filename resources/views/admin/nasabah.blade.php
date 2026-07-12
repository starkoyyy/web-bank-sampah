    @extends('layouts.app')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4 mt-2">
    <div>
        <h4 class="fw-bold text-dark mb-1"><i class="bi bi-people text-success me-2"></i>Data Warga / Nasabah</h4>
        <p class="text-muted mb-0">Daftar seluruh warga yang terdaftar di Bank Sampah Winduherang.</p>
    </div>
    <div>
        <a href="{{ url('/admin/nasabah/tambah') }}" class="btn btn-success rounded-3"><i class="bi bi-plus-lg me-1"></i> Tambah Nasabah</a>
    </div>
</div>



<div class="card border-0 shadow-sm rounded-4 bg-transparent">
    <div class="card-body p-0">
        <div class="table-responsive px-1 pb-3">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th width="5%">No</th>
                        <th width="25%">Nama Lengkap</th>
                        <th width="35%">Alamat Lengkap</th>
                        <th width="20%">Total Saldo Kas</th>
                        <th width="15%" class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data_nasabah as $n)
                    <tr>
                        <td class="text-muted fw-medium">{{ $loop->iteration }}</td>
                        <td class="fw-bold text-dark">
                            <div class="d-flex align-items-center">
                                <div class="bg-success text-white rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 36px; height: 36px; font-weight: 700;">
                                    {{ strtoupper(substr($n->nama, 0, 1)) }}
                                </div>
                                {{ $n->nama }}
                            </div>
                        </td>
                        <td class="text-secondary small">{{ $n->alamat }}</td>
                        <td>
                            <span class="text-success fw-bold">
                                Rp {{ number_format($n->total_saldo, 0, ',', '.') }}
                            </span>
                        </td>
                        <td class="text-end">
                            <a href="{{ url('/admin/nasabah/'.$n->id.'/edit') }}" class="btn btn-sm btn-light border shadow-sm rounded-circle me-1 text-primary hover-shadow" title="Edit" style="width: 32px; height: 32px;"><i class="bi bi-pencil" style="font-size: 0.8rem;"></i></a>
                            <form action="{{ url('/admin/nasabah/'.$n->id) }}" method="POST" class="d-inline form-delete">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-light border shadow-sm rounded-circle text-danger hover-shadow" title="Hapus" style="width: 32px; height: 32px;"><i class="bi bi-trash" style="font-size: 0.8rem;"></i></button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-5 bg-white rounded-4 shadow-sm">
                            <i class="bi bi-inbox fs-1 d-block mb-3 text-secondary opacity-50"></i>
                            <h6 class="fw-medium text-dark mb-1">Belum ada warga</h6>
                            <p class="small mb-0">Warga yang mendaftar akan tampil di sini.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Konfirmasi Hapus
        const deleteForms = document.querySelectorAll('.form-delete');
        deleteForms.forEach(form => {
            form.addEventListener('submit', function (e) {
                e.preventDefault();
                Swal.fire({
                    title: 'Hapus Nasabah?',
                    text: "Data yang dihapus tidak dapat dikembalikan.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#ef4444',
                    cancelButtonColor: '#f1f5f9',
                    confirmButtonText: 'Ya, Hapus',
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
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@endpush
@endsection