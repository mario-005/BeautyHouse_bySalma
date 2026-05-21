@extends('layouts.app')

@section('title', 'Login - BeautyHouse by Salma')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <span style="font-size:1.8rem; font-weight:800; color:#dc3545;">Beauty</span><span style="font-size:1.8rem; font-weight:800; color:#1a202c;">House</span>
                </a>
                <p class="text-muted mt-1" style="font-size:0.875rem;">Masuk ke akun Anda</p>
            </div>

            <div class="card-custom p-4 p-md-5">
                <h4 class="fw-bold text-dark mb-1">Selamat Datang Kembali</h4>
                <p class="text-muted mb-4" style="font-size:0.875rem;">Silakan masuk untuk melanjutkan berbelanja.</p>

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold" style="font-size:0.875rem;">Alamat Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required autofocus placeholder="email@contoh.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold" style="font-size:0.875rem;">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required placeholder="Masukkan password">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4 d-flex align-items-center justify-content-between">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="remember" id="remember">
                            <label class="form-check-label text-muted" for="remember" style="font-size:0.875rem;">Ingat saya</label>
                        </div>
                    </div>

                    <button type="submit" class="btn-bh-red w-100 py-2 text-center fw-semibold" style="border-radius:8px;">
                        Masuk
                    </button>
                </form>

                <hr class="my-4">
                <p class="text-center text-muted mb-0" style="font-size:0.875rem;">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-danger fw-semibold text-decoration-none">Daftar sekarang</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
