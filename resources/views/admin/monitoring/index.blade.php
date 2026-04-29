@extends('layouts.app')

@section('header', 'Monitoring Penilaian AHP')
@section('title', 'Monitoring Penilaian AHP')

@section('content')
<div class="container-fluid py-3">
    <div class="card border-0 shadow-sm" style="border-radius: 1rem;">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="fw-bold text-dark mb-0"><i class="bi bi-display me-2 text-primary"></i> Hasil Penilaian Kondisi</h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center mb-0">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th class="text-start">PERANGKAT</th>
                            <th>SKOR AHP</th>
                            <th>REKOMENDASI</th>
                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($results as $data)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td class="text-start">
                                <div class="fw-bold text-dark">{{ $data->asset->nama_perangkat }}</div>
                                <small class="text-muted">{{ $data->asset->kode_aset }}</small>
                            </td>
                            <td>
                                <span class="badge bg-primary-subtle text-primary border border-primary rounded-pill px-3">
                                    {{ number_format($data->total_score, 3) }}
                                </span>
                            </td>
                            <td>
                                @if($data->total_score >= 0.8)
                                    <span class="badge bg-success rounded-pill px-3">Sangat Layak</span>
                                @elseif($data->total_score >= 0.4)
                                    <span class="badge bg-warning text-dark rounded-pill px-3">Perbaikan</span>
                                @else
                                    <span class="badge bg-danger rounded-pill px-3">Ganti Baru</span>
                                @endif
                            </td>
                            <td>
                                <form action="{{ route('admin.monitoring.reset', $data->id) }}" method="POST" class="d-inline" id="reset-form-{{ $data->id }}">
                                    @csrf 
                                    @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-light border text-danger rounded-pill px-3 btn-reset-item" 
                                            data-id="{{ $data->id }}" 
                                            data-name="{{ $data->asset->nama_perangkat }}">
                                        <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-5 text-muted">Belum ada data penilaian yang masuk.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.querySelectorAll('.btn-reset-item').forEach(button => {
        button.addEventListener('click', function() {
            const id = this.getAttribute('data-id');
            const name = this.getAttribute('data-name');
            
            Swal.fire({
                title: 'Reset Penilaian?',
                text: "Penilaian untuk '" + name + "' akan dihapus dan harus diinput ulang oleh Staff.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#dc3545',
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal',
                customClass: { confirmButton: 'rounded-pill px-4', cancelButton: 'rounded-pill px-4' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reset-form-' + id).submit();
                }
            });
        });
    });
</script>
@endpush