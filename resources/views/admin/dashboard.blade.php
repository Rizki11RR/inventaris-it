@extends('layouts.app')

@section('header', 'Admin Dashboard')

@section('content')
<div class="container-fluid">
    <div class="row g-3 mb-4">
        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-people-fill text-primary fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Total User</div>
                        <h3 class="fw-bold mb-0">24</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-pc-display text-success fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Perangkat</div>
                        <h3 class="fw-bold mb-0">152</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="bg-warning bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-tools text-warning fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Perlu Cek</div>
                        <h3 class="fw-bold mb-0">12</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-0 shadow-sm rounded-4 bg-white p-3 h-100">
                <div class="d-flex align-items-center">
                    <div class="bg-danger bg-opacity-10 p-3 rounded-3 me-3">
                        <i class="bi bi-exclamation-octagon text-danger fs-4"></i>
                    </div>
                    <div>
                        <div class="text-muted small fw-bold text-uppercase">Rusak Berat</div>
                        <h3 class="fw-bold mb-0">5</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row g-4">
        <div class="col-lg-8">
            <div class="card border-0 shadow-sm rounded-4 bg-white">
                <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Aktivitas Terakhir</h5>
                    <button class="btn btn-sm btn-primary">Lihat Semua</button>
                </div>
                <div class="card-body px-4">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-light">
                                <tr class="small text-uppercase fw-bold text-muted">
                                    <th>Kode Aset</th>
                                    <th>Perangkat</th>
                                    <th>Kategori</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td><span class="badge bg-light text-dark border">#IT-001</span></td>
                                    <td>Laptop Dell Latitude 5420</td>
                                    <td>Laptop</td>
                                    <td><span class="badge bg-success bg-opacity-10 text-success rounded-pill px-3">Normal</span></td>
                                </tr>
                                <tr>
                                    <td><span class="badge bg-light text-dark border">#IT-042</span></td>
                                    <td>Printer Epson L3110</td>
                                    <td>Peripheral</td>
                                    <td><span class="badge bg-warning bg-opacity-10 text-warning rounded-pill px-3">Maintenance</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card border-0 shadow-sm rounded-4 bg-white mb-4">
                <div class="card-body p-4 text-center">
                    <div class="bg-primary bg-opacity-10 p-4 rounded-circle d-inline-block mb-3">
                        <i class="bi bi-database-fill-gear text-primary fs-1"></i>
                    </div>
                    <h6 class="fw-bold">Manajemen Master Data</h6>
                    <p class="text-muted small mb-4">Kelola kategori, lokasi, dan vendor perangkat IT dalam satu tempat.</p>
                    <div class="d-grid gap-2">
                        <a href="{{ route('categories.index') }}" class="btn btn-primary rounded-3 py-2">
                            <i class="bi bi-tag me-2"></i>Kategori Perangkat
                        </a>
                        <button class="btn btn-outline-primary rounded-3 py-2">
                            <i class="bi bi-geo-alt me-2"></i>Lokasi Perangkat
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Tambahan agar kartu membulat sempurna dan bayangan halus */
    .rounded-4 { border-radius: 16px !important; }
    .table thead th { border: none; }
    .card-header { border-bottom: none; }
</style>
@endsection