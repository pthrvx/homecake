@extends('layouts.app')
@section('title', 'Menu')
@section('desc', 'Daftar kue rumahan HomeCake lengkap dengan harga dan ketersediaan.')
@section('content')
<section class="mx-auto max-w-6xl px-4 py-12">
  <h1 class="font-display text-4xl font-bold">Menu HomeCake</h1>
  <form method="GET" action="{{ route('menu') }}" class="mt-6 grid gap-3 sm:grid-cols-[1fr_14rem_auto]">
    <input type="search" name="q" value="{{ request('q') }}" placeholder="Cari kue…" aria-label="Cari kue" class="field">
    <select name="category" aria-label="Kategori" class="field">
      <option value="">Semua kategori</option>
      @foreach($categories as $c)<option value="{{ $c }}" @selected(request('category') === $c)>{{ $c }}</option>@endforeach
    </select>
    <x-button>Cari</x-button>
  </form>
  @if($products->isEmpty())
    <p class="mt-8 rounded-2xl bg-white p-6">Tidak ada kue yang cocok. <a class="underline" href="{{ route('menu') }}">Reset pencarian</a></p>
  @else
    <div class="mt-8 grid gap-6 sm:grid-cols-2 lg:grid-cols-3">@foreach($products as $p)<x-product-card :product="$p" />@endforeach</div>
  @endif
</section>
@endsection
