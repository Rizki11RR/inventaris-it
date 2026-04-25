@extends('layouts.app')

@section('header', 'Master Status')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Status Kondisi Perangkat</h5>
            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#addStatusModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah Status
            </button>
        </div>
        <div class="card-body px-4 pb-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="small text-uppercase fw-bold text-muted">
                            <th>Nama Status</th>
                            <th>Preview Badge</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($statuses as $st)
                        <tr>
                            <td class="fw-bold">{{ $st->nama_status }}</td>
                            <td>
                                <span class="badge bg-{{ $st->warna }} rounded-pill px-3">
                                    {{ $st->nama_status }}
                                </span>
                            </td>
                            <td class="text-center">
                                <button class="btn btn-sm btn-light border rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#editStatusModal{{ $st->id }}">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                                <form action="{{ route('statuses.destroy', $st->id) }}" method="POST" class="d-inline">
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

@include('admin.statuses.add_modal')
@foreach($statuses as $st)
    @include('admin.statuses.edit_modal', ['status' => $st])
@endforeach

@endsection