@extends('layouts.app')
@section('content')
<div class="card card-body shadow">
    <table class="table ">
    <thead>
        <tr>
            <th>Id</th>
            <th>Produk</th>
            <th>Produksi 1</th>
            <th>Produksi 2</th>
            <th>Produksi 3</th>
            <th>Hasil Prediksi</th>
            <th>Tanggal Prediksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historis as $key => $data )

        <tr>
           <td>1</td>
           <td>Jagun</td>
           <td>9,899</td>
           <td>333</td>
           <td>222</td>
           <td>4,848</td>
           <td>12 05 2025</td>
        </tr>
        </tr>
        
            
        @endforeach
    </tbody>
</table></div>
@endsection