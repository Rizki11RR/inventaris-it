@extends('layouts.app')

@section('header', 'Master Data Vendor')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Data Vendor & Merk</h5>
            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#addVendorModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Vendor
            </button>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="small text-uppercase fw-bold text-muted">
                            <th>Nama Vendor</th>
                            <th>Merk</th>
                            <th>Kontak</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($vendors as $vendor)
                        <tr>
                            <td>{{ $vendor->nama_vendor }}</td>
                            <td>{{ $vendor->merk }}</td>
                            <td>{{ $vendor->kontak ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light border rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#editVendorModal{{ $vendor->id }}">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                                <form action="{{ route('vendors.destroy', $vendor->id) }}" method="POST" class="d-inline">
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
@include('admin.vendors.add_modal')

@foreach($vendors as $vendor)
    @include('admin.vendors.edit_modal')
@endforeach

@endsection