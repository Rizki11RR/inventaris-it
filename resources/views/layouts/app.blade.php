<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', $title ?? 'Halaman') | Inventaris IT</title>

    <link rel="icon" type="image/png" href="{{ asset('img/logo.png') }}">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    @stack('styles')
</head>
<body>

{{-- Sidebar Overlay (Mobile) --}}
<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

{{-- Sidebar --}}
<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="text-decoration-none d-flex align-items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo">
            <span class="sidebar-brand-text">Inventaris IT</span>
        </a>
    </div>
    <nav class="sidebar-nav">
        @include('layouts.partials.sidebar_menu')
    </nav>
</aside>

{{-- Main Content --}}
<div class="app-content">
    {{-- Header --}}
    <header class="app-header">
        <div class="app-header-left">
            <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Toggle menu">
                <i class="bi bi-list fs-5"></i>
            </button>
            <div>
                <h1 class="page-title">@yield('header', $header ?? 'Dashboard')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{ route(Auth::user()->role . '.dashboard') }}">{{ ucfirst(Auth::user()->role) }}</a></li>
                        <li class="breadcrumb-item active">@yield('header', 'Dashboard')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="app-header-right">
            <div class="user-dropdown">
                <button class="user-dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=3C50E0&color=fff&bold=true&size=36" 
                         alt="{{ Auth::user()->name }}" class="user-avatar">
                    <div class="user-info d-none d-sm-block">
                        <div class="user-name">{{ Auth::user()->name }}</div>
                        <div class="user-role">{{ ucfirst(Auth::user()->role) }}</div>
                    </div>
                    <i class="bi bi-chevron-down text-muted" style="font-size: 0.75rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" style="min-width: 180px;">
                    <li>
                        <a class="dropdown-item d-flex align-items-center gap-2" href="{{ route('profile.edit') }}">
                            <i class="bi bi-person text-muted"></i> Profil
                        </a>
                    </li>
                    <li><hr class="dropdown-divider my-1"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item d-flex align-items-center gap-2 text-danger">
                                <i class="bi bi-box-arrow-right"></i> Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    {{-- Body --}}
    <div class="app-body">
        @yield('content', $slot ?? '')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
    // Sidebar toggle for mobile
    function toggleSidebar() {
        const sidebar = document.getElementById('appSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
    }

    // Close sidebar on resize to desktop
    window.addEventListener('resize', function() {
        if (window.innerWidth > 991) {
            const sidebar = document.getElementById('appSidebar');
            const overlay = document.getElementById('sidebarOverlay');
            sidebar.classList.remove('show');
            overlay.classList.remove('show');
            document.body.style.overflow = '';
        }
    });

    $(document).ready(function() {
        // Success alert
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                customClass: { popup: 'swal2-popup-custom' }
            });
        @endif

        // Error alert
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
                customClass: { popup: 'swal2-popup-custom' }
            });
        @endif

        // Universal delete confirmation
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            let name = $(this).data('name') || 'data ini';
            Swal.fire({
                title: 'Hapus data ini?',
                text: name + " akan dihapus dari sistem!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#64748B',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'swal2-popup-custom' }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });
</script>
@stack('scripts')
</body>
</html>
