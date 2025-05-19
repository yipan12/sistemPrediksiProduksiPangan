@extends('layouts.app')
@section('content')

@if (session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif

    <div class="card card-body shadow">
        <table class=" table table-bordered">
            <thead class="table-success">
                <tr class="text-center">
                    <th>No</th>
                    <th>Produk</th>
                    <th>Hasil Prediksi</th>
                    <th>Tanggal Prediksi</th>
                    <th>Target Prediksi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $historis as $key => $data  )
                <tr class="text-center">
                    <td>{{ $historis->total() - $historis->firstItem() - $key + 1  }}</td>
                    <td>{{ $data->produk }}</td>
                    <td>{{ $data->prediksi }}</td>
                    <td>{{ $data->tanggal_prediksi }}</td>
                    <td>{{ $data->periode_prediksi }}</td>
                    <td>
                        <form action="{{ route('hapusLrIndex', $data->id) }}" method="post">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('yakin hapus data ini?')" class="btn btn-danger">
                                <i class="bi bi-trash"></i>    
                            </button>    
                        </form>    
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


@endsection