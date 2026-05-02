<x-guest-layout>
    <x-slot name="title">Login</x-slot>
    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f4f7fe !important;
        }
        .login-card {
            border: none;
            border-radius: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            background: #ffffff;
            padding: 40px;
        }
        .btn-primary-imux {
            background-color: #0d6efd;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-primary-imux:hover {
            background-color: #0b5ed7;
            transform: translateY(-2px);
        }
        .form-control-imux {
            border-radius: 10px;
            padding: 12px 15px;
            border: 1px solid #e2e8f0;
            background-color: #f8fafc;
        }
        .form-control-imux:focus {
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
            border-color: #0d6efd;
        }
        .brand-logo {
            color: #0d6efd;
            font-weight: 800;
            font-size: 1.5rem;
            letter-spacing: -0.5px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center align-items-center min-vh-100">
            <div class="col-md-5">
                <div class="text-center mb-4">
                    <div class="brand-logo mb-2">
                        <i class="bi bi-cpu-fill"></i> IMUX CORP
                    </div>
                    <p class="text-muted small">Sistem Informasi Inventaris & Penilaian IT</p>
                </div>

                <div class="login-card">
                    <h4 class="fw-bold mb-4 text-center">Selamat Datang</h4>
                    
                    <x-auth-session-status class="mb-4" :status="session('status')" />

                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="email" class="form-label small fw-bold text-muted">ALAMAT EMAIL</label>
                            <input id="email" type="email" name="email" 
                                   class="form-control form-control-imux @error('email') is-invalid @enderror" 
                                   value="{{ old('email') }}" required autofocus placeholder="nama@perusahaan.com">
                            <x-input-error :messages="$errors->get('email')" class="mt-2" />
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between">
                                <label for="password" class="form-label small fw-bold text-muted">KATA SANDI</label>
                                @if (Route::has('password.request'))
                                    <a class="text-decoration-none small fw-medium" href="{{ route('password.request') }}">
                                        Lupa sandi?
                                    </a>
                                @endif
                            </div>
                            <input id="password" type="password" name="password" 
                                   class="form-control form-control-imux @error('password') is-invalid @enderror" 
                                   required autocomplete="current-password" placeholder="••••••••">
                            <x-input-error :messages="$errors->get('password')" class="mt-2" />
                        </div>

                        <div class="mb-4 form-check">
                            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
                            <label for="remember_me" class="form-check-label small text-muted">Ingat perangkat ini</label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary btn-primary-imux">
                                Masuk ke Dashboard
                            </button>
                        </div>
                    </form>
                </div>
                
                <p class="text-center mt-4 text-muted small">
                    &copy; 2026 IMUX Corp Inventory System. 
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>