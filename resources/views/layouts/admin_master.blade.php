<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $title ?? 'Dashboard' }} | Inventaris IT</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body>

<div class="sidebar-overlay" id="sidebarOverlay" onclick="toggleSidebar()"></div>

<aside class="app-sidebar" id="appSidebar">
    <div class="sidebar-brand">
        <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="text-decoration-none d-flex align-items-center gap-3">
            <img src="{{ asset('img/logo.png') }}" alt="Logo" style="height: 36px;">
        </a>
    </div>
    <nav class="sidebar-nav">
        @include('layouts.partials.sidebar_menu')
    </nav>
</aside>

<div class="app-content">
    <header class="app-header">
        <div class="app-header-left">
            <button class="mobile-menu-btn" onclick="toggleSidebar()" aria-label="Toggle menu">
                <i class="bi bi-list fs-5"></i>
            </button>
            <div>
                <h1 class="page-title">@yield('header')</h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">{{ ucfirst(Auth::user()->role) }}</a></li>
                        <li class="breadcrumb-item active">@yield('header')</li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="app-header-right">
            <div class="user-dropdown">
                <button class="user-dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <img src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}&background=3C50E0&color=fff&bold=true&size=36" class="user-avatar" alt="Avatar">
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

    <div class="app-body">
        @yield('content')
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function toggleSidebar() {
        const sidebar = document.getElementById('appSidebar');
        const overlay = document.getElementById('sidebarOverlay');
        sidebar.classList.toggle('show');
        overlay.classList.toggle('show');
        document.body.style.overflow = sidebar.classList.contains('show') ? 'hidden' : '';
    }
    window.addEventListener('resize', function() {
        if (window.innerWidth > 991) {
            document.getElementById('appSidebar').classList.remove('show');
            document.getElementById('sidebarOverlay').classList.remove('show');
            document.body.style.overflow = '';
        }
    });
</script>
@stack('scripts')
</body>
</html>
