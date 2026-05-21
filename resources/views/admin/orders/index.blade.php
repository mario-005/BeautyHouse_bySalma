@extends('layouts.app')

@section('title', 'Dashboard Admin')

@section('content')
<div class="container my-4">
    <div class="d-flex flex-column flex-md-row justify-content-between align-items-md-center gap-3 mb-4">
        <div>
            <h2 class="section-title mb-1">Dashboard Admin</h2>
            <p class="text-muted mb-0" style="font-size:0.875rem;">Halaman manajemen penjualan dan pemantauan toko.</p>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.dashboard') }}" class="btn btn-danger btn-sm px-3 py-2 rounded-3 fw-semibold">Pesanan</a>
            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-dark btn-sm px-3 py-2 rounded-3 fw-semibold">Produk</a>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-dark btn-sm px-3 py-2 rounded-3 fw-semibold">User</a>
        </div>
    </div>

    <div class="row g-4 mb-5">
        <div class="col-md-3">
            <div class="card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-semibold" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.5px;">Total Penjualan</span>
                    <div class="bg-success-subtle text-success rounded-3 p-2"><i class="bi bi-currency-dollar fs-5"></i></div>
                </div>
                <div class="fw-bold fs-5 text-dark font-monospace">Rp {{ number_format($totalSales, 0, ',', '.') }}</div>
                <div class="text-success mt-1" style="font-size:0.8rem;">Dari pesanan selesai</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-semibold" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.5px;">Menunggu</span>
                    <div class="bg-warning-subtle text-warning rounded-3 p-2"><i class="bi bi-clock fs-5"></i></div>
                </div>
                <div class="fw-bold fs-2 text-dark">{{ $pendingCount }}</div>
                <div class="text-warning mt-1" style="font-size:0.8rem;">Pesanan pending</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-semibold" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.5px;">Selesai</span>
                    <div class="bg-success-subtle text-success rounded-3 p-2"><i class="bi bi-check-circle fs-5"></i></div>
                </div>
                <div class="fw-bold fs-2 text-dark">{{ $completedCount }}</div>
                <div class="text-success mt-1" style="font-size:0.8rem;">Pesanan selesai</div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card-custom p-4">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="text-muted fw-semibold" style="font-size:0.8rem; text-transform:uppercase; letter-spacing:0.5px;">Dibatalkan</span>
                    <div class="bg-danger-subtle text-danger rounded-3 p-2"><i class="bi bi-x-circle fs-5"></i></div>
                </div>
                <div class="fw-bold fs-2 text-dark">{{ $cancelledCount }}</div>
                <div class="text-danger mt-1" style="font-size:0.8rem;">Pesanan batal</div>
            </div>
        </div>
    </div>

    <div class="card-custom p-0 overflow-hidden">
        <div class="p-4 border-bottom">
            <h5 class="fw-bold mb-0">Daftar Pesanan</h5>
        </div>
        <div class="table-responsive">
            <table class="table table-hover align-middle mb-0">
                <thead>
                    <tr>
                        <th style="padding:1rem 1.5rem;">ID</th>
                        <th>Pelanggan</th>
                        <th style="min-width:160px;">Produk</th>
                        <th class="text-center">Qty</th>
                        <th class="text-end">Total</th>
                        <th class="text-center">Status</th>
                        <th class="text-center">Ubah Status</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $order)
                        <tr>
                            <td style="padding:1rem 1.5rem;" class="fw-bold text-muted">#BH-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                            <td>
                                <div class="fw-semibold" style="font-size:0.875rem;">{{ $order->user->name }}</div>
                                <div class="text-muted" style="font-size:0.75rem;">{{ $order->user->email }}</div>
                            </td>
                            <td>
                                <div class="fw-semibold" style="font-size:0.875rem;">{{ $order->product->name }}</div>
                                <span class="badge-category badge-{{ strtolower($order->product->category) }}">{{ $order->product->category }}</span>
                            </td>
                            <td class="text-center">{{ $order->quantity }}</td>
                            <td class="text-end price-text fw-semibold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                            <td class="text-center">
                                <span class="status-badge status-{{ strtolower(str_replace(' ', '', $order->status)) }}">{{ $order->status }}</span>
                            </td>
                            <td class="text-center">
                                <form action="{{ route('admin.orders.updateStatus', $order->id) }}" method="POST" class="d-flex justify-content-center gap-1">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select form-select-sm" style="width:130px; border-radius:8px;" onchange="this.form.submit()">
                                        <option value="Pending" {{ $order->status === 'Pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="Diproses" {{ $order->status === 'Diproses' ? 'selected' : '' }}>Diproses</option>
                                        <option value="Selesai" {{ $order->status === 'Selesai' ? 'selected' : '' }}>Selesai</option>
                                        <option value="Dibatalkan" {{ $order->status === 'Dibatalkan' ? 'selected' : '' }}>Dibatalkan</option>
                                    </select>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-5 text-muted">Belum ada pesanan masuk.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        @if($orders->hasPages())
            <div class="p-4 border-top">{{ $orders->links() }}</div>
        @endif
    </div>
</div>
@endsection
