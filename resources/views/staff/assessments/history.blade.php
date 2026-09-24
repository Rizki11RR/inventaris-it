@extends('layouts.app')

@section('header', 'Riwayat Penilaian Kondisi')
@section('title', 'Riwayat Penilaian')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-clock-history me-2 text-primary"></i>Histori Penilaian AHP
        </h5>
        <a href="{{ route('staff.assessments.index') }}" class="btn btn-primary btn-sm">
            <i class="bi bi-plus-lg me-1"></i> Penilaian Baru
        </a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Perangkat & Tanggal</th>
                        <th class="text-center">Skor Akhir</th>
                        <th class="text-center">Rekomendasi</th>
                        <th>Penilai</th>
                        <th class="text-center" style="width: 100px;">Detail</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assessments as $history)
                    <tr>
                        <td class="text-start">
                            <div class="fw-semibold">{{ $history->asset->nama_perangkat }}</div>
                            <div class="text-muted" style="font-size: 0.8125rem;">
                                <i class="bi bi-calendar3 me-1"></i> 
                                {{ \Carbon\Carbon::parse($history->tanggal_penilaian)->format('d M Y') }} 
                                &bull; <span class="text-primary fw-semibold">{{ $history->asset->kode_aset }}</span>
                            </div>
                        </td>
                        <td class="text-center">
                            <div class="d-flex flex-column align-items-center">
                                <span class="fw-bold">{{ number_format($history->total_score, 3) }}</span>
                                <div class="progress mt-1" style="width: 60px; height: 4px;">
                                    <div class="progress-bar" role="progressbar" 
                                         style="width: {{ $history->total_score * 100 }}%; background: var(--primary);"></div>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                            @if($history->rekomendasi == 'Sangat Layak' || $history->rekomendasi == 'Layak')
                                <span class="badge badge-dot bg-success-subtle text-success">
                                    <i class="bi bi-check-circle-fill me-1"></i> {{ $history->rekomendasi }}
                                </span>
                            @elseif($history->rekomendasi == 'Cukup / Perbaikan')
                                <span class="badge badge-dot bg-warning-subtle text-warning">
                                    <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $history->rekomendasi }}
                                </span>
                            @else
                                <span class="badge badge-dot bg-danger-subtle text-danger">
                                    <i class="bi bi-x-circle-fill me-1"></i> {{ $history->rekomendasi }}
                                </span>
                            @endif
                        </td>
                        <td>
                            <div class="fw-semibold" style="font-size: 0.875rem;">{{ $history->user->name }}</div>
                            <div class="text-muted" style="font-size: 0.75rem;">Staff IT</div>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-ghost btn-sm" 
                                    data-bs-toggle="modal" 
                                    data-bs-target="#detailScoreModal{{ $history->id }}">
                                <i class="bi bi-eye"></i> Skor
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="bi bi-journal-x d-block"></i>
                            Belum ada riwayat penilaian yang tercatat.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@foreach($assessments as $history)
<div class="modal fade" id="detailScoreModal{{ $history->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Detail Perhitungan AHP</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <div class="mb-4">
                    <h2 class="fw-bold text-primary mb-0">{{ number_format($history->total_score, 4) }}</h2>
                    <small class="text-muted">Total Skor Akhir</small>
                </div>
                <div class="p-3 bg-light rounded-3">
                    <p class="small text-muted mb-0">
                        Hasil ini didapatkan dari perkalian bobot global kriteria 
                        dengan nilai kondisi yang diinput oleh staff di lapangan.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection
