<div class="modal fade" id="editAssetModal{{ $asset->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-pencil me-2 text-primary"></i>Edit Perangkat</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff.assets.update', $asset->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label">Kode Aset</label>
                            <input type="text" name="kode_aset" value="{{ $asset->kode_aset }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Nama Perangkat</label>
                            <input type="text" name="nama_perangkat" value="{{ $asset->nama_perangkat }}" class="form-control" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Kategori</label>
                            <select name="category_id" class="form-select" required>
                                @foreach($categories as $cat)
                                    <option value="{{ $cat->id }}" {{ $asset->category_id == $cat->id ? 'selected' : '' }}>
                                        {{ $cat->nama_kategori }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Lokasi</label>
                            <select name="location_id" class="form-select" required>
                                @foreach($locations as $loc)
                                    <option value="{{ $loc->id }}" {{ $asset->location_id == $loc->id ? 'selected' : '' }}>
                                        {{ $loc->nama_lokasi }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Status</label>
                            <select name="status_id" class="form-select" required>
                                @foreach($statuses as $stat)
                                    <option value="{{ $stat->id }}" {{ $asset->status_id == $stat->id ? 'selected' : '' }}>
                                        {{ $stat->nama_status }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Pengadaan</label>
                            <input type="date" name="tanggal_pengadaan" value="{{ $asset->tanggal_pengadaan }}" class="form-control" required>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i> Update Perangkat</button>
                </div>
            </form>
        </div>
    </div>
</div>
