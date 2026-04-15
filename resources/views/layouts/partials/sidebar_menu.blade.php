@php
    $role = Auth::user()->role;
@endphp

<a href="{{ route($role . '.dashboard') }}" class="nav-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>

@if($role == 'admin')
    <a href="#" class="nav-link"><i class="bi bi-people"></i> Manajemen User</a>
    <div class="px-4 mt-3 mb-2 small text-muted fw-bold">MASTER DATA</div>
    <a href="{{ route('categories.index') }}" class="nav-link"><i class="bi bi-tag"></i> Kategori Perangkat</a>
    <a href="#" class="nav-link"><i class="bi bi-geo-alt"></i> Data Lokasi</a>
    
    <div class="px-4 mt-3 mb-2 small text-muted fw-bold">METODE AHP</div>
    <a href="#" class="nav-link"><i class="bi bi-calculate"></i> Kriteria & Bobot</a>

@elseif($role == 'staff')
    <div class="px-4 mt-3 mb-2 small text-muted fw-bold">INVENTARIS</div>
    <a href="#" class="nav-link"><i class="bi bi-display"></i> Data Perangkat</a>
    <a href="#" class="nav-link"><i class="bi bi-clipboard-check"></i> Penilaian Kondisi</a>
    <a href="#" class="nav-link"><i class="bi bi-tools"></i> Riwayat Perawatan</a>

@elseif($role == 'manajemen')
    <div class="px-4 mt-3 mb-2 small text-muted fw-bold">MONITORING</div>
    <a href="#" class="nav-link"><i class="bi bi-pie-chart"></i> Grafik Aset</a>
    <a href="#" class="nav-link"><i class="bi bi-file-earmark-bar-graph"></i> Laporan Ranking AHP</a>
@endif

<div class="px-4 mt-3 mb-2 small text-muted fw-bold">AKUN</div>
<a href="{{ route('profile.edit') }}" class="nav-link"><i class="bi bi-gear"></i> Pengaturan</a>