@extends('layouts.app')

@section('header', 'Master Data Lokasi Perangkat')
@section('title', 'Data Lokasi')

@section('content')
<div class="container-fluid py-3">
    <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
        <div class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-geo-alt-fill me-2 text-primary"></i> Data Lokasi Perangkat</h5>
            <button class="btn btn-primary btn-sm rounded-pill shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#tambahLokasiModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Lokasi
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4 text-start">NAMA LOKASI</th>
                            <th>KETERANGAN / RUANGAN</th>
                            <th>JUMLAH PERANGKAT</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($locations as $location)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $location->nama_lokasi }}</div>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $location->deskripsi ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="badge bg-info-subtle text-info border border-info rounded-pill px-3 py-2">
                                    {{ $location->assets_count }} Perangkat
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-light border text-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#editLokasiModal{{ $location->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    
                                    <form action="{{ route('locations.destroy', $location->id) }}" method="POST" class="d-inline" id="delete-form-{{ $location->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-light border text-danger rounded-pill btn-delete" data-id="{{ $location->id }}" data-name="{{ $location->nama_lokasi }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-5 text-center text-muted">Belum ada data master lokasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($locations as $location)
<div class="modal fade" id="editLokasiModal{{ $location->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Data Lokasi</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('locations.update', $location->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA LOKASI <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lokasi" class="form-control rounded-3" value="{{ $location->nama_lokasi }}" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">KETERANGAN (OPSIONAL)</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3">{{ $location->deskripsi }}</textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-0 pt-0 pb-4 px-4 justify-content-end">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-save me-2"></i>Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="tambahLokasiModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Lokasi Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('locations.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA LOKASI <span class="text-danger">*</span></label>
                        <input type="text" name="nama_lokasi" class="form-control rounded-3" placeholder="Contoh: Ruang Server, Divisi HRD, Lantai 2..." required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">KETERANGAN (OPSIONAL)</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3" placeholder="Keterangan detail ruangan ini"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-0 pt-0 pb-4 px-4 justify-content-end">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-save me-2"></i>Simpan Lokasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Logika SweetAlert untuk Tombol Hapus
        const deleteButtons = document.querySelectorAll('.btn-delete');
        
        deleteButtons.forEach(button => {
            button.addEventListener('click', function () {
                const locationId = this.getAttribute('data-id');
                const locationName = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Lokasi '" + locationName + "' akan dihapus. Pastikan tidak ada perangkat yang terdaftar di lokasi ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: '<i class="bi bi-trash me-1"></i> Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'rounded-pill px-4',
                        cancelButton: 'rounded-pill px-4'
                    }
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