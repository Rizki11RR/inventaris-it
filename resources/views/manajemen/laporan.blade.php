@extends('layouts.app')

@section('header', 'Laporan Analisis AHP')
@section('title', 'Laporan Inventaris')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h4 class="fw-bold mb-1">Ranking Kelayakan Perangkat</h4>
    </div>
    <a href="{{ route('manajemen.cetak') }}" target="_blank" class="btn btn-primary btn-sm">
        <i class="bi bi-printer me-1"></i> Cetak Laporan
    </a>
</div>

<div class="card">
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">Rank</th>
                        <th class="text-start">Informasi Perangkat</th>
                        <th>Kategori</th>
                        <th class="text-center">Skor AHP</th>
                        <th class="text-center">Rekomendasi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($rekomendasi as $key => $item)
                    <tr>
                        <td class="text-center">
                            @if($key + 1 <= 3)
                                <span class="badge bg-primary" style="width: 28px; height: 28px; padding: 7px; border-radius: 50%;">{{ $key + 1 }}</span>
                            @else
                                <span class="text-muted fw-bold">{{ $key + 1 }}</span>
                            @endif
                        </td>
                        <td class="text-start">
                            <div class="fw-semibold">{{ $item->asset->nama_perangkat ?? 'N/A' }}</div>
                            <div class="text-muted" style="font-size: 0.8125rem;">{{ $item->asset->kode_aset ?? '-' }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $item->asset->category->nama_kategori ?? '-' }}</span>
                        </td>
                        <td class="text-center">
                            <span class="fw-bold text-primary">{{ number_format($item->total_score, 3) }}</span>
                            <div class="progress mx-auto mt-1" style="width: 50px; height: 4px;">
                                <div class="progress-bar" style="width: {{ $item->total_score * 100 }}%; background: var(--primary);"></div>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($item->total_score >= 0.8)
                                <span class="badge badge-dot bg-success-subtle text-success">
                                    <i class="bi bi-check-circle-fill me-1"></i> Sangat Layak
                                </span>
                            @elseif($item->total_score >= 0.4)
                                <span class="badge badge-dot bg-warning-subtle text-warning">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> Perbaikan
                                </span>
                            @else
                                <span class="badge badge-dot bg-danger-subtle text-danger">
                                    <i class="bi bi-x-circle-fill me-1"></i> Ganti Baru
                                </span>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="bi bi-inbox d-block"></i>
                            Belum ada data penilaian yang tersedia untuk dianalisis.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
