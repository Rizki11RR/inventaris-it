@extends('layouts.app')

@section('header', 'Manajemen Data Perangkat IT')
@section('title', 'Daftar Aset')

@section('content')
<div class="container-fluid py-3">
    <div class="card">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-primary">
                <i class="bi bi-display me-2"></i> Daftar Inventaris Perangkat
            </h5>
            <button class="btn btn-primary shadow-sm" data-bs-toggle="modal" data-bs-target="#addAssetModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Perangkat
            </button>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-custom align-middle text-center">
                    <thead>
                        <tr>
                            <th class="ps-4 text-start">KODE & NAMA PERANGKAT</th>
                            <th>KATEGORI</th>
                            <th>LOKASI</th>
                            <th>STATUS</th>
                            <th class="text-center">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                        <tr>
                            <td class="text-start ps-4">
                                <div class="fw-bold text-dark">{{ $asset->nama_perangkat }}</div>
                            </td>
                            <td>
                                <span class="badge bg-light text-dark border px-3 py-2 rounded-pill">{{ $asset->category->nama_kategori }}</span>
                            </td>
                            <td>
                                <span class="text-muted small"><i class="bi bi-geo-alt me-1"></i>{{ $asset->location->nama_lokasi }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $asset->status->warna ?? 'secondary' }} rounded-pill px-3 py-2">
                                    {{ $asset->status->nama_status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm btn-light border text-primary" data-bs-toggle="modal" data-bs-target="#editAssetModal{{ $asset->id }}">
                                        <i class="bi bi-pencil-square"></i> Edit
                                    </button>
                                    <form id="delete-form-{{ $asset->id }}" action="{{ route('staff.assets.destroy', $asset->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-light border text-danger" onclick="confirmDelete('{{ $asset->id }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" class="py-5 text-muted text-center">
                                <i class="bi bi-inbox fs-1 d-block mb-2 text-secondary"></i>
                                Belum ada data perangkat terdaftar.
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- Include Modal Tambah --}}
@include('staff.assets.add_modal')

@foreach($assets as $asset)
    @include('staff.assets.edit_modal', ['asset' => $asset])
@endforeach

@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Apakah Anda yakin?',
            text: "Data perangkat ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#0d6efd',
            cancelButtonColor: '#dc3545',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true,
            borderRadius: '1rem'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    @if(session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Berhasil!',
            text: "{{ session('success') }}",
            showConfirmButton: false,
            timer: 1500
        });
    @endif
</script>
@endpush