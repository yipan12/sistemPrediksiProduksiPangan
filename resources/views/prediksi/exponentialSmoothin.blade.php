@extends('layouts.app')
@section('content')
    {{-- eror --}}
    @if (session('eror'))
    <div class="alert alert-danger">
        {{ session('eror') }}
    </div>
    @endif
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    {{-- akhir eror --}}
    <div class="container">
        <div class="card">
            <div class="card-header bg-dark text-white">
                <strong>Visualisasi Prediksi (Exponential Smoothing)</strong>
            </div>
            {{-- tab navigasi visualisasi prediksi --}}
            <ul class="nav nav-tabs mt-2 ms-2 gap-2">
                <li class="nav-item" >
                    <button class="nav-link active" id="line-chart-tab" data-bs-toggle="tab" data-bs-target="#lineChartTab" type="button" role="tab" aria-controls="lineChartTab" aria-selected="true">Line chart</button>
                </li>
                <li class="nav-item" >
                    <button class="nav-link" id="bar-chart-tab" data-bs-toggle="tab" data-bs-target="#barChartTab" type="button" role="tab" aria-controls="barChartTab" aria-selected="true">Bar chart</button>
                </li>
            </ul>
            {{-- tab akhir navigasi prediksi visualisasi --}}
            {{-- canvas untk chart --}}
            <div class="tab-content p-3" style="min-height: 350px">
                <div class="tab-pane fade show active" id="lineChartTab" role="tabpanel" aria-labelledby="line-chart-tab">
                    <canvas id="lineChart" width="600" height="300"></canvas>
                </div>
                <div class="tab-pane fade" id="barChartTab" role="tabpanel" aria-labelledby="bar-chart-tab" style="height: 400px; position: relative;">
                    <canvas id="barChart"></canvas>
                </div>
            </div>
            {{-- akhir canvas --}}
            <div class="card-body row">
                {{-- form prediksi --}}
                <div class="col-md-6">
                    <form action="{{ route('expoPrediksi') }}" method="POST"  class="w-50">
                      @csrf
                      <div class="form-group mb-3">
                        <label for="optionPilih">Pilih Komoditas</label>
                        <select name="produk" class="form-control" required >
                            <option id="optionPilih" value="">--- Pilih Komoditas ---</option>  
                            @foreach ( $komoditas as $item )
                            <option value="{{ $item }}" {{ old('produk') == $item ? 'selected' : '' }}>
                                {{ $item }}
                            </option>
                            @endforeach
                        </select>
                      </div>  
                      <button type="submit" class="btn btn-primary">Prediksi</button>
                    </form>
                </div>
                {{-- form simpan --}}
                <div class="col-md-6 justify-content-end d-flex align-items-end gap-3">
                    <a href="{{ route('EsIndex') }}" class="btn btn-success">Lihat Prediksi</a>
                    <form action="{{ route('simpanEs') }}" method="POST" class="w-25">
                        @csrf
                        <input type="hidden" name="produk" value="{{ $produk ?? ($komoditas->first() ?? '') }}" >
                        <input type="hidden" name="prediksi" value="{{ $prediksi }}">
                        <button class="btn btn-success" type="submit">Simpan prediksi</button>
                    </form>
                </div>
            </div>
            
        </div>
    </div>
    {{-- chart logic --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- chart logic --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            lineCtx = document.getElementById('lineChart').getContext('2d');
            barCtx = document.getElementById('barChart').getContext('2d');

            const lineChart = new Chart(lineCtx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [
                        {
                            label: 'Data Historis',
                            data: [],
                            backgroundColor: 'rgba(75, 192, 192, 0.2)',
                            borderColor:  'rgba(75, 192, 192, 1)',
                            borderWidth: 2,
                            tension: 0.3,
                            fill: false
                        },
                        {
                            label: 'prediksi Selanjutnya',
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

        @if (isset($dataRecord) && isset($prediksi))
        const labels = {!! json_encode($dataRecord->pluck('tanggal')->toArray()) !!};
            const historisData = {!! json_encode($dataRecord->pluck('jumlah')->toArray()) !!};
            const prediksi = {{ $prediksi }};

            // Update data untuk line chart 
            lineChart.data.labels = labels.concat(['Prediksi']);
            lineChart.data.datasets[0].data = historisData.concat([null]);
            lineChart.data.datasets[1].data = [...Array(historisData.length).fill(null), prediksi];
            lineChart.update();

            // Update data untuk bar chart
            barChart.data.labels = labels.concat(['Prediksi']);
            barChart.data.datasets[0].data = historisData.concat([null]);
            barChart.data.datasets[1].data = [...Array(historisData.length).fill(null), prediksi];
            barChart.update();
        @endif
        });
    </script>
@endsection