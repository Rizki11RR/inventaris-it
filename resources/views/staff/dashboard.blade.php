@extends('layouts.app')

@section('header', 'Dashboard Staff IT')
@section('title', 'Dashboard')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="bi bi-laptop"></i>
            </div>
            <div>
                <div class="stat-label">Total Perangkat</div>
                <div class="stat-value">{{ $totalAssets }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon warning">
                <i class="bi bi-clipboard-x"></i>
            </div>
            <div>
                <div class="stat-label">Belum Dinilai</div>
                <div class="stat-value">{{ $belumDinilai }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon danger">
                <i class="bi bi-exclamation-triangle"></i>
            </div>
            <div>
                <div class="stat-label">Perlu Perhatian</div>
                <div class="stat-value">{{ $perangkatRusak }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon success">
                <i class="bi bi-tools"></i>
            </div>
            <div>
                <div class="stat-label">Total Maintenance</div>
                <div class="stat-value">{{ $totalMaintenance }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="bi bi-clock-history me-2 text-primary"></i>5 Perawatan Terakhir
        </h6>
        <a href="{{ route('staff.maintenance.history') }}" class="btn btn-ghost btn-sm">Lihat Semua</a>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Tanggal & Perangkat</th>
                        <th class="text-start">Detail Kerusakan</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentMaintenances as $m)
                    <tr>
                        <td class="text-start">
                            <div class="fw-semibold">{{ \Carbon\Carbon::parse($m->tanggal_perawatan)->format('d M Y') }}</div>
                            <div class="text-muted" style="font-size: 0.8125rem;">{{ $m->asset->kode_aset }} &bull; {{ $m->asset->nama_perangkat }}</div>
                        </td>
                        <td class="text-start">
                            <span class="text-secondary" style="font-size: 0.8125rem; max-width: 300px; display: block; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                {{ $m->detail_perbaikan }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-dot bg-success-subtle text-success">Selesai</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="3" class="empty-state">
                            <i class="bi bi-inbox d-block"></i>
                            Belum ada aktivitas perawatan baru.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
