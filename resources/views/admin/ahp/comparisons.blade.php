@extends('layouts.app')

@section('header', 'Proses AHP: Perbandingan Kriteria')
@section('title', 'Perbandingan Kriteria')

@section('content')
<div class="container-fluid">
    {{-- Info Card --}}
    <div class="alert alert-primary border-0 shadow-sm rounded-4 mb-4 d-flex align-items-center p-3">
        <div class="bg-primary bg-opacity-10 p-3 rounded-3 me-3">
            <i class="bi bi-info-circle-fill text-primary fs-4"></i>
        </div>
        <div>
            <h6 class="fw-bold mb-1">Panduan Pengisian</h6>
            <p class="small mb-0 opacity-75">
                Isi nilai perbandingan pada sisi kanan (diagonal atas). Nilai kebalikan (sisi kiri) dan jumlah akan dihitung secara otomatis oleh sistem.
            </p>
        </div>
    </div>

    <div class="card border-0 shadow-sm rounded-4 bg-white overflow-hidden">
        <div class="card-header bg-white border-0 pt-4 px-4 d-flex justify-content-between align-items-center">
            <div>
                <h5 class="fw-bold mb-0 text-dark">
                    <i class="bi bi-grid-3x3-gap-fill me-2 text-primary"></i>Matriks Perbandingan Berpasangan
                </h5>
            </div>
            <div class="badge bg-light text-primary border px-3 py-2 rounded-pill">
                Skala Saaty 1-9
            </div>
        </div>

        <div class="card-body p-4">
            <form action="{{ route('ahp.store_comparisons') }}" method="POST">
                @csrf
                <div class="table-responsive rounded-3 border">
                    <table class="table table-hover align-middle mb-0 text-center" id="matriksAHP">
                        <thead class="bg-primary text-white">
                            <tr>
                                <th class="py-3 px-4 border-bottom-0">KRITERIA</th>
                                @foreach($criterias as $c)
                                    <th class="py-3 border-bottom-0 text-uppercase small fw-bolder">{{ $c->nama_kriteria }}</th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($criterias as $row => $cri_row) {{-- Perulangan Baris --}}
                            <tr>
                                <td class="bg-primary bg-opacity-10 fw-bold text-primary border-end text-uppercase small">
                                    {{ $cri_row->nama_kriteria }}
                                </td>
                                
                                @foreach($criterias as $col => $cri_col) {{-- Perulangan Kolom --}}
                                    @php
                                        $isDiagonal = $row == $col;
                                        $isUpper = $col > $row;

                                        // Mengambil data tersimpan
                                        $existing = $comparisons->where('criteria_id1', $cri_row->id)
                                                                ->where('criteria_id2', $cri_col->id)
                                                                ->first();
                                        $currentVal = $existing ? $existing->nilai : 1;
                                    @endphp

                                    <td class="p-2">
                                        @if($isDiagonal)
                                            <input type="text" class="form-control form-control-sm border-0 text-center bg-light fw-bold" value="1" readonly>
                                        @elseif($isUpper)
                                            <select name="ratio[{{ $cri_row->id }}][{{ $cri_col->id }}]" 
                                                    class="form-select form-select-sm border-primary border-opacity-25 shadow-sm select-ratio" 
                                                    data-row="{{ $row }}" data-col="{{ $col }}">
                                                
                                                {{-- Angka Bulat --}}
                                                @for ($i = 1; $i <= 9; $i++)
                                                    <option value="{{ $i }}" {{ $currentVal == $i ? 'selected' : '' }}>{{ $i }}</option>
                                                @endfor

                                                {{-- Angka Pecahan (Presisi Tinggi) --}}
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
                                                class="form-control form-control-sm border-0 text-center bg-light text-muted" value="0" readonly>
                                        @endif
                                    </td>
                                @endforeach {{-- Tutup Perulangan Kolom --}}
                            </tr>
                            @endforeach {{-- Tutup Perulangan Baris --}}
                        </tbody>
                        <tfoot class="table-light border-top">
                            <tr class="fw-bold">
                                <td class="text-uppercase small text-dark">Jumlah Total</td>
                                @foreach($criterias as $col => $c)
                                    <td id="total_col_{{ $col }}" class="text-primary fs-6">0</td>
                                @endforeach
                            </tr>
                        </tfoot>
                    </table>
                </div>

                <div class="d-flex justify-content-end gap-2 mt-4">
                    <button type="button" class="btn btn-outline-secondary rounded-3 px-4 shadow-sm" onclick="window.location.reload()">
                        <i class="bi bi-arrow-clockwise me-1"></i> Reset
                    </button>
                    <button type="submit" class="btn btn-primary rounded-3 px-4 shadow-sm">
                        <i class="bi bi-save me-1"></i> Simpan Nilai Kriteria
                    </button>
                   <button type="button" class="btn btn-success rounded-3 px-4 shadow-sm" onclick="prosesNormalisasi()">
                        <i class="bi bi-arrow-repeat me-1"></i> Hitung Normalisasi
                    </button>
                    <a href="{{ route('ahp.results') }}" class="btn btn-info text-white rounded-3 px-4 shadow-sm">
                        <i class="bi bi-calculator me-1"></i> Lihat Hasil & CR
                    </a>
                </div>
            </form>
            {{-- Area Hasil Perhitungan (Awalnya Tersembunyi) --}}
                <div id="section-perhitungan" style="display: none;" class="mt-5">
                    <hr class="my-5">
                    <h4 class="fw-bold mb-4 text-center">Hasil Analisis & Normalisasi AHP</h4>

                    {{-- Tabel Normalisasi --}}
                    <div class="card border-0 shadow-sm rounded-4 mb-4">
                        <div class="card-header bg-white border-0 pt-4 px-4">
                            <h5 class="fw-bold mb-0">1. Matriks Normalisasi & Bobot</h5>
                        </div>
                        <div class="card-body p-4">
                            <div class="table-responsive">
                                <table class="table table-bordered align-middle text-center" id="tableNormalisasi">
                                    <thead class="table-light">
                                        <tr id="headNormalisasi">
                                            <th>Kriteria</th>
                                            {{-- Kolom Kriteria akan diisi JS --}}
                                            <th class="bg-primary text-white">Bobot (EV)</th>
                                        </tr>
                                    </thead>
                                    <tbody id="bodyNormalisasi">
                                        {{-- Baris akan diisi JS --}}
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    {{-- Tabel Konsistensi --}}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card border-0 shadow-sm rounded-4">
                                <div class="card-header bg-white border-0 pt-4 px-4">
                                    <h5 class="fw-bold mb-0">2. Rasio Konsistensi (CR)</h5>
                                </div>
                                <div class="card-body p-4">
                                    <table class="table table-sm">
                                        <tr><td>Banyak Kriteria (n)</td><td id="res_n" class="fw-bold text-end">0</td></tr>
                                        <tr><td>Lambda Max (λmax)</td><td id="res_lambda" class="fw-bold text-end">0</td></tr>
                                        <tr><td>Consistency Index (CI)</td><td id="res_ci" class="fw-bold text-end">0</td></tr>
                                        <tr><td>Random Index (RI)</td><td id="res_ri" class="fw-bold text-end">0</td></tr>
                                        <tr class="table-primary">
                                            <td class="fw-bold">Consistency Ratio (CR)</td>
                                            <td id="res_cr" class="fw-bold text-end">0</td>
                                        </tr>
                                    </table>
                                    <div id="status-cr" class="alert mt-3 mb-0 py-2 small text-center"></div>
                                </div>
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
// Kita buat fungsi di luar document.ready agar bisa dipanggil oleh atribut onclick HTML
function prosesNormalisasi() {
    const n = {{ count($criterias) }};
    const criterias = {!! $criterias->pluck('nama_kriteria')->toJson() !!};
    let totals = [];

    // 1. Ambil Total Kolom (Pastikan total kolom sudah akurat)
    for (let j = 0; j < n; j++) {
        let t = parseFloat($(`#total_col_${j}`).text());
        if (isNaN(t) || t === 0) { 
            alert('Total kolom masih nol. Pastikan semua input sudah terisi!'); 
            return; 
        }
        totals.push(t);
    }

    // 2. Reset Tabel Normalisasi
    $('#bodyNormalisasi').empty();
    $('.extra-header').remove();
    criterias.forEach(nama => {
        $(`<th class="extra-header small bg-light text-uppercase">${nama}</th>`).insertBefore('#headNormalisasi th:last');
    });

    // 3. Hitung Normalisasi & Rata-rata (Bobot)
    let bobotPrioritas = [];
    for (let i = 0; i < n; i++) {
        let sumBarisNormalisasi = 0; // Reset total baris untuk setiap kriteria i
        let rowHtml = `<tr><td class="fw-bold small bg-light text-start text-uppercase">${criterias[i]}</td>`;

        for (let j = 0; j < n; j++) {
            let nilaiAsli = 0;
            
            // Mengambil nilai matriks asli (A)
            if (i === j) {
                nilaiAsli = 1;
            } else if (j > i) {
                nilaiAsli = parseFloat($(`select[data-row="${i}"][data-col="${j}"]`).val()) || 1;
            } else {
                // Sisi bawah diagonal menggunakan raw-val (1/n) untuk akurasi tinggi
                nilaiAsli = parseFloat($(`#reciprocal_${i}_${j}`).data('raw-val')) || 0;
            }

            // Normalisasi: nilai sel / total kolom
            let nilaiNormalisasi = nilaiAsli / totals[j];
            sumBarisNormalisasi += nilaiNormalisasi;
            
            rowHtml += `<td>${nilaiNormalisasi.toFixed(3)}</td>`;
        }

        // Hitung Rata-rata (Bobot Eigenvector)
        // Rumus: Total baris hasil normalisasi / jumlah kriteria (n)
        let ev = sumBarisNormalisasi / n; 
        
        bobotPrioritas.push(ev);
        rowHtml += `<td class="bg-primary bg-opacity-10 fw-bold text-primary">${ev.toFixed(3)}</td></tr>`;
        $('#bodyNormalisasi').append(rowHtml);
    }

    // 4. Hitung Lambda Max, CI, dan CR untuk validasi skripsi
    let lambdaMax = 0;
    for (let j = 0; j < n; j++) {
        // Lambda Max = jumlah (Total Kolom Asli * Bobot Kriteria)
        lambdaMax += totals[j] * bobotPrioritas[j];
    }

    let ci = (lambdaMax - n) / (n - 1);
    let riTable = {1: 0, 2: 0, 3: 0.58, 4: 0.9, 5: 1.12, 6: 1.24, 7: 1.32, 8: 1.41, 9: 1.45};
    let ri = riTable[n] || 1.45;
    let cr = (ri > 0) ? ci / ri : 0;

    // 5. Tampilkan ke UI
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
    // Fungsi untuk update nilai kebalikan (1/n)
    function updateAHP() {
        $('.select-ratio').each(function() {
            let val = parseFloat($(this).val());
            let row = $(this).data('row');
            let col = $(this).data('col');
            
            let reciprocal = 1 / val;
            
            // Simpan nilai asli di data-raw-val agar perhitungan normalisasi lebih presisi
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

    // Event listener saat dropdown berubah
    $('.select-ratio').on('change', updateAHP);
    
    // Inisialisasi awal
    updateAHP();
});
</script>
@endpush