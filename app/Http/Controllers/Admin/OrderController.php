<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class OrderController extends Controller
{
    public function index(Request $r)
    {
        $orders = Order::with('product')
            ->when($r->status, fn ($q, $s) => $q->where('status', $s))
            ->latest()->paginate(20)->withQueryString();
        $counts = Order::selectRaw('status, count(*) as total')->groupBy('status')->pluck('total', 'status');
        return view('admin.orders.index', compact('orders', 'counts'));
    }

    public function show(Order $order) { return view('admin.orders.show', compact('order')); }

    public function update(Request $r, Order $order)
    {
        $order->update($r->validate(['status' => ['required', Rule::in(Order::STATUSES)]]));
        return back()->with('ok', 'Status pesanan diperbarui.');
    }

    public function destroy(Order $order)
    {
        $order->delete();
        return redirect()->route('admin.orders.index')->with('ok', 'Pesanan dihapus.');
    }
}
