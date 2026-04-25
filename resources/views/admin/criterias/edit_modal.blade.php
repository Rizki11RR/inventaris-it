<div class="modal fade" id="editCriteriaModal{{ $criteria->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <form action="{{ route('criterias.update', $criteria->id) }}" method="POST" class="modal-content border-0 rounded-4 shadow">
            @csrf
            @method('PUT')
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0">Edit Kriteria</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">NAMA KRITERIA</label>
                    <input type="text" name="nama_kriteria" class="form-control bg-light border-0 py-2 rounded-3" value="{{ $criteria->nama_kriteria }}" required>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-3 px-4">Update Kriteria</button>
            </div>
        </form>
    </div>
</div>