<x-app-layout>
    {{-- Header ini akan mengisi @yield('header') atau $header di app.blade.php --}}
    @section('header', 'Dashboard Staff IT')

    @section('content')
    <div class="card-custom">
        <h5 class="fw-bold">Selamat Datang, {{ Auth::user()->name }}!</h5>
        <p class="text-muted">Gunakan menu di samping untuk melakukan penilaian kondisi perangkat IT.</p>
        
        <div class="row mt-4">
            <div class="col-md-4">
                <div class="p-3 bg-primary text-white rounded-4 shadow-sm">
                    <h6>Perangkat Perlu Dicek</h6>
                    <h3>12 Unit</h3>
                </div>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>