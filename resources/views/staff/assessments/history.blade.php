@extends('layouts.app')

@section('header', 'Riwayat Penilaian Kondisi')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-primary">
                <i class="bi bi-clock-history me-2"></i> Histori Penilaian AHP
            </h5>
            <div class="d-flex gap-2">
                <a href="{{ route('staff.assessments.index') }}" class="btn btn-primary btn-sm shadow-sm">
                    <i class="bi bi-plus-lg me-1"></i> Penilaian Baru
                </a>
            </div>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center">
                    <thead>
                        <tr>
                            <th class="ps-4 text-start">PERANGKAT & TANGGAL</th>
                            <th>SKOR AKHIR</th>
                            <th>REKOMENDASI</th>
                            <th>PENILAI</th>
                            <th class="text-center">DETAIL</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assessments as $history)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $history->asset->nama_perangkat }}</div>
                                <div class="small text-muted">
                                    <i class="bi bi-calendar3 me-1"></i> 
                                    {{ \Carbon\Carbon::parse($history->tanggal_penilaian)->format('d M Y') }} 
                                    &bull; <span class="text-primary fw-semibold">{{ $history->asset->kode_aset }}</span>
                                </div>
                            </td>
                            <td>
                                <div class="d-flex flex-column align-items-center">
                                    <h6 class="mb-0 fw-bold text-dark">{{ number_format($history->total_score, 3) }}</h6>
                                    <div class="progress mt-1" style="width: 60px; height: 6px;">
                                        <div class="progress-bar bg-primary" role="progressbar" 
                                             style="width: {{ $history->total_score * 100 }}%"></div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($history->rekomendasi == 'Sangat Layak' || $history->rekomendasi == 'Layak')
                                    <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3 py-2">
                                        <i class="bi bi-check-circle-fill me-1"></i> {{ $history->rekomendasi }}
                                    </span>
                                @elseif($history->rekomendasi == 'Cukup / Perbaikan')
                                    <span class="badge bg-warning-subtle text-warning border border-warning rounded-pill px-3 py-2">
                                        <i class="bi bi-exclamation-triangle-fill me-1"></i> {{ $history->rekomendasi }}
                                    </span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3 py-2">
                                        <i class="bi bi-x-circle-fill me-1"></i> {{ $history->rekomendasi }}
                                    </span>
                                @endif
                            </td>
                            <td>
                                <div class="small fw-semibold text-dark">{{ $history->user->name }}</div>
                                <div class="text-muted" style="font-size: 0.7rem;">Staff IT</div>
                            </td>
                            <td>
                                <button class="btn btn-sm btn-light border text-primary" 
                                        data-bs-toggle="modal" 
                                        data-bs-target="#detailScoreModal{{ $history->id }}">
                                    <i class="bi bi-eye"></i> Skor
                                </button>
                            </td>
                        </tr>

                        <div class="modal fade" id="detailScoreModal{{ $history->id }}" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content border-0">
                                    <div class="modal-header">
                                        <h6 class="modal-title fw-bold">Detail Perhitungan AHP</h6>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body p-4">
                                        <div class="text-center mb-4">
                                            <h2 class="fw-bold text-primary mb-0">{{ number_format($history->total_score, 4) }}</h2>
                                            <small class="text-muted">Total Skor Akhir</small>
                                        </div>
                                        <div class="p-3 bg-light rounded-4">
                                            <p class="small text-muted mb-0">
                                                Hasil ini didapatkan dari perkalian bobot global kriteria 
                                                dengan nilai kondisi yang diinput oleh staff di lapangan.
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @empty
                        <tr>
                            <td colspan="5" class="py-5 text-muted text-center">
                                <i class="bi bi-journal-x fs-1 d-block mb-2 text-secondary"></i>
                                Belum ada riwayat penilaian yang tercatat.
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