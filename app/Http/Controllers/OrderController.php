<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function checkout()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda masih kosong.');
        }

        $total = $cartItems->sum(fn($item) => $item->product->price * $item->quantity);

        return view('cart.checkout', compact('cartItems', 'total'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'shipping_address' => 'required|string|min:10',
        ]);

        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Keranjang Anda masih kosong.');
        }

        foreach ($cartItems as $item) {
            if ($item->product->stock < $item->quantity) {
                return back()->with('error', "Stok '{$item->product->name}' tidak mencukupi.");
            }
        }

        foreach ($cartItems as $item) {
            Order::create([
                'user_id' => Auth::id(),
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'total_price' => $item->product->price * $item->quantity,
                'status' => 'Pending',
                'shipping_address' => $request->shipping_address,
            ]);

            $item->product->decrement('stock', $item->quantity);
        }

        Cart::where('user_id', Auth::id())->delete();

        return redirect()->route('orders.index')->with('success', 'Pesanan berhasil dibuat! Terima kasih sudah berbelanja.');
    }

    public function index()
    {
        $orders = Order::with('product')
            ->where('user_id', Auth::id())
            ->latest()
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function adminIndex()
    {
        $orders = Order::with(['user', 'product'])->latest()->paginate(15);

        $totalSales = Order::where('status', 'Selesai')->sum('total_price');
        $pendingCount = Order::where('status', 'Pending')->count();
        $completedCount = Order::where('status', 'Selesai')->count();
        $cancelledCount = Order::where('status', 'Dibatalkan')->count();

        return view('admin.orders.index', compact(
            'orders', 'totalSales', 'pendingCount', 'completedCount', 'cancelledCount'
        ));
    }

    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:Pending,Diproses,Selesai,Dibatalkan',
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return back()->with('success', 'Status pesanan berhasil diperbarui.');
    }
}
