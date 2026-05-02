@extends('layouts.app')

@section('header', 'Master Status Perangkat')
@section('title', 'Master Status')

@section('content')
<div class="container-fluid py-3">
    <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
        <div class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-info-circle-fill me-2 text-primary"></i> Data Status Perangkat</h5>
            <button class="btn btn-primary btn-sm rounded-pill shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#tambahStatusModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Status
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">NAMA STATUS</th>
                            <th>LABEL / WARNA</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statuses as $st)
                        <tr>
                            <td class="ps-4 fw-bold">{{ $st->nama_status }}</td>
                            <td>
                                <span class="badge bg-{{ $st->warna }} rounded-pill px-3">
                                    {{ $st->nama_status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light border rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#editStatusModal{{ $st->id }}">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                                <form action="{{ route('statuses.destroy', $st->id) }}" method="POST" class="d-inline" id="delete-form-{{ $st->id }}">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-light border rounded-3 btn-delete" data-id="{{ $st->id }}" data-name="{{ $st->nama_status }}">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($statuses as $st)
<div class="modal fade" id="editStatusModal{{ $st->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Status</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('statuses.update', $st->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA STATUS <span class="text-danger">*</span></label>
                        <input type="text" name="nama_status" class="form-control rounded-3" value="{{ $st->nama_status }}" required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">WARNA LABEL (Bootstrap Class)</label>
                        <select name="warna" class="form-select rounded-3">
                            <option value="primary" {{ $st->warna == 'primary' ? 'selected' : '' }}>Biru (Primary)</option>
                            <option value="success" {{ $st->warna == 'success' ? 'selected' : '' }}>Hijau (Success)</option>
                            <option value="danger" {{ $st->warna == 'danger' ? 'selected' : '' }}>Merah (Danger)</option>
                            <option value="warning" {{ $st->warna == 'warning' ? 'selected' : '' }}>Kuning (Warning)</option>
                            <option value="info" {{ $st->warna == 'info' ? 'selected' : '' }}>Biru Muda (Info)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="tambahStatusModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-plus-lg me-2"></i>Tambah Status Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('statuses.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA STATUS <span class="text-danger">*</span></label>
                        <input type="text" name="nama_status" class="form-control rounded-3" placeholder="Contoh: Tersedia, Dipakai..." required>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">WARNA LABEL</label>
                        <select name="warna" class="form-select rounded-3">
                            <option value="primary">Biru (Primary)</option>
                            <option value="success">Hijau (Success)</option>
                            <option value="danger">Merah (Danger)</option>
                            <option value="warning">Kuning (Warning)</option>
                            <option value="info">Biru Muda (Info)</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">Simpan Status</button>
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
                    title: 'Hapus Status?',
                    text: "Status '" + name + "' akan dihapus dari sistem!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#dc3545',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Ya, Hapus!',
                    cancelButtonText: 'Batal',
                    customClass: {
                        confirmButton: 'rounded-pill px-4',
                        cancelButton: 'rounded-pill px-4'
                    }
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