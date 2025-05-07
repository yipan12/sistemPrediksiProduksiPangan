@extends('layouts.app')
@section('content')
{{-- eror --}}
    @if (session('eror'))
        <div class="alert alert-danger">
            {{ session('eror') }}
        </div>
    @endif
    {{-- akhir eror --}}
<div class="container">
    <div class="card ">
        <div class="card-header bg-dark text-white">
            <strong>Visualisasi Prediksi (Linear Regresion)</strong>
        </div>
        <div class="card-body">
            <canvas width="600" height="300" id="chartPrediksi" style="max-width: 100%;"></canvas>
        </div>
        {{-- form section --}}
        <div class="card-body row">
            <div class="col-md-6">
                <form action="{{ route('prediksi-linear') }}" method="POST" class="w-50 ">
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
                <form action="" method="post" class="w-25">
                    @csrf
                    <label for="button">Simpan Prediksi</label>
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
            labels: [], // Kosong dulu
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

    @if(isset($dataRecords) && isset($prediksi))
        chart.data.labels = {!! json_encode($dataRecords->pluck('tanggal')->toArray()) !!};
        chart.data.datasets[0].data = {!! json_encode($dataRecords->pluck('jumlah')->toArray()) !!};
        chart.data.datasets[1].data = [...Array({{ count($dataRecords) - 1 }}).fill(null), {{ $prediksi }}];
        
        chart.update();
    @endif

</script>
    
@endsection