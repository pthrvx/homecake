<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
   public function index()
{
    $products = Product::latest()->paginate(10);

    return view('admin.products.index', compact('products'));
}

    public function create() { return view('admin.products.form', ['product' => new Product(['is_available' => true])]); }

    public function store(ProductRequest $r)
    {
        $data = $r->safe()->except('image');
        $data['slug'] = Str::slug($data['name']).'-'.Str::lower(Str::random(4));
        if ($r->hasFile('image')) $data['image_path'] = $r->file('image')->store('products', 'public');
        Product::create($data);
        return redirect()->route('admin.products.index')->with('ok', 'Produk ditambahkan.');
    }

    public function edit(Product $product) { return view('admin.products.form', compact('product')); }

    public function update(ProductRequest $r, Product $product)
    {
        $data = $r->safe()->except('image') + ['is_sample' => false]; // sudah diedit admin = bukan contoh lagi
        if ($r->hasFile('image')) {
            $this->deleteImage($product);
            $data['image_path'] = $r->file('image')->store('products', 'public');
        }
        $product->update($data);
        return redirect()->route('admin.products.index')->with('ok', 'Produk diperbarui.');
    }

    public function destroy(Product $product)
    {
        $this->deleteImage($product);
        $product->delete();
        return redirect()->route('admin.products.index')->with('ok', 'Produk dihapus.');
    }

    private function deleteImage(Product $product): void
    {
        if ($product->image_path) Storage::disk('public')->delete($product->image_path);
    }
}
