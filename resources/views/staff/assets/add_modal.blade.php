<div class="modal fade" id="addAssetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('staff.assets.store') }}" method="POST" class="modal-content border-0 rounded-4 shadow">
            @csrf
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold">Registrasi Perangkat Baru</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4">
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">KODE ASET</label>
                        <input type="text" name="kode_aset" class="form-control bg-light border-0" placeholder="LAP-001" required>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">NAMA PERANGKAT</label>
                        <input type="text" name="nama_perangkat" class="form-control bg-light border-0" required>
                    </div>
                    {{-- Dropdown relasi --}}
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">KATEGORI</label>
                        <select name="category_id" class="form-select bg-light border-0" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">LOKASI</label>
                        <select name="location_id" class="form-select bg-light border-0" required>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}">{{ $loc->nama_lokasi }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">VENDOR</label>
                        <select name="vendor_id" class="form-select bg-light border-0" required>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}">{{ $vendor->nama_vendor }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">STATUS AWAL</label>
                        <select name="status_id" class="form-select bg-light border-0" required>
                            @foreach($statuses as $stat)
                                <option value="{{ $stat->id }}">{{ $stat->nama_status }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <label class="form-label small fw-bold">TANGGAL PENGADAAN</label>
                        <input type="date" name="tanggal_pengadaan" class="form-control bg-light border-0" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">Simpan Data</button>
            </div>
        </form>
    </div>
</div>