<div class="modal fade" id="editVendorModal{{ $vendor->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-4 border-0">
            <form action="{{ route('vendors.update', $vendor->id) }}" method="POST" autocomplete="off">
                @csrf @method('PUT')
                <div class="modal-header border-0">
                    <h5 class="fw-bold">Edit Vendor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label class="form-label">Nama Vendor</label>
                        <input type="text" name="nama_vendor" class="form-control rounded-3" value="{{ $vendor->nama_vendor }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Merk</label>
                        <input type="text" name="merk" class="form-control rounded-3" value="{{ $vendor->merk }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kontak</label>
                        <input type="text" name="kontak" class="form-control rounded-3" value="{{ $vendor->kontak }}" required>
                    </div>
                </div>
                <div class="modal-footer border-0">
                    <button type="button" class="btn btn-light rounded-3" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-3">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>
</div>