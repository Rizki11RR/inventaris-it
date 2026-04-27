@php
    $role = Auth::user()->role;
@endphp

<a href="{{ route($role . '.dashboard') }}" class="nav-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
    <i class="bi bi-speedometer2"></i> Dashboard
</a>

@if($role == 'admin')
    <div class="px-4 mt-3 mb-2 small text-muted fw-bold text-uppercase">Manajemen Sistem</div>
    
    <a href="{{ route('admin.users.index') }}" 
       class="nav-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Manajemen User
    </a>
    
    <div class="px-4 mt-3 mb-2 small text-muted fw-bold text-uppercase">Master Data</div>
    <a href="{{ route('categories.index') }}" 
    class="nav-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <i class="bi bi-tag"></i> Kategori Perangkat
    </a>

    <a href="{{ route('locations.index') }}" 
    class="nav-link {{ request()->routeIs('locations.*') ? 'active' : '' }}">
        <i class="bi bi-geo-alt"></i> Data Lokasi
    </a>

    <a href="{{ route('vendors.index') }}" 
    class="nav-link {{ request()->routeIs('vendors.*') ? 'active' : '' }}">
        <i class="bi bi-building"></i> Data Vendor / Merk
    </a>

    <a href="{{ route('statuses.index') }}" 
    class="nav-link {{ request()->routeIs('statuses.*') ? 'active' : '' }}">
        <i class="bi bi-info-circle"></i> Status Perangkat
    </a>
    
    <div class="px-4 mt-3 mb-2 small text-muted fw-bold text-uppercase">Metode AHP</div>

    <a href="{{ route('criterias.index') }}" class="nav-link {{ request()->routeIs('criter  ias.*') ? 'active' : '' }}">
        <i class="bi-clipboard-data"></i> Kriteria & Bobot
    </a>
    <a href="{{ route('ahp.comparisons') }}" class="nav-link {{ request()->routeIs('ahp.comparisons') ? 'active' : '' }}">
        <i class="bi bi-arrow-left-right"></i> Perbandingan Kriteria
    </a>
    <a class="nav-link {{ request()->is('admin/monitoring*') ? 'active' : '' }}" href="{{ route('admin.monitoring') }}">
         <i class="bi bi-display"></i> Monitoring Penilaian
    </a>
@elseif($role == 'staff')
    <div class="px-4 mt-3 mb-2 small text-muted fw-bold">INVENTARIS</div>
    <a href="{{ route('staff.assets.index') }}" class="nav-link {{ request()->routeIs('staff.assets.*') ? 'active' : '' }}"><i class="bi bi-display"></i> Data Perangkat</a>
    <a href="{{ route('staff.assessments.index') }}" class="nav-link {{ request()->routeIs('staff.assessments.index', 'staff.assessments.create') ? 'active' : '' }}">
        <i class="bi bi-clipboard-check"></i> <span>Penilaian Kondisi</span>
    </a>
    <a href="{{ route('staff.assessments.history') }}" class="nav-link {{ request()->routeIs('staff.assessments.history') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i> Riwayat Penilaian
    </a>
    <a class="nav-link {{ Request::is('staff/maintenance*') ? 'active' : '' }}" href="{{ route('staff.maintenance.history') }}">
        <i class="bi bi-tools me-2"></i> Riwayat Perawatan
    </a>

@elseif($role == 'manajemen')
    <a href="{{ route('manajemen.laporan') }}" 
    class="nav-link {{ Request::is('laporan-rekomendasi*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-bar-graph me-2"></i> Laporan Ranking AHP
    </a>
@endif