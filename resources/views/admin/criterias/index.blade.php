@extends('layouts.app')

@section('header', 'Kriteria & Bobot AHP')
@section('title', 'Data Kriteria')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-clipboard-data me-2 text-primary"></i>Daftar Kriteria Penilaian
        </h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCriteriaModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Kriteria
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-center" style="width: 50px;">#</th>
                        <th class="text-start">Nama Kriteria</th>
                        <th class="text-center">Sub-Kriteria</th>
                        <th class="text-center" style="width: 180px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($criterias as $index => $cr)
                    <tr>
                        <td class="text-center text-muted">{{ $index + 1 }}</td>
                        <td class="text-start fw-semibold">{{ $cr->nama_kriteria }}</td>
                        <td class="text-center">
                            <span class="badge bg-info-subtle text-info">
                                <i class="bi bi-list-stars me-1"></i> {{ $cr->subCriterias->count() }} Bobot
                            </span>
                        </td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-sm btn-warning text-white" data-bs-toggle="modal" data-bs-target="#subModal{{ $cr->id }}">
                                    <i class="bi bi-calculator me-1"></i> Bobot
                                </button>
                                <button class="btn btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#editCriteriaModal{{ $cr->id }}">
                                    <i class="bi bi-pencil"></i>
                                </button>
                                <form action="{{ route('criterias.destroy', $cr->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-ghost btn-sm text-danger btn-delete">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4" class="empty-state">
                            <i class="bi bi-clipboard-data d-block"></i>
                            Belum ada data kriteria.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('admin.criterias.add_modal')
@foreach($criterias as $cr)
    @include('admin.criterias.edit_modal', ['criteria' => $cr])
    @include('admin.criterias.sub_modal', ['criteria' => $cr])
@endforeach
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                customClass: { popup: 'swal2-popup-custom' }
            });
        @endif

        $(document).on('click', '.btn-delete', function(e) {
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus kriteria?',
                text: "Menghapus kriteria akan menghapus semua bobot di dalamnya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#EF4444',
                cancelButtonColor: '#64748B',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                customClass: { popup: 'swal2-popup-custom' }
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endpush
