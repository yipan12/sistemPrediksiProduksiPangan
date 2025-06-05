@extends('layouts.app')
@section('content')
<div class="container">
    {{-- eror kurang dari 3 --}}
    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show position-fixed top-0 start-50 translate-middle-x mt-3 shadow-sm" style="z-index: 1050; max-width: 500px;" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-exclamation-circle-fill me-2"></i>
                <ul class="mb-0 flex-grow-1">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {{-- akhir eror kurang dri 3 --}}
    {{-- CHART SECTION --}}
    <div class="card">
        <div class="card-header bg-dark text-white">
            <strong>Visualisasi Prediksi (Moving Average)</strong>
        </div>
        {{-- tab navigasi --}}
        <ul class="nav nav-tabs mt-2 ms-2 gap-2" id="chartTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link active" id="line-chart-tab" data-bs-toggle="tab" data-bs-target="#lineChartTab" type="button" role="tab" aria-controls="lineChartTab" aria-selected="true">Line chart</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link" id="bar-chart-tab" data-bs-toggle="tab" data-bs-target="#barChartTab" type="button" role="tab" aria-controls="barChartTab" aria-selected="false">Bar chart</button>
            </li>
        </ul>
        {{-- akhir tab navigasi --}}
        {{-- canvas --}}
        <div class="tab-content p-3" id="chartTabContent" style="min-height: 350px">
            <div class="tab-pane fade show active" id="lineChartTab" role="tabpanel" aria-labelledby="line-chart-tab">
                <canvas id="lineChart" width="600" height="300" style="max-width: 100%;"></canvas>
            </div>
            <div class="tab-pane fade" id="barChartTab" role="tabpanel" aria-labelledby="bar-chart-tab">
                <div style="height: 400px; position: relative;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
        </div>
        {{-- akhir canvas --}}
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
                    <button type="submit" class="btn btn-primary">Prediksi</button>
                </form>
            </div>
            {{-- simpan prediksi --}}
            <div class="col-md-6 d-flex justify-content-end align-items-end gap-3">
                <a href="{{ route('MovingarageIndex') }}" class="btn btn-success">Lihat Prediksi</a>
                <form action="{{ route('simpanMovingArrage') }}" method="post" class="w-25">
                    @csrf
                    <input type="hidden" name="produk" value="{{ $produk }}">
                    <input type="hidden" name="jumlah_1" value="{{ $dataTerakhir[0] ?? '' }}">
                    <input type="hidden" name="jumlah_2" value="{{ $dataTerakhir[1] ?? '' }}">
                    <input type="hidden" name="jumlah_3" value="{{ $dataTerakhir[2] ?? '' }}">
                    <input type="hidden" name="prediksi" value="{{ $prediksi }}">
                    <button type="submit" class="btn btn-success form-control">Simpan Prediksi</button>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Chart JS --}}
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const lineCtx = document.getElementById('lineChart').getContext('2d');
        const barCtx = document.getElementById('barChart').getContext('2d');

        const lineChart = new Chart(lineCtx, {
            type: 'line',
            data: {
                labels: [],
                datasets: [
                    {
                        label: 'Data Historis',
                        data: [],
                        backgroundColor: 'rgba(75, 192, 192, 0.2)',
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        tension: 0.3,
                        fill: false
                    },
                    {
                        label: 'Prediksi Berikutnya',
                        data: [],
                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                        borderColor: 'rgba(255, 99, 132, 1)',
                        borderDash: [5, 5],
                        borderWidth: 2,
                        tension: 0.3,
                        fill: false
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
        
        const barChart = new Chart(barCtx, {
            type: 'bar',
            data: {
                labels: [],
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
            const labels = [];
            @foreach($dataTerakhir as $index => $value)
                labels.push('Data {{ $index + 1 }}');
            @endforeach
            labels.push('Prediksi');
            
            const historisData = {!! json_encode(array_values($dataTerakhir->toArray())) !!};
            const prediksi = {{ $prediksi }};

            // Update data untuk line chart
            lineChart.data.labels = labels;
            lineChart.data.datasets[0].data = historisData.concat([null]);
            lineChart.data.datasets[1].data = [...Array(historisData.length).fill(null), prediksi];
            lineChart.update();

            // Update data untuk bar chart
            barChart.data.labels = labels;
            barChart.data.datasets[0].data = historisData.concat([null]);
            barChart.data.datasets[1].data = [...Array(historisData.length).fill(null), prediksi];
            barChart.update();
        @endif
    });
</script>
@endsection