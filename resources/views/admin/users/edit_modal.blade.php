<div class="modal fade" id="editUserModal{{ $user->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.users.update', $user->id) }}" method="POST" class="modal-content border-0 rounded-4 shadow">
            @csrf
            @method('PUT')
            
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Edit Data Pengguna</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body px-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control bg-light border-0 py-2" 
                           value="{{ $user->name }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Email</label>
                    <input type="email" class="form-control bg-light border-0 py-2" 
                           value="{{ $user->email }}" disabled>
                    <div class="form-text small text-info">Email tidak dapat diubah untuk keamanan sistem.</div>
                </div>

                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted text-uppercase">Role / Hak Akses</label>
                    <select name="role" class="form-select bg-light border-0 py-2">
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin IT</option>
                        <option value="staff" {{ $user->role == 'staff' ? 'selected' : '' }}>Staff IT</option>
                        <option value="manajemen" {{ $user->role == 'manajemen' ? 'selected' : '' }}>Manajemen</option>
                    </select>
                </div>

                <hr class="my-4 text-secondary opacity-25">

                <div class="mb-2">
                    <label class="form-label small fw-bold text-muted text-uppercase">Ubah Password (Opsional)</label>
                    <input type="password" name="password" class="form-control bg-light border-0 py-2" 
                           placeholder="Kosongkan jika tidak ingin ganti">
                </div>
            </div>

            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-3 px-4">Update User</button>
            </div>
        </form>
    </div>
</div>