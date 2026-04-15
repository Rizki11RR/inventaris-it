<x-app-layout>
    @section('header', 'Dashboard Manajemen')

    @section('content')
    <div class="row">
        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="badge bg-primary-subtle p-3 rounded-3 me-3">
                        <i class="bi bi-laptop text-primary fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Total Inventaris</h6>
                        <h4 class="fw-bold mb-0">150 Unit</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="badge bg-success-subtle p-3 rounded-3 me-3">
                        <i class="bi bi-check-circle text-success fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Kondisi Baik</h6>
                        <h4 class="fw-bold mb-0">120 Unit</h4>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 mb-4">
            <div class="card border-0 shadow-sm rounded-4 p-3 bg-white">
                <div class="d-flex align-items-center">
                    <div class="badge bg-danger-subtle p-3 rounded-3 me-3">
                        <i class="bi bi-exclamation-triangle text-danger fs-4"></i>
                    </div>
                    <div>
                        <h6 class="text-muted mb-0">Perlu Penggantian</h6>
                        <h4 class="fw-bold mb-0">5 Unit</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 bg-white mt-2">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3">Hasil Analisis Metode AHP</h5>
            <p class="text-muted">Berikut adalah ringkasan prioritas perbaikan perangkat berdasarkan perhitungan AHP.</p>
            
            <div class="table-responsive">
                <table class="table table-hover mt-3">
                    <thead class="table-light">
                        <tr>
                            <th>Ranking</th>
                            <th>Nama Perangkat</th>
                            <th>Skor Akhir</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td>Server RACK-01</td>
                            <td>0.895</td>
                            <td><span class="badge bg-danger">Prioritas Utama</span></td>
                        </tr>
                        <tr>
                            <td>2</td>
                            <td>Switch Core Lt.2</td>
                            <td>0.742</td>
                            <td><span class="badge bg-warning text-dark">Prioritas Menengah</span></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    @endsection
</x-app-layout>