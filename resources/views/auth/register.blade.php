@extends('layouts.app')

@section('title', 'Daftar Akun - BeautyHouse by Salma')

@section('content')
<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-5">
            <div class="text-center mb-4">
                <a href="{{ route('home') }}" class="text-decoration-none">
                    <span style="font-size:1.8rem; font-weight:800; color:#dc3545;">Beauty</span><span style="font-size:1.8rem; font-weight:800; color:#1a202c;">House</span>
                </a>
                <p class="text-muted mt-1" style="font-size:0.875rem;">Buat akun baru secara gratis</p>
            </div>

            <div class="card-custom p-4 p-md-5">
                <h4 class="fw-bold text-dark mb-1">Buat Akun Baru</h4>
                <p class="text-muted mb-4" style="font-size:0.875rem;">Isi formulir di bawah untuk mendaftar.</p>

                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="mb-3">
                        <label for="name" class="form-label fw-semibold" style="font-size:0.875rem;">Nama Lengkap</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror"
                            name="name" value="{{ old('name') }}" required autofocus placeholder="Masukkan nama lengkap">
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label fw-semibold" style="font-size:0.875rem;">Alamat Email</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror"
                            name="email" value="{{ old('email') }}" required placeholder="email@contoh.com">
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label fw-semibold" style="font-size:0.875rem;">Password</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required placeholder="Minimal 6 karakter">
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label fw-semibold" style="font-size:0.875rem;">Konfirmasi Password</label>
                        <input id="password_confirmation" type="password" class="form-control"
                            name="password_confirmation" required placeholder="Ulangi password">
                    </div>

                    <button type="submit" class="btn-bh-red w-100 py-2 text-center fw-semibold" style="border-radius:8px;">
                        Daftar Sekarang
                    </button>
                </form>

                <hr class="my-4">
                <p class="text-center text-muted mb-0" style="font-size:0.875rem;">
                    Sudah punya akun?
                    <a href="{{ route('login') }}" class="text-danger fw-semibold text-decoration-none">Masuk di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
