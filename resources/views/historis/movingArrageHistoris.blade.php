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
            <tr class="text-center">
                <th class="text-center">No</th>
                <th class="text-center">Produk</th>
                <th>    Produksi 1</th>
                <th>Produksi 2</th>
                <th>Produksi 3</th>
                <th>Hasil Prediksi</th>
                <th class="text-center">Tanggal Prediksi</th>
                <th>Target Prediksi</th>
                <th>Aksi</th>
            </tr>
        </thead>
    <tbody>
        @foreach ($historis as $key => $data )

        <tr class="text-center">
           <td class="text-center">{{ $historis->total() - $historis->firstItem() - $key + 1 }}</td>
           <td >{{ $data->produk }}</td>
           <td>{{ $data->jumlah_1 }}</td>
           <td>{{ $data->jumlah_2 }}</td>
           <td>{{ $data->jumlah_3 }}</td>
           <td>{{ $data->prediksi }}</td>
           <td class="text-center">{{ $data->tanggal_prediksi->format('Y-m-d') }}</td>
           <td>{{ $data->periode_prediksi }}</td>
           <td>
            <form action="{{ route('hapusMaIndex', $data->id) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="confirm('yakin mau hapus?')" class="btn btn-danger" >
                    <i class="bi bi-trash"></i> 
                </button>
            </form>
           </td>
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