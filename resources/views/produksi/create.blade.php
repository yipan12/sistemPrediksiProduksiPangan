@extends('layouts.app')

@section('content')
    <div class="row">
      <div class="col-md-6">
         <h1 class="poppins fs-3 fw-semibold mb-0">Tambah Data Produksi</h1>
         <p class="text-muted">Sistem produksi prediksi pangan</p>
      </div>
      <div class="col-md-6">
        <div class="d-flex justify-content-end">
             <a href="{{ route('produksi.index') }}" class="btn btn-outline-dark"> <i class="bi bi-arrow-left me-2"></i>Kembali</a>
        </div>
      </div>
    </div>

   <div class="card border-0 bg-white shadow-sm">
      <div class="card-body">
         <div class="row bg-white shadow-sm mb-3 rounded-1">
            <div class="my-3">
               <h5 class="poppins fw-semibold">Informasi Produksi</h5>
            </div>
         </div>
            <div class="card-body">
               <form action="{{ route('produksi.store') }}" method="POST">
               @csrf
               {{-- row pertama --}}
                  <div class="row mb-3 g-5">
                     <div class="col-md-6">
                        <label for="produk" class="form-label" >Nama Komoditas</label>
                        <input type="text" class="form-control" name="produk" id="produk" placeholder="Masukan nama komoditas...">
                     </div>
                     <div class="col-md-6">
                        <label for="tanggal" class="form-label">Tanggal Produksi</label>
                        <input type="date" class="form-control" name="tanggal" id="tanggal">
                     </div>
                     {{-- akhir row 1 --}}
                  </div>
                  <div class="row mb-3 g-5">
                     <div class="col-md-6">
                        <label for="jumlah" class="form-label">Jumlah Produksi</label>
                        <div class="input-group">
                           <input type="number" class="form-control" name="jumlah" id="jumlah" placeholder="Masukan jumlah produksi...">
                           <span class="input-group-text bg-light text-muted fw-medium">Kg</span>
                        </div>
                     </div>
                     <div class="col-md-6">
                        <label for="harga" class="form-label">Harga per Kg</label>
                        <div class="input-group">
                           <span class="input-group-text text-muted bg-light fw-medium">Rp</span><input type="number" class="form-control" name="harga" id="harga" placeholder="0">
                        </div>
                     </div>
                     {{-- akhir row 2 --}}
                  </div>
                  <button class="btn btn-primary mt-3" style="width: 200px" type="submit"> <i class="fas fa-save"></i> Simpan Data</button>
               </form>
            </div>
      </div>
   </div>
@endsection