@extends('layouts.app')

@section('title', 'Kelola Produk')

@section('content')
<div class="container my-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="section-title mb-1">Kelola Produk</h2>
            <p class="text-muted mb-0" style="font-size:0.875rem;">Manajemen katalog, stok, dan harga produk.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-dark btn-sm px-3 py-2 rounded-3 fw-semibold">Pesanan</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-danger btn-sm px-3 py-2 rounded-3 fw-semibold">Produk</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark btn-sm px-3 py-2 rounded-3 fw-semibold">User</a>
        </div>
    </div>

    <div class="card-custom p-0 overflow-hidden">
        <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
            <h5 class="fw-bold mb-0">Daftar Produk</h5>
            <a href="{{ route('admin.products.create') }}" class="btn-bh-red px-3 py-2 fw-semibold">
                <i class="bi bi-plus-lg me-1"></i>Tambah Produk
            </a>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="padding:1rem 1.5rem; width:70px;">Gambar</th>
                        <th>Nama Produk</th>
                        <th class="text-center">Kategori</th>
                        <th class="text-end">Harga</th>
                        <th class="text-center">Stok</th>
                        <th class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr>
                            <td style="padding:1rem 1.5rem;">
                                <div style="width:50px; height:50px; border-radius:10px; overflow:hidden; background:#f3f4f6;">
                                    @if($product->image)
                                        <img src="{{ Storage::url($product->image) }}" class="w-100 h-100" style="object-fit:cover;">
                                    @else
                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center">
                                            <i class="bi bi-image text-muted"></i>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="fw-semibold" style="font-size:0.9rem;">{{ $product->name }}</div>
                                <div class="text-muted" style="font-size:0.8rem; max-width:250px; white-space:nowrap; overflow:hidden; text-overflow:ellipsis;">{{ $product->description }}</div>
                            </td>
                            <td class="text-center"><span class="badge-category badge-{{ strtolower($product->category) }}">{{ $product->category }}</span></td>
                            <td class="text-end price-text fw-semibold">Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="{{ $product->stock > 5 ? 'text-success' : ($product->stock > 0 ? 'text-warning' : 'text-danger') }} fw-semibold">{{ $product->stock }}</span>
                            </td>
                            <td class="text-center">
                                <div class="d-flex justify-content-center gap-2">
                                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-sm btn-outline-primary" style="border-radius:8px;">Edit</a>
                                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" onsubmit="return confirm('Hapus produk ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger" style="border-radius:8px;">Hapus</button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">Belum ada produk yang ditambahkan.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($products->hasPages())
            <div class="p-4 border-top">{{ $products->links() }}</div>
        @endif
    </div>
</div>
@endsection
