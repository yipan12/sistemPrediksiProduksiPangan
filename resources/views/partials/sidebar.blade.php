@php
    use Illuminate\Support\Facades\Auth;
    $activeClass = function($page) use ($title) {
        return $title === $page ? 'text-success fw-bold' : 'text-black';
    };
@endphp


<div id="sidebar" class="bg-white text-black border  vh-100 p-3 sidebar position-fixed d-flex flex-column" >
    {{-- acount --}}
    <div class="w-full mt-2 poppins">
         <i class="fas fa-user text-center d-block mb-2 fs-2 text-gradient"></i>
         <h4 class="text-black mb-0 text-center text-bold text-gradient">{{ Auth::user()->name ?? 'Guest' }}</h4>
         <small class="text-center d-block mb-4 text-muted poppins">{{ Auth::user()->email }}</small>
    </div>
    <hr class="text-gray-400">
    {{-- akhir acount --}}
    <div class="flex-grow-1">
        <ul class="nav flex-column ">
                <h4 class="fs-5 fw-normal ms-2 mb-3">Menu utama</h4>
                <li class="nav-item mb-2">
                    <a class="nav-link  {{ $activeClass('Dashboard') }}" href="/dashboard">
                        <i class="fas fa-tachometer-alt me-2"></i> Dashboard
                    </a>
                </li>
                <li class="nav-item mb-2">
                    <a class="nav-link {{ $activeClass('Historis') }}" href="/produksi">
                        <i class="fas fa-history me-2"></i> Data historis
                    </a>
                </li>
                {{-- dropdown menu prediksi --}}
               <div>
                 {{-- area Prediksi --}}
                <h4 class="fs-5 ms-2 mb-2">Prediksi</h4>
                {{-- akhir area prediksi --}}
                  <li>
                        <a class="nav-link {{ request()->routeIs('prediksi-pangan') ? 'text-success fw-bold' : 'text-black' }}" href="{{ route('prediksi-pangan') }}">
                            <i class="fas fa-chart-line me-2"></i> Moving averrage
                        </a>
                        </li>
                        <li>
                            <a class="nav-link {{ request()->routeIs('linearView') ? 'text-success fw-bold' : 'text-black' }}" href="{{ route('linearView') }}">
                                <i class="fas fa-chart-pie me-2"></i> Linear regresion
                            </a>
                        </li>
                        <li>
                            <a class="nav-link {{ request()->routeIs('expoIndex') ? 'text-success fw-bold' : 'text-black' }}" href="{{ route('expoIndex') }}">
                            <i class="fas fa-chart-area me-2"></i> Exponential
                        </a> 
                     </li>
                </li>
               </div>
            </ul>
        </div>
        {{-- dropdown menu akhir prediksi --}}
        <div class="mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </div>
</div>
