<div class="modal fade" id="addUserModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('admin.users.store') }}" method="POST" class="modal-content border-0 rounded-4">
            @csrf
            <div class="modal-header border-0">
                <h5 class="fw-bold">Tambah Pengguna Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <div class="mb-3">
                    <label class="form-label small fw-bold">NAMA LENGKAP</label>
                    <input type="text" name="name" class="form-control bg-light border-0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">EMAIL</label>
                    <input type="email" name="email" class="form-control bg-light border-0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">PASSWORD</label>
                    <input type="password" name="password" class="form-control bg-light border-0" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold">ROLE</label>
                    <select name="role" class="form-select bg-light border-0">
                        <option value="admin">Admin IT</option>
                        <option value="staff">Staff IT</option>
                        <option value="manajemen">Manajemen</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan User</button>
            </div>
        </form>
    </div>
</div>