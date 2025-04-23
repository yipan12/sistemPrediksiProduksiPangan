@extends('layouts.app')

@section('content')
    <h1>Halaman Tambah Produksi</h1>

    <form action="{{ route('produksi.store') }}" method="POST">
        @csrf
         <div class="mb-3">
            <label for="produk" class="form-label">Produk</label>
            <input type="text" class="form-control" name="produk" id="produk">
         </div>
         <div class="mb-3">
            <label for="jumlah" class="form-label">Jumlah</label>
            <input type="number" class="form-control" name="jumlah" id="jumlah">
         </div>
         <div class="mb-3">
            <label for="tanggal" class="form-label">Tanggal</label>
            <input type="date" class="form-control" name="tanggal" id="tanggal">
         </div>
         <div class="mb-3">
            <label for="harga" class="form-label">Harga</label>
            <input type="number" class="form-control" name="harga" id="harga">
         </div>
         <button class="btn btn-primary" type="submit">Simpan</button>
         <a href="{{ route('produksi.index') }}" class="d-block">Kembali</a>
    </form>
@endsection