@extends('layouts.app')

@section('header', 'Penilaian Kondisi Perangkat')
@section('title', 'Penilaian Aset')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-clipboard-check me-2 text-primary"></i>Antrean Penilaian Perangkat
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Kode & Nama Perangkat</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assets as $asset)
                    <tr>
                        <td class="text-start">
                            <div class="fw-semibold">{{ $asset->nama_perangkat }}</div>
                            <div class="text-primary fw-semibold" style="font-size: 0.8125rem;">{{ $asset->kode_aset }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $asset->category->nama_kategori }}</span>
                        </td>
                        <td>
                            <span class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $asset->location->nama_lokasi }}</span>
                        </td>
                        <td class="text-center">
                            <a href="{{ route('staff.assessments.create', $asset->id) }}" class="btn btn-primary btn-sm">
                                <i class="bi bi-ui-checks me-1"></i> Nilai Sekarang
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            <i class="bi bi-check2-circle d-block" style="color: var(--success);"></i>
                            Semua perangkat sudah selesai dinilai.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
