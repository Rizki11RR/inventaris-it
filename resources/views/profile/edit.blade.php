@section('header', 'Edit Profile')
@section('title', 'Profil User')
<x-app-layout>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="fw-bold mb-0"><i class="bi bi-person me-2 text-primary"></i>Informasi Profil</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="fw-bold mb-0"><i class="bi bi-key me-2 text-primary"></i>Ubah Kata Sandi</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="card border-danger">
                <div class="card-header">
                    <h5 class="fw-bold mb-0 text-danger"><i class="bi bi-exclamation-triangle me-2"></i>Hapus Akun</h5>
                </div>
                <div class="card-body">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
