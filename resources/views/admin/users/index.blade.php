@extends('layouts.app')

@section('header', 'Manajemen Pengguna')
@section('title', 'Kelola Pengguna')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-people me-2 text-primary"></i>Data Pengguna Sistem
        </h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahUserModal">
            <i class="bi bi-person-plus me-1"></i> Tambah User
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Nama Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($users as $user)
                    <tr>
                        <td class="text-start">
                            <div class="d-flex align-items-center gap-3">
                                <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=3C50E0&color=fff&bold=true&size=36" 
                                     alt="{{ $user->name }}" class="rounded-circle" width="36" height="36">
                                <div class="fw-semibold">{{ $user->name }}</div>
                            </div>
                        </td>
                        <td>
                            <span class="text-secondary">{{ $user->email }}</span>
                        </td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger-subtle text-danger"><i class="bi bi-shield-lock me-1"></i>Admin</span>
                            @elseif($user->role == 'staff')
                                <span class="badge bg-primary-subtle text-primary"><i class="bi bi-tools me-1"></i>Staff IT</span>
                            @else
                                <span class="badge bg-success-subtle text-success"><i class="bi bi-graph-up me-1"></i>Manajemen</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button type="button" class="btn btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline" id="delete-form-{{ $user->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-ghost text-danger btn-delete" data-id="{{ $user->id }}" data-name="{{ $user->name }}">
                                        <i class="bi bi-trash me-1"></i> Hapus
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="bi bi-people d-block"></i>
                            Belum ada data pengguna.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($users as $user)
<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2 text-primary"></i>Edit User</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select" required>
                            <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin IT</option>
                            <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff IT</option>
                            <option value="manajemen" {{ $user->role == 'manajemen' ? 'selected' : '' }}>Manajemen</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Password Baru <span class="text-muted fw-normal">(Opsional)</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ingin ganti password">
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

<div class="modal fade" id="tambahUserModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-person-plus me-2 text-primary"></i>Tambah User Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.users.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
                        <input type="text" name="name" class="form-control" placeholder="Masukkan nama pengguna" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" name="email" class="form-control" placeholder="contoh@perusahaan.com" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Role <span class="text-danger">*</span></label>
                        <select name="role" class="form-select" required>
                            <option value="">-- Pilih Hak Akses --</option>
                            <option value="admin">Admin IT</option>
                            <option value="staff">Staff IT</option>
                            <option value="manajemen">Manajemen</option>
                        </select>
                    </div>
                    <div class="mb-0">
                        <label class="form-label">Password <span class="text-danger">*</span></label>
                        <input type="password" name="password" class="form-control" placeholder="Minimal 8 karakter" required minlength="8">
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
                    title: 'Hapus user?',
                    text: "User '" + name + "' akan dihapus dari sistem!",
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
