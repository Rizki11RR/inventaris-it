<div class="modal fade" id="addCriteriaModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-lg me-2 text-primary"></i>Tambah Kriteria</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('criterias.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-0">
                        <label class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kriteria" class="form-control" placeholder="Contoh: Kondisi Fisik atau Tahun Perolehan" required>
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
