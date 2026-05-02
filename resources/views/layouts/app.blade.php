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

    <style>
        /* =========================================
        1. CSS STRUKTUR LAYOUT (Bawaan Anda) 
        ========================================= */
        :root { 
            --imux-blue: #0d6efd; 
            --imux-light-blue: #eef4ff; 
            --sidebar-width: 260px; 
            --bg-body: #f4f7fe; 
        }
        body { 
            font-family: 'Inter', sans-serif; 
            background-color: var(--bg-body); 
        }
        .sidebar { 
            width: var(--sidebar-width); 
            height: 100vh; 
            position: fixed; 
            background: #ffffff; 
            border-right: 1px solid #e2e8f0; 
            z-index: 1000; 
            overflow-y: auto;
        }

        .sidebar::-webkit-scrollbar {
            width: 5px;
        }
        .sidebar::-webkit-scrollbar-thumb {
            background: #cbd5e0;
            border-radius: 10px;
        }
        .brand-section { 
            padding: 24px; 
            font-weight: 700; 
            font-size: 1.25rem; 
            color: var(--imux-blue); 
            border-bottom: 1px solid #f1f5f9; 
        }
        .nav-pills .nav-link { 
            color: #718096; 
            margin: 4px 16px; 
            padding: 12px 16px; 
            font-weight: 500; 
            display: flex; 
            align-items: center; 
            border-radius: 10px; 
            text-decoration: none; 
        }
        .nav-pills .nav-link i { 
            margin-right: 12px; 
            font-size: 1.1rem; 
        }
        .nav-pills .nav-link:hover, .nav-pills .nav-link.active { 
            background-color: var(--imux-light-blue); 
            color: var(--imux-blue); 
        }
        .main-content { 
            margin-left: var(--sidebar-width); 
            padding: 32px; 
        }

        /* =========================================
        2. CSS STANDAR KOMPONEN (Makeover Baru) 
        ========================================= */
        .card {
            background-color: #ffffff !important; 
            border: none !important;
            border-radius: 1rem !important; 
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important; 
        }
        .card-header {
            background-color: #ffffff;
            border-bottom: 1px solid rgba(0,0,0,.05);
            border-top-left-radius: 1rem !important;
            border-top-right-radius: 1rem !important;
            padding: 1.25rem 1.5rem;
        }
        .table-custom {
            margin-bottom: 0;
            background-color: #ffffff !important; 
        }
        .table-custom thead th {
            background-color: #f8f9fa; 
            color: #495057;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.5px;
            border-bottom: 2px solid #dee2e6;
            padding: 1rem;
        }
       .table-custom tbody td {
            background-color: #ffffff; /* Tambahkan baris ini agar baris tabel tidak transparan */
            padding: 1rem;
            vertical-align: middle;
            border-bottom: 1px solid #f2f2f2;
            color: #555;
        }
        .table-custom tbody tr:hover {
            background-color: #f8f9fa;
            transition: all 0.2s ease;
        }
        .btn {
            border-radius: 50rem; 
            padding: 0.5rem 1.25rem;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-sm {
            padding: 0.25rem 0.75rem;
            font-size: 0.875rem;
        }
        .modal-content {
            border: none;
            border-radius: 1rem;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
        }
        .modal-header {
            border-bottom: 1px solid rgba(0,0,0,.05);
            background-color: #fcfcfc;
            border-top-left-radius: 1rem;
            border-top-right-radius: 1rem;
        }
        .modal-footer {
            border-top: 1px solid rgba(0,0,0,.05);
            background-color: #fcfcfc;
            border-bottom-left-radius: 1rem;
            border-bottom-right-radius: 1rem;
        }
    </style>
</head>
<body>

<aside class="sidebar">
    <div class="brand-section d-flex justify-content-center align-items-center text-center py-3">
        <a href="{{ route(Auth::user()->role . '.dashboard') }}" class="text-decoration-none">
            <img src="{{ asset('img/logo.png') }}" style="height: 80px; width: auto;" class="d-block mx-auto mb-2">
        </a>
    </div>
    <div class="nav nav-pills flex-column mt-4">
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
                    <li class="breadcrumb-item active">@yield('header', 'Halaman Utama')</li>
                </ol>
            </nav>
        </div>
        
        <div class="dropdown">
            <button class="btn p-3 btn-white bg-white border dropdown-toggle" type="button" data-bs-toggle="dropdown">
                Halo, {{ Auth::user()->name }}
            </button>
            <ul class="dropdown-menu dropdown-menu-end shadow-sm">
                <li>
                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                        <i class="bi bi-person me-2"></i> Profil
                    </a>
                </li>
                <li><hr class="dropdown-divider"></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="dropdown-item text-danger">
                            <i class="bi bi-box-arrow-right me-2"></i> Logout
                        </button>
                    </form>
                </li>
            </ul>
        </div>
    </div>

    {{-- Tempat konten utama --}}
    @yield('content', $slot ?? '') 
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
    $(document).ready(function() {
        // Alert untuk pesan Sukses
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 2000
            });
        @endif

        // Alert untuk pesan Error
        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Gagal!',
                text: "{{ session('error') }}",
            });
        @endif

        // Konfirmasi Hapus Universal
        $(document).on('click', '.btn-delete', function(e) {
            e.preventDefault();
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus data ini?',
                text: "Data yang dihapus mungkin memengaruhi data perangkat terkait!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal'
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