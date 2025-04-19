@extends('layouts.app')

@section('content')
<div class="card p-4" style="max-width: 600px; margin: auto;">
    <h5 class="mb-4">
      <i class="fas fa-history me-2"></i> Riwayat Aktivitas
    </h5>
  
    <ul class="timeline">
      <li>
        <i class="fas fa-sign-in-alt timeline-icon"></i>
        <div class="timeline-content">
          <strong>Irpan login ke sistem</strong><br>
          <small>19 April 2025 • 08:23</small>
        </div>
      </li>
      <li>
        <i class="fas fa-plus-circle timeline-icon"></i>
        <div class="timeline-content">
          <strong>Admin menambahkan barang: Cat Tembok</strong><br>
          <small>18 April 2025 • 14:10</small>
        </div>
      </li>
      <li>
        <i class="fas fa-trash-alt timeline-icon"></i>
        <div class="timeline-content">
          <strong>User A menghapus data supplier</strong><br>
          <small>18 April 2025 • 11:45</small>
        </div>
      </li>
    </ul>
  </div>
  
@endsection