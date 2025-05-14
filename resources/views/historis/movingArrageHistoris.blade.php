@extends('layouts.app')
@section('content')

@if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
 @endif
<div class="card card-body shadow">
    <table class="table table-bordered ">
    <thead class="table-success">
        <tr>
            <th class="text-center">No</th>
            <th class="text-center">Produk</th>
            <th>    Produksi 1</th>
            <th>Produksi 2</th>
            <th>Produksi 3</th>
            <th>Hasil Prediksi</th>
            <th>Tanggal Prediksi</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($historis as $key => $data )

        <tr>
           <td class="text-center">{{ $historis->total() - $historis->firstItem() - $key + 1 }}</td>
           <td>{{ $data->produk }}</td>
           <td>{{ $data->jumlah_1 }}</td>
           <td>{{ $data->jumlah_2 }}</td>
           <td>{{ $data->jumlah_3 }}</td>
           <td>{{ $data->prediksi }}</td>
           <td>{{ $data->tanggal_prediksi }}</td>
        </tr>
        </tr>    
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-end active ">
    {{ $historis->links() }}
</div>

</div>
@endsection