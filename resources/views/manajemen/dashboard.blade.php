@extends('layouts.app')

@section('header', 'Dashboard Manajemen')
@section('title', 'Dashboard Manajemen')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="bi bi-box-seam"></i>
            </div>
            <div>
                <div class="stat-label">Total Inventaris</div>
                <div class="stat-value">{{ $totalAssets }} Unit</div>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="bi bi-clipboard2-check"></i>
            </div>
            <div>
                <div class="stat-label">Aset Sudah Dinilai</div>
                <div class="stat-value">{{ $totalAssessments }} Unit</div>
            </div>
        </div>
    </div>
</div>

<div class="row g-4">
    <div class="col-lg-5">
        <div class="card h-100">
            <div class="card-header">
                <h6 class="fw-bold mb-0">Status Kondisi Aset (%)</h6>
            </div>
            <div class="card-body d-flex align-items-center justify-content-center">
                <canvas id="ahpChart" style="max-height: 280px;"></canvas>
            </div>
        </div>
    </div>

    <div class="col-lg-7">
        <div class="card h-100">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h6 class="fw-bold mb-0">5 Aset Prioritas Perbaikan/Ganti</h6>
                <a href="{{ route('manajemen.laporan') }}" class="btn btn-ghost btn-sm">Lihat Semua</a>
            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-start">Perangkat</th>
                                <th class="text-center">Skor</th>
                                <th>Rekomendasi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($worstAssets as $wa)
                            <tr>
                                <td class="text-start">
                                    <div class="fw-semibold">{{ $wa->asset->nama_perangkat }}</div>
                                    <div class="text-muted" style="font-size: 0.8125rem;">{{ $wa->asset->kode_aset }}</div>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-light text-dark">{{ number_format($wa->total_score, 3) }}</span>
                                </td>
                                <td>
                                    <span class="badge badge-dot bg-danger-subtle text-danger">
                                        {{ $wa->rekomendasi }}
                                    </span>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3" class="empty-state">
                                    <i class="bi bi-inbox d-block"></i>
                                    Belum ada data kritis.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
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
                backgroundColor: ['#22C55E', '#F59E0B', '#EF4444'],
                borderWidth: 0,
                hoverOffset: 8
            }]
        },
        options: {
            plugins: {
                legend: { 
                    position: 'bottom',
                    labels: {
                        padding: 16,
                        usePointStyle: true,
                        pointStyle: 'circle',
                        font: { family: 'Inter', size: 12 }
                    }
                }
            },
            cutout: '70%'
        }
    });
</script>
@endsection
