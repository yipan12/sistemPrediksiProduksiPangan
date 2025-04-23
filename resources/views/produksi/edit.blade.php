@extends('layouts.app')

@section('content')
    <form action="{{ route('produksi.update', $produksi->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="produk" class="form-label">Produk</label>
            <input type="text" class="form-control" name="produk" id="produk" value="{{ $produksi->produk }}">
         </div>
        <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="text" class="form-control" name="jumlah" id="jumlah" value="{{ $produksi->jumlah }}">
         </div>
         <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" id="tanggal" value="{{ $produksi->tanggal }}">
         </div>
         <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga" value="{{ $produksi->harga }}">
         </div>
         <button class="btn btn-primary" type="submit">Edit data produksi</button>
    </form>
@endsection