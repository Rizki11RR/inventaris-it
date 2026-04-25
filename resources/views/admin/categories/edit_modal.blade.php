<div class="modal fade" id="editCategoryModal{{ $cat->id }}" tabindex="-1">
    <div class="modal-dialog">
        <form action="{{ route('categories.update', $cat->id) }}" method="POST" class="modal-content border-0 rounded-4">
            @csrf @method('PUT')
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold">Edit Kategori</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">NAMA KATEGORI</label>
                    <input type="text" name="nama_kategori" class="form-control bg-light border-0 py-2" value="{{ $cat->nama_kategori }}" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">KETERANGAN</label>
                    <textarea name="deskripsi" class="form-control bg-light border-0 py-2" rows="2">{{ $cat->deskripsi }}</textarea>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-3 px-4">Update</button>
            </div>
        </form>
    </div>
</div>