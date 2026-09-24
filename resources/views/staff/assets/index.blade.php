@extends('layouts.app')

@section('header', 'Data Perangkat IT')
@section('title', 'Daftar Aset')

@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-laptop me-2 text-primary"></i>Daftar Inventaris Perangkat
        </h5>
        <button class="btn btn-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addAssetModal">
            <i class="bi bi-plus-lg me-1"></i> Tambah Perangkat
        </button>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Kode & Nama Perangkat</th>
                        <th>Kategori</th>
                        <th>Lokasi</th>
                        <th>Status</th>
                        <th class="text-center" style="width: 150px;">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($assets as $asset)
                    <tr>
                        <td class="text-start">
                            <div class="fw-semibold">{{ $asset->nama_perangkat }}</div>
                            <div class="text-muted" style="font-size: 0.8125rem;">{{ $asset->kode_aset }}</div>
                        </td>
                        <td>
                            <span class="badge bg-light text-dark">{{ $asset->category->nama_kategori }}</span>
                        </td>
                        <td>
                            <span class="text-muted"><i class="bi bi-geo-alt me-1"></i>{{ $asset->location->nama_lokasi }}</span>
                        </td>
                        <td>
                            <span class="badge badge-dot bg-{{ $asset->status->warna ?? 'secondary' }}-subtle text-{{ $asset->status->warna ?? 'secondary' }}">
                                {{ $asset->status->nama_status }}
                            </span>
                        </td>
                        <td>
                            <div class="d-flex justify-content-center gap-2">
                                <button class="btn btn-ghost btn-sm" data-bs-toggle="modal" data-bs-target="#editAssetModal{{ $asset->id }}">
                                    <i class="bi bi-pencil me-1"></i> Edit
                                </button>
                                <form id="delete-form-{{ $asset->id }}" action="{{ route('staff.assets.destroy', $asset->id) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-ghost btn-sm text-danger" onclick="confirmDelete('{{ $asset->id }}')">
                                        <i class="bi bi-trash me-1"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="empty-state">
                            <i class="bi bi-inbox d-block"></i>
                            Belum ada data perangkat terdaftar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

@include('staff.assets.add_modal')

@foreach($assets as $asset)
    @include('staff.assets.edit_modal', ['asset' => $asset])
@endforeach
@endsection

@push('scripts')
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Hapus perangkat?',
            text: "Data perangkat ini akan dihapus permanen!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#EF4444',
            cancelButtonColor: '#64748B',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            customClass: { popup: 'swal2-popup-custom' }
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
            timer: 1500,
            customClass: { popup: 'swal2-popup-custom' }
        });
    @endif
</script>
@endpush
