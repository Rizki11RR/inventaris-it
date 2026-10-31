@extends('layouts.app')

@section('header', 'Hasil Perhitungan AHP')
@section('title', 'Hasil AHP')

@section('content')
<div class="container-fluid">
    @php
        $n = count($criterias);
        $weightTotal = array_sum($bobot);
        $isConsistent = $cr !== null && $cr <= 0.1;
    @endphp

    {{-- Ringkasan Konsistensi --}}
    <div class="row mb-4 g-3">
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 {{ $isConsistent ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} h-100">
                <div class="card-body p-4">
                    <h6 class="small text-uppercase">Status Konsistensi</h6>
                    <h2 class="fw-bold mb-0">{{ $isConsistent ? 'Konsisten' : 'Tidak Konsisten' }}</h2>
                    <p class="small mb-0 mt-2">{{ $cr === null ? 'CR tidak tersedia untuk n kurang dari 3.' : ($isConsistent ? 'Matriks memenuhi batas CR ≤ 0.1.' : 'Matriks perlu diperiksa kembali.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 h-100">
                <div class="card-body p-4">
                    <div class="row g-3">
                        <div class="col-6 col-lg-4"><small class="text-muted d-block">n</small><strong>{{ $n }}</strong></div>
                        <div class="col-6 col-lg-4"><small class="text-muted d-block">Lambda Max (λmax)</small><strong>{{ number_format($lambdaMax, 4) }}</strong></div>
                        <div class="col-6 col-lg-4"><small class="text-muted d-block">Consistency Index (CI)</small><strong>{{ number_format($ci, 4) }}</strong></div>
                        <div class="col-6 col-lg-4"><small class="text-muted d-block">Random Index (RI)</small><strong>{{ number_format($ri, 2) }}</strong></div>
                        <div class="col-6 col-lg-4"><small class="text-muted d-block">Consistency Ratio (CR)</small><strong>{{ $cr === null ? 'N/A' : number_format($cr, 4) }}</strong></div>
                        <div class="col-6 col-lg-4"><small class="text-muted d-block">Total Bobot</small><strong>{{ number_format($weightTotal, 4) }}</strong></div>
                    </div>
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