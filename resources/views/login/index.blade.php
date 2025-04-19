@extends('layouts.auth')

@section('container')
<div class="container flex-column d-flex justify-content-center align-items-center vh-100">
    <div class="card  p-4" style="width: 100%; max-width: 400px;">
        <h3 class="text-center mb-4">Login</h3>

        {{-- Flash message success --}}
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
        
        <form method="POST" action="/login">
            @csrf
            {{-- email --}}
            <div class="mb-3 form-floating">
                <input 
                    type="email" 
                    class="form-control @error('email') is-invalid @enderror" 
                    id="email" 
                    name="email" 
                    value="{{ old('email') }}" 
                    placeholder="Email"
                    required 
                    autofocus>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="email" class="form-label">Email</label>
            </div>
            {{-- password --}}
            <div class="mb-3 form-floating">
                <input 
                    type="password" 
                    class="form-control @error('password') is-invalid @enderror" 
                    id="password" 
                    placeholder="Password"
                    name="password" 
                    required>
                @error('password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <label for="password" class="form-label">Password</label>
            </div>

            <button type="submit" class="btn btn-primary w-100">Login</button>
            
                
                
            
        </form>

    </div>
    <a href="/register" class="mt-3">Not have account?</a>
</div>
@endsection
