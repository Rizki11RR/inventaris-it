@extends('layouts.app')

@section('header', 'Dashboard Manajemen')
@section('title', 'Dashboard Manajemen')

@section('content')
<div class="container-fluid py-3">
    <div class="row g-4 mb-4">
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-box-seam fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold small">TOTAL INVENTARIS</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalAssets }} Unit</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-clipboard2-check fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold small">ASET SUDAH DINILAI</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalAssessments }} Unit</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-5">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h6 class="fw-bold text-dark mb-0">Status Kondisi Aset (%)</h6>
                </div>
                <div class="card-body px-4 pb-4">
                    <canvas id="ahpChart" style="max-height: 300px;"></canvas>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between">
                    <h6 class="fw-bold text-dark mb-0">5 Aset Prioritas Perbaikan/Ganti</h6>
                    <a href="#" class="small text-decoration-none">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom align-middle mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4">PERANGKAT</th>
                                    <th class="text-center">SKOR</th>
                                    <th>REKOMENDASI</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($worstAssets as $wa)
                                <tr>
                                    <td class="ps-4">
                                        <div class="fw-bold text-dark">{{ $wa->asset->nama_perangkat }}</div>
                                        <small class="text-muted">{{ $wa->asset->kode_aset }}</small>
                                    </td>
                                    <td class="text-center">
                                        <span class="badge bg-light text-dark border">{{ number_format($wa->total_score, 3) }}</span>
                                    </td>
                                    <td>
                                        @if($wa->total_score >= 0.8)
                                            <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3">
                                                {{ $wa->rekomendasi }}
                                            </span>
                                        @elseif($wa->total_score >= 0.6)
                                            <span class="badge bg-warning-subtle text-warning border border-warning rounded-pill px-3">
                                                {{ $wa->rekomendasi }}
                                            </span>
                                        @elseif($wa->total_score >= 0.4)
                                            <span class="badge bg-info-subtle text-info border border-info rounded-pill px-3">
                                                {{ $wa->rekomendasi }}
                                            </span>
                                        @else
                                            <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3">
                                                {{ $wa->rekomendasi }}
                                            </span>
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="text-center py-4 text-muted">Belum ada data kritis.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('ahpChart').getContext('2d');
    new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Layak', 'Perbaikan', 'Diganti'],
            datasets: [{
                data: [{{ $dataGrafik['layak'] }}, {{ $dataGrafik['perbaikan'] }}, {{ $dataGrafik['ganti'] }}],
                backgroundColor: ['#198754', '#ffc107', '#dc3545'],
                borderWidth: 0,
                hoverOffset: 10
            }]
        },
        options: {
            plugins: {
                legend: { position: 'bottom' }
            },
            cutout: '70%'
        }
    });
</script>
@endsection