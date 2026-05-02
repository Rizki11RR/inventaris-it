@extends('layouts.app')

@section('header', 'Form Penilaian AHP')
@section('title', 'Tambah Penilaian')

@section('content')
<div class="container-fluid py-3">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            
            <div class="mb-4 shadow-sm" style="background-color: #f8f9fa; border: 1px solid #dee2e6; border-radius: 1rem;">
                <div class="p-4 d-flex align-items-center">
                    <div class="bg-primary text-white rounded-circle d-flex justify-content-center align-items-center me-4 shadow-sm" style="width: 60px; height: 60px;">
                        <i class="bi bi-laptop fs-3"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1 text-dark">{{ $asset->nama_perangkat }}</h5>
                        <p class="mb-0 text-secondary">
                            <i class="bi bi-upc-scan me-2"></i><span class="fw-semibold text-primary">{{ $asset->kode_aset }}</span> &bull; 
                            <i class="bi bi-geo-alt mx-1"></i>{{ $asset->location->nama_lokasi }}
                        </p>
                    </div>
                </div>
            </div>

            <div class="card border-0 shadow-sm">
                <div class="card-header bg-white border-0 pt-4 pb-2 px-4">
                    <h5 class="fw-bold text-dark mb-0"><i class="bi bi-list-check me-2 text-primary"></i> Kriteria Kondisi</h5>
                    <small class="text-muted">Pilih satu sub-kriteria yang paling menggambarkan kondisi perangkat.</small>
                </div>
                
                <form action="{{ route('staff.assessments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                    
                    <div class="card-body px-4 pb-4">
                        @foreach($criterias as $kriteria)
                        <div class="mb-4 p-0 bg-white rounded-4 border overflow-hidden">
                            <div class="bg-light p-3 border-bottom">
                                <label class="fw-bold text-dark mb-0">
                                    {{ $loop->iteration }}. {{ $kriteria->nama_kriteria }}
                                </label>
                            </div>
                            
                            <div class="p-2">
                                @foreach($kriteria->subCriterias as $sub)
                                <div class="col-12 mb-2">
                                    <div class="form-check custom-option p-0">
                                        <input class="form-check-input visually-hidden" type="radio" 
                                                name="criteria[{{ $kriteria->id }}]" 
                                                id="sub_{{ $sub->id }}" 
                                                value="{{ $sub->nilai }}" 
                                                required>
                                            
                                        <label class="form-check-label d-flex align-items-center p-3 border rounded-3 w-100" 
                                            for="sub_{{ $sub->id }}" 
                                            style="cursor: pointer; transition: 0.2s;">
                                            
                                            <div class="me-3 d-flex align-items-center">
                                                <i class="bi bi-circle text-muted icon-uncheck fs-5"></i>
                                                <i class="bi bi-check-circle-fill text-primary d-none icon-check fs-5"></i>
                                            </div>
                                            
                                            <div class="w-100">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <span class="d-block fw-bold text-dark mb-0">{{ $sub->nama_sub }}</span>
                                                    <span class="badge bg-light text-dark border px-2 py-1">Skor: {{ $sub->nilai }}</span>
                                                </div>
                                                
                                                @if(isset($sub->deskripsi))
                                                <p class="mb-0 mt-1 text-secondary" style="font-size: 0.85rem;">
                                                    {{ $sub->deskripsi }}
                                                </p>
                                                @endif
                                                
                                            </div>
                                        </label>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endforeach
                    </div>
                    
                    <div class="card-footer bg-white border-top-0 px-4 pb-4 text-end">
                        <a href="{{ route('staff.assessments.index') }}" class="btn btn-light border rounded-pill px-4 me-2">Batal</a>
                        <button type="submit" class="btn btn-primary rounded-pill px-5 shadow-sm fw-bold">
                            <i class="bi bi-calculator me-2"></i> Simpan Penilaian
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>

<style>
    /* Styling agar pilihan yang diklik berubah warna */
    .form-check-input:checked + .form-check-label {
        background-color: #eef4ff;
        border-color: #0d6efd !important;
    }
    .form-check-input:checked + .form-check-label .icon-uncheck {
        display: none;
    }
    .form-check-input:checked + .form-check-label .icon-check {
        display: inline-block !important;
    }
    .form-check-label:hover {
        background-color: #f8f9fa;
    }
</style>
@endsection