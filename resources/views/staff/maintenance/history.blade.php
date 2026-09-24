@extends('layouts.app')

@section('header', 'Riwayat Perawatan Perangkat')
@section('title', 'Riwayat Maintenance')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-tools me-2 text-primary"></i>Histori Maintenance
        </h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#tambahMaintenanceModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Perawatan
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Tanggal & Perangkat</th>
                        <th class="text-start">Detail Perbaikan</th>
                        <th>Biaya</th>
                        <th>Dokumentasi</th>
                        <th class="text-center" style="width: 100px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($maintenances as $m)
                    <tr>
                        <td class="text-start">
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($m->tanggal_perawatan)->format('d M Y') }}</div>
                            <div class="text-muted" style="font-size: 0.8125rem;">
                                <span class="text-primary fw-semibold">{{ $m->asset->kode_aset }}</span> &bull; {{ $m->asset->nama_perangkat }}
                            </div>
                        </td>
                        <td class="text-start">
                            <p class="mb-0 text-secondary" style="font-size: 0.8125rem; max-width: 250px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $m->detail_perbaikan }}
                            </p>
                        </td>
                        <td>
                            @if($m->biaya > 0)
                                <span class="badge bg-success-subtle text-success">
                                    Rp {{ number_format($m->biaya, 0, ',', '.') }}
                                </span>
                            @else
                                <span class="badge bg-light text-muted">Gratis / Garansi</span>
                            @endif
                        </td>
                        <td>
                            @if($m->dokumentasi_kerusakan)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#detailModal{{ $m->id }}">
                                    <img src="{{ asset('storage/kerusakan/' . $m->dokumentasi_kerusakan) }}" 
                                         class="rounded-2 border" 
                                         style="width: 48px; height: 36px; object-fit: cover; cursor: pointer;" 
                                         alt="Foto Kerusakan">
                                </a>
                            @else
                                <span class="text-muted" style="font-size: 0.8125rem;"><i class="bi bi-image me-1"></i>Kosong</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#detailModal{{ $m->id }}">
                                <i class="bi bi-eye me-1"></i> Detail
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="bi bi-tools d-block"></i>
                            Belum ada riwayat perawatan yang dicatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($maintenances as $m)
<div class="modal fade" id="detailModal{{ $m->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-info-circle me-2 text-primary"></i>Detail Perawatan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                @if($m->dokumentasi_kerusakan)
                    <img src="{{ asset('storage/kerusakan/' . $m->dokumentasi_kerusakan) }}" 
                         class="img-fluid rounded-3 mb-3 border" style="max-height: 250px; object-fit: cover;" alt="Dokumentasi">
                @else
                    <div class="bg-light rounded-3 d-flex align-items-center justify-content-center mb-3 border" style="height: 150px;">
                        <span class="text-muted"><i class="bi bi-image-alt fs-1 d-block mb-2"></i>Tidak ada foto</span>
                    </div>
                @endif
                
                <div class="text-start p-3 bg-light rounded-3">
                    <label class="small text-muted fw-bold d-block mb-1">Catatan Perbaikan:</label>
                    <p class="mb-0">{{ $m->detail_perbaikan }}</p>
                </div>
            </div>
            <div class="modal-footer justify-content-center">
                <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Tutup</button>
            </div>
        </div>
    </div>
</div>
@endforeach

<div class="modal fade" id="tambahMaintenanceModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold"><i class="bi bi-plus-circle me-2 text-primary"></i>Tambah Histori Perawatan</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('staff.maintenance.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
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
                            <label class="form-label">Pilih Perangkat <span class="text-danger">*</span></label>
                            <select name="asset_id" class="form-select" required>
                                <option value="">-- Pilih Perangkat --</option>
                                @foreach($assets as $asset)
                                    <option value="{{ $asset->id }}">
                                        {{ $asset->kode_aset }} - {{ $asset->nama_perangkat }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Tanggal Perawatan <span class="text-danger">*</span></label>
                            <input type="date" name="tanggal_perawatan" class="form-control" value="{{ date('Y-m-d') }}" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label">Detail Kerusakan / Perbaikan <span class="text-danger">*</span></label>
                            <textarea name="detail_perbaikan" class="form-control" rows="3" placeholder="Contoh: Penggantian RAM karena sering bluescreen..." required></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Biaya Perbaikan (Rp)</label>
                            <input type="number" name="biaya" class="form-control" placeholder="0" value="0">
                            <small class="text-muted">Isi 0 jika masih garansi atau perbaikan internal.</small>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Foto Dokumentasi <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="file" name="foto" class="form-control" accept="image/*">
                            <small class="text-muted">Format: JPG/PNG. Maks: 10MB.</small>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-ghost" data-bs-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-primary"><i class="bi bi-check2 me-1"></i> Simpan Riwayat</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
