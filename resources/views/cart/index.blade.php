@extends('layouts.app')

@section('title', 'Keranjang Belanja')

@section('content')
<div class="container my-4">
    <h2 class="section-title mb-4">Keranjang Belanja</h2>

    @if($cartItems->isEmpty())
        <div class="card-custom p-5 text-center">
            <i class="bi bi-bag-x" style="font-size:5rem; color:#d1d5db;"></i>
            <h4 class="fw-bold mt-3 mb-2">Keranjang Masih Kosong</h4>
            <p class="text-muted mb-4">Anda belum menambahkan produk apapun ke keranjang.</p>
            <a href="{{ route('home') }}" class="btn-bh-red px-4 py-2">Mulai Belanja</a>
        </div>
    @else
        <div class="row g-4">
            <div class="col-lg-8">
                <div class="card-custom p-0 overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead>
                                <tr>
                                    <th style="min-width:220px; padding:1rem 1.5rem;">Produk</th>
                                    <th class="text-center">Harga</th>
                                    <th class="text-center" style="width:150px;">Jumlah</th>
                                    <th class="text-end">Subtotal</th>
                                    <th class="text-center">Hapus</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($cartItems as $item)
                                    <tr>
                                        <td style="padding:1rem 1.5rem;">
                                            <div class="d-flex align-items-center gap-3">
                                                <div style="width:50px; height:50px; border-radius:10px; overflow:hidden; background:#f3f4f6; flex-shrink:0;">
                                                    @if($item->product->image)
                                                        <img src="{{ Storage::url($item->product->image) }}" class="w-100 h-100" style="object-fit:cover;">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                                            <i class="bi bi-bag text-muted"></i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div>
                                                    <div class="fw-semibold" style="font-size:0.9rem;">{{ $item->product->name }}</div>
                                                    <span class="badge-category badge-{{ strtolower($item->product->category) }}">{{ $item->product->category }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="text-center price-text fw-semibold">Rp {{ number_format($item->product->price, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="d-flex justify-content-center align-items-center gap-1">
                                                @csrf
                                                @method('PUT')
                                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" max="{{ $item->product->stock }}"
                                                    class="form-control text-center fw-semibold p-1" style="width:70px; border-radius:8px;" onchange="this.form.submit()">
                                            </form>
                                        </td>
                                        <td class="text-end fw-bold">Rp {{ number_format($item->product->price * $item->quantity, 0, ',', '.') }}</td>
                                        <td class="text-center">
                                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;" onclick="return confirm('Hapus produk ini?')">
                                                    <i class="bi bi-trash"></i>
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card-custom p-4">
                    <h5 class="fw-bold mb-4">Ringkasan Belanja</h5>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Total Item</span>
                        <span class="fw-semibold">{{ $cartItems->sum('quantity') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Subtotal</span>
                        <span class="fw-semibold">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <div class="d-flex justify-content-between mb-2">
                        <span class="text-muted">Ongkir</span>
                        <span class="text-success fw-semibold">Gratis</span>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-between mb-4">
                        <span class="fw-bold fs-5">Total</span>
                        <span class="price-text fw-bold fs-5">Rp {{ number_format($total, 0, ',', '.') }}</span>
                    </div>
                    <a href="{{ route('cart.checkout') }}" class="btn-bh-red w-100 py-2 text-center fw-semibold d-block" style="border-radius:8px;">
                        Lanjut ke Checkout
                    </a>
                    <a href="{{ route('home') }}" class="btn-bh-outline w-100 py-2 text-center fw-semibold d-block mt-2" style="border-radius:8px;">
                        Lanjut Belanja
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
