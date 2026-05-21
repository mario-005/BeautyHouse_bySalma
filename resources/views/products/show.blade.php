@extends('layouts.app')

@section('title', $product->name . ' - BeautyHouse by Salma')

@section('content')
<div class="container my-4">
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('home') }}" class="text-danger text-decoration-none">Beranda</a></li>
            <li class="breadcrumb-item"><a href="{{ route('home') }}?category={{ $product->category }}" class="text-danger text-decoration-none">{{ $product->category }}</a></li>
            <li class="breadcrumb-item active">{{ $product->name }}</li>
        </ol>
    </nav>

    <div class="row g-4 mb-5">
        <div class="col-lg-5">
            <div class="card-custom overflow-hidden" style="border-radius:16px;">
                @if($product->image)
                    <img src="{{ Storage::url($product->image) }}" class="w-100" style="height:400px; object-fit:cover;" alt="{{ $product->name }}">
                @else
                    <div class="d-flex align-items-center justify-content-center"
                        style="height:400px; background: linear-gradient(135deg,
                        {{ $product->category === 'Beauty' ? '#fce7f3, #fdf2f8' : ($product->category === 'Fashion' ? '#ede9fe, #f5f3ff' : '#fef9c3, #fefce8') }});">
                        <i class="bi bi-{{ $product->category === 'Beauty' ? 'flower2' : ($product->category === 'Fashion' ? 'bag-heart' : 'cup-hot') }}"
                            style="font-size:6rem; color: {{ $product->category === 'Beauty' ? '#be123c' : ($product->category === 'Fashion' ? '#4338ca' : '#92400e') }};"></i>
                    </div>
                @endif
            </div>
        </div>

        <div class="col-lg-7">
            <span class="badge-category badge-{{ strtolower($product->category) }} mb-2 d-inline-block">{{ $product->category }}</span>
            <h1 class="section-title fs-2 mb-2">{{ $product->name }}</h1>

            <div class="d-flex align-items-center gap-2 mb-3">
                @php $avgInt = round($avgRating ?? 0); @endphp
                <div>
                    @for($i = 1; $i <= 5; $i++)
                        <i class="bi bi-star-fill {{ $i <= $avgInt ? 'star-filled' : 'star-empty' }}" style="font-size:1rem;"></i>
                    @endfor
                </div>
                <span class="text-muted" style="font-size:0.875rem;">({{ $product->reviews->count() }} ulasan)</span>
            </div>

            <div class="price-text fs-2 fw-bold mb-3">Rp {{ number_format($product->price, 0, ',', '.') }}</div>

            <p class="text-muted mb-4">{{ $product->description }}</p>

            <div class="d-flex align-items-center gap-3 mb-4">
                <span class="fw-semibold" style="font-size:0.875rem;">Stok Tersedia:</span>
                <span class="badge {{ $product->stock > 0 ? 'bg-success-subtle text-success' : 'bg-danger-subtle text-danger' }} px-3 py-2" style="border-radius:8px;">
                    {{ $product->stock > 0 ? $product->stock . ' item' : 'Habis' }}
                </span>
            </div>

            @auth
                @if($product->stock > 0)
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="d-flex align-items-center gap-3">
                            <div class="d-flex align-items-center border rounded-3 overflow-hidden" style="height:44px;">
                                <button type="button" class="btn btn-light px-3 h-100 border-0" onclick="adjustQty(-1)">-</button>
                                <input type="number" id="qty-input" name="quantity" value="1" min="1" max="{{ $product->stock }}"
                                    class="form-control border-0 text-center fw-semibold" style="width:60px; height:100%;">
                                <button type="button" class="btn btn-light px-3 h-100 border-0" onclick="adjustQty(1)">+</button>
                            </div>
                            <button type="submit" class="btn-bh-red px-4 py-2 fw-semibold">
                                <i class="bi bi-bag-plus me-2"></i>Tambah ke Keranjang
                            </button>
                        </div>
                    </form>
                @else
                    <button class="btn btn-secondary px-4 py-2" disabled>Stok Habis</button>
                @endif
            @else
                <a href="{{ route('login') }}" class="btn-bh-red px-4 py-2 fw-semibold">
                    <i class="bi bi-person me-2"></i>Login untuk Berbelanja
                </a>
            @endauth
        </div>
    </div>

    <div class="row">
        <div class="col-12">
            <h3 class="section-title mb-2">Ulasan Pelanggan</h3>
            <hr class="divider-red mt-0 mb-4">
        </div>

        @auth
            @php $userReview = $product->reviews->where('user_id', Auth::id())->first(); @endphp
            @if(!$userReview)
                <div class="col-lg-5 mb-4">
                    <div class="card-custom p-4">
                        <h5 class="fw-bold mb-3">Tulis Ulasan</h5>
                        <form action="{{ route('reviews.store') }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <div class="mb-3">
                                <label class="form-label fw-semibold" style="font-size:0.875rem;">Rating</label>
                                <div class="d-flex gap-2">
                                    @for($i = 1; $i <= 5; $i++)
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input visually-hidden" type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" required>
                                            <label class="form-check-label" for="star{{ $i }}" style="cursor:pointer; font-size:1.5rem;" onclick="highlightStars({{ $i }})">
                                                <i class="bi bi-star-fill" id="star-icon-{{ $i }}" style="color:#d1d5db;"></i>
                                            </label>
                                        </div>
                                    @endfor
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="comment" class="form-label fw-semibold" style="font-size:0.875rem;">Komentar</label>
                                <textarea id="comment" name="comment" class="form-control @error('comment') is-invalid @enderror"
                                    rows="3" placeholder="Tulis pengalaman Anda dengan produk ini...">{{ old('comment') }}</textarea>
                                @error('comment')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            <button type="submit" class="btn-bh-red px-4 py-2 fw-semibold">Kirim Ulasan</button>
                        </form>
                    </div>
                </div>
            @endif
        @endauth

        <div class="col-lg-7">
            @forelse($product->reviews as $review)
                <div class="card-custom p-4 mb-3">
                    <div class="d-flex justify-content-between align-items-start">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center fw-bold text-white"
                                style="width:42px; height:42px; background:#dc3545; font-size:0.875rem;">
                                {{ strtoupper(substr($review->user->name, 0, 1)) }}
                            </div>
                            <div>
                                <div class="fw-semibold" style="font-size:0.9rem;">{{ $review->user->name }}</div>
                                <div>
                                    @for($i = 1; $i <= 5; $i++)
                                        <i class="bi bi-star-fill {{ $i <= $review->rating ? 'star-filled' : 'star-empty' }}" style="font-size:0.75rem;"></i>
                                    @endfor
                                </div>
                            </div>
                        </div>
                        @auth
                            @if($review->user_id === Auth::id())
                                <div class="d-flex gap-2">
                                    <a href="{{ route('reviews.edit', $review->id) }}" class="btn btn-sm btn-outline-secondary" style="border-radius:8px;">Edit</a>
                                    <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" onsubmit="return confirm('Hapus ulasan ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;">Hapus</button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                    <p class="text-muted mb-0 mt-3" style="font-size:0.875rem;">{{ $review->comment }}</p>
                    <div class="text-muted mt-2" style="font-size:0.75rem;">{{ $review->created_at->format('d M Y') }}</div>
                </div>
            @empty
                <div class="text-center py-4">
                    <i class="bi bi-chat-left-text" style="font-size:3rem; color:#d1d5db;"></i>
                    <p class="text-muted mt-2">Belum ada ulasan untuk produk ini.</p>
                </div>
            @endforelse
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function adjustQty(delta) {
    const inp = document.getElementById('qty-input');
    const max = parseInt(inp.max);
    let val = parseInt(inp.value) + delta;
    if (val < 1) val = 1;
    if (val > max) val = max;
    inp.value = val;
}

function highlightStars(n) {
    for (let i = 1; i <= 5; i++) {
        document.getElementById('star-icon-' + i).style.color = i <= n ? '#f59e0b' : '#d1d5db';
    }
}
</script>
@endsection
