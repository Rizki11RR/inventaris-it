@extends('layouts.app')

@section('header', 'Input Kondisi Perangkat')

@section('content')
<div class="container-fluid">
    <div class="row g-4">
        {{-- Detail Perangkat --}}
        <div class="col-md-4">
            <div class="card border-0 shadow-sm rounded-4 mb-4">
                <div class="card-header bg-white border-0 pt-4 px-4">
                    <h6 class="fw-bold mb-0">Informasi Perangkat</h6>
                </div>
                <div class="card-body px-4 pb-4">
                    <div class="mb-3">
                        <label class="small text-muted d-block">Kode Aset</label>
                        <span class="fw-bold">{{ $asset->kode_aset }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block">Nama Perangkat</label>
                        <span class="fw-bold text-primary">{{ $asset->nama_perangkat }}</span>
                    </div>
                    <div class="mb-3">
                        <label class="small text-muted d-block">Tanggal Pengadaan</label>
                        <span>{{ \Carbon\Carbon::parse($asset->tanggal_pengadaan)->format('d M Y') }}</span>
                    </div>
                    <div class="mb-0 text-muted small">
                        <i class="bi bi-info-circle me-1"></i> Penilaian ini akan diproses menggunakan metode AHP untuk menentukan rekomendasi kondisi akhir.
                    </div>
                </div>
            </div>
        </div>

        {{-- Form Penilaian --}}
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-4 overflow-hidden">
                <div class="card-header bg-primary text-white border-0 py-3 px-4">
                    <h5 class="fw-bold mb-0">Form Kriteria Penilaian</h5>
                </div>
                <div class="card-body p-4">
                    <form action="{{ route('staff.assessments.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="asset_id" value="{{ $asset->id }}">

                        @foreach($criterias as $criteria)
                        <div class="mb-4 p-3 rounded-4 border bg-light bg-opacity-50">
                            <label class="fw-bold mb-2 d-flex align-items-center">
                                <span class="badge bg-primary me-2">{{ $loop->iteration }}</span>
                                {{ $criteria->nama_kriteria }}
                            </label>
                            <p class="small text-muted mb-3">{{ $criteria->penjelasan ?? 'Berikan penilaian skala 1-5 berdasarkan kondisi riil perangkat.' }}</p>
                            
                            <div class="d-flex justify-content-between gap-2">
                                @foreach($criteria->subCriterias->sortBy('nilai') as $sub)
                                <div class="flex-fill">
                                    <input type="radio" class="btn-check" name="criteria[{{ $criteria->id }}]" 
                                           id="cri_{{ $criteria->id }}_{{ $sub->id }}" 
                                           value="{{ $sub->nilai }}" required>
                                    <label class="btn btn-outline-primary w-100 rounded-3 py-2 h-100 d-flex flex-column align-items-center justify-content-center shadow-sm" 
                                           for="cri_{{ $criteria->id }}_{{ $sub->id }}">
                                        <span class="fw-bold fs-5">{{ $sub->nilai }}</span>
                                        <small class="x-small text-center mt-1" style="font-size: 0.7rem;">{{ $sub->nama_sub_kriteria }}</small>
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach

                        <div class="mb-3">
                            <label class="fw-bold mb-2">Catatan Tambahan (Opsional)</label>
                            <textarea name="catatan" class="form-control rounded-3" rows="3" placeholder="Contoh: Baterai sudah drop, layar ada dead pixel..."></textarea>
                        </div>

                        <div class="text-end mt-4">
                            <a href="{{ route('staff.assets.index') }}" class="btn btn-light rounded-pill px-4 me-2 border">Batal</a>
                            <button type="submit" class="btn btn-primary rounded-pill px-5 shadow">
                                <i class="bi bi-calculator me-2"></i>Simpan & Proses AHP
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .btn-check:checked + .btn-outline-primary {
        background-color: var(--bs-primary);
        color: white;
        box-shadow: 0 4px 10px rgba(13, 110, 253, 0.3) !important;
    }
    .x-small {
        line-height: 1.1;
    }
</style>
@endsection