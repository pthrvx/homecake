<?php
namespace App\Http\Controllers;

use App\Http\Requests\OrderRequest;
use App\Models\GalleryPhoto;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class SiteController extends Controller
{
    public function home()
    {
        $featured = Product::where('is_featured', true)->where('is_available', true)->latest()->take(3)->get();
        return view('home', compact('featured'));
    }

    public function menu(Request $r)
    {
        $products = Product::query()
            ->when($r->q, fn ($q, $v) => $q->where('name', 'like', "%{$v}%"))
            ->when($r->category, fn ($q, $v) => $q->where('category', $v))
            ->orderByDesc('is_available')->latest()->get();
        $categories = Product::distinct()->orderBy('category')->pluck('category');
        return view('menu', compact('products', 'categories'));
    }

    public function gallery()
    {
        return view('gallery', [
            'products' => Product::whereNotNull('image_path')->latest()->get(),
            'photos' => GalleryPhoto::latest()->get(),
        ]);
    }

    public function about() { return view('about'); }

    public function show(Product $product) { return view('product', compact('product')); }

    public function orderForm(Request $r)
    {
        $products = Product::where('is_available', true)->orderBy('name')->get();
        $selected = Product::where('slug', $r->product)->value('id');
        $min = Order::earliestDate();
        return view('order', compact('products', 'selected') + [
            'minDate' => $min,
            'minDays' => (int) config('homecake.min_days'),
            'minLabel' => $min->copy()->locale('id')->translatedFormat('l, j F Y'),
            'token' => Crypt::encryptString((string) time()), // penanda waktu form dibuka (anti-spam)
        ]);
    }

    public function orderStore(OrderRequest $r)
    {
        $order = Order::create($r->validated() + ['status' => 'Baru']);
        return redirect()->route('order.thanks')->with(['order_name' => $order->customer_name, 'order_code' => $order->code]);
    }

    public function thanks()
    {
        if (! session('order_name')) return redirect()->route('home');
        session()->reflash(); // kode tetap tampil kalau halaman di-refresh
        return view('thanks');
    }
}
