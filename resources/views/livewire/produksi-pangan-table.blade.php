<div>

      <div class="row mb-3">
            <div class="col-md-6">
                <h1 class="fs-3 poppins mt-1 lh-sm mb-0">Rekapitulasi Data Produksi</h1>
                <p class="text-muted mt-0">Kelola data produksi yang akan digunakan untuk prediksi</p>
            </div>
            <div class="col-md-6 d-flex justify-content-end align-items-center gap-3">
                  {{-- Search Input --}}
                        <div class="col-md-6">
                                <input 
                                type="text" 
                                wire:model.live="search"
                                placeholder="Cari nama produk..." 
                                class="form-control form-control-sm"
                            >
                        </div>
                        <div class="col-md-3">
                            <select wire:model="perPage" wire:change="updatePerPage" class="form-select form-select-sm">
                                <option value="5">5 per halaman</option>
                                <option value="12">12 per halaman</option>
                                <option value="25">25 per halaman</option>
                                <option value="50">50 per halaman</option>
                            </select>
                        </div>
                     
                {{-- akhir search --}}
            </div>
        </div>

        <div class="row">
            <div class="card col-md-4">
                <h1>{{ 'Rp ' . number_format($rataRata, 0, ',', '.') }}</h1>
            </div>
        </div>
        

        {{-- Alert Messages --}}
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show">
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

    {{-- Loading State --}}
    <div wire:loading class="text-center py-2">
        <div class="spinner-border spinner-border-sm" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        <span class="ms-2">Mencari data...</span>
    </div>

    {{-- Results Count --}}
    @if($products->total() > 0)
        <div class="mb-2">
            <small class="text-muted">
                Menampilkan {{ $products->firstItem() }} - {{ $products->lastItem() }} 
                dari {{ $products->total() }} produk
                @if(!empty($search))
                    untuk pencarian "{{ $search }}"
                @endif
            </small>
        </div>
    @endif

    {{-- Table --}}
    <div class="table-responsive">
        <table class="table  table-bordered table-hover table-striped">
            <thead class="table-success">
                <tr class="">
                    <th class="text-center" style="width: 50px;">NO</th>
                    <th>Produk</th>
                    <th class="text-center">Jumlah</th>
                    <th>Harga Satuan</th>
                    <th>Tanggal</th>
                    <th class="text-center" style="width: 120px;">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($products as $index => $product)
                    <tr class="">
                        <td class="text-center">
                            {{ $products->total() - $products->firstItem() - $index + 1 }}
                        </td>
                        <td>{{ $product->produk }}</td>
                        <td class="text-center">{{ number_format($product->jumlah) }}</td>
                        <td>Rp {{ number_format($product->harga, 0, ',', '.') }}</td>
                        <td>{{ \Carbon\Carbon::parse($product->tanggal)->format('d M Y') }}</td>
                        <td class="text-center">
                            <div class="btn-group btn-group-sm" role="group">
                                <a href="{{ route('produksi.edit', $product->id) }}" 
                                   class="btn btn-warning btn-sm">
                                    <i class="bi bi-pencil"></i>
                                </a>
                                <form action="{{ route('produksi.destroy', $product->id) }}" 
                                      method="POST" 
                                      class="d-inline"
                                      onsubmit="return confirm('Yakin hapus data ini?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger btn-sm">
                                        <i class="bi bi-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center py-4 text-muted">
                            @if(!empty($search))
                                Tidak ada produk yang ditemukan untuk pencarian "{{ $search }}"
                            @else
                                Belum ada data produksi
                            @endif
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-between align-items-center">
    <div>
        <a href="{{ route('produksi.create') }}" class="btn btn-success">
            <i class="bi bi-plus-circle"></i> Tambah Data
        </a>
    </div>

    {{-- Pagination --}}
    <div>
        @if($products->hasPages())
            <div class="mt-3">
                {{ $products->links() }}
            </div>
        @endif
    </div>
</div>

</div>