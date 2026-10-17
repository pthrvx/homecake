@extends('layouts.admin')
@section('title', 'Pesanan #'.$order->id)
@section('content')
<a href="{{ route('admin.orders.index') }}" class="text-sm underline">← Semua pesanan</a>
<h1 class="mt-2 font-display text-3xl font-bold">Pesanan #{{ $order->id }}</h1>
<dl class="mt-6 grid max-w-2xl gap-x-4 gap-y-3 rounded-2xl border border-cocoa/10 bg-white p-6 sm:grid-cols-[10rem_1fr]">
  <dt class="font-medium">Kode</dt><dd class="font-mono">{{ $order->code }}</dd>
  <dt class="font-medium">Nama</dt><dd>{{ $order->customer_name }}</dd>
  <dt class="font-medium">WhatsApp</dt><dd>{{ $order->whatsapp }} · <a class="underline" href="{{ $order->wa_link }}" target="_blank" rel="noopener">Buka WhatsApp</a></dd>
  <dt class="font-medium">Email</dt><dd>{{ $order->email ?: '-' }}</dd>
  <dt class="font-medium">Produk</dt><dd>{{ $order->product?->name ?? '(produk dihapus)' }}</dd>
  <dt class="font-medium">Jumlah</dt><dd>{{ $order->quantity }}</dd>
  <dt class="font-medium">Tanggal acara</dt><dd>{{ $order->event_date->format('d/m/Y') }}</dd>
  <dt class="font-medium">Catatan</dt><dd class="whitespace-pre-line">{{ $order->notes ?: '-' }}</dd>
  <dt class="font-medium">Dikirim</dt><dd>{{ $order->wib('created_at') }}</dd>
</dl>
<form method="POST" action="{{ route('admin.orders.update', $order) }}" class="mt-6 flex flex-wrap items-end gap-3">
  @csrf @method('PUT')
  <div><label for="status" class="mb-1 block text-sm font-medium">Ubah status</label>
    <select id="status" name="status" class="field">@foreach(\App\Models\Order::STATUSES as $s)<option @selected($order->status === $s)>{{ $s }}</option>@endforeach</select></div>
  <x-button>Simpan status</x-button>
</form>
<form method="POST" action="{{ route('admin.orders.destroy', $order) }}" class="mt-8" onsubmit="return confirm('Hapus pesanan ini?')">
  @csrf @method('DELETE')<button class="min-h-11 text-red-700 underline">Hapus pesanan</button>
</form>
@endsection
