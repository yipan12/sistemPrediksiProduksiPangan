@extends('layouts.landing')
@section('content')
{{-- baris pertama --}}
    <section class="row mt-4" id="home">
        <div class="col-md-6 col-12 d-flex align-items-center">
           <div class="ms-5 mb-5">
                <p class="text-success fw-bold mb-0">SYSTEM PREDIKSI PRODUKSI PANGAN</p>
                <h4 style="font-size: 70px" class="dmSerif text-success">
                    Prediksi Produksi Pangan Anda Tanpa Ribet!!
                </h4>
                <p class="poppins text-success">
                    Gunakan data historis untuk memprediksi hasil produksi pangan secara otomatis dan akurat.
                    Tingkatkan efisiensi perencanaan produksi hanya dalam beberapa klik.
                </p>
                <div class="flex mb-5">
                    <a href="{{ route('registrasi.index') }}" class="btn btn-success fw-bold poppins">Daftar Sekarang</a>
                    <a href="#fitur" class="btn btn-outline-success fw-bold poppins">Lihat Fitur</a>
                </div>
           </div>
        </div>
        <div class="col-md-6 col-12">
            <img src="/asset/HeroSection.jpg" class="d-block img-fluid w-100 ms-auto rounded-hero"
            style="width: 100%; height: 80%; max-width: 700px; aspect-ratio: 1/1; object-fit: cover;  border-top-left-radius: 150px; border-bottom-left-radius: 150px;"
            alt="Logo">
        </div>
    </section>
{{-- baris kedua --}}
    <section class="my-5 py-5 text-center">
        <div class="container my-5">
            <div class="p-4 border-start border-4 border-success bg-light rounded shadow-sm">
                <h4 class="fst-italic text-success fs-5">
                    <i class="bi bi-quote fs-3 me-2 text-success"></i>
                    "Sejak menggunakan sistem ini, saya bisa tahu kapan produksi akan naik atau turun. Ini sangat membantu saya merencanakan penanaman dengan lebih efisien."
                </h4>
                <p class="mt-3 fw-semibold text-success mb-0">— Irpan Maulana</p>
                <small class="text-muted">Petani Jagung, Jawa Barat</small>
            </div>
        </div>
    </section>
{{-- baris ketiga --}}
    <section id="fitur" class="py-5 bg-light">
    <h4 class="fs-4 dmSerif text-center mb-4 text-success">Fitur Unggulan</h4>
    <div class="container">
        <div class="row g-4">
            {{-- Fitur 1 --}}
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-graph-up text-success fs-1"></i>
                        </div>
                        <h5 class="card-title fw-bold text-success">Prediksi Otomatis</h5>
                        <p class="card-text text-muted small">
                            Sistem akan menghitung prediksi produksi berdasarkan data historis dengan algoritma andal.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Fitur 2 --}}
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-bar-chart-line text-success fs-1"></i>
                        </div>
                        <h5 class="card-title fw-bold text-success">Visualisasi Data</h5>
                        <p class="card-text text-muted small">
                            Menampilkan grafik tren produksi dari waktu ke waktu untuk memudahkan analisis dan pengambilan keputusan.
                        </p>
                    </div>
                </div>
            </div>

            {{-- Fitur 3 --}}
            <div class="col-md-4 col-sm-6">
                <div class="card h-100 shadow-sm border-0 rounded-4 p-3">
                    <div class="card-body text-center">
                        <div class="mb-3">
                            <i class="bi bi-cloud-upload text-success fs-1"></i>
                        </div>
                        <h5 class="card-title fw-bold text-success">Input Data Mudah</h5>
                        <p class="card-text text-muted small">
                            Pengguna dapat dengan mudah menginput data produksi bulanan melalui dashboard yang ramah pengguna.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- baris ke 4 --}}

   <section id="tentang" class="py-5 about-section">
        <div class="container py-5">
            <h2 class="section-title dmSerif fade-in-up">Tentang Sistem Prediksi</h2>
            
            {{-- Baris 1: Teks kiri, Gambar kanan --}}
            <div class="row align-items-center mb-5">
                <div class="col-md-6 fade-in-up">
                    <div class="content-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-lightbulb"></i>
                        </div>
                        <h4 class="dmSerif pertanyaan">Kenapa sistem ini dibuat?</h4>
                        <p class="poppins description">
                            Sistem ini dibuat untuk membantu petani dan stakeholder dalam memprediksi hasil produksi pangan secara otomatis. Dengan data historis, petani bisa merencanakan penanaman lebih efisien dan tepat waktu.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 fade-in-up">
                    <div class="enhanced-image">
                        <img src="https://images.unsplash.com/photo-1574943320219-553eb213f72d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Kenapa Dibuat" class="img-fluid" style="max-height: 350px; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            {{-- Baris 2: Gambar kiri, Teks kanan --}}
            <div class="row align-items-center mb-5">
                <div class="col-md-6 order-md-2 fade-in-up">
                    <div class="content-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-chart-line"></i>
                        </div>
                        <h4 class="dmSerif pertanyaan">Apa manfaatnya?</h4>
                        <p class="poppins description">
                            Sistem ini membantu petani membuat keputusan berdasarkan data. Dengan prediksi yang akurat, mereka bisa mencegah overproduksi, mengelola stok dengan lebih baik, dan meningkatkan keuntungan pertanian.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 order-md-1 fade-in-up">
                    <div class="enhanced-image">
                        <img src="https://images.unsplash.com/photo-1416879595882-3373a0480b5b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Manfaat Sistem" class="img-fluid" style="max-height: 350px; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>

            {{-- Baris 3: Teks kiri, Gambar kanan --}}
            <div class="row align-items-center">
                <div class="col-md-6 fade-in-up">
                    <div class="content-card">
                        <div class="icon-wrapper">
                            <i class="fas fa-cogs"></i>
                        </div>
                        <h4 class="dmSerif pertanyaan">Teknologi yang digunakan?</h4>
                        <p class="poppins description">
                            Sistem dibangun dengan Laravel 10, memanfaatkan algoritma prediksi seperti <em>Linear Regression,</em> <em>Exponential Smoothing</em> dan <em>Moving Average</em>. Data historis diproses secara otomatis untuk memberikan hasil prediksi akurat dan cepat.
                        </p>
                    </div>
                </div>
                <div class="col-md-6 fade-in-up">
                    <div class="enhanced-image">
                        <img src="https://images.unsplash.com/photo-1518186285589-2f7649de83e0?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1000&q=80" alt="Teknologi Sistem" class="img-fluid" style="max-height: 350px; width: 100%; object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </section>

   <section id="faq" class="py-5 bg-light">
    <div class="container py-5">
        <h2 class="section-title dmSerif text-center mb-5 text-success fade-in-up">Pertanyaan yang Sering Diajukan</h2>
        
        <div class="row justify-content-center">
            <div class="col-lg-10">
                <div class="accordion" id="faqAccordion">
                    
                    {{-- FAQ 1 --}}
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 fade-in-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white text-success fw-bold rounded-3" 
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq1" 
                                    aria-expanded="false" aria-controls="faq1">
                                <i class="bi bi-question-circle me-3 fs-5"></i>
                                Bagaimana cara kerja sistem prediksi ini?
                            </button>
                        </h2>
                        <div id="faq1" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Sistem menggunakan algoritma Linear Regression, Exponential Smoothing, dan Moving Average untuk menganalisis data historis produksi pangan Anda. Data tersebut kemudian diproses secara otomatis untuk memberikan prediksi produksi yang akurat.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 2 --}}
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 fade-in-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white text-success fw-bold rounded-3" 
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq2" 
                                    aria-expanded="false" aria-controls="faq2">
                                <i class="bi bi-clock me-3 fs-5"></i>
                                Berapa lama waktu yang dibutuhkan untuk mendapatkan prediksi?
                            </button>
                        </h2>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Pertama, Anda menginput data produksi bulanan ke dalam tabel data historis. Setelah data dirasa cukup untuk prediksi, Anda dapat mengakses halaman prediksi dan memilih metode prediksi yang diinginkan (Linear Regression, Exponential Smoothing, atau Moving Average). Sistem akan langsung memproses dan menampilkan hasil prediksi.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 3 --}}
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 fade-in-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white text-success fw-bold rounded-3" 
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq3" 
                                    aria-expanded="false" aria-controls="faq3">
                                <i class="bi bi-bar-chart me-3 fs-5"></i>
                                Apakah sistem ini cocok untuk semua jenis tanaman?
                            </button>
                        </h2>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Ya, sistem ini dapat digunakan untuk berbagai jenis tanaman pangan seperti padi, jagung, sayuran, dan buah-buahan. Algoritma prediksi akan menyesuaikan dengan pola produksi masing-masing jenis tanaman.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 4 --}}
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 fade-in-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white text-success fw-bold rounded-3" 
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq4" 
                                    aria-expanded="false" aria-controls="faq4">
                                <i class="bi bi-shield-check me-3 fs-5"></i>
                                Apakah data produksi saya aman?
                            </button>
                        </h2>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Tentu saja! Sistem kami menggunakan enkripsi tingkat tinggi untuk melindungi semua data pengguna. Data produksi Anda hanya akan digunakan untuk proses prediksi dan tidak akan dibagikan kepada pihak ketiga.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 5 --}}
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 fade-in-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white text-success fw-bold rounded-3" 
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq5" 
                                    aria-expanded="false" aria-controls="faq5">
                                <i class="bi bi-calendar-check me-3 fs-5"></i>
                                Berapa minimal data historis yang dibutuhkan?
                            </button>
                        </h2>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Untuk mendapatkan prediksi yang akurat, sistem membutuhkan minimal 3 bulan data historis produksi. Semakin banyak data yang tersedia (6-12 bulan), semakin akurat prediksi yang dihasilkan oleh algoritma sistem.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 6 --}}
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 fade-in-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white text-success fw-bold rounded-3" 
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq6" 
                                    aria-expanded="false" aria-controls="faq6">
                                <i class="bi bi-currency-dollar me-3 fs-5"></i>
                                Apakah ada biaya untuk menggunakan sistem ini?
                            </button>
                        </h2>
                        <div id="faq6" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Sistem ini sepenuhnya gratis untuk digunakan! Anda dapat mengakses semua fitur prediksi, visualisasi data, dan input data historis tanpa biaya apapun. Cukup daftar akun dan mulai gunakan sistem untuk membantu perencanaan produksi pangan Anda.
                            </div>
                        </div>
                    </div>

                    {{-- FAQ 7 --}}
                    <div class="accordion-item border-0 mb-3 shadow-sm rounded-3 fade-in-up">
                        <h2 class="accordion-header">
                            <button class="accordion-button collapsed bg-white text-success fw-bold rounded-3" 
                                    type="button" data-bs-toggle="collapse" data-bs-target="#faq7" 
                                    aria-expanded="false" aria-controls="faq7">
                                <i class="bi bi-phone me-3 fs-5"></i>
                                Bagaimana jika saya mengalami kesulitan menggunakan sistem?
                            </button>
                        </h2>
                        <div id="faq7" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                            <div class="accordion-body text-muted">
                                Jika Anda mengalami kesulitan dalam menggunakan sistem, tim kami siap membantu dan membimbing Anda melalui chat WhatsApp atau email. Kami akan dengan senang hati menjelaskan cara penggunaan sistem dan membantu menyelesaikan masalah yang Anda hadapi.
                            </div>                        </div>
                    </div>

                </div>
            </div>
        </div>

        {{-- CTA Section --}}
        <div class="text-center mt-5 fade-in-up">
            <div class="bg-success bg-opacity-10 rounded-4 p-4 border border-success border-opacity-25">
                <h5 class="text-success fw-bold mb-3">Masih ada pertanyaan lain?</h5>
                <p class="text-muted mb-4">Tim support kami siap membantu Anda 24/7</p>
                <div class="d-flex justify-content-center gap-3 flex-wrap">
                    <a href="mailto:irpanstudent@outlook.com" class="btn btn-success">
                        <i class="bi bi-envelope me-2"></i>Email Support
                    </a>
                    <a href="https://wa.me/6289648260834" class="btn btn-outline-success">
                        <i class="bi bi-whatsapp me-2"></i>WhatsApp
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>

<footer id="footer" class="bg-success py-5 text-white">
  <div class="container">
    <div class="row">
      <!-- Tim Pengembang -->
      <div class="col-lg-6 mb-4">
        <h2 class="dmSerif text-center mb-4 team-title">Tim Pengembang</h2>
        <div class="row justify-content-center text-center">
          <div class="col-md-6 col-sm-12 mb-3">
            <div class="bg-white bg-opacity-10 border border-white rounded p-3 h-100">
              <h5 class="fw-semibold poppins mb-0">Irpan Maulana</h5>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 mb-3">
            <div class="bg-white bg-opacity-10 border border-white rounded p-3 h-100">
              <h5 class="fw-semibold poppins mb-0">Muhammad Daffa Haikal Iskandar</h5>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 mb-3">
            <div class="bg-white bg-opacity-10 border border-white rounded p-3 h-100">
              <h5 class="fw-semibold poppins mb-0">Agus Tiansyah Ramadhan</h5>
            </div>
          </div>
          <div class="col-md-6 col-sm-12 mb-3">
            <div class="bg-white bg-opacity-10 border border-white rounded p-3 h-100">
              <h5 class="fw-semibold poppins mb-0">Arya Wardana</h5>
            </div>
          </div>
        </div>
      </div>

      <!-- Ajakan & Tombol -->
      <div class="col-lg-6 text-center d-flex flex-column justify-content-center align-items-center">
        <h4 class="mb-4">Tunggu apa lagi? Daftarkan diri kamu di sistem kami!</h4>
        <div class="d-flex gap-3">
          <a href="{{ route('loginIndex') }}" class="btn btn-outline-light">Masuk</a>
          <a href="{{ route('registrasi.index') }}" class="btn btn-light text-success">Daftar</a>
        </div>
      </div>
    </div>
  </div>
</footer>


<script>
document.addEventListener('DOMContentLoaded', function() {
    // Inisialisasi accordion dengan Bootstrap
    const accordionButtons = document.querySelectorAll('.accordion-button');
    
    accordionButtons.forEach(button => {
        button.addEventListener('click', function() {
            const target = this.getAttribute('data-bs-target');
            const accordionItem = document.querySelector(target);
            const isExpanded = this.getAttribute('aria-expanded') === 'true';
            
            // Toggle aria-expanded
            this.setAttribute('aria-expanded', !isExpanded);
            
            // Toggle collapsed class
            if (isExpanded) {
                this.classList.add('collapsed');
                accordionItem.classList.remove('show');
            } else {
                this.classList.remove('collapsed');
                accordionItem.classList.add('show');
            }
            
            // Tutup accordion lain
            accordionButtons.forEach(otherButton => {
                if (otherButton !== this) {
                    const otherTarget = otherButton.getAttribute('data-bs-target');
                    const otherAccordionItem = document.querySelector(otherTarget);
                    otherButton.classList.add('collapsed');
                    otherButton.setAttribute('aria-expanded', 'false');
                    otherAccordionItem.classList.remove('show');
                }
            });
        });
    });
});



    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
    <script>
        // acording
        // Intersection Observer untuk animasi scroll
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.classList.add('active');
                }
            });
        }, observerOptions);

        // Observe semua elemen dengan class fade-in-up
        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // Smooth scroll untuk internal links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                }
            });
        });
    </script>





@endsection