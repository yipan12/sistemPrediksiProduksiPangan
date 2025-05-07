@php
    use Illuminate\Support\Facades\Auth;
    $activeClass = function($page) use ($title) {
        return $title === $page ? 'text-primary fw-bold' : 'text-black';
    };
@endphp


<div id="sidebar" class="bg-white text-black border  vh-100 p-3 sidebar position-fixed">
    <h4 class="text-black mb-4 text-center text-bold text-gradient">{{ Auth::user()->name }}</h4>
    <ul class="nav flex-column">
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
        <li class="nav-item mb-2">
            <a class="nav-link dropdown-toggle {{ request()->routeIs('prediksi-pangan*') ? 'text-primary fw-bold' : 'text-black' }}" 
               href="#" 
               id="dropdownPrediksi" 
               role="button" 
               data-bs-toggle="collapse" 
               data-bs-target="#submenuPrediksi" 
               aria-expanded="false" 
               aria-controls="submenuPrediksi">
                <i class="fas fa-cog me-2"></i> Prediksi
            </a>
            <ul class="collapse list-unstyled ps-4" id="submenuPrediksi">
                <li>
                    <a class="nav-link {{ request()->routeIs('prediksi-pangan') ? 'text-primary fw-bold' : 'text-black' }}" href="{{ route('prediksi-pangan') }}">
                        <i class="fas fa-chart-line me-2"></i> Moving averrage
                    </a>
                </li>
                <li>
                    <a class="nav-link {{ request()->routeIs('linearView') ? 'text-primary fw-bold' : 'text-black' }}" href="{{ route('linearView') }}">
                        <i class="fas fa-chart-pie me-2"></i> Linear regresion
                    </a>
                </li>
            </ul>
        </li>
        {{-- dropdown menu akhir prediksi --}}
        <li class="nav-item mt-4">
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger w-100">
                    <i class="fas fa-sign-out-alt me-2"></i> Logout
                </button>
            </form>
        </li>
    </ul>
</div>
