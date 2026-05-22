@extends('layouts.app')

@section('title', 'Katalog Produk - BeautyHouse by Salma')

@section('content')
<div class="hero-section py-5 mb-4">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-7">
                <p class="text-danger fw-semibold mb-1" style="font-size:0.875rem; letter-spacing:1px; text-transform:uppercase;">Koleksi Terbaru 2026</p>
                <h1 class="section-title display-5 fw-black mb-3">Fashion, Beauty & <br>Koleksi Terbaik</h1>
                <p class="text-muted mb-4" style="max-width: 460px;">Temukan produk pilihan berkualitas tinggi untuk penampilan dan gaya hidup terbaik Anda.</p>
                <div class="d-flex gap-3 flex-wrap">
                    <a href="#products" class="btn-bh-red px-4 py-2">Lihat Produk</a>
                    @guest
                        <a href="{{ route('register') }}" class="btn-bh-outline px-4 py-2">Daftar Gratis</a>
                    @endguest
                </div>
            </div>
            <div class="col-lg-5 d-none d-lg-flex justify-content-center">
                <div class="d-flex gap-3">
                    <div class="d-flex flex-column gap-3">
                        <div style="width:120px; height:150px; background: linear-gradient(135deg, #fce7f3, #fff1f2); border-radius: 12px;"></div>
                        <div style="width:120px; height:100px; background: linear-gradient(135deg, #ede9fe, #ddd6fe); border-radius: 12px;"></div>
                    </div>
                    <div class="d-flex flex-column gap-3" style="margin-top:30px;">
                        <div style="width:120px; height:100px; background: linear-gradient(135deg, #fef9c3, #fef3c7); border-radius: 12px;"></div>
                        <div style="width:120px; height:150px; background: linear-gradient(135deg, #dbeafe, #eff6ff); border-radius: 12px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container pb-5" id="products">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center mb-4 gap-3">
        <div>
            <h2 class="section-title mb-1">Semua Produk</h2>
            <hr class="divider-red mt-0 mb-0">
        </div>
        <form method="GET" action="{{ route('home') }}" class="d-flex gap-2">
            <input type="text" name="search" class="form-control" placeholder="Cari produk..." value="{{ request('search') }}" style="border-radius:8px; min-width:200px;">
            @if(request('category'))
                <input type="hidden" name="category" value="{{ request('category') }}">
            @endif
            <button type="submit" class="btn-bh-red px-3 py-2">Cari</button>
        </form>
    </div>

    <div class="d-flex gap-2 flex-wrap mb-4">
        <a href="{{ route('home') }}" class="filter-pill {{ !request('category') && !request('search') ? 'active' : '' }}">Semua</a>
        <a href="{{ route('home') }}?category=Sunscreen" class="filter-pill {{ request('category') === 'Sunscreen' ? 'active' : '' }}">Sunscreen</a>
        <a href="{{ route('home') }}?category=Face+Wash" class="filter-pill {{ request('category') === 'Face Wash' ? 'active' : '' }}">Face Wash</a>
        <a href="{{ route('home') }}?category=Scrub" class="filter-pill {{ request('category') === 'Scrub' ? 'active' : '' }}">Scrub</a>
        <a href="{{ route('home') }}?category=Serum" class="filter-pill {{ request('category') === 'Serum' ? 'active' : '' }}">Serum</a>
        <a href="{{ route('home') }}?category=Fashion" class="filter-pill {{ request('category') === 'Fashion' ? 'active' : '' }}">Fashion</a>
    </div>

    @if($products->isEmpty())
        <div class="text-center py-5">
            <i class="bi bi-search" style="font-size: 4rem; color: #d1d5db;"></i>
            <h4 class="mt-3 text-muted">Produk tidak ditemukan</h4>
            <a href="{{ route('home') }}" class="btn-bh-red px-4 py-2 mt-2 d-inline-block">Lihat Semua Produk</a>
        </div>
    @else
        <div class="row row-cols-2 row-cols-md-3 row-cols-lg-4 g-4">
            @foreach($products as $product)
                @php
                    $badgeClass = match($product->category) {
                        'Sunscreen' => 'badge-sunscreen',
                        'Face Wash' => 'badge-facewash',
                        'Scrub'     => 'badge-scrub',
                        'Serum'     => 'badge-serum',
                        default     => 'badge-fashion',
                    };
                    $bgGrad = match($product->category) {
                        'Sunscreen' => '#fef9c3, #fef3c7',
                        'Face Wash' => '#dbeafe, #eff6ff',
                        'Scrub'     => '#ede9fe, #f5f3ff',
                        'Serum'     => '#ffe4e6, #fff1f2',
                        default     => '#e0e7ff, #eef2ff',
                    };
                    $icon = match($product->category) {
                        'Sunscreen' => 'sun',
                        'Face Wash' => 'droplet',
                        'Scrub'     => 'stars',
                        'Serum'     => 'eyedropper',
                        default     => 'bag-heart',
                    };
                    $iconColor = match($product->category) {
                        'Sunscreen' => '#854d0e',
                        'Face Wash' => '#1e40af',
                        'Scrub'     => '#4338ca',
                        'Serum'     => '#be123c',
                        default     => '#3730a3',
                    };
                @endphp
                <div class="col">
                    <div class="card-custom h-100 p-0 overflow-hidden">
                        <a href="{{ route('products.show', $product->id) }}" class="text-decoration-none text-dark">
                            @if($product->image)
                                <img src="{{ Storage::url($product->image) }}" class="w-100" style="height:200px; object-fit:cover;" alt="{{ $product->name }}">
                            @else
                                <div class="d-flex align-items-center justify-content-center"
                                    style="height:200px; background: linear-gradient(135deg, {{ $bgGrad }});">
                                    <i class="bi bi-{{ $icon }}" style="font-size:3rem; color: {{ $iconColor }};"></i>
                                </div>
                            @endif
                            <div class="p-3">
                                <span class="badge-category {{ $badgeClass }} mb-2 d-inline-block">{{ $product->category }}</span>
                                <h6 class="fw-semibold mb-1" style="font-size:0.9rem; line-height:1.4;">{{ $product->name }}</h6>
                                <p class="text-muted mb-2" style="font-size:0.8rem; display:-webkit-box; -webkit-line-clamp:2; -webkit-box-orient:vertical; overflow:hidden;">{{ $product->description }}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="price-text">Rp {{ number_format($product->price, 0, ',', '.') }}</span>
                                    <span class="text-muted" style="font-size:0.75rem;">Stok: {{ $product->stock }}</span>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-5 d-flex justify-content-center">
            {{ $products->links() }}
        </div>
    @endif
</div>
@endsection
