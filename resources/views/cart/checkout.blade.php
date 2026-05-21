@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<div class="container my-4">
    <h2 class="section-title mb-4">Checkout Pesanan</h2>

    <div class="row g-4">
        <div class="col-lg-7">
            <div class="card-custom p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-geo-alt-fill text-danger me-2"></i>Informasi Pengiriman</h5>

                <form action="{{ route('orders.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:0.875rem;">Nama Penerima</label>
                        <input type="text" class="form-control bg-light" value="{{ Auth::user()->name }}" disabled>
                    </div>

                    <div class="mb-4">
                        <label for="shipping_address" class="form-label fw-semibold" style="font-size:0.875rem;">Alamat Lengkap Pengiriman</label>
                        <textarea id="shipping_address" name="shipping_address" rows="4"
                            class="form-control @error('shipping_address') is-invalid @enderror"
                            placeholder="Contoh: Jl. Sukapura, Telekomunikasi, Bojongsoang, Kabupaten Bandung">{{ old('shipping_address') }}</textarea>
                        @error('shipping_address')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn-bh-red w-100 py-2 fw-semibold" style="border-radius:8px;">
                        <i class="bi bi-check-circle me-2"></i>Konfirmasi Pesanan
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-5">
            <div class="card-custom p-4">
                <h5 class="fw-bold mb-4"><i class="bi bi-bag-check text-danger me-2"></i>Ringkasan Pesanan</h5>

                @foreach($cartItems as $item)
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex align-items-center gap-2">
                            <div style="width:40px; height:40px; border-radius:8px; background:#f3f4f6; flex-shrink:0; overflow:hidden;">
                                @if($item->product->image)
                                    <img src="{{ Storage::url($item->product->image) }}" class="w-100 h-100" style="object-fit:cover;">
                                @else
                                    <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                        <i class="bi bi-bag" style="font-size:0.9rem; color:#9ca3af;"></i>
                                    </div>
                                @endif
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:0.85rem;">{{ $item->product->name }}</div>
                                <div class="text-muted" style="font-size:0.75rem;">x {{ $item->quantity }}</div>
                            </div>
                        </div>
                        <span class="fw-semibold" style="font-size:0.875rem;">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</span>
                    </div>
                @endforeach

                <hr>
                <div class="d-flex justify-content-between">
                    <span class="fw-bold">Total Pembayaran</span>
                    <span class="price-text fw-bold fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
