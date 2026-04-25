@extends('layouts.app')

@section('header', 'Manajemen User')

@section('content')
<div class="container-fluid">
    <div class="card border-0 shadow-sm rounded-4 bg-white">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Daftar Pengguna</h5>
            <button class="btn btn-primary rounded-3" data-bs-toggle="modal" data-bs-target="#addUserModal">
                <i class="bi bi-plus-lg me-2"></i> Tambah User
            </button>
        </div>
        <div class="card-body px-4 pb-4">
            @push('scripts')
            <script>
                // 1. Alert untuk Pesan Success dari Session
                @if(session('success'))
                    Swal.fire({
                        icon: 'success',
                        title: 'Berhasil!',
                        text: "{{ session('success') }}",
                        showConfirmButton: false,
                        timer: 2000,
                        customClass: {
                            popup: 'rounded-4'
                        }
                    });
                @endif

                // 2. Alert untuk Pesan Error dari Session
                @if(session('error'))
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "{{ session('error') }}",
                        customClass: {
                            popup: 'rounded-4'
                        }
                    });
                @endif

                // 3. Konfirmasi Hapus Data
                $('.btn-delete').on('click', function(e) {
                    e.preventDefault();
                    let form = $(this).closest('form');
                    
                    Swal.fire({
                        title: 'Apakah anda yakin?',
                        text: "Data user yang dihapus tidak dapat dikembalikan!",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#0d6efd',
                        cancelButtonColor: '#718096',
                        confirmButtonText: 'Ya, Hapus!',
                        cancelButtonText: 'Batal',
                        customClass: {
                            popup: 'rounded-4',
                            confirmButton: 'rounded-3',
                            cancelButton: 'rounded-3'
                        }
                    }).then((result) => {
                        if (result.isConfirmed) {
                            form.submit();
                        }
                    });
                });
            </script>
            @endpush

            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr class="small text-uppercase fw-bold text-muted">
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Role</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span class="badge {{ $user->role == 'admin' ? 'bg-danger' : ($user->role == 'staff' ? 'bg-primary' : 'bg-success') }} bg-opacity-10 {{ $user->role == 'admin' ? 'text-danger' : ($user->role == 'staff' ? 'text-primary' : 'text-success') }} px-3 rounded-pill">
                                    {{ ucfirst($user->role) }}
                                </span>
                            </td>
                            <td class="text-center">
                                {{-- Tombol Edit --}}
                                <button class="btn btn-sm btn-light border rounded-3 me-1" data-bs-toggle="modal" data-bs-target="#editUserModal{{ $user->id }}">
                                    <i class="bi bi-pencil-square text-primary"></i>
                                </button>
                                
                                {{-- Tombol Hapus --}}
                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" class="d-inline">
                                    @csrf 
                                    @method('DELETE')
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

@include('admin.users.add_modal')

@foreach($users as $user)
    @include('admin.users.edit_modal')
@endforeach

@endsection