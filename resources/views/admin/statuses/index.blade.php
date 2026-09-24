@extends('layouts.app')

@section('header', 'Data Status Perangkat')
@section('title', 'Data Status')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-toggle-on me-2 text-primary"></i>Status Perangkat
        </h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahStatusModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Status
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Nama Status</th>
                        <th>Label</th>
                        <th class="text-center" style="width: 120px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($statuses as $st)
                    <tr>
                        <td class="text-start fw-semibold">{{ $st->nama_status }}</td>
                        <td>
                            <span class="badge bg-{{ $st->warna }}">{{ $st->nama_status }}</span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#editStatusModal{{ $st->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('statuses.destroy', $st->id) }}" method="POST" class="d-inline" id="delete-form-{{ $st->id }}">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="btn btn-ghost btn-sm text-danger btn-delete" data-id="{{ $st->id }}" data-name="{{ $st->nama_status }}">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($statuses as $st)
<div class="modal fade" id="editStatusModal{{ $st->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2 text-primary"></i>Edit Status</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('statuses.update', $st->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Status <span class="text-danger">*</span></label>
                        <input type="text" name="nama_status" class="form-control" value="{{ $st->nama_status }}" required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Warna Label</label>
                        <select name="warna" class="form-select">
                            <option value="primary" {{ $st->warna == 'primary' ? 'selected' : '' }}>Biru (Primary)</option>
                            <option value="success" {{ $st->warna == 'success' ? 'selected' : '' }}>Hijau (Success)</option>
                            <option value="danger" {{ $st->warna == 'danger' ? 'selected' : '' }}>Merah (Danger)</option>
                            <option value="warning" {{ $st->warna == 'warning' ? 'selected' : '' }}>Kuning (Warning)</option>
                            <option value="info" {{ $st->warna == 'info' ? 'selected' : '' }}>Biru Muda (Info)</option>
                        </select>
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

<div class="modal fade" id="tambahStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-lg me-2 text-primary"></i>Tambah Status</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('statuses.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Status <span class="text-danger">*</span></label>
                        <input type="text" name="nama_status" class="form-control" placeholder="Contoh: Tersedia, Dipakai..." required>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Warna Label</label>
                        <select name="warna" class="form-select">
                            <option value="primary">Biru (Primary)</option>
                            <option value="success">Hijau (Success)</option>
                            <option value="danger">Merah (Danger)</option>
                            <option value="warning">Kuning (Warning)</option>
                            <option value="info">Biru Muda (Info)</option>
                        </select>
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
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                Swal.fire({
                    title: 'Hapus status?',
                    text: "Status '" + name + "' akan dihapus dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#EF4444',
                    cancelButtonColor: '#64748B',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: { popup: 'swal2-popup-custom' }
                }).then((result) => {
                    if (result.isConfirmed) {
                        document.getElementById('delete-form-' + id).submit();
                    }
                });
            });
        });
    });
</script>
@endpush
