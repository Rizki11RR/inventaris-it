@extends('layouts.app')

@section('header', 'Manajemen Pengguna (User)')

@section('content')
<div class="container-fluid py-3">
    <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
        <div class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-people-fill me-2 text-primary"></i> Data Pengguna Sistem</h5>
            <button class="btn btn-primary btn-sm rounded-pill shadow-sm px-3" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
                <i class="bi bi-person-plus-fill me-1"></i> Tambah User Baru
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4 text-start">NAMA PENGGUNA</th>
                            <th>EMAIL</th>
                            <th>ROLE / HAK AKSES</th>
                            <th>TANGGAL DAFTAR</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $user->name }}</div>
                            </td>
                            <td>
                                <span class="text-secondary">{{ $user->email }}</span>
                            </td>
                            <td>
                                @if($user->role == 'admin')
                                    <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3 py-2"><i class="bi bi-shield-lock me-1"></i> Admin IT</span>
                                @elseif($user->role == 'staff')
                                    <span class="badge bg-primary-subtle text-primary border border-primary rounded-pill px-3 py-2"><i class="bi bi-tools me-1"></i> Staff IT</span>
                                @else
                                    <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-2"><i class="bi bi-graph-up me-1"></i> Manajemen</span>
                                @endif
                            </td>
                            <td>
                                <span class="small text-muted">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button type="button" class="btn btn-sm btn-light border text-primary rounded-pill" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" id="delete-form-{{ $user->id }}">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-light border text-danger rounded-pill btn-delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                            <i class="bi bi-trash"></i> Hapus
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-5 text-center text-muted">Belum ada data pengguna.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($users as $user)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-pencil-square me-2"></i>Edit Data User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA LENGKAP <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">EMAIL <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control rounded-3" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">ROLE (HAK AKSES) <span class="text-danger">*</span></label>
                        <select name="role" class="form-select rounded-3" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin IT</option>
                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff IT</option>
                            <option value="manajemen" {{ $user->role == 'manajemen' ? 'selected' : '' }}>Manajemen</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">PASSWORD BARU</label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="Kosongkan jika tidak ingin ganti password">
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

<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0" style="border-radius: 1rem;">
            <div class="modal-header bg-light border-0" style="border-top-left-radius: 1rem; border-top-right-radius: 1rem;">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-person-plus-fill me-2"></i>Tambah User Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-body p-4 text-start">
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">NAMA LENGKAP <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control rounded-3" placeholder="Masukkan nama pengguna" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">EMAIL <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control rounded-3" placeholder="contoh@perusahaan.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label text-muted small fw-bold">ROLE (HAK AKSES) <span class="text-danger">*</span></label>
                        <select name="role" class="form-select rounded-3" required>
                            <option value="">-- Pilih Hak Akses --</option>
                            <option value="admin">Admin IT</option>
                            <option value="staff">Staff IT</option>
                            <option value="manajemen">Manajemen</option>
                        </select>
                    </div>
                    <div class="mb-2">
                        <label class="form-label text-muted small fw-bold">PASSWORD <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control rounded-3" placeholder="Minimal 8 karakter" required minlength="8">
                    </div>
                </div>
                <div class="modal-footer bg-white border-0 pt-0 pb-4 px-4 justify-content-end">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm"><i class="bi bi-save me-2"></i>Simpan User</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
