@extends('layouts.app')
@section('title', $product->name)
@section('desc', \Illuminate\Support\Str::limit($product->description ?: 'Kue rumahan dari HomeCake.', 150))
@section('content')
<section class="mx-auto grid max-w-6xl gap-8 px-4 py-12 md:grid-cols-2">
  <div class="product-detail-media aspect-[4/3] overflow-hidden rounded-3xl bg-butter">
    @if($product->image_url)<img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-full w-full object-cover">
    @else<div class="flex h-full items-center justify-center text-7xl" aria-hidden="true">🍰</div>@endif
  </div>
  <div>
    <a href="{{ route('menu') }}" class="text-sm underline">← Kembali ke menu</a>
    <div class="mt-3 flex flex-wrap gap-2">
      <x-badge>{{ $product->category }}</x-badge>
      @unless($product->is_available)<x-badge tone="warn">Stok habis</x-badge>@endunless
      @if($product->is_sample)<x-badge tone="butter">Contoh data</x-badge>@endif
    </div>
    <h1 class="mt-3 font-display text-4xl font-bold">{{ $product->name }}</h1>
    <p class="mt-2 text-2xl font-bold text-terra">{{ $product->price_label }}</p>
    <p class="mt-4 whitespace-pre-line">{{ $product->description }}</p>
    <div class="mt-6">
      @if($product->is_available)<x-button :href="route('order.create', ['product' => $product->slug])">Pesan produk ini</x-button>
      @else<p class="inline-block rounded-full bg-cocoa/10 px-6 py-2.5 font-semibold">Tidak tersedia</p>@endif
    </div>
  </div>
</section>
@endsection
