@props(['product'])
<article class="product-card-shell flex flex-col overflow-hidden rounded-2xl border border-cocoa/10 bg-white">
  <a href="{{ route('product.show', $product) }}" aria-label="Lihat {{ $product->name }}" class="product-card-media block aspect-[4/3] bg-butter">
    @if($product->image_url)<img src="{{ $product->image_url }}" alt="{{ $product->name }}" loading="lazy" class="h-full w-full object-cover {{ $product->is_available ? '' : 'opacity-60' }}">
    @else<span class="flex h-full items-center justify-center text-5xl" aria-hidden="true">🍰</span>@endif
  </a>
  <div class="flex flex-1 flex-col gap-2 p-4">
    <div class="flex flex-wrap gap-2">
      <x-badge>{{ $product->category }}</x-badge>
      @unless($product->is_available)<x-badge tone="warn">Stok habis</x-badge>@endunless
      @if($product->is_sample)<x-badge tone="butter">Contoh data</x-badge>@endif
    </div>
    <h3 class="product-card-title font-display text-xl font-bold"><a href="{{ route('product.show', $product) }}">{{ $product->name }}</a></h3>
    <p class="product-card-description text-sm text-cocoa/75">{{ \Illuminate\Support\Str::limit($product->description, 90) }}</p>
    <p class="mt-auto pt-2 text-lg font-bold">{{ $product->price_label }}</p>
    @if($product->is_available)<x-button :href="route('order.create', ['product' => $product->slug])">Pesan produk ini</x-button>
    @else<p class="rounded-full bg-cocoa/10 py-2.5 text-center text-sm font-semibold">Tidak tersedia</p>@endif
  </div>
</article>
