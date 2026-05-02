@extends('layouts.app')

@section('header', 'Master Data Kategori Perangkat')
@section('title', 'Data Kategori Perangkat')

@section('content')
<div class="container-fluid py-3">
    <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
        <div class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-tags-fill me-2 text-primary"></i> Data Kategori Perangkat</h5>
            <button class="btn btn-primary btn-sm rounded-pill shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4 text-start">NAMA KATEGORI</th>
                            <th>DESKRIPSI / KETERANGAN</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $category->nama_kategori }}</div>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $category->deskripsi ?? '-' }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-light border text-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $category->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    
                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" id="delete-form-{{ $category->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-light border text-danger rounded-pill btn-delete" data-id="{{ $category->id }}" data-name="{{ $category->nama_kategori }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-5 text-center text-muted">Belum ada data master kategori.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($categories as $category)
<div class="modal fade" id="editKategoriModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Data Kategori</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA KATEGORI <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control rounded-3" value="{{ $category->nama_kategori }}" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">DESKRIPSI (OPSIONAL)</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3">{{ $category->deskripsi }}</textarea>
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

<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Kategori Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA KATEGORI <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control rounded-3" placeholder="Contoh: Laptop, Printer, Router..." required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">DESKRIPSI (OPSIONAL)</label>
                        <textarea name="deskripsi" class="form-control rounded-3" rows="3" placeholder="Keterangan singkat kategori ini"></textarea>
                    </div>
                </div>
                <div class="modal-footer bg-white border-0 pt-0 pb-4 px-4 justify-content-end">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-save me-2"></i>Simpan Kategori</button>
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
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');

                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    text: "Kategori '" + categoryName + "' akan dihapus. Pastikan tidak ada perangkat yang sedang menggunakan kategori ini!",
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
                        document.getElementById('delete-form-' + categoryId).submit();
                    }
                });
            });
        });
    });
</script>
@endpush