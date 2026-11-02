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

</head>
<body>
<div class="sidebar-backdrop" data-sidebar-close></div>
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
        <div class="d-flex align-items-center gap-2">
            <button class="btn btn-outline-secondary d-md-none" type="button" aria-label="Buka menu" data-sidebar-toggle><i class="bi bi-list"></i></button>
        <div>
            <h4 class="fw-bold mb-0">@yield('header', $header ?? 'Dashboard')</h4>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="#" class="text-decoration-none">{{ ucfirst(Auth::user()->role) }}</a></li>
                    <li class="breadcrumb-item active">@yield('header', 'Halaman Utama')</li>
                </ol>
            </nav>
        </div>
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
        $('[data-sidebar-toggle]').on('click', function() { $('body').toggleClass('sidebar-open'); });
        $('[data-sidebar-close]').on('click', function() { $('body').removeClass('sidebar-open'); });

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