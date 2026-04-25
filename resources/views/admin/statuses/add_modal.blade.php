<div class="modal fade" id="addStatusModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('statuses.store') }}" method="POST" class="modal-content border-0 rounded-4">
            @csrf
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold">Tambah Status</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">NAMA STATUS</label>
                    <input type="text" name="nama_status" class="form-control bg-light border-0 py-2" placeholder="Misal: Bagus, Perbaikan, Hilang" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">WARNA BADGE</label>
                    <select name="warna" class="form-select bg-light border-0 py-2" required>
                        <option value="success">Hijau (Success)</option>
                        <option value="danger">Merah (Danger)</option>
                        <option value="warning">Kuning (Warning)</option>
                        <option value="primary">Biru (Primary)</option>
                        <option value="secondary">Abu-abu (Secondary)</option>
                        <option value="info">Biru Muda (Info)</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-3">Simpan</button>
            </div>
        </form>
    </div>
</div>