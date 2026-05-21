@extends('layouts.app')

@section('title', 'Edit Ulasan')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card-custom p-4">
                <h4 class="fw-bold mb-4">Edit Ulasan</h4>

                <form action="{{ route('reviews.update', $review->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label class="form-label fw-semibold" style="font-size:0.875rem;">Rating</label>
                        <div class="d-flex gap-2">
                            @for($i = 1; $i <= 5; $i++)
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input visually-hidden" type="radio" name="rating" id="star{{ $i }}" value="{{ $i }}" {{ $review->rating == $i ? 'checked' : '' }}>
                                    <label class="form-check-label" for="star{{ $i }}" style="cursor:pointer; font-size:1.5rem;" onclick="highlightStars({{ $i }})">
                                        <i class="bi bi-star-fill" id="star-icon-{{ $i }}" style="color: {{ $review->rating >= $i ? '#f59e0b' : '#d1d5db' }};"></i>
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="comment" class="form-label fw-semibold" style="font-size:0.875rem;">Komentar</label>
                        <textarea id="comment" name="comment" rows="4"
                            class="form-control @error('comment') is-invalid @enderror">{{ old('comment', $review->comment) }}</textarea>
                        @error('comment')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex gap-2">
                        <button type="submit" class="btn-bh-red px-4 py-2 fw-semibold">Simpan Perubahan</button>
                        <a href="{{ route('products.show', $review->product_id) }}" class="btn-bh-outline px-4 py-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
function highlightStars(n) {
    for (let i = 1; i <= 5; i++) {
        document.getElementById('star-icon-' + i).style.color = i <= n ? '#f59e0b' : '#d1d5db';
    }
}
</script>
@endsection
