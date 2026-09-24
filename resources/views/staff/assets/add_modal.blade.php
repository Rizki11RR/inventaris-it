<div class="modal fade" id="addAssetModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2 text-primary"></i>Registrasi Perangkat Baru</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff.assets.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Aset <span class="text-danger">*</span></label>
                            <input type="text" name="kode_aset" class="form-control" placeholder="Contoh: LAP-001" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Perangkat <span class="text-danger">*</span></label>
                            <input type="text" name="nama_perangkat" class="form-control" placeholder="Contoh: Laptop Asus VivoBook" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori <span class="text-danger">*</span></label>
                            <select name="category_id" class="form-select" required>
                                <option value="">-- Pilih Kategori --</option>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}">{{ $cat->nama_kategori }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi <span class="text-danger">*</span></label>
                            <select name="location_id" class="form-select" required>
                                <option value="">-- Pilih Ruangan --</option>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}">{{ $loc->nama_lokasi }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status Awal <span class="text-danger">*</span></label>
                            <select name="status_id" class="form-select" required>
                                @foreach($statuses as $stat)
                                    <option value="{{ $stat->id }}">{{ $stat->nama_status }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pengadaan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_pengadaan" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i> Simpan Data</button>
                </div>
            </form>
        </div>
    </div>
</div>
