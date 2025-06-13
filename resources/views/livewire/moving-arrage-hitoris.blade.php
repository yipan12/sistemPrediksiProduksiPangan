
<div class="container">
    <div class="container mb-3 card border-0 shadow-sm">
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
    <div class="table-responsive card-body p-0 shadow-sm">
        <h5 class=" poppins fs-4 mb-3 p-2"><i class="bi bi-calendar-week text-primary"></i> Data Riwayat Prediksi</h5>
    <table class="table align-middle mb-0 ">
            <thead class="table-primary">
                <tr class="text-center">
                    <th class="text-center">No</th>
                    <th class="text-start"><i class="bi bi-box me-2 fs-5"></i>Produk</th>
                    <th>
                        <div>
                            Produksi
                        <small class="d-block text-muted">Periode 1</small>
                        </div>
                    </th>
                    <th>
                        <div>
                            Produksi
                        <small class="d-block text-muted">Periode 1</small>
                        </div>
                    </th>
                    <th>
                        <div>
                            Produksi
                        <small class="d-block text-muted">Periode 1</small>
                        </div>
                    </th>
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
            @foreach ($historis as $key => $data )

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
                <td class="text-center">{{ $historis->total() - $historis->firstItem() - $key + 1 }}</td>
               <td class="text-start">
                    <div class="d-flex align-items-center  gap-2">
                        <i class="bi bi-box fs-5 text-primary"></i>
                        <span class="fw-semibold">{{ $data->produk }}</span>
                    </div>
                </td>
                <td>
                    <span class="badge bg-light text-dark">{{ $data->jumlah_1 }} Kg</span>
                </td>
                <td>
                    <span class="badge bg-light text-dark">{{ $data->jumlah_2 }} Kg</span>
                </td>
                <td>
                    <span class="badge bg-light text-dark">{{ $data->jumlah_3 }} Kg</span>
                </td>
                <td>
                    <span class="badge bg-success ">{{ $data->prediksi }} Kg</span>
                </td>
                <td class="text-center">
                    <div class="d-inline-flex align-items-center justify-content-center gap-2 px-2 py-1 rounded"
                        style="background-color: {{ $warnaBg }}; color: {{ $text }};">
                        <i class="bi {{ $ikon }}"></i>
                        <span>{{ $data->akurasi > 0 ? $data->akurasi . '%' : '-' }}</span>
                    </div>
                </td>
                <td class="text-center">
                    <span>{{ $data->tanggal_prediksi->format('Y-m-d') }}</span>
                </td>
                <td><span class="badge bg-info">{{ $data->periode_prediksi }}</span></td>
                <td>
                    <form action="{{ route('hapusMaIndex', $data->id) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit" onclick="confirm('yakin mau hapus?')" class="btn btn-danger" >
                            <i class="bi bi-trash"></i> 
                        </button>
                    </form>
                </td>
            </tr>    
            @endforeach
        </tbody>
    </table>

    <div class="d-flex justify-content-end active ">
    {{ $historis->links() }}
    </div>
    </div>
</div>