@extends('layouts.app')

@section('content')

    <h1>Data Produksi</h1>
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif
    <table class="table table-primary">
        <thead>
            <tr>
                <th>Id</th>
                <th>Produk</th>
                <th>Jumlah</th>
                <th>Tanggal</th>
                <th>Harga</th>
                <th>created_at</th>
                <th>updated_at</th>
                <th>action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($produksiPangan as $key => $data )

            <tr>
                <td>{{ $key + 1 }}</td>
                <td>{{ $data->produk }}</td>
                <td>{{ $data->jumlah }}</td>
                <td>{{ $data->tanggal }}</td>
                <td>{{ $data->harga }}</td>
                <td>{{ $data->created_at }}</td>
                <td>{{ $data->updated_at }}</td>
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
    <a href="{{ route('produksi.create') }}" class="btn btn-primary">Tambah Hasil Produksi</a>
@endsection
