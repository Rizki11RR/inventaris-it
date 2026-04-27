@extends('layouts.app')

@section('header', 'Laporan Analisis AHP')

@section('content')
<div class="container-fluid py-3">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold text-dark mb-1">Ranking Kelayakan Perangkat</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('manajemen.cetak') }}" target="_blank" class="btn btn-primary btn-sm shadow-sm px-3">
                <i class="bi bi-printer me-1"></i> Cetak Laporan
            </a>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle mb-0">
                    <thead>
                        <tr>
                            <th class="ps-4">RANK</th>
                            <th>INFORMASI PERANGKAT</th>
                            <th>KATEGORI</th>
                            <th class="text-center">SKOR AHP</th>
                            <th class="text-center">REKOMENDASI TINDAKAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($rekomendasi as $key => $item)
                        <tr>
                            <td class="ps-4">
                                @if($key + 1 <= 3)
                                    <span class="badge bg-primary rounded-circle" style="width: 25px; height: 25px; padding: 6px;">{{ $key + 1 }}</span>
                                @else
                                    <span class="text-muted fw-bold">{{ $key + 1 }}</span>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $item->asset->nama_perangkat ?? 'N/A' }}</div>
                                <div class="small text-muted">{{ $item->asset->kode_aset ?? '-' }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-4 py-2 fw-bolder">
                                    {{ $item->asset->category->nama_kategori ?? '-' }}
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="fw-bold text-primary fs-6">{{ number_format($item->total_score, 3) }}</span>
                                <div class="progress mx-auto" style="width: 50px; height: 4px;">
                                    <div class="progress-bar" style="width: {{ $item->total_score * 100 }}%"></div>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($item->total_score >= 0.8)
                                    <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> Sangat Layak
                                    </span>
                                @elseif($item->total_score >= 0.4)
                                    <span class="badge bg-warning-subtle text-warning border border-warning rounded-pill px-3 py-2">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> Perbaikan
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3 py-2">
                                        <i class="bi bi-x-circle-fill me-1"></i> Ganti Baru
                                    </span>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="text-center py-5">
                                <img src="{{ asset('img/no-data.svg') }}" alt="" style="width: 150px;" class="opacity-50">
                                <p class="text-muted mt-3">Belum ada data penilaian yang tersedia untuk dianalisis.</p>
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