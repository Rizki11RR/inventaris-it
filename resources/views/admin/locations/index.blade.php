@extends('layouts.app')

@section('header', 'Data Lokasi Perangkat')
@section('title', 'Data Lokasi')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-geo-alt me-2 text-primary"></i>Lokasi Perangkat
        </h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahLokasiModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Lokasi
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Nama Lokasi</th>
                        <th>Keterangan</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($locations as $location)
                    <tr>
                        <td class="text-start">
                            <div class="fw-semibold">{{ $location->nama_lokasi }}</div>
                        </td>
                        <td>
                            <span class="text-secondary">{{ $location->deskripsi ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#editLokasiModal{{ $location->id }}">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>
                                <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="d-inline" id="delete-form-{{ $location->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-ghost text-danger btn-delete" data-id="{{ $location->id }}" data-name="{{ $location->nama_lokasi }}">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="empty-state">
                            <i class="bi bi-geo-alt d-block"></i>
                            Belum ada data lokasi.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($locations as $location)
<div class="modal fade" id="editLokasiModal{{ $location->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2 text-primary"></i>Edit Lokasi</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('locations.update', $location->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lokasi" class="form-control" value="{{ $location->nama_lokasi }}" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Keterangan <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $location->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="tambahLokasiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-lg me-2 text-primary"></i>Tambah Lokasi</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('locations.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lokasi <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lokasi" class="form-control" placeholder="Contoh: Ruang Server, Divisi HRD, Lantai 2..." required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Keterangan <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Keterangan detail ruangan ini"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i> Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const deleteButtons = document.querySelectorAll('.btn-delete');
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const locationId = this.getAttribute('data-id');
                const locationName = this.getAttribute('data-name');
                Swal.fire({
                    title: 'Hapus lokasi?',
                    text: "Lokasi '" + locationName + "' akan dihapus. Pastikan tidak ada perangkat di lokasi ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#64748B',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: { popup: 'swal2-popup-custom' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + locationId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
