@extends('layouts.app')

@section('header', 'Manajemen Data Perangkat IT')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0 text-dark">
                <i class="bi bi-display me-2 text-primary"></i>Daftar Inventaris Perangkat
            </h5>
            <button class="btn btn-primary rounded-3 px-4 shadow-sm" data-bs-toggle="modal" data-bs-target="#addAssetModal">
                <i class="bi bi-plus-lg me-1"></i> Tambah Perangkat
            </button>
        </div>

        <div class="card-body p-4">
            <div class="table-responsive rounded-3 border">
                <table class="table table-hover align-middle mb-0 text-center">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="py-3 px-4">KODE</th>
                            <th class="py-3">NAMA PERANGKAT</th>
                            <th class="py-3">KATEGORI</th>
                            <th class="py-3">LOKASI</th>
                            <th class="py-3">STATUS</th>
                            <th class="py-3">AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                        <tr>
                            <td class="fw-bold text-primary small">{{ $asset->kode_aset }}</td>
                            <td class="text-start ps-4">
                                <div class="fw-bold">{{ $asset->nama_perangkat }}</div>
                                <div class="small text-muted">{{ $asset->vendor->merk ?? '-' }}</div>
                            </td>
                            <td>{{ $asset->category->nama_kategori }}</td>
                            <td>{{ $asset->location->nama_lokasi }}</td>
                            <td>
                                <span class="badge bg-{{ $asset->status->warna ?? 'secondary' }} rounded-pill px-3">
                                    {{ $asset->status->nama_status }}
                                </span>
                            </td>
                            <td>
                                <div class="d-flex justify-content-center gap-2">
                                    <button class="btn btn-sm btn-light text-primary rounded-3" 
                                            data-bs-toggle="modal" 
                                            data-bs-target="#editAssetModal{{ $asset->id }}">
                                        <i class="bi bi-pencil-square"></i>
                                    </button>
                                    <form action="{{ route('staff.assets.destroy', $asset->id) }}" method="POST" onsubmit="return confirm('Hapus perangkat ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" class="btn btn-sm btn-light text-danger rounded-3" onclick="confirmDelete('{{ $asset->id }}')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                    {{-- Form Hapus (Hidden) --}}
                                    <form id="delete-form-{{ $asset->id }}" action="{{ route('staff.assets.destroy', $asset->id) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="py-5 text-muted small italic">Belum ada data perangkat terdaftar.</td>
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
            text: "Data perangkat ini akan dihapus permanen dari sistem!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Ya, Hapus!',
            cancelButtonText: 'Batal',
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        });
    }

    // Menampilkan Notifikasi Sukses Jika Ada
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