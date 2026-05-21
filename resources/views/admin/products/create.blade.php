@extends('layouts.app')

@section('title', 'Tambah Produk')

@section('content')
<div class="container my-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="d-flex align-items-center gap-3 mb-4">
                <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-sm rounded-3">
                    <i class="bi bi-arrow-left me-1"></i>Kembali
                </a>
                <h4 class="fw-bold mb-0">Tambah Produk Baru</h4>
            </div>

            <div class="card-custom p-4">
                <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="row g-3">
                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Nama Produk</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name') }}" placeholder="Masukkan nama produk">
                            @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Kategori</label>
                            <select name="category" class="form-select @error('category') is-invalid @enderror">
                                <option value="">Pilih Kategori</option>
                                <option value="Sunscreen" {{ old('category') === 'Sunscreen' ? 'selected' : '' }}>Sunscreen</option>
                                <option value="Face Wash" {{ old('category') === 'Face Wash' ? 'selected' : '' }}>Face Wash</option>
                                <option value="Scrub" {{ old('category') === 'Scrub' ? 'selected' : '' }}>Scrub</option>
                                <option value="Serum" {{ old('category') === 'Serum' ? 'selected' : '' }}>Serum</option>
                                <option value="Fashion" {{ old('category') === 'Fashion' ? 'selected' : '' }}>Fashion</option>
                            </select>
                            @error('category')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Harga (Rp)</label>
                            <input type="number" name="price" class="form-control @error('price') is-invalid @enderror"
                                value="{{ old('price') }}" min="0" placeholder="0">
                            @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-md-4">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Stok</label>
                            <input type="number" name="stock" class="form-control @error('stock') is-invalid @enderror"
                                value="{{ old('stock') }}" min="0" placeholder="0">
                            @error('stock')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Deskripsi</label>
                            <textarea name="description" rows="4" class="form-control @error('description') is-invalid @enderror"
                                placeholder="Tulis deskripsi produk...">{{ old('description') }}</textarea>
                            @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>

                        <div class="col-12">
                            <label class="form-label fw-semibold" style="font-size:0.875rem;">Gambar Produk <span class="text-muted fw-normal">(Opsional)</span></label>
                            <input type="file" name="image" class="form-control @error('image') is-invalid @enderror" accept="image/*">
                            @error('image')<div class="invalid-feedback">{{ $message }}</div>@enderror
                        </div>
                    </div>

                    <div class="d-flex gap-2 mt-4">
                        <button type="submit" class="btn-bh-red px-4 py-2 fw-semibold">Simpan Produk</button>
                        <a href="{{ route('admin.products.index') }}" class="btn-bh-outline px-4 py-2">Batal</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
