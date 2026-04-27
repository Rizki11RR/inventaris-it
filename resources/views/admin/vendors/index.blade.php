@extends('layouts.app')

@section('header', 'Master Data Vendor')

@section('content')
<div class="container-fluid py-3">
    <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
        <div class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-shop me-2 text-primary"></i> Data Vendor / Supplier</h5>
            <button class="btn btn-primary btn-sm rounded-pill shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#tambahVendorModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Vendor
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4 text-start">NAMA VENDOR</th>
                            <th>MERK</th>
                            <th>KONTAK</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $vendor->nama_vendor }}</div>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $vendor->merk ?? '-' }}</span>
                            </td>
                            <td>
                                <span class="text-dark fw-medium">{{ $vendor->kontak ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-light border text-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#editVendorModal{{ $vendor->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    
                                    <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="d-inline" id="delete-form-{{ $vendor->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-light border text-danger rounded-pill btn-delete" data-id="{{ $vendor->id }}" data-name="{{ $vendor->nama_vendor }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-5 text-center text-muted">Belum ada data vendor.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($vendors as $vendor)
<div class="modal fade" id="editVendorModal{{ $vendor->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Data Vendor</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('vendors.update', $vendor->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA VENDOR <span class="text-danger">*</span></label>
                        <input type="text" name="nama_vendor" class="form-control rounded-3" value="{{ $vendor->nama_vendor }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">MERK</label>
                        <input type="text" name="merk" class="form-control rounded-3" value="{{ $vendor->merk }}">
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">KONTAK</label>
                        <input type="text" name="kontak" class="form-control rounded-3" value="{{ $vendor->kontak }}">
                    </div>
                </div>
                <div class="modal-footer bg-white border-0 pt-0 pb-4 px-4 justify-content-end">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="tambahVendorModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Vendor Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('vendors.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA VENDOR <span class="text-danger">*</span></label>
                        <input type="text" name="nama_vendor" class="form-control rounded-3" placeholder="Contoh: PT. Maju Jaya" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">MERK</label>
                        <input type="text" name="merk" class="form-control rounded-3" placeholder="Contoh: Asus, Dell, Epson...">
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">KONTAK</label>
                        <input type="text" name="kontak" class="form-control rounded-3" placeholder="Nomor telepon atau email">
                    </div>
                </div>
                <div class="modal-footer bg-white border-0 pt-0 pb-4 px-4 justify-content-end">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Vendor</button>
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
                const vendorId = this.getAttribute('data-id');
                const vendorName = this.getAttribute('data-name');
                Swal.fire({
                    title: 'Hapus Vendor?',
                    text: "Data '" + vendorName + "' akan dihapus dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: { confirmButton: 'rounded-pill px-4', cancelButton: 'rounded-pill px-4' }
                }).then((result) => {
                    if (result.isConfirmed) { document.getElementById('delete-form-' + vendorId).submit(); }
                });
            });
        });
    });
</script>
@endpush