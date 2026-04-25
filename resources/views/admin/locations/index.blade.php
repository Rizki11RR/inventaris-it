@extends('layouts.app')

@section('header', 'Master Data Lokasi')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Daftar Lokasi Perangkat</h5>
            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#addLocationModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Lokasi
            </button>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="small text-uppercase fw-bold text-muted">
                            <th>Nama Lokasi</th>
                            <th>Deskripsi / Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($locations as $loc)
                        <tr>
                            <td class="fw-bold">{{ $loc->nama_lokasi }}</td>
                            <td>{{ $loc->deskripsi ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light border rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#editLocationModal{{ $loc->id }}">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                                <form action="{{ route('locations.destroy', $loc->id) }}" method="POST" class="d-inline">
                                    @csrf @method('DELETE')
                                    <button type="button" class="btn btn-sm btn-light border rounded-3 btn-delete">
                                        <i class="bi bi-trash text-danger"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

{{-- MODAL AREA --}}
@include('admin.locations.add_modal')
@foreach($locations as $loc)
    @include('admin.locations.edit_modal', ['location' => $loc])
@endforeach

@endsection