@extends('layouts.app')
@section('title', 'Tentang')
@section('desc', 'Kenali HomeCake: kue rumahan untuk acara sederhana, nilai kami, dan cara memesan.')
@section('content')
{{-- GANTI teks di halaman ini dengan kisah asli HomeCake (awal usaha, proses pembuatan, dll.) --}}
<section class="mx-auto max-w-6xl px-4 py-12">
  <div class="about-hero-image"><img src="https://images.unsplash.com/photo-1556911220-e15b29be8c8f?auto=format&amp;fit=crop&amp;w=1500&amp;q=80" alt="Inspirasi dapur rumahan" loading="lazy"><div><p class="eyebrow eyebrow-light">CERITA DI BALIK SETIAP GIGITAN</p><h1 class="font-display text-4xl font-bold text-white md:text-5xl">Tentang HomeCake</h1><p class="mt-3 max-w-xl text-white/85">Kue rumahan untuk momen sederhana yang layak dirayakan.</p></div></div>
  <div class="mx-auto max-w-3xl">
  <p class="mt-4 text-lg text-cocoa/80">HomeCake adalah usaha kue rumahan untuk acara sederhana: ulang tahun, arisan, rapat, syukuran, dan kumpul keluarga.</p>

  <h2 class="mt-10 font-display text-2xl font-bold">Cerita kami</h2>
  <p class="mt-3">Kami membuat kue di dapur rumah. Tujuan kami sederhana: memesan kue harus terasa mudah, harganya jelas, dan Anda selalu tahu perkembangan pesanan Anda.</p>

  <h2 class="mt-10 font-display text-2xl font-bold">Yang kami pegang</h2>
  <div class="mt-4 grid gap-4 sm:grid-cols-3">
    <div class="rounded-2xl bg-sage p-5"><h3 class="font-display text-lg font-bold">Jujur dan jelas</h3><p class="mt-1 text-sm">Harga, stok, dan status pesanan ditampilkan apa adanya.</p></div>
    <div class="rounded-2xl bg-butter p-5"><h3 class="font-display text-lg font-bold">Ramah</h3><p class="mt-1 text-sm">Pesanan kecil dan acara sederhana sama pentingnya.</p></div>
    <div class="rounded-2xl bg-sage p-5"><h3 class="font-display text-lg font-bold">Sesuai acara</h3><p class="mt-1 text-sm">Kue disiapkan sesuai tanggal acara atau pengambilan yang Anda pilih.</p></div>
  </div>

  <h2 class="mt-10 font-display text-2xl font-bold">Cara memesan</h2>
  <ol class="mt-3 list-decimal space-y-2 pl-5">
    <li>Pilih kue di <a class="underline" href="{{ route('menu') }}">menu</a>.</li>
    <li>Isi form pesanan, termasuk tanggal acara atau pengambilan.@if(config('homecake.min_days') > 0) Pesan minimal <strong>{{ config('homecake.min_days') }} hari</strong> sebelumnya agar kue sempat disiapkan.@endif</li>
    <li>Simpan <strong>kode pesanan</strong> yang muncul setelah memesan.</li>
    <li>Pantau status di <a class="underline" href="{{ route('track.form') }}">Cek Pesanan</a>, tanpa perlu login.</li>
  </ol>

  <div class="mt-10 flex flex-wrap gap-3">
    <x-button :href="route('menu')">Lihat Menu</x-button>
    <x-button :href="route('order.create')" variant="outline">Pesan Sekarang</x-button>
  </div>
  </div>
</section>
@endsection
