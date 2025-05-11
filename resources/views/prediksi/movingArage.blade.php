@extends('layouts.app')
@section('content')
<div class="container mt-4">


    {{-- CHART SECTION --}}
    <div class="card">
        <div class="card-header bg-dark text-white">
            <strong>Visualisasi Prediksi (Moving Average)</strong>
        </div>
        <div class="card-body">
            <canvas width="600" height="300" id="chartPrediksi" style="max-width: 100%;"></canvas>
        </div>
   {{-- FORM SECTION --}}
        <div class="card-body row">
            <div class="col-md-6">
                <form action="{{ route('prediksi-pangan') }}" method="POST" class="w-50 ">
                    @csrf
                    <div class="form-group mb-3">
                        <label for="produksi">Pilih Komoditas</label>
                        <select name="produk" class="form-control" required >
                            <option value="">--- Pilih Komoditas ---</option>
                            @foreach ($komoditas as $item)
                                <option value="{{ $item }}" {{ old('produk') == $item ? 'selected' : '' }}>
                                    {{ $item }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary ">Prediksi</button>
                </form>
            </div>
            {{-- simpan prediksi --}}
            <div class="col-md-6 d-flex justify-content-end align-items-end">
                <form action="{{ route('simpanMovingArrage') }}" method="post" class="w-25">
                    @csrf
                    <input type="hidden" name="produk" value="{{ $produk }}">
                    <input type="hidden" name="jumlah_1" value="{{ $dataTerakhir[0] ?? '' }}">
                    <input type="hidden" name="jumlah_2" value="{{ $dataTerakhir[1] ?? '' }}">
                    <input type="hidden" name="jumlah_3" value="{{ $dataTerakhir[2] ?? '' }}">
                    <input type="hidden" name="prediksi" value="{{ $prediksi }}">
                    <button type="submit" class="btn btn-success form-control">Simpan</button>
                </form>
            </div>
        </div>
</div>

</div>

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    const ctx = document.getElementById('chartPrediksi').getContext('2d');
    
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(
                    collect($dataTerakhir)->map(function($item, $index) {
                        return 'Data ' . ($index + 1);
                    })->toArray()
                ) !!},
            datasets: [
                {
                    label: 'Data Historis',
                    data: [],
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                },
                {
                    label: 'Prediksi Berikutnya',
                    data: [],
                    backgroundColor: 'rgba(255, 99, 132, 0.2)',
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderDash: [5, 5],
                    borderWidth: 1
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });

    @if(isset($dataTerakhir) && isset($prediksi))
        chart.data.labels = {!! json_encode(collect($dataTerakhir)->map(function($item, $index) {
            return 'Data ' . ($index + 1);
        })->toArray()) !!};
        
        chart.data.datasets[0].data = {!! json_encode(array_values($dataTerakhir->toArray())) !!};
        chart.data.datasets[1].data = [...Array({{ count($dataTerakhir) - 1 }}).fill(null), {{ $prediksi }}];

        chart.update();
    @endif
</script>

@endsection
