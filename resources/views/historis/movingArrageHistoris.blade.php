@extends('layouts.app')
@section('content')
@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
 @endif

 <div class="row mb-3">
    <div class="col-md-6">
        <h5 class="poppins fs-3 mb-0 text-primary"><i class="bi bi-graph-up"></i> Riwayat Prediksi Produksi</h5>
        <small class="text-muted poppins">Kelola dan pantau hasil prediksi produksi Moving Average</small>
    </div>
    <div class="col-md-6 d-flex justify-content-end">
        <div class="d-flex align-items-center">
            <a class="btn btn-primary" href="{{ route('prediksi-pangan') }}"><i class="bi bi-plus fs-6"></i> Tambah Prediksi</a>
        </div>
    </div>
 </div>

<div>
     @livewire('moving-arrage-hitoris')
</div>
@endsection