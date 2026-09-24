@php
    $role = Auth::user()->role;
@endphp

<a href="{{ route($role . '.dashboard') }}" class="sidebar-link {{ request()->routeIs('*.dashboard') ? 'active' : '' }}">
    <i class="bi bi-grid-1x2"></i> Dashboard
</a>

@if($role == 'admin')
    <div class="sidebar-section-title">Manajemen Sistem</div>
    
    <a href="{{ route('admin.users.index') }}" 
       class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
        <i class="bi bi-people"></i> Manajemen User
    </a>
    
    <div class="sidebar-section-title">Master Data</div>
    
    <a href="{{ route('categories.index') }}" 
       class="sidebar-link {{ request()->routeIs('categories.*') ? 'active' : '' }}">
        <i class="bi bi-tag"></i> Kategori
    </a>

    <a href="{{ route('locations.index') }}" 
       class="sidebar-link {{ request()->routeIs('locations.*') ? 'active' : '' }}">
        <i class="bi bi-geo-alt"></i> Lokasi
    </a>

    <a href="{{ route('statuses.index') }}" 
       class="sidebar-link {{ request()->routeIs('statuses.*') ? 'active' : '' }}">
        <i class="bi bi-toggle-on"></i> Status
    </a>
    
    <div class="sidebar-section-title">Metode AHP</div>

    <a href="{{ route('criterias.index') }}" 
       class="sidebar-link {{ request()->routeIs('criterias.*') ? 'active' : '' }}">
        <i class="bi bi-clipboard-data"></i> Kriteria & Bobot
    </a>
    
    <a href="{{ route('ahp.comparisons') }}" 
       class="sidebar-link {{ request()->routeIs('ahp.comparisons') ? 'active' : '' }}">
        <i class="bi bi-arrow-left-right"></i> Perbandingan
    </a>
    
    <a href="{{ route('admin.monitoring') }}" 
       class="sidebar-link {{ request()->is('admin/monitoring*') ? 'active' : '' }}">
        <i class="bi bi-display"></i> Monitoring
    </a>

@elseif($role == 'staff')
    <div class="sidebar-section-title">Inventaris</div>
    
    <a href="{{ route('staff.assets.index') }}" 
       class="sidebar-link {{ request()->routeIs('staff.assets.*') ? 'active' : '' }}">
        <i class="bi bi-laptop"></i> Data Perangkat
    </a>
    
    <a href="{{ route('staff.assessments.index') }}" 
       class="sidebar-link {{ request()->routeIs('staff.assessments.index', 'staff.assessments.create') ? 'active' : '' }}">
        <i class="bi bi-clipboard-check"></i> Penilaian Kondisi
    </a>
    
    <a href="{{ route('staff.assessments.history') }}" 
       class="sidebar-link {{ request()->routeIs('staff.assessments.history') ? 'active' : '' }}">
        <i class="bi bi-clock-history"></i> Riwayat Penilaian
    </a>
    
    <a href="{{ route('staff.maintenance.history') }}" 
       class="sidebar-link {{ request()->is('staff/maintenance*') ? 'active' : '' }}">
        <i class="bi bi-tools"></i> Riwayat Perawatan
    </a>

@elseif($role == 'manajemen')
    <div class="sidebar-section-title">Laporan</div>
    
    <a href="{{ route('manajemen.laporan') }}" 
       class="sidebar-link {{ Request::is('laporan-rekomendasi*') ? 'active' : '' }}">
        <i class="bi bi-file-earmark-bar-graph"></i> Ranking AHP
    </a>
@endif
