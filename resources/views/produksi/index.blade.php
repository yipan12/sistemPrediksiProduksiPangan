@extends('layouts.app')
@section('body-class', 'customBg')
@section('content')
    {{-- Moving arage tabel --}}
    <div class="container-fluid mb-5">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow-lg h-100 card-background ">
                    <img src="{{ asset("/asset/movingarrage.png") }}" class="card-img-top w-75 mx-auto mt-4" alt="...">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <h5 class="card-title fs-5 fw-bold">Moving Average</h5> 
                            <p class="btn skyblue-custoom text-white fw-bold">{{ $history }} Hasil Prediksi</p>
                        </div>
                        <p>Silahkan klik button “Lihat lebih” untuk melihat detail History prediksi</p>
                        <a href="{{ route('MovingarageIndex') }}" class="btn btn-success btn-sm">Lihat Lebih</a>
                    </div>
                </div>
            </div>
            {{-- linear regresion tabel --}}
            <div class="col-md-4">
                    <div class="card shadow-lg h-100 card-background">
                        <img src="{{ asset("/asset/undraw_users-per-minute_eg97.png") }}" class="card-img-top  mx-auto mt-5" alt="...">
                        <div class="card-body">
                            <div class="d-flex justify-content-between mt-4">
                                <h5 class="card-title fs-5 fw-bold">Linear Regresion</h5>
                                <p class="btn skyblue-custoom text-white fw-bold">{{ $historylr }}  Hasil Prediksi<p>
                            </div>
                            <p class="mt-1">Silahkan klik button “Lihat lebih” untuk melihat detail History prediksi</p>
                            <a href="{{ route('LrIndex') }}" class="btn btn-success btn-sm">Lihat Lebih</a>
                        </div>
                    
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-lg h-100 card-background" >
                    <img src="{{ asset("/asset/exponential.png") }}" class="card-img-top mx-auto w-75 mt-4" alt="...">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="card-title fs-5 fw-bold">Exponential Smoothing</h5>
                            <button class="btn skyblue-custoom text-white fw-bold">{{ $historyEs }} Hasil Prediksi</button>
                        </div>
                        <p class="mt-3">Silahkan klik button “Lihat lebih” untuk melihat detail History prediksi</p>
                        <a href="{{ route('EsIndex') }}" class="btn btn-success btn-sm">Lihat Lebih</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- tabel --}}
    <div class="card card-body shadow mt-4 card-background ">
        <div class="text-center mb-2 ">
            <h1 class="fs-2 poppins mt-1 lh-sm mb-0">Rekapitulasi Data Produksi</h1>
            <p class="text-muted mt-0">Tabel ini menampilkan data produksi yang telah dicatat dalam sistem. Gunakan tombol aksi untuk mengedit atau menghapus data.</p>
        </div>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
       
        <table class="table  table-bordered table-responsive-sm table-hover shadow-sm  table-striped">
            <thead class="table-success">
                <tr class="ibm">
                    <th class="text-center">No</th>
                    <th>Produk</th>
                    <th class="text-center text-truncate">Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th class="text-center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produksiPangan as $key => $data)
                <tr class="ibm">
                    <td class="text-center">{{ $produksiPangan->total() - $produksiPangan->firstItem() - $key + 1 }}</td>
                    <td>{{ $data->produk }}</td>
                    <td class="text-center">{{ $data->jumlah }}</td>
                    <td>Rp {{ number_format($data->harga, 0, ',', '.') }}</td>
                    <td>{{ \Carbon\Carbon::parse($data->tanggal)->format('d M Y') }}</td>
                    <td class="text-center">
                        <div class="btn-group " role="group">
                            <a href="{{ route('produksi.edit', $data->id) }}" class="btn btn-warning rounded-1 btn-sm me-1">
                                <i class="bi bi-pencil"></i> Edit
                            </a>
                            <form action="{{ route('produksi.destroy', $data->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">
                                    <i class="bi bi-trash"></i> Hapus
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row mt-2">
            <div class=" col-md-6 ">
                <a href="{{ route('produksi.create') }}" class="btn btn-success">Tambah Hasil Produksi</a>
            </div>

              {{-- Navigasi pagination --}}
            <div class="d-flex justify-content-end  col-md-6 ">
                {{ $produksiPangan->links() }}
            </div>
        </div>
        {{-- table perbandingan --}}
    </div>
    <div class="card card-body mt-3 shadow shadow-lg card-background">
        @if (session('hapus'))
            <div class="alert alert-success">
                {{ session('hapus') }}
            </div>
        @endif
        <table class=" table table-bordered table-responsive table-hover shadow-sm">
            <thead class="table-success">
                <tr class="text-center ibm">
                    <th>No</th>
                    <th>Produk</th>
                    <th>Produksi Aktual</th>
                    <th>Target prediksi</th>
                    <th>Prediksi Ma</th>
                    <th>Prediksi Lr</th>
                    <th>Prediksi Es</th>
                    <th>Hasil terbaik</th>
                    <th>Akurasi persen</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($perbandingan as $key => $data )
                <tr class="text-center ibm">
                        <td>{{ $perbandingan->total() - $perbandingan->firstItem() - $key + 1 }}</td>
                        <td>{{ $data->produk }}</td>
                        <td>{{ $data->produksi_aktual }}</td>
                        <td>{{ $data->target_prediksi }}</td>
                        <td>{{ $data->prediksi_ma === 0 ? '-' : $data->prediksi_ma}}</td>
                        <td>{{ $data->prediksi_lr === 0 ? '--' : $data->prediksi_lr }}</td>
                        <td>{{ $data->prediksi_Es === 0 ? '--' : $data->prediksi_Es }}</td>
                        <td>{{ $data->hasil_terbaik }}</td>
                        <td class="fw-semibold" style="color: {{ $data->akurasi_persen > 80.00 ? 'green' : 'red' }}">{{ $data->akurasi_persen }}%</td>
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
