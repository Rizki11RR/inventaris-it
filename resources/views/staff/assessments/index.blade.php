@extends('layouts.app')
@section('header', 'Penilaian Kondisi Perangkat')
@section('content')
<div class="card border-0 shadow-sm rounded-4 bg-white">
    <div class="card-body p-4">
        <table class="table table-hover align-middle text-center">
            <thead class="bg-primary text-white">
                <tr>
                    <th>KODE ASET</th>
                    <th>NAMA PERANGKAT</th>
                    <th>STATUS SAAT INI</th>
                    <th>AKSI</th>
                </tr>
            </thead>
            <tbody>
                @foreach($assets as $asset)
                <tr>
                    <td>{{ $asset->kode_aset }}</td>
                    <td>{{ $asset->nama_perangkat }}</td>
                    <td><span class="badge bg-{{ $asset->status->warna }}">{{ $asset->status->nama_status }}</span></td>
                    <td>
                        <a href="{{ route('staff.assessments.create', $asset->id) }}" class="btn btn-sm btn-primary rounded-3">
                            Mulai Penilaian AHP
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection