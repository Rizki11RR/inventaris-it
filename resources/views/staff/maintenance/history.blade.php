@extends('layouts.app')

@section('header', 'Riwayat Perawatan Perangkat')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-primary">
                <i class="bi bi-tools me-2"></i> Histori Maintenance
            </h5>
            <button class="btn btn-primary btn-sm shadow-sm" data-bs-toggle="modal" data-bs-target="#tambahMaintenanceModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Perawatan
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center">
                    <thead>
                        <tr>
                            <th class="ps-4 text-start">TANGGAL & PERANGKAT</th>
                            <th class="text-start">DETAIL PERBAIKAN</th>
                            <th>BIAYA</th>
                            <th>DOKUMENTASI</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($maintenances as $m)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($m->tanggal_perawatan)->format('d M Y') }}</div>
                                <div class="small text-muted mt-1">
                                    <span class="text-primary fw-semibold">{{ $m->asset->kode_aset }}</span> &bull; {{ $m->asset->nama_perangkat }}
                                </div>
                            </td>
                            <td class="text-start">
                                <p class="mb-0 text-secondary" style="max-width: 250px; font-size: 0.85rem; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    {{ $m->detail_perbaikan }}
                                </p>
                            </td>
                            <td>
                                @if($m->biaya > 0)
                                    <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-2">
                                        Rp {{ number_format($m->biaya, 0, ',', '.') }}
                                    </span>
                                @else
                                    <span class="badge bg-light text-secondary border rounded-pill px-3 py-2">Gratis / Garansi</span>
                                @endif
                            </td>
                            <td>
                                @if($m->dokumentasi_kerusakan)
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $m->id }}">
                                        <img src="{{ asset('storage/kerusakan/' . $m->dokumentasi_kerusakan) }}" 
                                             class="rounded-3 shadow-sm border img-thumbnail" 
                                             style="width: 60px; height: 45px; object-fit: cover; cursor: pointer;" 
                                             alt="Foto Kerusakan">
                                    </a>
                                @else
                                    <span class="badge bg-light text-muted border px-2 py-1"><i class="bi bi-image me-1"></i>Kosong</span>
                                @endif
                            </td>
                            <td>
                                <button type="button" class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#detailModal{{ $m->id }}">
                                    <i class="bi bi-eye"></i> Detail
                                </button>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-5 text-muted text-center">
                                <i class="bi bi-tools fs-1 d-block mb-2 text-secondary opacity-50"></i>
                                Belum ada riwayat perawatan yang dicatat.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@foreach($maintenances as $m)
<div class="modal fade" id="detailModal{{ $m->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-info-circle me-2"></i>Detail Perawatan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 text-center">
                @if($m->dokumentasi_kerusakan)
                    <img src="{{ asset('storage/kerusakan/' . $m->dokumentasi_kerusakan) }}" 
                         class="img-fluid rounded-4 mb-3 shadow-sm border" style="max-height: 250px; object-fit: cover;" alt="Dokumentasi">
                @else
                    <div class="bg-light rounded-4 d-flex align-items-center justify-content-center mb-3 border" style="height: 150px;">
                        <span class="text-muted"><i class="bi bi-image-alt fs-1 d-block mb-2"></i>Tidak ada foto</span>
                    </div>
                @endif
                
                <div class="text-start p-3 bg-light rounded-4 border">
                    <label class="small text-muted fw-bold d-block mb-1">Catatan Perbaikan:</label>
                    <p class="mb-0 text-dark" style="font-size: 0.9rem;">{{ $m->detail_perbaikan }}</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center bg-white border-0 pt-0">
                <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="tambahMaintenanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold text-primary"><i class="bi bi-plus-circle me-2"></i>Tambah Histori Perawatan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff.maintenance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body p-4">
                    
                    @if ($errors->any())
                        <div class="alert alert-danger rounded-3">
                            <ul class="mb-0 small">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">PILIH PERANGKAT <span class="text-danger">*</span></label>
                            <select name="asset_id" class="form-select rounded-3" required>
                                <option value="">-- Pilih Perangkat --</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">
                                        {{ $asset->kode_aset }} - {{ $asset->nama_perangkat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">TANGGAL PERAWATAN <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_perawatan" class="form-control rounded-3" value="{{ date('Y-m-d') }}" required>
                        </div>
                        
                        <div class="col-12">
                            <label class="form-label text-muted small fw-bold">DETAIL KERUSAKAN / PERBAIKAN <span class="text-danger">*</span></label>
                            <textarea name="detail_perbaikan" class="form-control rounded-3" rows="3" placeholder="Contoh: Penggantian RAM karena sering bluescreen..." required></textarea>
                        </div>

                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">BIAYA PERBAIKAN (RP)</label>
                            <input type="number" name="biaya" class="form-control rounded-3" placeholder="0" value="0">
                            <small class="text-muted" style="font-size: 0.75rem;">Isi 0 jika masih garansi atau perbaikan internal.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label text-muted small fw-bold">FOTO DOKUMENTASI (OPSIONAL)</label>
                            <input type="file" name="foto" class="form-control rounded-3" accept="image/*">
                            <small class="text-muted" style="font-size: 0.75rem;">Format: JPG/PNG. Maks: 10MB.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light border rounded-pill px-4" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary rounded-pill px-4 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Riwayat
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection