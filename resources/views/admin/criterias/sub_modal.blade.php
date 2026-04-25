<div class="modal fade" id="subModal{{ $criteria->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content border-0 rounded-4">
            <div class="modal-header border-0">
                <h5 class="fw-bold">Bobot Nilai: {{ $criteria->nama_kriteria }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body px-4">
                {{-- Form Tambah Bobot --}}
                <form action="{{ route('criterias.storeSub') }}" method="POST" class="row g-2 mb-4 bg-light p-3 rounded-3">
                    @csrf
                    <input type="hidden" name="criteria_id" value="{{ $criteria->id }}">
                    <div class="col-md-7">
                        <input type="text" name="nama_sub" class="form-control border-0" placeholder="Nama Sub-Kriteria (ex: Bagus / < 2 Tahun)" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="nilai" class="form-control border-0" placeholder="Nilai (1-5)" step="0.01" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus"></i></button>
                    </div>
                </form>

                {{-- Tabel Daftar Bobot --}}
                <table class="table table-sm">
                    <thead>
                        <tr class="small text-muted">
                            <th>Nama Sub-Kriteria</th>
                            <th>Nilai Bobot</th>
                            <th class="text-end">Hapus</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($criteria->subCriterias as $sub)
                        <tr>
                            <td>{{ $sub->nama_sub }}</td>
                            <td><span class="badge bg-secondary">{{ $sub->nilai }}</span></td>
                            <td class="text-end">
                                <form action="{{ route('criterias.destroySub', $sub->id) }}" method="POST">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger p-0" onclick="return confirm('Hapus bobot ini?')">
                                        <i class="bi bi-x-circle"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>