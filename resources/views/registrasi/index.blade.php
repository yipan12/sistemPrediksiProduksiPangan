@extends('layouts.auth')

@section('container')
<div class="container d-flex flex-column  justify-content-center align-items-center vh-100">
    <div class="card  p-4" style="width: 100%; max-width: 450px;">
        <h3 class="text-center mb-4">Registration Form</h3>
        <form method="POST" action="/register">
            @csrf
            {{-- nama --}}
            <div class="mb-3 form-floating">
                
                <input 
                    type="text" 
                    class="form-control @error('name') is-invalid @enderror" 
                    id="name" 
                    name="name" 
                    value="{{ old('name') }}" 
                    placeholder="name"
                    required 
                    autofocus>
                @error('name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="name">name</label>
            </div>
            {{-- email --}}
            <div class="mb-3 form-floating">
                
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="email"
                    required 
                    autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="email">Email</label>
            </div>
            {{-- password --}}
            <div class="mb-3 form-floating">
                
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    name="password" 
                    placeholder="Password"
                    required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="password">Password</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Regist</button>
            
        </form>
    </div>
    <small class="mt-3">Already registered? <a href="/">Login</a></small>
</div>
@endsection
