@extends('layouts.app')

@section('header', 'Perbandingan Kriteria AHP')
@section('title', 'Perbandingan Kriteria')

@section('content')
{{-- Info Card --}}
<div class="alert d-flex align-items-center p-3 mb-4" style="background: var(--primary-light); border: 1px solid rgba(60,80,224,0.15); border-radius: 10px;">
    <div class="me-3" style="width: 40px; height: 40px; background: rgba(60,80,224,0.1); border-radius: 10px; display: flex; align-items: center; justify-content: center;">
        <i class="bi bi-info-circle text-primary"></i>
    </div>
    <div>
        <h6 class="fw-bold mb-1" style="color: var(--primary);">Panduan Pengisian</h6>
        <p class="small mb-0 text-secondary">
            Isi nilai perbandingan pada sisi kanan (diagonal atas). Nilai kebalikan (sisi kiri) dan jumlah akan dihitung secara otomatis oleh sistem.
        </p>
    </div>
</div>

<div class="card">
    <div class="card-header d-flex justify-content-between align-items-center">
        <h5 class="fw-bold mb-0">
            <i class="bi bi-grid-3x3-gap me-2 text-primary"></i>Matriks Perbandingan Berpasangan
        </h5>
        <span class="badge bg-primary-subtle text-primary">Skala Saaty 1-9</span>
    </div>

    <div class="card-body">
        <form action="{{ route('ahp.store_comparisons') }}" method="POST">
            @csrf
            <div class="table-responsive rounded-3 border">
                <table class="table table-custom align-middle mb-0 text-center" id="matriksAHP">
                    <thead>
                        <tr style="background: var(--primary); color: #FFFFFF;">
                            <th class="py-3 px-4 border-bottom-0" style="color: #FFFFFF;">KRITERIA</th>
                            @foreach($criterias as $c)
                                <th class="py-3 border-bottom-0 text-uppercase small fw-bold" style="color: #FFFFFF;">{{ $c->nama_kriteria }}</th>
                            @endforeach
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($criterias as $row => $cri_row)
                        <tr>
                            <td class="fw-bold text-primary border-end text-uppercase small" style="background: var(--primary-light);">
                                {{ $cri_row->nama_kriteria }}
                            </td>
                            
                            @foreach($criterias as $col => $cri_col)
                                @php
                                    $isDiagonal = $row == $col;
                                    $isUpper = $col > $row;

                                    $existing = $comparisons->where('criteria_id1', $cri_row->id)
                                                            ->where('criteria_id2', $cri_col->id)
                                                            ->first();
                                    $currentVal = $existing ? $existing->nilai : 1;
                                @endphp

                                <td class="p-2">
                                    @if($isDiagonal)
                                        <input type="text" class="form-control form-control-sm border-0 text-center fw-bold" style="background: #F8FAFC;" value="1" readonly>
                                    @elseif($isUpper)
                                        <select name="ratio[{{ $cri_row->id }}][{{ $cri_col->id }}]" 
                                                class="form-select form-select-sm border-primary shadow-sm select-ratio" 
                                                data-row="{{ $row }}" data-col="{{ $col }}"
                                                style="border-width: 1px; border-color: rgba(60,80,224,0.2);">
                                            @for ($i = 1; $i <= 9; $i++)
                                                <option value="{{ $i }}" {{ $currentVal == $i ? 'selected' : '' }}>{{ $i }}</option>
                                            @endfor
                                            <option value="0.5" {{ abs($currentVal - 0.5) < 0.001 ? 'selected' : '' }}>0.50 (1/2)</option>
                                            <option value="0.333333333333" {{ abs($currentVal - 0.3333) < 0.001 ? 'selected' : '' }}>0.33 (1/3)</option>
                                            <option value="0.25" {{ abs($currentVal - 0.25) < 0.001 ? 'selected' : '' }}>0.25 (1/4)</option>
                                            <option value="0.2" {{ abs($currentVal - 0.2) < 0.001 ? 'selected' : '' }}>0.20 (1/5)</option>
                                            <option value="0.166666666667" {{ abs($currentVal - 0.1666) < 0.001 ? 'selected' : '' }}>0.17 (1/6)</option>
                                            <option value="0.142857142857" {{ abs($currentVal - 0.1428) < 0.001 ? 'selected' : '' }}>0.14 (1/7)</option>
                                            <option value="0.125" {{ abs($currentVal - 0.125) < 0.001 ? 'selected' : '' }}>0.13 (1/8)</option>
                                            <option value="0.111111111111" {{ abs($currentVal - 0.1111) < 0.001 ? 'selected' : '' }}>0.11 (1/9)</option>
                                        </select>
                                    @else
                                        <input type="text" id="reciprocal_{{ $row }}_{{ $col }}" 
                                            class="form-control form-control-sm border-0 text-center text-muted" style="background: #F8FAFC;" value="0" readonly>
                                    @endif
                                </td>
                            @endforeach
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr style="background: #F8FAFC;">
                            <td class="fw-bold small text-dark py-3">Jumlah Total</td>
                            @foreach($criterias as $col => $c)
                                <td id="total_col_{{ $col }}" class="fw-bold text-primary py-3">0</td>
                            @endforeach
                        </tr>
                    </tfoot>
                </table>
            </div>

            <div class="d-flex justify-content-end gap-2 mt-4">
                <button type="button" class="btn btn-ghost" onclick="window.location.reload()">
                    <i class="bi bi-arrow-clockwise me-1"></i> Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="bi bi-save me-1"></i> Simpan Nilai
                </button>
                <button type="button" class="btn btn-success" onclick="prosesNormalisasi()">
                    <i class="bi bi-arrow-repeat me-1"></i> Hitung Normalisasi
                </button>
                <a href="{{ route('ahp.results') }}" class="btn btn-info text-white">
                    <i class="bi bi-calculator me-1"></i> Lihat Hasil & CR
                </a>
            </div>
        </form>

        {{-- Area Hasil Perhitungan --}}
        <div id="section-perhitungan" style="display: none;" class="mt-5">
            <hr class="my-5">
            <h5 class="fw-bold mb-4 text-center">Hasil Analisis & Normalisasi AHP</h5>

            {{-- Tabel Normalisasi --}}
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="fw-bold mb-0">1. Matriks Normalisasi & Bobot</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-custom align-middle text-center mb-0" id="tableNormalisasi">
                            <thead>
                                <tr id="headNormalisasi">
                                    <th class="text-start">Kriteria</th>
                                    <th class="text-primary">Bobot (EV)</th>
                                </tr>
                            </thead>
                            <tbody id="bodyNormalisasi"></tbody>
                        </table>
                    </div>
                </div>
            </div>

            {{-- Tabel Konsistensi --}}
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="fw-bold mb-0">2. Rasio Konsistensi (CR)</h6>
                        </div>
                        <div class="card-body">
                            <table class="table table-custom mb-0">
                                <tr><td class="text-secondary">Banyak Kriteria (n)</td><td id="res_n" class="fw-bold text-end">0</td></tr>
                                <tr><td class="text-secondary">Lambda Max (λmax)</td><td id="res_lambda" class="fw-bold text-end">0</td></tr>
                                <tr><td class="text-secondary">Consistency Index (CI)</td><td id="res_ci" class="fw-bold text-end">0</td></tr>
                                <tr><td class="text-secondary">Random Index (RI)</td><td id="res_ri" class="fw-bold text-end">0</td></tr>
                                <tr style="background: var(--primary-light);">
                                    <td class="fw-bold">Consistency Ratio (CR)</td>
                                    <td id="res_cr" class="fw-bold text-end text-primary">0</td>
                                </tr>
                            </table>
                            <div id="status-cr" class="alert mt-3 mb-0 py-2 small text-center" style="border-radius: 8px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function prosesNormalisasi() {
    const n = {{ count($criterias) }};
    const criterias = {!! $criterias->pluck('nama_kriteria')->toJson() !!};
    let totals = [];

    for (let j = 0; j < n; j++) {
        let t = parseFloat($(`#total_col_${j}`).text());
        if (isNaN(t) || t === 0) { 
            alert('Total kolom masih nol. Pastikan semua input sudah terisi!'); 
            return; 
        }
        totals.push(t);
    }

    $('#bodyNormalisasi').empty();
    $('.extra-header').remove();
    criterias.forEach(nama => {
        $(`<th class="extra-header small text-uppercase text-secondary" style="background: #F8FAFC;">${nama}</th>`).insertBefore('#headNormalisasi th:last');
    });

    let bobotPrioritas = [];
    for (let i = 0; i < n; i++) {
        let sumBarisNormalisasi = 0;
        let rowHtml = `<tr><td class="fw-semibold small text-start" style="background: #F8FAFC;">${criterias[i]}</td>`;

        for (let j = 0; j < n; j++) {
            let nilaiAsli = 0;
            
            if (i === j) {
                nilaiAsli = 1;
            } else if (j > i) {
                nilaiAsli = parseFloat($(`select[data-row="${i}"][data-col="${j}"]`).val()) || 1;
            } else {
                nilaiAsli = parseFloat($(`#reciprocal_${i}_${j}`).data('raw-val')) || 0;
            }

            let nilaiNormalisasi = nilaiAsli / totals[j];
            sumBarisNormalisasi += nilaiNormalisasi;
            
            rowHtml += `<td>${nilaiNormalisasi.toFixed(3)}</td>`;
        }

        let ev = sumBarisNormalisasi / n; 
        bobotPrioritas.push(ev);
        rowHtml += `<td class="fw-bold text-primary" style="background: var(--primary-light);">${ev.toFixed(3)}</td></tr>`;
        $('#bodyNormalisasi').append(rowHtml);
    }

    let lambdaMax = 0;
    for (let j = 0; j < n; j++) {
        lambdaMax += totals[j] * bobotPrioritas[j];
    }

    let ci = (lambdaMax - n) / (n - 1);
    let riTable = {1: 0, 2: 0, 3: 0.58, 4: 0.9, 5: 1.12, 6: 1.24, 7: 1.32, 8: 1.41, 9: 1.45};
    let ri = riTable[n] || 1.45;
    let cr = (ri > 0) ? ci / ri : 0;

    $('#res_lambda').text(lambdaMax.toFixed(4));
    $('#res_ci').text(ci.toFixed(4));
    $('#res_cr').text(cr.toFixed(4));

    let statusBox = $('#status-cr');
    statusBox.removeClass('alert-success alert-danger');
    if (cr <= 0.1) {
        statusBox.addClass('alert-success').html('<b>KONSISTEN:</b> Nilai CR memenuhi syarat (≤ 0.1)');
    } else {
        statusBox.addClass('alert-danger').html('<b>TIDAK KONSISTEN:</b> Nilai CR > 0.1, periksa kembali input Anda.');
    }

    $('#section-perhitungan').fadeIn();
}

$(document).ready(function() {
    function updateAHP() {
        $('.select-ratio').each(function() {
            let val = parseFloat($(this).val());
            let row = $(this).data('row');
            let col = $(this).data('col');
            
            let reciprocal = 1 / val;
            
            $(`#reciprocal_${col}_${row}`).val(reciprocal.toFixed(3)).data('raw-val', reciprocal);
        });
        calculateTotals();
    }

    function calculateTotals() {
        let n = {{ count($criterias) }};
        for (let j = 0; j < n; j++) {
            let total = 0;
            for (let i = 0; i < n; i++) {
                let cellVal = 0;
                if (i === j) {
                    cellVal = 1;
                } else if (j > i) {
                    cellVal = parseFloat($(`select[data-row="${i}"][data-col="${j}"]`).val()) || 1;
                } else {
                    cellVal = parseFloat($(`#reciprocal_${i}_${j}`).data('raw-val')) || 0;
                }
                total += cellVal;
            }
            $(`#total_col_${j}`).text(total.toFixed(3));
        }
    }

    $('.select-ratio').on('change', updateAHP);
    updateAHP();
});
</script>
@endpush
