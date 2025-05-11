@extends('layouts.auth')

@section('container')
<body class="min-vh-100 d-flex flex-column container" style="background: url('/asset/backgorund2.png') no-repeat center center; background-size: cover;">
    

<div class="min-vh-100 d-flex flex-column container">
    <div class="container-fluid flex-grow-1 d-flex">
        <div class="row w-100">        
            <!-- Gambar -->
            <div class="col-lg-7 d-md-flex justify-content-center align-items-center d-none" >
                <img src="{{ asset('asset/undraw_online-banking_l9sn.png') }}"
                     class="w-75" alt="Sample image">
            </div>

            <!-- Form -->
            <div class="col-lg-5 d-flex flex-column justify-content-start ">
                
                <div class="mb-5 mt-4 d-flex w-50 align-items-center gap-2">
                    <img src="{{ asset('asset/logoSistemPrediksi.png') }}"  style="width: 50px">
                    <h1 class="fs-6 mt-2 poppins fw-bolder text-gradient-green-blue">SISTEM PREDIKSI PRODUKSI PANGAN</h1>
                </div>
                <div class="mt-5">
                    <h1 class="text-center fs-3 poppins">Selamat datang</h1>
                    <p class="text-center poppins ">Silahkan Masukan Email dan Password kamu!!</p>
                </div>
                <hr>
                <div class="w-100 px-4"> 
                    <form method="POST" action="/login">
                        {{-- Notifikasi --}}
                        @if (session('status'))
                            <div class="alert alert-success text-center">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (session('LoginEror'))
                            <div class="alert alert-danger text-center">
                                {{ session('LoginEror') }}
                            </div>
                        @endif
                        {{-- Akhir Notifikasi --}}

                        @csrf

                        <!-- Judul -->
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start mb-4 ">
                            <p class="lead fw-normal mb-0 me-3 poppins fw-bold">Sign In</p>
                            <button type="button" class="btn btn-success btn-floating mx-1"></button>
                            <button type="button" class="btn btn-success btn-floating mx-1"></button>
                            <button type="button" class="btn btn-success btn-floating mx-1"></button>
                        </div>
                        <!-- Email input -->
                        <div class="form-floating mb-4 ">
                            <input type="email" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email') }}" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   placeholder="Email" 
                                   required 
                                   autofocus />
                                   <label for="email poppins">Email</label>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password input -->
                        <div class="form-floating mb-4 ">
                            <input type="password" 
                                   id="password" 
                                   name="password" 
                                   class="form-control" 
                                   placeholder="Password"
                                   />
                                   <i class="fa-solid fa-eye password-toggle" id="togglePassword"
                                    style="position: absolute; color: rgb(179, 179, 179); top: 50%; right: 1rem; transform: translateY(-50%); cursor: pointer;"></i>
                                   <label for="password">Password</label>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            
                        </div>

                        <!-- Tombol dan link -->
                        <div class="text-center text-lg-start">
                            <button type="submit" class="btn btn-success w-100"
                                style="padding-left: 2.5rem; padding-right: 2.5rem;">Login</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Gak punya akun? 
                                <a href="/register" class="link-danger fw-bold">Regist di sini!!</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</div>
</body>
@endsection