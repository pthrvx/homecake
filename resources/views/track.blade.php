@extends('layouts.app')
@section('title', 'Cek Pesanan')
@section('desc', 'Cek status pesanan HomeCake dengan kode pesanan dan nomor WhatsApp, tanpa perlu login.')
@section('content')
<section class="mx-auto max-w-2xl px-4 py-12">
@isset($order)
  @php
    $info = \App\Models\Order::STATUS_INFO[$order->status] ?? \App\Models\Order::STATUS_INFO['Baru'];
    $bg = ['Baru' => 'bg-butter', 'Diproses' => 'bg-sage', 'Selesai' => 'bg-sage', 'Dibatalkan' => 'bg-red-100'][$order->status] ?? 'bg-butter';
    $steps = ['Baru' => 'Diterima', 'Diproses' => 'Diproses', 'Selesai' => 'Selesai'];
    $idx = $order->status === 'Selesai' ? 3 : (int) array_search($order->status, array_keys($steps));
  @endphp
  <p class="text-sm font-medium">Kode pesanan</p>
  <h1 class="font-display text-3xl font-bold tracking-widest">{{ $order->code }}</h1>

  <div class="mt-6 rounded-2xl p-6 {{ $bg }}" role="status">
    <p class="text-4xl" aria-hidden="true">{{ $info['icon'] }}</p>
    <h2 class="mt-2 font-display text-2xl font-bold">{{ $info['title'] }}</h2>
    <p class="mt-2">{{ $info['text'] }}</p>
    <p class="mt-3 text-sm"><strong>Langkah berikutnya:</strong> {{ $info['next'] }}</p>
    <p class="mt-3 text-xs text-cocoa/70">Terakhir diperbarui {{ $order->wib('updated_at') }}. Status diubah manual oleh admin, jadi bisa ada jeda.</p>
  </div>

  @if($order->status !== 'Dibatalkan')
  <ol class="mt-6 grid grid-cols-3 gap-2 text-center text-sm" aria-label="Tahapan pesanan">
    @foreach($steps as $label)
      @php $state = $loop->index < $idx ? 'done' : ($loop->index === $idx ? 'now' : 'todo'); @endphp
      <li @if($state === 'now') aria-current="step" @endif
          class="rounded-xl border p-3 {{ $state === 'todo' ? 'border-cocoa/15 text-cocoa/50' : ($state === 'now' ? 'border-terra bg-terra font-bold text-white' : 'border-sage bg-sage') }}">
        <span class="block text-lg" aria-hidden="true">{{ $state === 'done' ? '✓' : $loop->iteration }}</span>
        {{ $label }}
        <span class="sr-only">{{ ['done' => '(sudah dilewati)', 'now' => '(tahap sekarang)', 'todo' => '(belum)'][$state] }}</span>
      </li>
    @endforeach
  </ol>
  @endif

  <h2 class="mt-8 font-display text-xl font-bold">Ringkasan pesanan</h2>
  <dl class="mt-3 grid gap-x-4 gap-y-3 rounded-2xl border border-cocoa/10 bg-white p-5 sm:grid-cols-[11rem_1fr]">
    <dt class="font-medium">Atas nama</dt><dd>{{ $order->customer_name }}</dd>
    <dt class="font-medium">Produk</dt><dd>{{ $order->product?->name ?? '(produk sudah tidak ada di menu)' }}</dd>
    <dt class="font-medium">Jumlah</dt><dd>{{ $order->quantity }}</dd>
    <dt class="font-medium">Tanggal acara / pengambilan</dt><dd>{{ $order->event_date_label }}</dd>
    <dt class="font-medium">Dipesan pada</dt><dd>{{ $order->wib('created_at') }}</dd>
    <dt class="font-medium">Catatan Anda</dt><dd class="whitespace-pre-line">{{ $order->notes ?: '-' }}</dd>
  </dl>

  <div class="mt-6 rounded-2xl border border-cocoa/10 bg-white p-5">
    <h2 class="font-display text-lg font-bold">Ada yang ingin diubah atau ditanyakan?</h2>
    @if(config('homecake.wa'))
      <p class="mt-1 text-sm">Hubungi HomeCake dan sebutkan kode pesanan Anda.</p>
      <x-button class="mt-3" :href="'https://wa.me/'.config('homecake.wa').'?text='.rawurlencode('Halo HomeCake, saya ingin menanyakan pesanan '.$order->code)" target="_blank" rel="noopener">Chat via WhatsApp</x-button>
    @else
      <p class="mt-1 text-sm">Sebutkan kode <strong>{{ $order->code }}</strong> saat menghubungi HomeCake.</p>
    @endif
  </div>

  <div class="mt-8 flex flex-wrap gap-3">
    <x-button :href="route('track.form')" variant="outline">Cek pesanan lain</x-button>
    <x-button :href="route('menu')">Lihat menu</x-button>
  </div>
@else
  <h1 class="font-display text-4xl font-bold">Cek status pesanan</h1>
  <p class="mt-2 text-cocoa/80">Tanpa login. Cukup isi dua data ini:</p>
  <ol class="mt-4 space-y-2 text-sm">
    <li><strong>1. Kode pesanan</strong>: muncul di halaman konfirmasi setelah Anda memesan (contoh: HC-A7K2Q9).</li>
    <li><strong>2. Nomor WhatsApp</strong>: nomor yang Anda isi saat memesan.</li>
  </ol>
  @error('lookup')<div role="alert" class="mt-6 rounded-xl bg-red-100 p-4 text-red-800">{{ $message }}</div>@enderror
  <form method="POST" action="{{ route('track.check') }}" class="mt-6 space-y-5"
        onsubmit="const b=this.querySelector('button[type=submit]');b.disabled=true;b.textContent='Mencari…'">
    @csrf
    <x-input name="code" label="Kode pesanan" :value="$code ?? null" placeholder="HC-A7K2Q9" required maxlength="20" autocomplete="off" autocapitalize="characters" class="uppercase" />
    <x-input name="whatsapp" label="Nomor WhatsApp" type="tel" placeholder="081234567890" required autocomplete="tel" />
    <x-button class="w-full">Cek status</x-button>
  </form>
  <p class="mt-6 text-sm text-cocoa/80">Lupa kode? Hubungi HomeCake
    @if(config('homecake.wa'))lewat <a class="underline" href="https://wa.me/{{ config('homecake.wa') }}" target="_blank" rel="noopener">WhatsApp</a>@endif
    dan sebutkan nama serta tanggal acara Anda.</p>
@endisset
</section>
@endsection
