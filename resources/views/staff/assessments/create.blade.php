@extends('layouts.app')

@section('header', 'Form Penilaian AHP')
@section('title', 'Tambah Penilaian')

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-8">
        
        {{-- Asset Info --}}
        <div class="card mb-4">
            <div class="card-body p-4">
                <div class="d-flex align-items-center">
                    <div class="stat-icon primary me-3">
                        <i class="bi bi-laptop"></i>
                    </div>
                    <div>
                        <h5 class="fw-bold mb-1">{{ $asset->nama_perangkat }}</h5>
                        <div class="text-secondary mb-0">
                            <span class="fw-semibold text-primary">{{ $asset->kode_aset }}</span> &bull; 
                            <i class="bi bi-geo-alt mx-1"></i>{{ $asset->location->nama_lokasi }}
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Assessment Form --}}
        <div class="card">
            <div class="card-header">
                <h5 class="fw-bold mb-0"><i class="bi bi-list-check me-2 text-primary"></i>Kriteria Kondisi</h5>
                <small class="text-muted">Pilih satu sub-kriteria yang paling menggambarkan kondisi perangkat.</small>
            </div>
            
            <form action="{{ route('staff.assessments.store') }}" method="POST">
                @csrf
                <input type="hidden" name="asset_id" value="{{ $asset->id }}">
                
                <div class="card-body">
                    @foreach($criterias as $kriteria)
                    <div class="mb-4 p-0 rounded-3 border overflow-hidden">
                        <div class="p-3" style="background: #F8FAFC; border-bottom: 1px solid var(--border-color);">
                            <label class="fw-bold mb-0">
                                {{ $loop->iteration }}. {{ $kriteria->nama_kriteria }}
                            </label>
                        </div>
                        
                        <div class="p-2">
                            @foreach($kriteria->subCriterias as $sub)
                            <div class="col-12 mb-2">
                                <div class="form-check p-0">
                                    <input class="form-check-input visually-hidden" type="radio" 
                                            name="criteria[{{ $kriteria->id }}]" 
                                            id="sub_{{ $sub->id }}" 
                                            value="{{ $sub->nilai }}" 
                                            required>
                                    
                                    <label class="form-check-label d-flex align-items-center p-3 border rounded-3 w-100 assessment-option" 
                                        for="sub_{{ $sub->id }}">
                                        
                                        <div class="me-3 d-flex align-items-center">
                                            <i class="bi bi-circle text-muted icon-uncheck fs-5"></i>
                                            <i class="bi bi-check-circle-fill text-primary d-none icon-check fs-5"></i>
                                        </div>
                                        
                                        <div class="w-100">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <span class="d-block fw-bold mb-0">{{ $sub->nama_sub }}</span>
                                                <span class="badge bg-light text-dark">Skor: {{ $sub->nilai }}</span>
                                            </div>
                                            @if(isset($sub->deskripsi))
                                            <p class="mb-0 mt-1 text-secondary" style="font-size: 0.8125rem;">
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
                
                <div class="card-footer d-flex justify-content-end gap-2">
                    <a href="{{ route('staff.assessments.index') }}" class="btn btn-ghost">Batal</a>
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-calculator me-2"></i> Simpan Penilaian
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .form-check-input:checked + .form-check-label {
        background-color: var(--primary-light);
        border-color: var(--primary) !important;
    }
    .form-check-input:checked + .form-check-label .icon-uncheck {
        display: none;
    }
    .form-check-input:checked + .form-check-label .icon-check {
        display: inline-block !important;
    }
    .form-check-label:hover {
        background-color: #F8FAFC;
    }
</style>
@endsection
