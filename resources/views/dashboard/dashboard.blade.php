@extends('layouts.app')
@section('body-class', 'customBg')
@section('content')
    <div class="row" style="margin-left: -0.7rem; margin-right: -0.7rem; margin-top: -0.5rem;">
        <div class="p-0 container col-md-6" style="color: #52075E">
            <h1 class="fs-5 fw-bold poppins mb-0 d-none d-md-block">Hello, {{ explode(' ', Auth::user()->name)[0] }}!</h1>
            <p class="text-muted poppins small d-none d-md-block">Hari ini {{ $tanggal }}</p>
        </div>
        {{-- total prediksi --}}
        <div class="col-md-6 d-flex justify-content-end">
            <div>
                <a href="" class="btn btn-dark text-white poppins fw-bold">Lihat Prediksi</a>
            </div>
        </div>
    </div>
    <hr class="mt-0 mb-0">
    
    {{-- summary card statistic prediksi --}}
    <div class="row py-3 gap-0">
        {{-- card yang pertama --}}
        <div class="col-md-3">
            <div class="card gradient rounded-3 shadow-sm border-0 sumary-card py-2">
                <div class="card-body">
                    <div class="d-flex justify-content-between ms-2 text-white">
                        <div class="d-flex flex-column justify-content-center">
                            <h1 class="mb-0">{{ $total }}</h1>
                            <p class="small">Total keseluruhan prediksi</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="bi bi-bar-chart-line-fill fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- card yang kedua --}}
        <div class="col-md-3">
            <div class="card mb-3 rounded-3 shadow-sm border-0 gradient-blue sumary-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between ms-2 gap-3">
                        <div class="d-flex flex-column justify-content-end text-white">
                            <h4 class="poppins mb-0 mt-3">{{ $akurasi['akurasi'] }}%</h4>
                            <p class="small poppins">Akurasi prediksi yang paling tinggi</p>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <i class="bi bi-graph-up fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- card yang ke 3 --}}
        <div class="col-md-3">
            <div class="card mb-3 rounded-3 shadow-sm border-0 gradient-blue sumary-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between ms-2 gap-3">
                        <div class="d-flex flex-column justify-content-end text-white">
                            <h4 class="poppins mb-0 mt-3 fs-6">{{ $metodeTerbaik['metode'] }}</h4>
                            <p class="small poppins">Akurasi prediksi yang paling baik</p>
                        </div>
                        <div class="d-flex align-items-center text-white">
                            <i class="bi bi-graph-up fs-1 opacity-50"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- akhir div row atas --}}
    </div>
@endsection