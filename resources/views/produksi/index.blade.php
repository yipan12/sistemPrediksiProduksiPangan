@extends('layouts.app')

@section('content')

{{-- Moving arage tabel --}}
    <div class="row container">
        <div class="card shadow my-3 col-4" style="width: 18rem;">
            <img src="..." class="card-img-top" alt="...">
            <div class="card-body">
              <h5 class="card-title fs-6">Moving Average</h5>
             
              <a href="{{ route('MovingarageIndex') }}" class="btn btn-primary">Lihat</a>
            </div>
          </div>
          {{-- linear regresion --}}
    </div>

    <div class="card card-body shadow">
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
