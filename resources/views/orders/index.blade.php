@extends('layouts.app')

@section('title', 'Riwayat Belanja')

@section('content')
<div class="container my-4">
    <h2 class="section-title mb-4">Riwayat Belanja</h2>

    @if($orders->isEmpty())
        <div class="card-custom p-5 text-center">
            <i class="bi bi-bag-x" style="font-size:5rem; color:#d1d5db;"></i>
            <h4 class="fw-bold mt-3 mb-2">Belum Ada Riwayat Belanja</h4>
            <p class="text-muted mb-4">Anda belum melakukan transaksi apapun.</p>
            <a href="{{ route('home') }}" class="btn-bh-red px-4 py-2">Belanja Sekarang</a>
        </div>
    @else
        <div class="card-custom p-0 overflow-hidden">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead>
                        <tr>
                            <th style="padding:1rem 1.5rem;">ID Pesanan</th>
                            <th style="min-width:180px;">Produk</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-end">Total</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Tanggal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $order)
                            <tr>
                                <td style="padding:1rem 1.5rem;" class="fw-bold text-muted">#BH-{{ str_pad($order->id, 4, '0', STR_PAD_LEFT) }}</td>
                                <td>
                                    <div class="fw-semibold" style="font-size:0.9rem;">{{ $order->product->name }}</div>
                                    <span class="badge-category badge-{{ strtolower($order->product->category) }}">{{ $order->product->category }}</span>
                                </td>
                                <td class="text-center">{{ $order->quantity }}</td>
                                <td class="text-end price-text fw-bold">Rp {{ number_format($order->total_price, 0, ',', '.') }}</td>
                                <td class="text-center">
                                    <span class="status-badge status-{{ strtolower(str_replace(' ', '', $order->status)) }}">{{ $order->status }}</span>
                                </td>
                                <td class="text-center text-muted" style="font-size:0.8rem;">{{ $order->created_at->format('d M Y') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <div class="mt-4 d-flex justify-content-center">
            {{ $orders->links() }}
        </div>
    @endif
</div>
@endsection
