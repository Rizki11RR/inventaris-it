@extends('layouts.app')

@section('header', 'Hasil Perhitungan AHP')
@section('title', 'Hasil AHP')

@section('content')
{{-- Ringkasan Konsistensi --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="stat-card" style="background: {{ $cr <= 0.1 ? 'var(--success)' : 'var(--danger)' }}; color: #FFFFFF; border: none;">
            <div class="stat-icon" style="background: rgba(255,255,255,0.2); color: #FFFFFF;">
                <i class="bi {{ $cr <= 0.1 ? 'bi-check-circle' : 'bi-exclamation-triangle' }}"></i>
            </div>
            <div>
                <div class="stat-label" style="color: rgba(255,255,255,0.8);">Consistency Ratio (CR)</div>
                <div class="stat-value" style="color: #FFFFFF;">{{ number_format($cr, 4) }}</div>
            </div>
        </div>
    </div>
</div>

{{-- Tabel Bobot Prioritas --}}
<div class="card">
    <div class="card-header">
        <h5 class="fw-bold mb-0">Bobot Prioritas Kriteria</h5>
    </div>
    <div class="card-body p-0">
        <div class="table-responsive">
            <table class="table table-custom align-middle mb-0">
                <thead>
                    <tr>
                        <th class="text-start">Kriteria</th>
                        <th class="text-center">Bobot (Priority Vector)</th>
                        <th class="text-center">Persentase</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($criterias as $c)
                    <tr>
                        <td class="text-start fw-semibold">{{ $c->nama_kriteria }}</td>
                        <td class="text-center">{{ number_format($bobot[$c->id], 4) }}</td>
                        <td class="text-center" style="min-width: 200px;">
                            <div class="progress mb-1" style="height: 8px;">
                                <div class="progress-bar" role="progressbar" style="width: {{ $bobot[$c->id]*100 }}%; background: var(--primary);"></div>
                            </div>
                            <small class="text-muted">{{ number_format($bobot[$c->id] * 100, 2) }}%</small>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
