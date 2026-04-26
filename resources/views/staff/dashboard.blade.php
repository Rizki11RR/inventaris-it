@extends('layouts.app')

@section('header', 'Dashboard Staff IT')

@section('content')
<div class="container-fluid">
    {{-- Ringkasan Status Inventaris --}}
    <div class="row g-3 mb-4">
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="flex-shrink-0 bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-laptop text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small mb-1">Total Perangkat</h6>
                        <h4 class="fw-bold mb-0">128</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="flex-shrink-0 bg-success bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small mb-1">Kondisi Baik</h6>
                        <h4 class="fw-bold mb-0">112</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="flex-shrink-0 bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-exclamation-triangle text-warning fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small mb-1">Perlu Maintenance</h6>
                        <h4 class="fw-bold mb-0">12</h4>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-sm-6 col-xl-3">
            <div class="card border-0 shadow-sm rounded-4 h-100 bg-white">
                <div class="card-body d-flex align-items-center p-3">
                    <div class="flex-shrink-0 bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-x-circle text-danger fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted small mb-1">Rusak Berat</h6>
                        <h4 class="fw-bold mb-0">4</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        {{-- Tabel Aktivitas Pemeliharaan Terakhir --}}
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Tugas Pemeliharaan Terbaru</h5>
                    <a href="#" class="btn btn-sm btn-light rounded-pill px-3 border">Lihat Semua</a>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th class="px-4 py-3 border-0 small text-uppercase fw-bold text-muted">ID Perangkat</th>
                                    <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Nama Barang</th>
                                    <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Lokasi</th>
                                    <th class="py-3 border-0 small text-uppercase fw-bold text-muted">Status</th>
                                    <th class="py-3 border-0 text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td class="px-4 fw-medium text-primary">#DEV-2024-001</td>
                                    <td>Asus Vivobook A416</td>
                                    <td>Lab RPL</td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning px-3 rounded-pill">Pending</span></td>
                                    <td class="text-end px-4">
                                        <button class="btn btn-sm btn-outline-primary rounded-pill px-3">Update Kondisi</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 fw-medium text-primary">#DEV-2024-042</td>
                                    <td>PC Desktop Dell Optiplex</td>
                                    <td>Ruang Staff</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success px-3 rounded-pill">Selesai</span></td>
                                    <td class="text-end px-4">
                                        <button class="btn btn-sm btn-outline-secondary rounded-pill px-3" disabled>Selesai</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
</div>
@endsection