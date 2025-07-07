<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top" style="min-height: 90px">
    <div class="container">
        {{-- logo --}}
        <div class="d-flex align-items-center gap-2">
            <img src="/asset/logoSistemPrediksi.png" alt="Logo" style="height: 50px; width: 50px;">
            <a href="{{ url('/') }}" class="navbar-brand fw-bold text-success pt-lg-2 d-inline-block">Sistem Produksi Prediksi Pangan</a>
        </div>
        {{-- mobile --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarContent" 
        aria-controls="navbarContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        {{-- menu --}}
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ms-auto poppins" id="navbarContent">
                <li class="nav-item">
                    <a href="#home" class="nav-link text-dark" id="header">Beranda</a>
                </li>
                <li class="nav-item">
                    <a href="#fitur" class="nav-link text-dark" id="header">Fitur</a>
                </li>
                <li class="nav-item">
                    <a href="#tentang" class="nav-link text-dark" id="header">Tentang</a>
                </li>
                <li class="nav-item">
                    <a href="#faq" class="nav-link text-dark" id="header">FAQ</a>
                </li>
            </ul>
            {{-- Auth --}}
            <div class="d-flex ms-lg-4 gap-2 poppins">
                <a href="{{ route('loginIndex') }}" class="btn btn-outline-success">Masuk</a>
                <a href="{{ route('registrasi.index') }}" class="btn btn-success">Daftar</a>
            </div>
        </div>
        {{-- akhir --}}
    </div>
</nav>