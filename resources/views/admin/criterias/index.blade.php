@extends('layouts.app')

@section('header', 'Kriteria & Bobot AHP')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0">Daftar Kriteria Penilaian</h5>
                <p class="small text-muted mb-0">Kelola kriteria dan bobot nilai untuk perhitungan AHP</p>
            </div>
            <button class="btn btn-primary rounded-3 px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addCriteriaModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Kriteria
            </button>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="small text-uppercase fw-bold text-muted">
                            <th style="width: 50px" class="text-center">#</th>
                            <th>Nama Kriteria</th>
                            <th>Sub-Kriteria</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($criterias as $index => $cr)
                        <tr>
                            <td class="text-center text-muted">{{ $index + 1 }}</td>
                            <td class="fw-bold text-dark">{{ $cr->nama_kriteria }}</td>
                            <td>
                                <span class="badge bg-info bg-opacity-10 text-info px-3 py-2 rounded-pill border border-info border-opacity-25">
                                    <i class="bi bi-list-stars me-1"></i> {{ $cr->subCriterias->count() }} Bobot
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-warning text-white rounded-3 px-3 me-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#subModal{{ $cr->id }}">
                                    <i class="bi bi-calculate me-1"></i> Bobot
                                </button>
                                <button class="btn btn-sm btn-light border rounded-3 me-1 shadow-sm" data-bs-toggle="modal" data-bs-target="#editCriteriaModal{{ $cr->id }}">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                                <form action="{{ route('criterias.destroy', $cr->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-light border rounded-3 shadow-sm btn-delete">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">Belum ada data kriteria.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Memanggil Semua Modal --}}
@include('admin.criterias.add_modal')
@foreach($criterias as $cr)
    @include('admin.criterias.edit_modal', ['criteria' => $cr])
    @include('admin.criterias.sub_modal', ['criteria' => $cr])
@endforeach

@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        {{-- 1. SweetAlert untuk Pesan Sukses --}}
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Berhasil!',
                text: "{{ session('success') }}",
                showConfirmButton: false,
                timer: 1500,
                timerProgressBar: true,
                customClass: { popup: 'rounded-4' }
            });
        @endif

        {{-- 2. Konfirmasi Hapus --}}
        $(document).on('click', '.btn-delete', function(e) {
            let form = $(this).closest('form');
            Swal.fire({
                title: 'Hapus Data?',
                text: "Menghapus kriteria akan menghapus semua bobot di dalamnya!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Ya, Hapus!',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: { popup: 'rounded-4', confirmButton: 'rounded-3', cancelButton: 'rounded-3' }
            }).then((result) => {
                if (result.isConfirmed) form.submit();
            });
        });
    });
</script>
@endpush