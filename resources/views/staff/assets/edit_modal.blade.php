<div class="modal fade" id="editAssetModal{{ $asset->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-header">
                <h6 class="modal-title fw-bold text-success"><i class="bi bi-pencil-square me-2"></i>Edit Data Perangkat</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff.assets.update', $asset->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body p-4">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">KODE ASET</label>
                            <input type="text" name="kode_aset" value="{{ $asset->kode_aset }}" class="form-control rounded-3" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">NAMA PERANGKAT</label>
                            <input type="text" name="nama_perangkat" value="{{ $asset->nama_perangkat }}" class="form-control rounded-3" required>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">KATEGORI</label>
                            <select name="category_id" class="form-select rounded-3" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $asset->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">LOKASI</label>
                            <select name="location_id" class="form-select rounded-3" required>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ $asset->location_id == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->nama_lokasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">VENDOR / MERK</label>
                            <select name="vendor_id" class="form-select rounded-3" required>
                                @foreach($vendors as $ven)
                                    <option value="{{ $ven->id }}" {{ $asset->vendor_id == $ven->id ? 'selected' : '' }}>
                                        {{ $ven->nama_vendor }} ({{ $ven->merk }})
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">STATUS</label>
                            <select name="status_id" class="form-select rounded-3" required>
                                @foreach($statuses as $stat)
                                    <option value="{{ $stat->id }}" {{ $asset->status_id == $stat->id ? 'selected' : '' }}>
                                        {{ $stat->nama_status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label text-muted small fw-bold">TANGGAL PENGADAAN</label>
                            <input type="date" name="tanggal_pengadaan" value="{{ $asset->tanggal_pengadaan }}" class="form-control rounded-3" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success shadow-sm rounded-pill px-4 text-white">
                        <i class="bi bi-check2-circle me-1"></i> Update Perangkat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>