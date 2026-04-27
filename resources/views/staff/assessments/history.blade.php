@extends('layouts.app')
@section('header', 'Riwayat Penilaian Kondisi')
@section('content')
<div class="card border-0 shadow-sm rounded-4 bg-white">
    <div class="card-body p-4">
        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead class="bg-light">
                    <tr>
                        <th>Tanggal</th>
                        <th>Perangkat</th>
                        <th>Skor Akhir</th>
                        <th>Rekomendasi</th>
                        <th>Penilai</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($histories as $h)
                    <tr>
                        <td>{{ $h->tanggal_penilaian->format('d/m/Y') }}</td>
                        <td>
                            <div class="fw-bold">{{ $h->asset->nama_perangkat }}</div>
                            <small class="text-muted">{{ $h->asset->kode_aset }}</small>
                        </td>
                        <td><span class="badge bg-primary">{{ number_format($h->total_score, 3) }}</span></td>
                        <td>
                            <span class="badge {{ $h->total_score >= 0.6 ? 'bg-success' : 'bg-danger' }}">
                                {{ $h->rekomendasi }}
                            </span>
                        </td>
                        <td>{{ $h->user->name ?? 'Staff' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection