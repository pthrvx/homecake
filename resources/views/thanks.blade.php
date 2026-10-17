@extends('layouts.app')
@section('title', 'Pesanan diterima')
@section('content')
<section class="mx-auto max-w-xl px-4 py-16 text-center">
  <div class="text-6xl" aria-hidden="true">🎉</div>
  <h1 class="mt-4 font-display text-4xl font-bold">Terima kasih, {{ session('order_name') }}!</h1>
  <p class="mt-3">Pesanan Anda sudah tercatat dengan status <strong>Baru</strong>.</p>

  <div class="mt-6 rounded-2xl border-2 border-dashed border-terra bg-white p-6">
    <p class="text-sm font-medium">Kode pesanan Anda</p>
    <p class="mt-1 select-all font-display text-4xl font-bold tracking-widest">{{ session('order_code') }}</p>
    <p class="mt-2 text-sm">Simpan atau screenshot kode ini. Anda membutuhkannya untuk mengecek status pesanan.</p>
  </div>

  <div class="mt-6 rounded-2xl bg-sage p-5 text-left text-sm">
    <p class="font-semibold">Apa yang terjadi selanjutnya?</p>
    <ol class="mt-2 list-decimal space-y-1 pl-5">
      <li>Admin HomeCake memeriksa pesanan Anda.</li>
      <li>Status pesanan diperbarui: Baru → Diproses → Selesai.</li>
      <li>Cek kapan saja di halaman <strong>Cek Pesanan</strong> dengan kode di atas dan nomor WhatsApp yang Anda isi.</li>
    </ol>
  </div>

  <div class="mt-6 flex flex-wrap justify-center gap-3">
    <x-button :href="route('track.form', ['kode' => session('order_code')])">Cek status pesanan</x-button>
    <x-button :href="route('home')" variant="outline">Ke beranda</x-button>
  </div>
</section>
@endsection
