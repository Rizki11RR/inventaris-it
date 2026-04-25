<div class="modal fade" id="addVendorModal" tabindex="-1" aria-labelledby="addVendorModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('vendors.store') }}" method="POST" class="modal-content border-0 rounded-4" autocomplete="off">
            @csrf
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold mb-0" id="addVendorModalLabel">Tambah Vendor Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body px-4">
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">NAMA VENDOR</label>
                    <input type="text" name="nama_vendor" class="form-control bg-light border-0 py-2" placeholder="Contoh: PT. Maju Jaya" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">MERK / BRAND</label>
                    <input type="text" name="merk" class="form-control bg-light border-0 py-2" placeholder="Contoh: Asus, Dell, Lenovo" required>
                </div>
                <div class="mb-3">
                    <label class="form-label small fw-bold text-muted">KONTAK (OPSIONAL)</label>
                    <input type="text" name="kontak" class="form-control bg-light border-0 py-2" placeholder="No. Telp atau Email">
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-3 px-4">Simpan Vendor</button>
            </div>
        </form>
    </div>
</div>