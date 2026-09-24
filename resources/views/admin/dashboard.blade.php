@extends('layouts.app')

@section('header', 'Dashboard Admin IT')
@section('title', 'Dashboard Admin')

@section('content')
<div class="row g-4 mb-4">
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon primary">
                <i class="bi bi-people"></i>
            </div>
            <div>
                <div class="stat-label">Total Pengguna</div>
                <div class="stat-value">{{ $totalUsers }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon success">
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
                <i class="bi bi-tags"></i>
            </div>
            <div>
                <div class="stat-label">Kategori</div>
                <div class="stat-value">{{ $totalKategori }}</div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-md-6">
        <div class="stat-card">
            <div class="stat-icon info">
                <i class="bi bi-geo-alt"></i>
            </div>
            <div>
                <div class="stat-label">Lokasi</div>
                <div class="stat-value">{{ $totalLokasi }}</div>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h6 class="fw-bold mb-0">
            <i class="bi bi-people me-2 text-primary"></i>5 Pengguna Terdaftar Terakhir
        </h6>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Nama Pengguna</th>
                        <th>Email</th>
                        <th>Role</th>
                        <th>Tanggal Daftar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($recentUsers as $user)
                    <tr>
                        <td class="text-start">
                            <div class="fw-semibold">{{ $user->name }}</div>
                        </td>
                        <td>
                            <span class="text-secondary">{{ $user->email }}</span>
                        </td>
                        <td>
                            @if($user->role == 'admin')
                                <span class="badge bg-danger-subtle text-danger"><i class="bi bi-shield-lock me-1"></i>Admin</span>
                            @elseif($user->role == 'staff')
                                <span class="badge bg-primary-subtle text-primary"><i class="bi bi-tools me-1"></i>Staff IT</span>
                            @else
                                <span class="badge bg-success-subtle text-success"><i class="bi bi-graph-up me-1"></i>Manajemen</span>
                            @endif
                        </td>
                        <td>
                            <span class="text-muted">{{ \Carbon\Carbon::parse($user->created_at)->format('d M Y') }}</span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            <i class="bi bi-people d-block"></i>
                            Belum ada pengguna terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
