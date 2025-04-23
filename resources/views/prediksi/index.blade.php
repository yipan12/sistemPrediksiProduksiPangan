@extends('layouts.app')
@section('content')
<div class="container mt-4">

    {{-- CHART SECTION --}}
    <div class="card">
        <div class="card-header bg-dark text-white">
            <strong>Visualisasi Prediksi (Moving Average)</strong>
        </div>
        <div class="card-body">
            <canvas id="chartPrediksi"></canvas>
        </div>
    </div>

    {{-- FORM SECTION --}}
    <div class="card">
        <div class="card-header  text-white">
            <strong>Form Prediksi Komoditas</strong>
        </div>
        <div class="card-body">
            <form action="{{ route('prediksi-pangan2') }}" method="POST">
                @csrf
                <div class="form-group mb-3">
                    <label for="produksi">Pilih Komoditas</label>
                    <select name="produk" class="form-control" required>
                        <option value="">--- Pilih Komoditas ---</option>
                        @foreach ($komoditas as $item)
                            <option value="{{ $item }}" {{ old('produk') == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Prediksi</button>
            </form>
        </div>
    </div>

</div>

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    @if(isset($dataTerakhir) && isset($prediksi))
    const ctx = document.getElementById('chartPrediksi').getContext('2d');
    const chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: {!! json_encode(collect($dataTerakhir)->map(function($item, $index) {
    return 'Data ' . ($index + 1);
})->toArray()) !!},

            datasets: [
                {
                    label: 'Data Historis',
                    data: {!! json_encode(array_values($dataTerakhir->toArray())) !!},
                    borderColor: 'rgba(75, 192, 192, 1)',
                    tension: 0.4
                },
                {
                    label: 'Prediksi Berikutnya',
                    data: [...Array({{ count($dataTerakhir) - 1 }}).fill(null), {{ $prediksi }}],
                    borderColor: 'rgba(255, 99, 132, 1)',
                    borderDash: [5, 5],
                    tension: 0.4
                }
            ]
        }
    });
    @endif
</script>
@endsection
