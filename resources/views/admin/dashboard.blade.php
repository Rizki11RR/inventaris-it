@extends('layouts.admin_master')

@section('header', 'Dashboard Ringkasan')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card-custom d-flex align-items-center">
            <div class="icon-shape bg-primary text-white me-3">
                <i class="bi bi-pc-display"></i>
            </div>
            <div>
                <p class="text-muted mb-1 small fw-bold text-uppercase">Total Perangkat</p>
                <h3 class="fw-bold mb-0">142</h3>
            </div>
        </div>
    </div>
    {{-- Ulangi untuk Card lainnya (Rusak, Perbaikan) --}}
</div>

<div class="row g-4">
    <div class="col-lg-8">
        <div class="card-custom">
            <h6 class="fw-bold mb-4"><i class="bi bi-bar-chart-line me-2"></i>Grafik Kondisi Perangkat</h6>
            <div style="height: 300px;">
                <canvas id="conditionChart"></canvas>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="card-custom bg-primary text-white">
            <h6 class="fw-bold mb-3">Status Sistem AHP</h6>
            <div class="bg-white bg-opacity-25 rounded-3 p-3 mb-3">
                <small class="d-block mb-1">Consistency Ratio (CR)</small>
                <h4 class="fw-bold mb-0">0.046</h4>
                <small class="badge bg-success mt-2">Konsisten</small>
            </div>
            <a href="#" class="btn btn-light btn-sm w-100 fw-bold">Detail Perhitungan</a>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('conditionChart').getContext('2d');
    new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Normal', 'Maintenance', 'Replace'],
            datasets: [{
                label: 'Unit',
                data: [98, 24, 20],
                backgroundColor: ['#0d6efd', '#ffc107', '#dc3545'],
                borderRadius: 8
            }]
        },
        options: { responsive: true, maintainAspectRatio: false }
    });
</script>