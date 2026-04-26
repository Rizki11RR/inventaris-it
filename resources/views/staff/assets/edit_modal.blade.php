<div class="modal fade" id="editAssetModal{{ $asset->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <form action="{{ route('staff.assets.update', $asset->id) }}" method="POST" class="modal-content border-0 rounded-4 shadow">
            @csrf
            @method('PUT')
            <div class="modal-header border-0 pt-4 px-4">
                <h5 class="fw-bold">Edit Data: {{ $asset->nama_perangkat }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4">
                <div class="row g-3">
                    {{-- Kode Aset --}}
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">KODE ASET</label>
                        <input type="text" name="kode_aset" value="{{ $asset->kode_aset }}" class="form-control bg-light border-0" required>
                    </div>
                    
                    {{-- Nama Perangkat --}}
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">NAMA PERANGKAT</label>
                        <input type="text" name="nama_perangkat" value="{{ $asset->nama_perangkat }}" class="form-control bg-light border-0" required>
                    </div>

                    {{-- Dropdown Kategori --}}
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">KATEGORI</label>
                        <select name="category_id" class="form-select bg-light border-0" required>
                            @foreach($categories as $cat)
                                <option value="{{ $cat->id }}" {{ $asset->category_id == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->nama_kategori }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Lokasi --}}
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">LOKASI</label>
                        <select name="location_id" class="form-select bg-light border-0" required>
                            @foreach($locations as $loc)
                                <option value="{{ $loc->id }}" {{ $asset->location_id == $loc->id ? 'selected' : '' }}>
                                    {{ $loc->nama_lokasi }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Vendor --}}
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">VENDOR</label>
                        <select name="vendor_id" class="form-select bg-light border-0" required>
                            @foreach($vendors as $ven)
                                <option value="{{ $ven->id }}" {{ $asset->vendor_id == $ven->id ? 'selected' : '' }}>
                                    {{ $ven->nama_vendor }} ({{ $ven->merk }})
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Dropdown Status --}}
                    <div class="col-md-6">
                        <label class="form-label small fw-bold">STATUS</label>
                        <select name="status_id" class="form-select bg-light border-0" required>
                            @foreach($statuses as $stat)
                                <option value="{{ $stat->id }}" {{ $asset->status_id == $stat->id ? 'selected' : '' }}>
                                    {{ $stat->nama_status }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tanggal Pengadaan --}}
                    <div class="col-md-12">
                        <label class="form-label small fw-bold">TANGGAL PENGADAAN</label>
                        <input type="date" name="tanggal_pengadaan" value="{{ $asset->tanggal_pengadaan }}" class="form-control bg-light border-0" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer border-0 pb-4 px-4">
                <button type="button" class="btn btn-light rounded-3 px-4" data-bs-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-success rounded-3 px-4 shadow-sm text-white">Update Perangkat</button>
            </div>
        </form>
    </div>
</div>