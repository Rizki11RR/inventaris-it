@extends('layouts.app')

@section('header', 'Data Kategori Perangkat')
@section('title', 'Data Kategori')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-tag me-2 text-primary"></i>Kategori Perangkat
        </h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahKategoriModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kategori
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Nama Kategori</th>
                        <th>Deskripsi</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($categories as $category)
                    <tr>
                        <td class="text-start">
                            <div class="fw-semibold">{{ $category->nama_kategori }}</div>
                        </td>
                        <td>
                            <span class="text-secondary">{{ $category->deskripsi ?? '-' }}</span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#editKategoriModal{{ $category->id }}">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>
                                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" class="d-inline" id="delete-form-{{ $category->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-ghost text-danger btn-delete" data-id="{{ $category->id }}" data-name="{{ $category->nama_kategori }}">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="empty-state">
                            <i class="bi bi-tag d-block"></i>
                            Belum ada data kategori.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($categories as $category)
<div class="modal fade" id="editKategoriModal{{ $category->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2 text-primary"></i>Edit Kategori</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('categories.update', $category->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control" value="{{ $category->nama_kategori }}" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Deskripsi <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea name="deskripsi" class="form-control" rows="3">{{ $category->deskripsi }}</textarea>
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

<div class="modal fade" id="tambahKategoriModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-lg me-2 text-primary"></i>Tambah Kategori</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('categories.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Kategori <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kategori" class="form-control" placeholder="Contoh: Laptop, Printer, Router..." required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Deskripsi <span class="text-muted fw-normal">(Opsional)</span></label>
                        <textarea name="deskripsi" class="form-control" rows="3" placeholder="Keterangan singkat kategori ini"></textarea>
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
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');
                Swal.fire({
                    title: 'Hapus kategori?',
                    text: "Kategori '" + categoryName + "' akan dihapus. Pastikan tidak ada perangkat yang menggunakan kategori ini!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#64748B',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: { popup: 'swal2-popup-custom' }
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
