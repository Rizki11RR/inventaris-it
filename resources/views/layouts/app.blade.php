<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        :root { --imux-blue: #0d6efd; --imux-light-blue: #eef4ff; --sidebar-width: 260px; --bg-body: #f4f7fe; }
        body { font-family: 'Inter', sans-serif; background-color: var(--bg-body); }
        .sidebar { width: var(--sidebar-width); height: 100vh; position: fixed; background: #ffffff; border-right: 1px solid #e2e8f0; z-index: 1000; }
        .brand-section { padding: 24px; font-weight: 700; font-size: 1.25rem; color: var(--imux-blue); border-bottom: 1px solid #f1f5f9; }
        .nav-pills .nav-link { color: #718096; margin: 4px 16px; padding: 12px 16px; font-weight: 500; display: flex; align-items: center; border-radius: 10px; text-decoration: none; }
        .nav-pills .nav-link i { margin-right: 12px; font-size: 1.1rem; }
        .nav-pills .nav-link:hover, .nav-pills .nav-link.active { background-color: var(--imux-light-blue); color: var(--imux-blue); }
        .main-content { margin-left: var(--sidebar-width); padding: 32px; }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="brand-section text-center"><i class="bi bi-cpu-fill"></i> IMUX CORP</div>
    <div class="nav nav-pills flex-column mt-4">
        {{-- INI ADALAH STEP UPDATE UTAMA: Memanggil Sidebar --}}
        @include('layouts.partials.sidebar_menu')
    </div>
</aside>

<main class="main-content">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h4 class="fw-bold mb-0">@yield('header', $header ?? 'Dashboard')</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">{{ ucfirst(Auth::user()->role) }}</a></li>
                    <li class="breadcrumb-item active">Halaman Utama</li>
                </ol>
            </nav>
        </div>
        
        <div class="dropdown">
            <button class="btn btn-white bg-white border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0d6efd&color=fff" class="rounded-circle me-2" width="25">
                {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li><a class="dropdown-item" href="{{ route('profile.edit') }}"><i class="bi bi-person me-2"></i> Profil</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger"><i class="bi bi-box-arrow-right me-2"></i> Logout</button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    {{-- Tempat konten utama --}}
    @yield('content', $slot ?? '') 
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
@stack('scripts')
</body>
</html>