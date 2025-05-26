@extends('layouts.app')
@section('body-class', 'customBg')
@section('content')
@vite('resources/js/app.js')
{{-- data untuk chart --}}
    <script>
        window.hasilAkurasi = @json($hasilAkurasi);
    </script>
{{-- data untuk chart --}}
 

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
            <div class="flip-container h-100 position-relative" id="card-1">
                <button class="btn position-absolute top-0 end-0 m-2 p-2 rounded-circle border-0 text-white z-3"
                        style="background: rgba(255,255,255,0.2); width: 35px; height: 35px;"
                        onclick="flipCard(1)">
                    <i class="bi bi-info-circle-fill"></i>
                </button>
                <div class="flip-inner h-100 w-100" id="flip-1">
            {{-- depan --}}
                    <div class="flip-front card gradient rounded-3 shadow-sm border-0 sumary-card py-2 h-100  top-0 start-0 w-100">
                        <div class=" card-body d-flex justify-content-between align-items-center ms-2 gap-3">
                            <div class="d-flex flex-column justify-content-center text-white">
                                <h4 class="poppins mb-0 mt-2 fs-1">{{ $total }}</h4>
                                <p class="small poppins">Total Prediksi</p>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <i class="bi bi-graph-up fs-1 opacity-50 mt-4"></i>
                            </div>
                        </div>
                    </div>
                    {{-- belakang --}}
                    <div class="flip-back card mb-3 rounded-3 shadow-sm border-0 gradient sumary-card h-100 position-absolute top-0 start-0 w-100">
                        <div class="card-body pt-4">
                            <div class="d-flex justify-content-center align-items-center text-white mt-2">
                               <p>
                                Jumlah total produksi yang telah diprediksi hingga saat ini mencapai <strong>{{ $total }}</strong>
                               </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- card yang kedua --}}
        <div class="col-md-3">
            <div class="flip-container h-100 position-relative" id="card-2">
                <button class="btn position-absolute top-0 end-0 m-2 p-2 rounded-circle border-0 text-white z-3"
                        style="background: rgba(255,255,255,0.2); width: 35px; height: 35px;"
                        onclick="flipCard(2)">
                    <i class="bi bi-info-circle-fill"></i>
                </button>
                <div class="flip-inner h-100 w-100" id="flip-2">
            {{-- depan --}}
                    <div class="flip-front card gradient rounded-3 shadow-sm border-0 sumary-card py-2 h-100 position-absolute top-0 start-0 w-100">
                        <div class=" card-body d-flex justify-content-between align-items-center ms-2 gap-3">
                            <div class="d-flex flex-column justify-content-center text-white">
                                <h4 class="poppins mb-0 mt-2">{{ $akurasi['akurasi'] }}%</h4>
                                <p class="small poppins">Akurasi Prediksi Tertinggi</p>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <i class="bi bi-graph-up fs-1 opacity-50 mt-4"></i>
                            </div>
                        </div>
                    </div>
                    {{-- belakang --}}
                    <div class="flip-back card mb-3 rounded-3 shadow-sm border-0 gradient sumary-card h-100 position-absolute top-0 start-0 w-100">
                        <div class="card-body pt-4">
                            <div class="d-flex justify-content-center align-items-center text-white">
                                <p>Tercatat sejauh ini, akurasi prediksi
                                    <br> 
                                    yang paling tinggi di peroleh <strong class="text-capitalize">{{ $akurasi['metode'] }} </strong> dengan akurasi mencapai <strong style="color: lightgreen"> {{ $akurasi['akurasi'] }}% </strong></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- card yang ke 3 --}}
        <div class="col-md-3">
            <div class="flip-container h-100 position-relative" id="card-3">
                <button class="btn position-absolute top-0 end-0 m-2 p-2 rounded-circle border-0 text-white z-3"
                        style="background: rgba(255,255,255,0.2); width: 35px; height: 35px;"
                        onclick="flipCard(3)">
                    <i class="bi bi-info-circle-fill"></i>
                </button>

                <div class="flip-inner h-100 w-100" id="flip-3">
                    {{-- depan --}}
                    <div class=" flip-front card mb-3 rounded-3 shadow-sm border-0 gradient sumary-card h-100 position-absolute top-0 start-0 w-100" >
                        <div class=" card-body d-flex justify-content-between align-items-center ms-2 gap-2">
                            <div class="d-flex flex-column justify-content-end text-white">
                                <h4 class="poppins mb-0 mt-2 fs-6">{{ $metodeTerbaik['metode'] }}</h4>
                                <p class="small poppins">Metode prediksi dengan akurasi terbaik</p>
                            </div>
                            <div class="d-flex align-items-center text-white">
                                <i class="bi bi-award fs-1 opacity-50 icon-3d mt-4"></i>
                            </div>
                        </div>
                    </div>
                {{-- belakang --}}
                    <div class="flip-back card mb-3 rounded-3 shadow-sm border-0 gradient sumary-card h-100 position-absolute top-0 start-0 w-100">
                        <div class="card-body">
                            <div class="d-flex justify-content-center align-items-center text-white">
                               <p >Metode prediksi <strong class="text-capitalize">{{ $metodeTerbaik['metode'] }}</strong> dipilih sebagai metode terbaik karena memiliki rata-rata akurasi tertinggi sebesar <strong style="color: lightgreen">{{ $metodeTerbaik['akurasi'] }}%</strong> dibanding metode lainnya.</p>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        {{-- card ke 4 --}}
        <div class="col-md-3">
            <div class="flip-container h-100 position-relative" id="card-4">
                <button class="btn position-absolute top-0 end-0 m-2 p-2 rounded-circle border-0 text-white z-3"
                        style="background: rgba(255,255,255,0.2); width: 35px; height: 35px;"
                        onclick="flipCard(4)">
                    <i class="bi bi-info-circle-fill"></i>
                </button>

                <div class="flip-inner w-100 h-100" id="flip-4">
                    {{-- depan --}}
                    <div class="flip-front card mb-3 rounded-3 shadow-sm border-0 gradient sumary-card h-100 position-absolute top-0 start-0 w-100">
                        <div class="card-body d-flex justify-content-between align-items-center ms-2 gap-2 text-white">
                            <div class="d-flex flex-column justify-content-end">
                                <h4 class="poppins mb-0 mt-1 fs-4 text-capitalize">{{ $produksiTerbanyak['produk'] }}</h4>
                                <p class="small poppins">Komoditas yang banyak di produksi</p>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="bi bi-trophy fs-1 opacity-50 icon-3d mt-4"></i>
                            </div>
                        </div>
                    </div>

                    {{-- belakang --}}
                    <div class="flip-back card mb-3 rounded-3 shadow-sm border-0 gradient sumary-card h-100 position-absolute top-0 start-0 w-100">
                        <div class="card-body d-flex align-items-center justify-content-center text-white">
                            <p class="mb-0"> Komoditas <strong class="text-capitalize ">{{ $produksiTerbanyak->produk }}</strong>  merupakan komoditas terbanyak di produksi sejauh ini hingga mencapai <strong style="color: lightgreen">{{ $produksiTerbanyak->total_jumlah_formatted }}</strong> produksi</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- akhir dari card --}}

    


    <div class="row py-2 g-0">
        <div class="col-10 card">
        {{-- bar navigasi --}}
        <ul class="nav nav-tabs mt-2 ms-2 gap-2" id="chartTab" role="tablist">
            <li class="nav-item" >
                <button class="nav-link active" id="line-chart-tab" data-bs-toggle="tab" data-bs-target="#lineChartTab" type="button" role="tab" aria-controls="lineChartTab" aria-selected="true">Line chart</button>
            </li>
            <li class="nav-item" >
                <button class="nav-link" id="bar-chart-tab" data-bs-toggle="tab" data-bs-target="#barChartTab" type="button" role="tab" aria-controls="barChartTab" aria-selected="false">Bar chart</button>
            </li>
        </ul>
        {{-- akhir bar --}}
        {{-- barchart --}}
            <div class="tab-content" id="chartTabcontent">
                {{-- line chart --}}
                <div class="tab-pane fade show active" style="height: 450px" id="lineChartTab" role="tabpanel" aria-labelledby="line-chart-tab">
                    <div id="productionChart"></div>
                </div>

                {{-- bar chart --}}
                <div class="tab-pane fade" style="height: 450px" id="barChartTab" role="tabpanel" aria-labelledby="bar-chart-tabel">
                    <div id="barChart"></div>
                </div>
            </div>

            {{-- div penutup col --}}
        </div> 
        <div class="col-2 d-flex flex-column">
            <div class="card h-50 d-flex justify-content-center align-items-center">
                <h6 class="text-muted">Terakhir Input</h6>
                <h1>{{ $terakhirKali }}</h1>
            </div>
            <div class="card h-50">
                <h1>h</h1>
            </div>
        </div>
    </div>


@endsection