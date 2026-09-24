<x-guest-layout>
    <x-slot name="title">Login</x-slot>

    <div class="auth-brand">
        <img src="{{ asset('img/logo.png') }}" alt="Logo">
        <div class="auth-title">Selamat Datang</div>
        <div class="auth-subtitle">Masuk ke dashboard inventaris IT</div>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" name="email" 
                   class="form-control @error('email') is-invalid @enderror" 
                   value="{{ old('email') }}" required autofocus placeholder="nama@perusahaan.com">
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mb-3">
            <div class="d-flex justify-content-between">
                <label for="password" class="form-label mb-0">Kata Sandi</label>
                @if (Route::has('password.request'))
                    <a class="text-decoration-none small" href="{{ route('password.request') }}" style="color: var(--primary);">
                        Lupa sandi?
                    </a>
                @endif
            </div>
            <input id="password" type="password" name="password" 
                   class="form-control @error('password') is-invalid @enderror mt-1"
                   required autocomplete="current-password" placeholder="Masukkan kata sandi">
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mb-4 form-check">
            <input id="remember_me" type="checkbox" class="form-check-input" name="remember">
            <label for="remember_me" class="form-check-label small text-muted">Ingat perangkat ini</label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-primary py-2 fw-semibold">
                Masuk ke Dashboard
            </button>
        </div>
    </form>

    <p class="text-center mt-4 text-muted small">
        &copy; 2026 Inventaris IT System
    </p>
</x-guest-layout>
