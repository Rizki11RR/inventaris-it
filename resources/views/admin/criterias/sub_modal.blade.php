<div class="modal fade" id="subModal{{ $criteria->id }}" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title fw-bold">Bobot Nilai: {{ $criteria->nama_kriteria }}</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                {{-- Form Tambah Bobot --}}
                <form action="{{ route('criterias.storeSub') }}" method="POST" class="row g-2 mb-4 p-3 bg-light rounded-3">
                    @csrf
                    <input type="hidden" name="criteria_id" value="{{ $criteria->id }}">
                    <div class="col-md-7">
                        <input type="text" name="nama_sub" class="form-control" placeholder="Nama Sub-Kriteria (ex: Bagus / < 2 Tahun)" required>
                    </div>
                    <div class="col-md-3">
                        <input type="number" name="nilai" class="form-control" placeholder="Nilai (1-5)" step="0.01" required>
                    </div>
                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100"><i class="bi bi-plus"></i></button>
                    </div>
                </form>

                {{-- Tabel Daftar Bobot --}}
                <div class="table-responsive">
                    <table class="table table-custom align-middle mb-0">
                        <thead>
                            <tr>
                                <th class="text-start">Sub-Kriteria</th>
                                <th class="text-center">Nilai</th>
                                <th class="text-end" style="width: 80px;">Hapus</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($criteria->subCriterias as $sub)
                            <tr>
                                <td class="text-start">{{ $sub->nama_sub }}</td>
                                <td class="text-center">
                                    <span class="badge bg-primary-subtle text-primary">{{ $sub->nilai }}</span>
                                </td>
                                <td class="text-end">
                                    <form action="{{ route('criterias.destroySub', $sub->id) }}" method="POST">
                                        @csrf @method('DELETE')
                                        <button type="submit" class="btn btn-ghost btn-sm text-danger" onclick="return confirm('Hapus bobot ini?')">
                                            <i class="bi bi-x-lg"></i>
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
</div>
