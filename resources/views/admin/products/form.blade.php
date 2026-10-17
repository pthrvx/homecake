@extends('layouts.admin')
@section('title', $product->exists ? 'Ubah produk' : 'Tambah produk')
@section('content')
<h1 class="font-display text-3xl font-bold">{{ $product->exists ? 'Ubah produk' : 'Tambah produk' }}</h1>
<form method="POST" enctype="multipart/form-data" class="mt-6 max-w-2xl space-y-5"
      action="{{ $product->exists ? route('admin.products.update', $product) : route('admin.products.store') }}">
  @csrf
  @if($product->exists) @method('PUT') @endif
  <x-input name="name" label="Nama produk" :value="$product->name" required maxlength="120" />
  <div>
    <label for="description" class="mb-1 block text-sm font-medium">Deskripsi</label>
    <textarea id="description" name="description" rows="4" class="field">{{ old('description', $product->description) }}</textarea>
    @error('description')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
  </div>
  <x-input name="price" label="Harga (Rp)" type="number" :value="$product->price" min="0" required />
  <x-input name="category" label="Kategori" :value="$product->category" list="kategori" required maxlength="60" />
  <datalist id="kategori">@foreach(\App\Models\Product::distinct()->pluck('category') as $c)<option value="{{ $c }}">@endforeach</datalist>
  <div>
    <label for="image" class="mb-1 block text-sm font-medium">Foto (jpg/png/webp, maks 2 MB)</label>
    @if($product->image_url)<img src="{{ $product->image_url }}" alt="Foto {{ $product->name }}" class="mb-2 h-28 rounded-xl object-cover">@endif
    <input id="image" name="image" type="file" accept="image/jpeg,image/png,image/webp" class="field">
    @error('image')<p class="mt-1 text-sm text-red-700">{{ $message }}</p>@enderror
  </div>
  <label class="flex min-h-11 items-center gap-3"><input type="hidden" name="is_available" value="0"><input type="checkbox" name="is_available" value="1" class="size-5" @checked(old('is_available', $product->is_available))> Tersedia</label>
  <label class="flex min-h-11 items-center gap-3"><input type="hidden" name="is_featured" value="0"><input type="checkbox" name="is_featured" value="1" class="size-5" @checked(old('is_featured', $product->is_featured))> Produk unggulan (tampil di beranda)</label>
  <div class="flex gap-3"><x-button>Simpan</x-button><x-button :href="route('admin.products.index')" variant="outline">Batal</x-button></div>
</form>
@endsection
