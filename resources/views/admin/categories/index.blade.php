@extends('layouts.app')

@section('header', 'Master Kategori')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Kategori Perangkat IT</h5>
            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Kategori
            </button>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="small text-uppercase fw-bold text-muted">
                            <th>Nama Kategori</th>
                            <th>Keterangan</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $cat)
                        <tr>
                            <td class="fw-bold">{{ $cat->nama_kategori }}</td>
                            <td>{{ $cat->deskripsi ?? '-' }}</td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light border rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#editCategoryModal{{ $cat->id }}">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                                <form action="{{ route('categories.destroy', $cat->id) }}" method="POST" class="d-inline">
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
@include('admin.categories.add_modal')
@foreach($categories as $cat)
    @include('admin.categories.edit_modal', ['category' => $cat])
@endforeach

@endsection