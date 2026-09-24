@extends('layouts.app')

@section('header', 'Monitoring Penilaian AHP')
@section('title', 'Monitoring Penilaian')

@section('content')
<div class="card">
    <div class="card-header">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-display me-2 text-primary"></i>Hasil Penilaian Kondisi
        </h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 60px;">No</th>
                        <th class="text-start">Perangkat</th>
                        <th class="text-center">Skor AHP</th>
                        <th class="text-center">Rekomendasi</th>
                        <th class="text-center" style="width: 130px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($results as $data)
                    <tr>
                        <td class="text-center text-muted">{{ $loop->iteration }}</td>
                        <td class="text-start">
                            <div class="fw-semibold">{{ $data->asset->nama_perangkat }}</div>
                            <div class="text-muted" style="font-size: 0.8125rem;">{{ $data->asset->kode_aset }}</div>
                        </td>
                        <td class="text-center">
                            <span class="badge bg-primary-subtle text-primary">{{ number_format($data->total_score, 3) }}</span>
                        </td>
                        <td class="text-center">
                            @if($data->total_score >= 0.8)
                                <span class="badge badge-dot bg-success-subtle text-success">Sangat Layak</span>
                            @elseif($data->total_score >= 0.4)
                                <span class="badge badge-dot bg-warning-subtle text-warning">Perbaikan</span>
                            @else
                                <span class="badge badge-dot bg-danger-subtle text-danger">Ganti Baru</span>
                            @endif
                        </td>
                        <td class="text-center">
                            <form action="{{ route('admin.monitoring.reset', $data->id) }}" method="POST" class="d-inline" id="reset-form-{{ $data->id }}">
                                @csrf 
                                @method('DELETE')
                                <button type="button" class="btn btn-sm btn-ghost text-danger btn-reset-item" 
                                        data-id="{{ $data->id }}" 
                                        data-name="{{ $data->asset->nama_perangkat }}">
                                    <i class="bi bi-arrow-counterclockwise me-1"></i> Reset
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="bi bi-inbox d-block"></i>
                            Belum ada data penilaian yang masuk.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
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
                title: 'Reset penilaian?',
                text: "Penilaian untuk '" + name + "' akan dihapus dan harus diinput ulang oleh Staff.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                confirmButtonText: 'Ya, Reset!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'swal2-popup-custom' }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('reset-form-' + id).submit();
                }
            });
        });
    });
</script>
@endpush
