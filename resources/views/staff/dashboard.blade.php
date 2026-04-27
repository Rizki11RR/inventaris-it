@extends('layouts.app')

@section('header', 'Dashboard Staff IT')

@section('content')
<div class="container-fluid py-3">
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-laptop fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold" style="font-size: 0.85rem;">TOTAL PERANGKAT</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalAssets }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 text-warning rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-clipboard-x fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold" style="font-size: 0.85rem;">BELUM DINILAI</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $belumDinilai }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 text-danger rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-exclamation-triangle fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold" style="font-size: 0.85rem;">PERLU PERHATIAN</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $perangkatRusak }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-tools fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold" style="font-size: 0.85rem;">TOTAL MAINTENANCE</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalMaintenance }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark mb-0"><i class="bi bi-clock-history me-2 text-primary"></i>5 Perawatan Terakhir</h6>
                    <a href="{{ route('staff.maintenance.history') }}" class="btn btn-sm btn-light border rounded-pill">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom align-middle text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4 text-start">TANGGAL & PERANGKAT</th>
                                    <th class="text-start">DETAIL KERUSAKAN</th>
                                    <th>STATUS</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentMaintenances as $m)
                                <tr>
                                    <td class="text-start ps-4">
                                        <div class="fw-bold text-dark">{{ \Carbon\Carbon::parse($m->tanggal_perawatan)->format('d M Y') }}</div>
                                        <div class="small text-muted">{{ $m->asset->kode_aset }} &bull; {{ $m->asset->nama_perangkat }}</div>
                                    </td>
                                    <td class="text-start">
                                        <p class="mb-0 text-secondary" style="font-size: 0.85rem; max-width: 300px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $m->detail_perbaikan }}
                                        </p>
                                    </td>
                                    <td>
                                        <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3">Selesai</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="3" class="py-4 text-center text-muted">Belum ada aktivitas perawatan baru.</td>
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
@endsection