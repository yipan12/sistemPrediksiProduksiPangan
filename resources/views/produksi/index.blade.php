@extends('layouts.app')
@section('body-class', 'customBg')
@section('content')

    @php
        function getColor($value) {
            if ($value >= 80) return 'bg-success';
            elseif ($value >= 50) return 'bg-warning';
            else return 'bg-danger';
        }
    @endphp

    {{-- header --}}
    <div class="row mb-3">
        <div class="col-12 ">
            <div class="card border-0 bg-gradient-success text-white">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-6">
                            <h1 class="poppins fs-4 ">History & perbandingan prediksi</h1>
                            <p>Kelola data produksi dan bandingakan hasil akurasi</p>
                        </div>
                        <div class="col-md-6  ">
                            <div class="d-flex justify-content-end gap-5 poppins">
                                <div class="">
                                    <h1 class="fs-5">Total Produksi</h1>
                                    <h1 class="fs-5">{{ $produksiPangan->total() }}</h1>
                                </div>
                                <div>
                                    <h1 class="fs-5">Akurasi tertinggi</h1>
                                    <h1 class="fs-5">{{ $perbandingan->max('akurasi_persen') }}%</h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir header --}}
    {{-- Moving arage tabel --}}
    <div class="container-fluid mb-5">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow-lg h-100  ">
                    <img src="{{ asset("/asset/movingarrage.png") }}" class="card-img-top w-75 mx-auto mt-4" alt="...">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fs-5 fw-bold">Moving Average</h5> 
                            <p class="btn skyblue-custoom text-white fw-bold">{{ $history }} Hasil Prediksi</p>
                        </div>
                        {{-- progres bar --}}
                         <small class="d-block mb-2 text-center mt-0">Akurasi : {{ number_format($rataRataPrediksi['moving_average'],2) }}% </small>
                        <div class="progress mb-2" style="height: 5px">
                            <div class="progress-bar {{ getColor($rataRataPrediksi['moving_average']) }}"
                                style="width: {{ $rataRataPrediksi['moving_average'] }}%">
                            </div>
                        </div>
                        {{-- akhir progres bar --}}
                        <p>Silahkan klik button “Lihat lebih” untuk melihat detail History prediksi</p>
                        <a href="{{ route('MovingarageIndex') }}" class="btn btn-success btn-sm">Lihat Lebih</a>
                    </div>
                </div>
            </div>
            {{-- linear regresion tabel --}}
            <div class="col-md-4">
                    <div class="card shadow-lg h-100 ">
                        <img src="{{ asset("/asset/undraw_users-per-minute_eg97.png") }}" class="card-img-top  mx-auto mt-5" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mt-4">
                                <h5 class="card-title fs-5 fw-bold">Linear Regresion</h5>
                                <p class="btn skyblue-custoom text-white fw-bold">{{ $historylr }}  Hasil Prediksi<p>
                            </div>
                            {{-- progres bar --}}
                            <small class="d-block mb-2 text-center mt-0">Akurasi : {{ number_format($rataRataPrediksi['linear_regression'],2) }}% </small>
                            <div class="progress mb-2" style="height: 5px">
                                <div class="progress-bar {{ getColor($rataRataPrediksi['linear_regression']) }}" style="width: {{ $rataRataPrediksi['linear_regression'] }}%">
                                </div>
                            </div>
                            {{-- akhir progres bar --}}
                            <p class="mt-1">Silahkan klik button “Lihat lebih” untuk melihat detail History prediksi</p>
                            <a href="{{ route('LrIndex') }}" class="btn btn-success btn-sm">Lihat Lebih</a>
                        </div>
                    
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-lg h-100 " >
                    <img src="{{ asset("/asset/exponential.png") }}" class="card-img-top mx-auto w-75 mt-4" alt="...">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="card-title fs-5 fw-bold">Exponential Smoothing</h5>
                            <button class="btn skyblue-custoom text-white fw-bold">{{ $historyEs }} Hasil Prediksi</button>
                        </div>
                        {{-- progres bar --}}
                        <small class="d-block mb-2 mt-3 text-center mt-0">Akurasi : {{ number_format($rataRataPrediksi['exponential_smoothing'],2) }}% </small>
                        <div class="progress " style="height: 5px">
                            <div class="progress-bar {{ getColor($rataRataPrediksi['exponential_smoothing']) }}" style="width: {{ $rataRataPrediksi['exponential_smoothing'] }}%">
                            </div>
                        </div>
                        {{-- akhir progres bar --}}
                        <p class="mt-3">Silahkan klik button “Lihat lebih” untuk melihat detail History prediksi</p>
                        <a href="{{ route('EsIndex') }}" class="btn btn-success btn-sm">Lihat Lebih</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- tabel --}}
    <div class="card card-body shadow mt-4  ">
        <livewire:produksi-pangan-table />
    </div>
    {{-- akhir tabel produksi --}}
    <div class="card card-body mt-3 shadow shadow-lg ">

        {{-- card info --}}
        <div class="container">
            <h1 class="fs-3 poppins ">Perbandingan Akurasi Prediksi</h1>
            <p class="text-muted">Analisis perbandingan metode prediksi berdasarkan akurasi</p>

            {{-- rata rata --}}
            <div class="row mb-4">
                <div class="col-4">
                    <div class="border border-1 rounded text-center py-3 shadow bg-light">
                        <h4 class="fs-5 ">Moving Average</h4>
                        <strong class="fs-5">{{ number_format($rataRataPrediksi['moving_average'],2) }} %</strong>
                        <small class="d-block text-muted">Akurasi rata-rata</small>
                    </div>
                </div>
                {{-- linear regresion --}}
                <div class="col-4">
                    <div class="border border-1 rounded text-center py-3 shadow bg-light">
                        <h4 class="fs-5 ">Linear Regresion</h4>
                        <strong class="fs-5">{{ number_format($rataRataPrediksi['linear_regression'],2) }} %</strong>
                        <small class="d-block text-muted">Akurasi rata-rata</small>
                    </div>
                </div>
                {{-- exponential Regresion --}}
                <div class="col-4">
                    <div class="border border-1 rounded text-center py-3 shadow bg-light">
                        <h4 class="fs-5 ">Exponential Smoothing</h4>
                        <strong class="fs-5">{{ number_format($rataRataPrediksi['exponential_smoothing'],2) }} %</strong>
                        <small class="d-block text-muted">Akurasi rata-rata</small>
                    </div>
                </div>
            </div>
        </div>
        {{-- akhir card info --}}

        @if (session('hapus'))
            <div class="alert alert-success">
                {{ session('hapus') }}
            </div>
        @endif
        <table class=" table table-bordered table-responsive table-hover shadow-sm">
            <thead class="table-success ">
                <tr class="text-center ibm align-middle small">
                    <th rowspan="2">No</th>
                    <th rowspan="2">Produk</th>
                    <th rowspan="2">Produksi Aktual</th>
                    <th rowspan="2">Target prediksi</th>
                    <th colspan="3">Hasil Prediksi</th>
                    <th rowspan="2">Hasil terbaik</th>
                    <th rowspan="2">Akurasi persen</th>
                    <th rowspan="2">Aksi</th>
                </tr>
                <tr class="text-center">
                    <th>Ma</th>
                    <th>Lr</th>
                    <th>Es</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perbandingan as $key => $data )
                <tr class="text-center ibm">
                        <td>{{ $perbandingan->total() - $perbandingan->firstItem() - $key + 1 }}</td>
                        <td>
                            {{ $data->produk }}    
                        </td>
                        <td>
                            <span class="badge bg-dark-subtle text-dark">{{ $data->produksi_aktual }} Kg</span>
                        </td>
                        <td>{{ $data->target_prediksi }}</td>
                        <td>
                            @if ($data->prediksi_ma === 0)
                                <span class="text-muted">-</span>
                            @else
                                <span>{{ $data->prediksi_ma }}</span>
                                <br><small class="text-muted">Selisih: {{ abs($data->produksi_aktual - $data->prediksi_ma) }}</small>
                            @endif
                        </td>
                        <td>
                            @if ($data->prediksi_lr === 0)
                                <span class="text-muted">-</span>
                            @else
                                <span>{{ $data->prediksi_lr }}</span>
                                <br><small class="text-muted">Selisih: {{ abs($data->produksi_aktual - $data->prediksi_lr) }}</small>
                            @endif
                        </td>
                        <td>
                            @if ($data->prediksi_Es === 0)
                                <span class="text-muted">-</span>
                            @else
                                <span>{{ $data->prediksi_Es }}</span>
                                <br><small class="text-muted">Selisih: {{ abs($data->produksi_aktual - $data->prediksi_Es) }}</small>
                            @endif
                        </td>
                        <td>
                            <span class="badge bg-success">{{ $data->hasil_terbaik }}</span>
                            <small class="d-block">{{ \Carbon\Carbon::parse($data->created_at)->diffForHumans()}}</small>
                        </td>
                        {{-- hasil akurasi --}}
                        <td >
                           <div class="d-flex flex-column justify-content-center align-items-center">
                             {{ $data->akurasi_persen }}%
                            <div class="progress me-2 w-75" style="height: 8px;">
                                    <div class="progress-bar {{ $data->akurasi_persen > 80.00 ? 'bg-success' : ($data->akurasi_persen > 60.00 ? 'bg-warning' : 'bg-danger' ) }}" style="width: {{ $data->akurasi_persen }}%"></div>
                            </div>
                           </div>
                            @if($data->akurasi_persen > 90)
                                <small class="badge bg-success">Sangat Baik</small>
                            @elseif($data->akurasi_persen > 80)
                                <small class="badge bg-warning">Baik</small>
                            @elseif($data->akurasi_persen > 60)
                                <small class="badge bg-orange">Lumayan</small>
                            @else
                                <small class="badge bg-danger">Buruk</small>
                            @endif
                        </td>
                        {{-- akhir hasil akurasi --}}
                        {{-- aksi --}}
                        <td>
                            <form action="{{ route('hapusPerbandingan', $data->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
            </tbody>
        </table>
        <div class="d-flex justify-content-end  col-md-6 ">
            {{ $perbandingan->links() }}
        </div>
    </div>
@endsection
