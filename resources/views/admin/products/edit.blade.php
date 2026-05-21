@extends('layouts.app')

@section('title', 'Edit Produk')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
                <h4 class="fw-bold mb-0">Edit Produk</h4>
            </div>

            <div class="card-custom p-4">
                <form action="{{ route('admin.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Nama Produk</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $product->name) }}">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Kategori</label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror">
                                <option value="Sunscreen" {{ old('category', $product->category) === 'Sunscreen' ? 'selected' : '' }}>Sunscreen</option>
                                <option value="Face Wash" {{ old('category', $product->category) === 'Face Wash' ? 'selected' : '' }}>Face Wash</option>
                                <option value="Scrub" {{ old('category', $product->category) === 'Scrub' ? 'selected' : '' }}>Scrub</option>
                                <option value="Serum" {{ old('category', $product->category) === 'Serum' ? 'selected' : '' }}>Serum</option>
                                <option value="Fashion" {{ old('category', $product->category) === 'Fashion' ? 'selected' : '' }}>Fashion</option>

                            </select>
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price', $product->price) }}" min="0">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Stok</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock', $product->stock) }}" min="0">
                            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Deskripsi</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror">{{ old('description', $product->description) }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Gambar Produk</label>
                            @if($product->image)
                                <div class="mb-2">
                                    <img src="{{ Storage::url($product->image) }}" style="height:100px; border-radius:10px; object-fit:cover;">
                                </div>
                            @endif
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            <div class="form-text">Kosongkan jika tidak ingin mengganti gambar.</div>
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn-bh-red px-4 py-2 fw-semibold">Simpan Perubahan</button>
                        <a href="{{ route('admin.products.index') }}" class="btn-bh-outline px-4 py-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
