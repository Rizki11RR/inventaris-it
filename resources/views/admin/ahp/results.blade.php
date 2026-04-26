@extends('layouts.app')

@section('header', 'Hasil Perhitungan AHP')

@section('content')
<div class="container-fluid">
    {{-- Ringkasan Konsistensi --}}
    <div class="row mb-4">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 {{ $cr <= 0.1 ? 'bg-success' : 'bg-danger' }} text-white">
                <div class="card-body p-4">
                    <h6 class="small text-uppercase opacity-75">Consistency Ratio (CR)</h6>
                    <h2 class="fw-bold mb-0">{{ number_format($cr, 4) }}</h2>
                    <hr class="opacity-25">
                    <p class="small mb-0">
                        <i class="bi {{ $cr <= 0.1 ? 'bi-check-circle' : 'bi-exclamation-triangle' }}"></i>
                        {{ $cr <= 0.1 ? 'Matriks Konsisten (Valid)' : 'Matriks Tidak Konsisten (Harap Ulangi)' }}
                    </p>
                </div>
            </div>
        </div>
        </div>

    {{-- Tabel Bobot Prioritas --}}
    <div class="card border-0 shadow-sm rounded-4 mb-4">
        <div class="card-header bg-white border-0 pt-4 px-4">
            <h5 class="fw-bold mb-0">Bobot Prioritas Kriteria</h5>
        </div>
        <div class="card-body p-4">
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>Kriteria</th>
                            <th class="text-center">Bobot (Priority Vector)</th>
                            <th class="text-center">Persentase</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($criterias as $c)
                        <tr>
                            <td class="fw-bold">{{ $c->nama_kriteria }}</td>
                            <td class="text-center">{{ number_format($bobot[$c->id], 4) }}</td>
                            <td class="text-center">
                                <div class="progress" style="height: 10px;">
                                    <div class="progress-bar" role="progressbar" style="width: {{ $bobot[$c->id]*100 }}%"></div>
                                </div>
                                <small>{{ number_format($bobot[$c->id] * 100, 2) }}%</small>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection