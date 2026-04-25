<div class="modal fade" id="addLocationModal" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('locations.store') }}" method="POST" class="modal-content border-0 rounded-4" autocomplete="off">
            @csrf
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold">Tambah Lokasi Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">NAMA LOKASI</label>
                    <input type="text" name="nama_lokasi" class="form-control bg-light border-0 py-2" placeholder="Contoh: Lab Komputer 1" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">DESKRIPSI (OPSIONAL)</label>
                    <textarea name="deskripsi" class="form-control bg-light border-0 py-2" rows="3" placeholder="Keterangan gedung/lantai"></textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-3">Simpan Lokasi</button>
            </div>
        </form>
    </div>
</div>