@extends('layouts.app')

@section('content')



    {{-- Moving arage tabel --}}
        <div class="container-fluid mb-5">
        <div class="row g-3">
            <div class="col-md-4">
                <div class="card shadow-lg h-100">
                    <img src="{{ asset("asset/undraw_organizing-data_uns9.svg") }}" class="card-img-top w-75 mx-auto mt-4" alt="...">
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
            
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset("asset/undraw_data-trends_kv5v.svg") }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fs-6">Moving Average</h5>
                        <a href="{{ route('MovingarageIndex') }}" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
            
            <div class="col-md-4">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset("asset/undraw_data-trends_kv5v.svg") }}" class="card-img-top" alt="...">
                    <div class="card-body">
                        <h5 class="card-title fs-6">Moving Average</h5>
                        <a href="{{ route('MovingarageIndex') }}" class="btn btn-primary">Lihat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- tabel --}}
    <div class="card card-body shadow mt-4">
        <h1 class="fs-2 text-center">Data Produksi</h1>
        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif
        <table class="table table-hover mt-3">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Produk</th>
                    <th>Jumlah</th>
                    <th>Harga</th>
                    <th>Tanggal</th>
                    <th>action</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($produksiPangan as $key => $data )

                <tr>
                    <td>{{ $produksiPangan->total() - $produksiPangan->firstItem() - $key + 1 }}</td>
                    <td>{{ $data->produk }}</td>
                    <td>{{ $data->jumlah }}</td>
                    <td>{{ $data->harga }}</td>
                    <td>{{ $data->tanggal }}</td>
                    <td>
                        <a href="{{ route('produksi.edit', $data->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('produksi.destroy', $data->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Yakin hapus?')" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row mt-2">
            <div class=" col-md-6 ">
                <a href="{{ route('produksi.create') }}" class="btn btn-primary">Tambah Hasil Produksi</a>
            </div>

              {{-- Navigasi pagination --}}
            <div class="d-flex justify-content-end  col-md-6 ">
                {{ $produksiPangan->links() }}
            </div>
        </div>
    </div>
@endsection
