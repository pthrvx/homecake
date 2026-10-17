@extends('layouts.app')
@section('title', 'Galeri')
@section('desc', 'Galeri foto kue dan dokumentasi kegiatan HomeCake.')
@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
  <h1 class="font-display text-4xl font-bold">Galeri</h1>
  <p class="mt-2 text-cocoa/80">Foto kue dan dokumentasi kegiatan HomeCake.</p>

  <h2 class="mt-10 font-display text-2xl font-bold">Foto produk</h2>
  @if($products->isEmpty())
    <p class="mt-4 rounded-2xl bg-white p-6">Belum ada foto produk.</p>
  @else
    <div class="gallery-grid mt-4 grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4">
      @foreach($products as $p)
        <a href="{{ route('product.show', $p) }}" class="gallery-tile group flex h-full flex-col overflow-hidden rounded-2xl bg-white">
          <img src="{{ $p->image_url }}" alt="{{ $p->name }}" loading="lazy" class="gallery-image aspect-square w-full object-cover motion-safe:transition motion-safe:group-hover:scale-105">
          <span class="gallery-caption block flex-1 p-3 text-sm font-medium">{{ $p->name }}</span>
        </a>
      @endforeach
    </div>
  @endif

  <h2 class="mt-12 font-display text-2xl font-bold">Dokumentasi kegiatan</h2>
  @if($photos->isEmpty())
    <p class="mt-4 rounded-2xl bg-white p-6">Belum ada foto dokumentasi.</p>
  @else
    <div class="gallery-grid mt-4 grid grid-cols-2 gap-3 md:grid-cols-3 lg:grid-cols-4">
      @foreach($photos as $f)
        <figure class="gallery-tile flex h-full flex-col overflow-hidden rounded-2xl bg-white">
          <img src="{{ $f->image_url }}" alt="{{ $f->caption }}" loading="lazy" class="gallery-image aspect-square w-full object-cover">
          <figcaption class="gallery-caption flex-1 p-3 text-sm">{{ $f->caption }}</figcaption>
        </figure>
      @endforeach
    </div>
  @endif
</section>
@endsection
