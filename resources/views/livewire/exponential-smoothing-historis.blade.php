<div class="container">
    <div class="card row mb-3 shadow-sm border-0">
            <div class="card-body row">
                {{-- kolom pencarian --}}
                <div class="col-md-4">
                    <strong class="poppins mb-2">Cari Produk</strong>
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-search"></i></span>
                    <input type="text" wire:model.live="search" placeholder="Cari Produk..." class="form-control form-control-sm">
                </div>

                    {{-- Loading State --}}
                    <div wire:loading class="text-center py-2">
                        <div class="spinner-border spinner-border-sm" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                        <span class="ms-2">Mencari data...</span>
                    </div>
                </div>
                {{-- akhir kolom pencarian --}}
                {{-- filter akurasi --}}
                <div class="col-md-4">
                    <label for="akurasi" class="poppins fw-bold mb-0">Filter akurasi</label>
                    <select wire:model.live="akurasi" id="akurasi" class="form-select">
                        <option value="">-- Semua Akurasi --</option>
                        <option value="90">≥ 90%</option>
                        <option value="70">≥ 70%</option>
                        <option value="40">≥ 40%</option>
                    </select>
                </div>
                {{-- filter periode --}}
                <div class="col-md-4">
                    <label for="periode" class="poppins mb-0 fw-bold">Filter Periode</label>
                    <select id="periode" class="form-select" wire:model.live="periode">
                        <option value="">-- Semua Periode --</option>
                        <option value="3_bulan">3 Bulan Terakhir</option>
                        <option value="6_bulan">6 Bulan Terakhir</option>
                        <option value="1_tahun">1 Tahun Terakhir</option>
                    </select>
                </div>
            </div>
        </div>
    {{-- tabel --}}
       <div class="table-responsive card-body p-0 shadow-sm mb-0">
        <h5 class=" poppins fs-4 mb-3 p-2"><i class="bi bi-calendar-week text-primary"></i> Data Riwayat Prediksi</h5>
        <table class=" table align-middle mb-0">
            <thead class="table-primary">
                <tr class="text-center">
                    <th>No</th>
                    <th class="text-start"> <i class="bi bi-box fs-5 me-2"></i> Produk</th>
                    <th class="text-center fw-semibold" style="width: 120px"><i class="bi bi-graph-up me-1"></i> Hasil Prediksi</th>
                     <th class="text-center fw-semibold">
                    <i class="bi bi-speedometer" style="width: 100px"></i> Akurasi</th>
                     <th class="text-center" style="width: 130px">
                    <i class="bi bi-calendar-week" ></i> Tanggal</th>
                    <th style="width: 120px">Target</th>
                   <th>
                    <i class="bi bi-gear"></i> Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $historis as $key => $data  )
                 @php
        $warnaBg = '';
        $ikon = '';
        $text = '';

        if ($data->akurasi > 80) {
            $warnaBg = '#d4f8d4'; // hijau muda
            $ikon = 'bi-check-circle-fill';
            $text = '#2e8b57'; // hijau teks
        } elseif ($data->akurasi >= 70) {
            $warnaBg = '#fff7d1'; // kuning muda
            $ikon = 'bi-exclamation-circle-fill';
            $text = '#e8c156'; // kuning teks
        } elseif ($data->akurasi > 0) {
            $warnaBg = '#ffe5e5'; // merah muda
            $ikon = 'bi-x-circle-fill';
            $text = '#e85656'; // merah teks
        }
    @endphp

                <tr class="text-center">
                    <td>{{ $historis->total() - $historis->firstItem() - $key + 1  }}</td>
                    <td class="text-start text-capitalize"> <i class="bi bi-box text-primary fs-5 me-2"></i> {{ $data->produk }}</td>
                    <td>{{ $data->prediksi }}</td>
                    <td class="text-center">
                        <div class="d-inline-flex align-items-center justify-content-center gap-2 px-2 py-1 rounded"
                            style="background-color: {{ $warnaBg }}; color: {{ $text }};">
                            <i class="bi {{ $ikon }}"></i>
                            <span>{{ $data->akurasi > 0 ? $data->akurasi . '%' : '-' }}</span>
                        </div>
                    </td>
                    <td>{{ $data->tanggal_prediksi }}</td>
                    <td >
                        <div class="badge bg-info">
                            {{ $data->periode_prediksi }}
                        </div>
                    </td>
                    <td>
                        <form action="{{ route('hapusLrIndex', $data->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('yakin hapus data ini?')" class="btn btn-danger">
                                <i class="bi bi-trash"></i>    
                            </button>    
                        </form>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
       </div>

    <div class="d-flex justify-content-end active ">
    {{ $historis->links() }}
    </div>
</div>
