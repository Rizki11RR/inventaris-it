@extends('layouts.app')

@section('header', 'Penilaian Kondisi Perangkat')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-primary">
                <i class="bi bi-clipboard-check me-2"></i> Antrean Penilaian Perangkat
            </h5>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center">
                    <thead>
                        <tr>
                            <th class="ps-4 text-start">KODE & NAMA PERANGKAT</th>
                            <th>KATEGORI</th>
                            <th>LOKASI</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $asset->nama_perangkat }}</div>
                                <div class="small text-primary fw-semibold">{{ $asset->kode_aset }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $asset->category->nama_kategori }}</span>
                            </td>
                            <td>
                                <span class="text-muted small"><i class="bi bi-geo-alt me-1"></i>{{ $asset->location->nama_lokasi }}</span>
                            </td>
                            <td>
                                <a href="{{ route('staff.assessments.create', $asset->id) }}" class="btn btn-sm btn-primary rounded-pill px-3 shadow-sm">
                                    <i class="bi bi-ui-checks me-1"></i> Nilai Sekarang
                                </a>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="py-5 text-muted text-center">
                                <i class="bi bi-check2-circle fs-1 d-block mb-2 text-success"></i>
                                Hore! Semua perangkat sudah selesai dinilai.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection