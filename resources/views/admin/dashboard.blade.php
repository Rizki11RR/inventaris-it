@extends('layouts.app')

@section('header', 'Dashboard Admin IT')
@section('title', 'Dashboard Admin')


@section('content')
<div class="container-fluid py-3">
    <div class="row g-4 mb-4">
        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-primary bg-opacity-10 text-primary rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-people fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold" style="font-size: 0.85rem;">TOTAL PENGGUNA</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalUsers }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-success bg-opacity-10 text-success rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
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
                        <i class="bi bi-tags fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold" style="font-size: 0.85rem;">MASTER KATEGORI</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalKategori }}</h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6">
            <div class="card border-0 shadow-sm h-100" style="border-radius: 1rem;">
                <div class="card-body p-4 d-flex align-items-center">
                    <div class="bg-info bg-opacity-10 text-info rounded-circle d-flex justify-content-center align-items-center me-3" style="width: 60px; height: 60px;">
                        <i class="bi bi-geo-alt fs-3"></i>
                    </div>
                    <div>
                        <p class="text-muted mb-0 fw-bold" style="font-size: 0.85rem;">MASTER LOKASI</p>
                        <h3 class="fw-bold mb-0 text-dark">{{ $totalLokasi }}</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
                <div class="card-header bg-white border-0 pt-4 pb-3 px-4 d-flex justify-content-between align-items-center">
                    <h6 class="fw-bold text-dark mb-0"><i class="bi bi-person-plus me-2 text-primary"></i>5 Pengguna Terdaftar Terakhir</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-custom align-middle text-center mb-0">
                            <thead>
                                <tr>
                                    <th class="ps-4 text-start">NAMA PENGGUNA</th>
                                    <th>EMAIL</th>
                                    <th>ROLE</th>
                                    <th>TANGGAL DAFTAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($recentUsers as $user)
                                <tr>
                                    <td class="text-start ps-4">
                                        <div class="fw-bold text-dark">{{ $user->name }}</div>
                                    </td>
                                    <td>
                                        <span class="text-muted">{{ $user->email }}</span>
                                    </td>
                                    <td>
                                        @if($user->role == 'admin')
                                            <span class="badge bg-danger-subtle text-danger border border-danger rounded-pill px-3">Admin IT</span>
                                        @elseif($user->role == 'staff')
                                            <span class="badge bg-primary-subtle text-primary border border-primary rounded-pill px-3">Staff IT</span>
                                        @else
                                            <span class="badge bg-success-subtle text-success border border-success rounded-pill px-3">Manajemen</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span class="small text-muted">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</span>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-4 text-center text-muted">Belum ada pengguna yang terdaftar.</td>
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