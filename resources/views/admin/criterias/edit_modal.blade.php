<div class="modal fade" id="editCriteriaModal{{ $criteria->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2 text-primary"></i>Edit Kriteria</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('criterias.update', $criteria->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-0">
                        <label class="form-label">Nama Kriteria <span class="text-danger">*</span></label>
                        <input type="text" name="nama_kriteria" class="form-control" value="{{ $criteria->nama_kriteria }}" required>
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
